<?php

namespace App\Http\Controllers\dokumen_mutu;

use App\Http\Controllers\Controller;
use App\Models\MutuDokumen;
use App\Models\MutuMasterDokumen;
use App\Models\MutuPeriode;
use App\Models\UnitMaster;
use Illuminate\Http\Request;

class MutuMasterContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::orderby('unit_kategori_id', 'asc')->get();
        return view('dokumen_mutu.home_dokumen', compact('UnitMasters'));
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
            'unit_master_id' => 'required',
            'mutu_periode_id' => 'required'
        ]);
        MutuMasterDokumen::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('mutu_master_dokumen.show', encrypt($request->unit_master_id))->with($message);
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
        $MutuPeriodes = MutuPeriode::orderby('siklus', 'DESC')->limit(10)->get();
        $MutuMasterDokumens = MutuMasterDokumen::with(['unit_master', 'mutu_periode'])->where('unit_master_id', decrypt($id))->latest()->get();
        return view('dokumen_mutu.index_dokumen', compact('UnitMasters', 'MutuPeriodes', 'MutuMasterDokumens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $MutuMasterDokumens = MutuMasterDokumen::find($id);
        $url = Route('mutu_master_dokumen.update', $MutuMasterDokumens->id);
        return response()->json($MutuMasterDokumens);
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
        $MutuMasterDokumens = MutuMasterDokumen::find($id);
        $rule = [
            'unit_master_id_m' => 'required',
            'mutu_periode_id_m' => 'required'
        ];

        $request->validate($rule);
        $MutuMasterDokumens->unit_master_id = $request->unit_master_id_m;
        $MutuMasterDokumens->mutu_periode_id = $request->mutu_periode_id_m;
        $MutuMasterDokumens->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('mutu_master_dokumen.show', encrypt($request->unit_master_id_m))->with($message);
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
