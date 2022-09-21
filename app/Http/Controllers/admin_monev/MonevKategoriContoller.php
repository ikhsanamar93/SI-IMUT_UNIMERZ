<?php

namespace App\Http\Controllers\admin_monev;

use App\Http\Controllers\Controller;
use App\Models\MonevKategori;
use Illuminate\Http\Request;

class MonevKategoriContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MonevKategoris = MonevKategori::all();
        return view('admin_monev.monev_kategori', compact('MonevKategoris'));
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
        MonevKategori::create([
            'nm_jenis_monev' => $request->nm_jenis_monev,
            'no_jenis_monev' => $request->no_jenis_monev,
            'ket' => $request->ket
        ]);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('monev_kategori.index')->with($message);
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
        $MonevKategoris = MonevKategori::find($id);
        $url = Route('monev_kategori.update', $MonevKategoris->id);
        return response()->json($MonevKategoris);
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
        $MonevKategoris = MonevKategori::find($id);
        $MonevKategoris->nm_jenis_monev = $request->nm_jenis_monev;
        $MonevKategoris->no_jenis_monev = $request->no_jenis_monev;
        $MonevKategoris->ket = $request->ket;
        $MonevKategoris->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('monev_kategori.index')->with($message);
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
