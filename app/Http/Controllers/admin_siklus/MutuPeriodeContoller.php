<?php

namespace App\Http\Controllers\admin_siklus;

use App\Http\Controllers\Controller;
use App\Models\MutuPeriode;
use Illuminate\Http\Request;

class MutuPeriodeContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MutuPeriodes = MutuPeriode::orderby('siklus', 'DESC')->get();
        return view('admin_siklus.mutu_periode', compact('MutuPeriodes'));
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
            'siklus' => 'required|unique:mutu_periodes,siklus',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'akreditasi' => 'max:1',
            'spmi' => 'max:1'
        ]);

        MutuPeriode::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('periode_mutu.index')->with($message);
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
        $MutuPeriodes = MutuPeriode::find($id);
        $url = Route('periode_mutu.update', $MutuPeriodes->id);
        return response()->json($MutuPeriodes);
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
        $MutuPeriodes = MutuPeriode::find($id);
        $rule = [
            'tgl_awal_m' => 'required|date',
            'tgl_akhir_m' => 'required|date',
            'akreditasi_m' => 'max:1',
            'spmi_m' => 'max:1'
        ];

        if ($request->siklus_m != $MutuPeriodes->siklus) {
            $rule['siklus_m'] = 'required|unique:mutu_periodes,siklus';
        }

        $request->validate($rule);
        $MutuPeriodes->siklus = $request->siklus_m;
        $MutuPeriodes->tgl_awal = $request->tgl_awal_m;
        $MutuPeriodes->tgl_akhir = $request->tgl_akhir_m;
        $MutuPeriodes->akreditasi = $request->akreditasi_m;
        $MutuPeriodes->spmi = $request->spmi_m;
        $MutuPeriodes->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('periode_mutu.index')->with($message);
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
