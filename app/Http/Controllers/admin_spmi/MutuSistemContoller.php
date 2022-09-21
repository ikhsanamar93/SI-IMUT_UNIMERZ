<?php

namespace App\Http\Controllers\admin_spmi;

use App\Http\Controllers\Controller;
use App\Models\MutuSistem;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class MutuSistemContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MutuSistems = MutuSistem::orderBy('id', 'asc')->get();
        return view('admin_spmi.mutu_sistem', compact('MutuSistems'));
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
            'nm_sistem_mutu' => 'required|unique:mutu_sistems,nm_sistem_mutu',
            'no_sistem_mutu' => 'max:20',
            'ket' => 'max:255'
        ]);
        MutuSistem::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('sistem_mutu.index')->with($message);
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
        $MutuSistems = MutuSistem::find($id);
        $url = Route('sistem_mutu.update', $MutuSistems->id);
        return response()->json($MutuSistems);
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
        $MutuSistems = MutuSistem::find($id);

        $rule = [
            'no_sistem_mutu_m' => 'max:20',
            'ket_m' => 'max:255'
        ];

        if ($request->nm_sistem_mutu_m != $MutuSistems->nm_sistem_mutu) {
            $rule['nm_sistem_mutu_m'] = 'required|unique:mutu_sistems,nm_sistem_mutu';
        }

        $request->validate($rule);

        $MutuSistems->nm_sistem_mutu = $request->nm_sistem_mutu_m;
        $MutuSistems->no_sistem_mutu = $request->no_sistem_mutu_m;
        $MutuSistems->ket = $request->ket_m;
        $MutuSistems->update();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('sistem_mutu.index')->with($message);
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
