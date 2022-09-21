<?php

namespace App\Http\Controllers\admin_spmi;

use App\Http\Controllers\Controller;
use App\Models\MutuDokumen;
use Illuminate\Http\Request;

class MutuDokumenContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MutuDokumens = MutuDokumen::all();
        return view('admin_spmi.mutu_dokumen', compact('MutuDokumens'));
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
            'jenis_dokumen_mutu' => 'required',
            'nm_dokumen_mutu' => 'required|unique:mutu_dokumens,nm_dokumen_mutu',
            'no_dokumen_mutu' => 'max:20',
            'ket' => 'max:255'
        ]);

        MutuDokumen::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('dokumen_mutu.index')->with($message);
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
        $MutuDokumens = MutuDokumen::find($id);
        $url = Route('dokumen_mutu.update', $MutuDokumens->id);
        return response()->json($MutuDokumens);
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
        $MutuDokumens = MutuDokumen::find($id);
        $rule = [
            'jenis_dokumen_mutu_m' => 'required',
            'no_dokumen_mutu_m' => 'max:20',
            'ket_m' => 'max:255'
        ];

        if ($request->nm_dokumen_mutu_m != $MutuDokumens->nm_dokumen_mutu) {
            $rule['nm_dokumen_mutu_m'] = 'required|unique:mutu_dokumens,nm_dokumen_mutu';
        }

        $request->validate($rule);

        $MutuDokumens->jenis_dokumen_mutu = $request->jenis_dokumen_mutu_m;
        $MutuDokumens->nm_dokumen_mutu = $request->nm_dokumen_mutu_m;
        $MutuDokumens->no_dokumen_mutu = $request->no_dokumen_mutu_m;
        $MutuDokumens->ket = $request->ket_m;
        $MutuDokumens->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('dokumen_mutu.index')->with($message);
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
