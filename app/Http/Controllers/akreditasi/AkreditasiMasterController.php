<?php

namespace App\Http\Controllers\akreditasi;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiKategori;
use App\Models\AkreditasiMaster;
use App\Models\MonevKategori;
use Illuminate\Http\Request;

class AkreditasiMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return ('Oke');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $MonevKategoris = MonevKategori::all();
        $AkreditasiKategoris = AkreditasiKategori::find(decrypt($id));
        return view('akreditasi.master.add_master', compact('AkreditasiKategoris', 'MonevKategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'akreditasi_kategori_id' => 'required',
            'monev_kategori_id' => 'required',
            'jenis_dokumen' => 'required',
            'no_akreditasi_master' => 'required',
            'elemen' => 'nullable',
            'indikator' => 'required',
            'indikator_4' => 'required',
            'indikator_3' => 'nullable',
            'indikator_2' => 'nullable',
            'indikator_1' => 'nullable',
            'dokumen_terkait' => 'nullable',
            'bobot_penilaian' => 'required'
        ]);

        AkreditasiMaster::create($validasi);
        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('akreditasi_kategori.show', encrypt($request->akreditasi_kategori_id))->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AkreditasiMasters = AkreditasiMaster::find(decrypt($id));
        $MonevKategoris = MonevKategori::all();
        $AkreditasiKategoris = AkreditasiKategori::where('id', $AkreditasiMasters->akreditasi_kategori_id)->first();
        return view('akreditasi.master.edit_master', compact('AkreditasiMasters', 'AkreditasiKategoris', 'MonevKategoris'));
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
        $validasi = $request->validate([
            'akreditasi_kategori_id' => 'required',
            'monev_kategori_id' => 'required',
            'jenis_dokumen' => 'required',
            'no_akreditasi_master' => 'required',
            'elemen' => 'nullable',
            'indikator' => 'required',
            'indikator_4' => 'required',
            'indikator_3' => 'nullable',
            'indikator_2' => 'nullable',
            'indikator_1' => 'nullable',
            'dokumen_terkait' => 'nullable',
            'bobot_penilaian' => 'required'
        ]);

        AkreditasiMaster::where('id', decrypt($id))->update($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('akreditasi_kategori.show', encrypt($request->akreditasi_kategori_id))->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
