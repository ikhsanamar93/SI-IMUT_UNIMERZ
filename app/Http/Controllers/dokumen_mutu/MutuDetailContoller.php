<?php

namespace App\Http\Controllers\dokumen_mutu;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiMasterDokumen;
use App\Models\MutuDetailDokumen;
use App\Models\MutuDokumen;
use App\Models\MutuMasterDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MutuDetailContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'mutu_master_dokumen_id' => 'required',
            'mutu_dokumen_id' => 'required',
            'nm_detail_dokumen_mutu' => 'required',
            'unit_master_id' => 'required',
            'mutu_periode_id' => 'required',
            'link_dokumen' => 'nullable|url',
            'file_dokumen' => 'mimes:pdf|file|max:5120'
        ]);

        $file_dokumen = null;
        if ($request->file('file_dokumen')) {
            $file_dokumen = $request->file_dokumen->store('Dok_Mutu');
        }

        MutuDetailDokumen::create([
            'mutu_dokumen_id' => $request->mutu_dokumen_id,
            'mutu_master_dokumen_id' => $request->mutu_master_dokumen_id,
            'nm_detail_dokumen_mutu' => $request->nm_detail_dokumen_mutu,
            'mutu_periode_id' => $request->mutu_periode_id,
            'unit_master_id' => $request->unit_master_id,
            'file_dokumen' => $file_dokumen,
            'link_dokumen' => $request->link_dokumen
        ]);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('mutu_detail_dokumen.show', encrypt($request->mutu_master_dokumen_id))->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $MutuDokumens = MutuDokumen::where('jenis_dokumen_mutu', 'Dokumen Kinerja')->get();
        $MutuMasterDokumens = MutuMasterDokumen::find(decrypt($id));
        $MutuDetailDokumens = MutuDetailDokumen::where('mutu_master_dokumen_id', decrypt($id))->get();
        return view('dokumen_mutu.upload_dokumen', compact('MutuDokumens', 'MutuMasterDokumens', 'MutuDetailDokumens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $MutuDetailDokumens = MutuDetailDokumen::find($id);
        $url = Route('mutu_detail_dokumen.update', $MutuDetailDokumens->id);
        return response()->json($MutuDetailDokumens);
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
        $MutuDetailDokumens = MutuDetailDokumen::find($id);

        $request->validate([
            'mutu_dokumen_id_m' => 'required',
            'mutu_master_dokumen_id_m' => 'required',
            'nm_detail_dokumen_mutu_m' => 'required',
            'unit_master_id_m' => 'required',
            'mutu_periode_id_m' => 'required',
            'link_dokumen_m' => 'nullable|url',
            'file_dokumen_m' => 'mimes:pdf|file|max:5120'
        ]);

        $file_dokumen = null;
        if ($request->file('file_dokumen_m')) {
            if ($request->old_file) {
                Storage::delete($request->old_file);
            }
            $file_dokumen = $request->file_dokumen_m->store('Dok_Mutu');
        } else {
            $file_dokumen = $request->old_file;
        }
        //return $file_dokumen;
        $MutuDetailDokumens->mutu_dokumen_id = $request->mutu_dokumen_id_m;
        $MutuDetailDokumens->mutu_master_dokumen_id = $request->mutu_master_dokumen_id_m;
        $MutuDetailDokumens->nm_detail_dokumen_mutu = $request->nm_detail_dokumen_mutu_m;
        $MutuDetailDokumens->unit_master_id = $request->unit_master_id_m;
        $MutuDetailDokumens->mutu_periode_id = $request->mutu_periode_id_m;
        $MutuDetailDokumens->file_dokumen = $file_dokumen;
        $MutuDetailDokumens->link_dokumen = $request->link_dokumen_m;
        $MutuDetailDokumens->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('mutu_detail_dokumen.show', encrypt($request->mutu_master_dokumen_id_m))->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $MutuDetailDokumens = MutuDetailDokumen::find($id);
        $AkreditasiMasterDokumens = AkreditasiMasterDokumen::where('mutu_detail_dokumen_id', $id)->first();

        DB::beginTransaction();
        if ($MutuDetailDokumens->file_dokumen) {
            Storage::delete($MutuDetailDokumens->file_dokumen);
        }

        $MutuDetailDokumens::destroy($id);
        if ($AkreditasiMasterDokumens != null) {
            $AkreditasiMasterDokumens->delete();
        }
        DB::commit();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Telah di Hapus.'
        ];

        return redirect()->route('mutu_detail_dokumen.show', encrypt($MutuDetailDokumens->mutu_master_dokumen_id))->with($message);
    }
}
