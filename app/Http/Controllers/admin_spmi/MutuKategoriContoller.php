<?php

namespace App\Http\Controllers\admin_spmi;

use App\Http\Controllers\Controller;
use App\Models\MutuKategori;
use App\Models\MutuSistem;
use Illuminate\Http\Request;

class MutuKategoriContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MutuSistems = MutuSistem::orderBy('id', 'asc')->get();
        $MutuKategoris = MutuKategori::with(['mutu_sistem'])->get();
        return view('admin_spmi.mutu_kategori', compact('MutuSistems', 'MutuKategoris'));
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
        $validasi = $request->validate([
            'mutu_sistem_id' => 'required',
            'nm_kategori_mutu' => 'required|unique:mutu_kategoris,nm_kategori_mutu',
            'no_kategori_mutu' => 'max:20',
            'ket' => 'max:255'
        ]);

        MutuKategori::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('kategori_mutu.index')->with($message);
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
        $MutuKategoris = MutuKategori::find($id);
        $url = Route('kategori_mutu.update', $MutuKategoris->id);
        return response()->json($MutuKategoris);
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
        $MutuKategoris = MutuKategori::find($id);

        $rule = [
            'mutu_sistem_id_m' => 'required',
            'no_kategori_mutu_m' => 'max:20',
            'ket_m' => 'max:255'
        ];

        if ($request->nm_kategori_mutu_m != $MutuKategoris->nm_kategori_mutu) {
            $rule['nm_kategori_mutu_m'] = 'required|unique:mutu_kategoris,nm_kategori_mutu';
        }

        $request->validate($rule);

        $MutuKategoris->mutu_sistem_id = $request->mutu_sistem_id_m;
        $MutuKategoris->nm_kategori_mutu = $request->nm_kategori_mutu_m;
        $MutuKategoris->no_kategori_mutu = $request->no_kategori_mutu_m;
        $MutuKategoris->ket = $request->ket_m;
        $MutuKategoris->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('kategori_mutu.index')->with($message);
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
