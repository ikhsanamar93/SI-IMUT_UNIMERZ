<?php

namespace App\Http\Controllers\dokumen_spmi;

use App\Http\Controllers\Controller;
use App\Models\MutuKategori;
use App\Models\SpmiDetailDokumen;
use App\Models\SpmiMasterDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class SpmiDetailContoller extends Controller
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
            'spmi_master_dokumen_id' => 'required',
            'nm_detail_spmi' => 'required',
            'no_detail_spmi' => 'required|max:20',
            'mutu_kategori_id' => 'required',
            'unit_master_id' => 'required',
            'file_spmi' => 'mimes:pdf|file|max:5120',
            'link_spmi' => 'nullable|url'
        ]);

        $file_spmi = null;
        if ($request->file('file_spmi')) {
            $file_spmi = $request->file_spmi->store('Dok_SPMI');
        }

        SpmiDetailDokumen::create([
            'spmi_master_dokumen_id' => decrypt($request->spmi_master_dokumen_id),
            'nm_detail_spmi' => $request->nm_detail_spmi,
            'no_detail_spmi' => $request->no_detail_spmi,
            'mutu_kategori_id' => $request->mutu_kategori_id,
            'unit_master_id' => $request->unit_master_id,
            'file_spmi' => $file_spmi,
            'link_spmi' => $request->link_spmi
        ]);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('spmi_dokumen.show', $request->spmi_master_dokumen_id)->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $SpmiMasterDokumens = SpmiMasterDokumen::find(decrypt($id));
        // dd($SpmiMasterDokumens);
        //$sistem_id = $SpmiMasterDokumens->mutu_sistem_id;
        $MutuKategoris = MutuKategori::where('mutu_sistem_id', $SpmiMasterDokumens->mutu_sistem_id)->get();
        $SpmiDetailDokumens = SpmiDetailDokumen::with(['mutu_kategori'])->where('spmi_master_dokumen_id', decrypt($id))->orderby('mutu_kategori_id', 'asc')->get();
        return view('dokumen_spmi.upload_spmi', compact('MutuKategoris', 'SpmiDetailDokumens', 'SpmiMasterDokumens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SpmiDetailDokumens = SpmiDetailDokumen::find($id);
        $url = Route('spmi_dokumen.update', $SpmiDetailDokumens->id);
        return response()->json($SpmiDetailDokumens);
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
        $SpmiDetailDokumens = SpmiDetailDokumen::find($id);

        $request->validate([
            'spmi_master_dokumen_id_m' => 'required',
            'nm_detail_spmi_m' => 'required',
            'no_detail_spmi_m' => 'required|max:20',
            'mutu_kategori_id_m' => 'required',
            'unit_master_id_m' => 'required',
            'file_spmi_m' => 'mimes:pdf|file|max:5120',
            'link_spmi_m' => 'nullable|url'
        ]);

        $data = Crypt::encrypt($request->spmi_master_dokumen_id_m);

        $file_spmi = null;
        if ($request->file('file_spmi_m')) {
            if ($request->old_file) {
                Storage::delete($request->old_file);
            }
            $file_spmi = $request->file_spmi_m->store('Dok_SPMI');
        } else {
            $file_spmi = $request->old_file;
        }

        $SpmiDetailDokumens->spmi_master_dokumen_id = $request->spmi_master_dokumen_id_m;
        $SpmiDetailDokumens->nm_detail_spmi = $request->nm_detail_spmi_m;
        $SpmiDetailDokumens->no_detail_spmi = $request->no_detail_spmi_m;
        $SpmiDetailDokumens->mutu_kategori_id = $request->mutu_kategori_id_m;
        $SpmiDetailDokumens->unit_master_id = $request->unit_master_id_m;
        $SpmiDetailDokumens->file_spmi = $file_spmi;
        $SpmiDetailDokumens->link_spmi = $request->link_spmi_m;
        $SpmiDetailDokumens->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('spmi_dokumen.show', $data)->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SpmiDetailDokumens = SpmiDetailDokumen::find($id);
        $data = Crypt::encrypt($SpmiDetailDokumens->spmi_master_dokumen_id);
        if ($SpmiDetailDokumens->file_spmi) {
            Storage::delete($SpmiDetailDokumens->file_spmi);
        }

        $SpmiDetailDokumens::destroy($id);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Telah di Hapus.'
        ];

        return redirect()->route('spmi_dokumen.show', $data)->with($message);
    }
}
