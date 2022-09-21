<?php

namespace App\Http\Controllers\dokumen_induk;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiMasterDokumen;
use App\Models\IndukMasterDokumen;
use App\Models\MutuDokumen;
use App\Models\UnitMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndukMasterContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::with(['unit_pengelola'])->orderby('unit_kategori_id', 'asc')->get();
        return view('dokumen_induk.home_induk', compact('UnitMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_dokumen_induk' => 'required',
            'no_dokumen_induk' => 'nullable|max:30',
            'mutu_dokumen_id' => 'required',
            'unit_master_id' => 'required',
            'link_dokumen' => 'nullable|url',
            'file_dokumen' => 'nullable|mimes:pdf|file|max:5120',
            'status' => 'nullable|max:1'
        ]);

        $data = Crypt::encrypt($request->unit_master_id);

        $file_dokumen = null;
        if ($request->file('file_dokumen')) {
            $file_dokumen = $request->file_dokumen->store('Dok_Induk');
        }

        IndukMasterDokumen::create([
            'nm_dokumen_induk' => $request->nm_dokumen_induk,
            'no_dokumen_induk' => $request->no_dokumen_induk,
            'mutu_dokumen_id' => $request->mutu_dokumen_id,
            'unit_master_id' => $request->unit_master_id,
            'link_dokumen' => $request->link_dokumen,
            'file_dokumen' => $file_dokumen,
            'status' => $request->status
        ]);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('induk_master_dokumen.show', $data)->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $UnitMasters = UnitMaster::where('id', decrypt($id))->get();
        $MutuDokumens = MutuDokumen::where('jenis_dokumen_mutu', 'Dokumen Induk')->get();
        $IndukMasterDokumens = IndukMasterDokumen::with(['unit_master', 'mutu_dokumen'])->where('unit_master_id', decrypt($id))->orderby('mutu_dokumen_id', 'asc')->get();
        return view('dokumen_induk.index_induk', compact('UnitMasters', 'MutuDokumens', 'IndukMasterDokumens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $IndukMasterDokumens = IndukMasterDokumen::find($id);
        $url = Route('induk_master_dokumen.update', $IndukMasterDokumens->id);
        return response()->json($IndukMasterDokumens);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $IndukMasterDokumens = IndukMasterDokumen::find($id);
        $data = Crypt::encrypt($request->unit_master_id_m);

        $request->validate([
            'nm_dokumen_induk_m' => 'required',
            'no_dokumen_induk_m' => 'nullable|max:30',
            'mutu_dokumen_id_m' => 'required',
            'unit_master_id_m' => 'required',
            'link_dokumen_m' => 'nullable|url',
            'file_dokumen_m' => 'nullable|mimes:pdf|file|max:5120',
            'status_m' => 'nullable|max:1'
        ]);

        $file_dokumen = null;
        if ($request->file('file_dokumen_m')) {
            if ($request->old_file) {
                Storage::delete($request->old_file);
            }
            $file_dokumen = $request->file_dokumen_m->store('Dok_Induk');
        } else {
            $file_dokumen = $request->old_file;
        }

        $IndukMasterDokumens->nm_dokumen_induk = $request->nm_dokumen_induk_m;
        $IndukMasterDokumens->no_dokumen_induk = $request->no_dokumen_induk_m;
        $IndukMasterDokumens->mutu_dokumen_id = $request->mutu_dokumen_id_m;
        $IndukMasterDokumens->unit_master_id = $request->unit_master_id_m;
        $IndukMasterDokumens->file_dokumen = $file_dokumen;
        $IndukMasterDokumens->link_dokumen = $request->link_dokumen_m;
        $IndukMasterDokumens->status = $request->status_m;
        $IndukMasterDokumens->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('induk_master_dokumen.show', $data)->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $IndukMasterDokumens = IndukMasterDokumen::find($id);
        $AkreditasiMasterDokumens = AkreditasiMasterDokumen::where('induk_master_dokumen_id', $id)->first();

        $data = Crypt::encrypt($IndukMasterDokumens->unit_master_id);

        DB::beginTransaction();

        if ($IndukMasterDokumens->file_dokumen) {
            Storage::delete($IndukMasterDokumens->file_dokumen);
        }

        $IndukMasterDokumens::destroy($id);

        if ($AkreditasiMasterDokumens != null) {
            $AkreditasiMasterDokumens->delete();
        }

        DB::commit();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Telah di Hapus.'
        ];

        return redirect()->route('induk_master_dokumen.show', $data)->with($message);
    }
}
