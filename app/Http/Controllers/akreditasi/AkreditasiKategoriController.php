<?php

namespace App\Http\Controllers\akreditasi;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiKategori;
use App\Models\AkreditasiMaster;
use Illuminate\Http\Request;

class AkreditasiKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AkreditasiKategoris = AkreditasiKategori::all();
        return view('akreditasi.kategori', compact('AkreditasiKategoris'));
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
        AkreditasiKategori::create([
            'nm_kategori' => $request->nm_kategori,
            'no_kategori' => $request->no_kategori,
            'ket' => $request->ket
        ]);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('akreditasi_kategori.index')->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $AkreditasiMasters = AkreditasiMaster::with(['akreditasi_kategori', 'monev_kategori'])->where('akreditasi_kategori_id', decrypt($id))->orderby('monev_kategori_id', 'ASC')->get();
        $data = decrypt($id);
        return view('akreditasi.master.index_master', compact('AkreditasiMasters', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AkreditasiKategoris = AkreditasiKategori::find($id);
        $url = Route('akreditasi_kategori.update', $AkreditasiKategoris->id);
        return response()->json($AkreditasiKategoris);
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
        $AkreditasiKategoris = AkreditasiKategori::find($id);
        $AkreditasiKategoris->nm_kategori = $request->nm_kategori;
        $AkreditasiKategoris->no_kategori = $request->no_kategori;
        $AkreditasiKategoris->ket = $request->ket;
        $AkreditasiKategoris->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('akreditasi_kategori.index')->with($message);
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
