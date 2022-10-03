<?php

namespace App\Http\Controllers\dokumen_spmi;

use App\Http\Controllers\Controller;
use App\Models\MutuSistem;
use App\Models\SpmiMasterDokumen;
use App\Models\UnitMaster;
use App\Models\VersiMaster;
use Illuminate\Http\Request;

class SpmiMasterContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::with(['unit_pengelola'])->where('unit_kategori_id', '!=', '3')->orderby('unit_kategori_id', 'asc')->get();
        $UnitMasters1 = UnitMaster::with(['unit_pengelola'])->where('unit_kategori_id', '=', '3')->orderby('unit_pengelola_id', 'asc')->get();
        return view('dokumen_spmi.home_spmi', compact('UnitMasters', 'UnitMasters1'));
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
            'nm_spmi' => 'required',
            'no_spmi' => 'nullable|max:20',
            'mutu_sistem_id' => 'required',
            'unit_master_id' => 'required',
            'versi_master_id' => 'required',
            'status_spmi' => 'max:1'
        ]);

        SpmiMasterDokumen::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('spmi.show', encrypt($request->unit_master_id))->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $MutuSistems = MutuSistem::all();
        $VersiMasters = VersiMaster::all();
        $UnitMasters = UnitMaster::where('id', decrypt($id))->get();
        $SpmiMasterDokumens = SpmiMasterDokumen::with(['mutu_sistem', 'versi_master', 'unit_master'])->where('unit_master_id', decrypt($id))->orderby('mutu_sistem_id', 'asc')->get();
        return view('dokumen_spmi.index_spmi', compact('SpmiMasterDokumens', 'MutuSistems', 'VersiMasters', 'UnitMasters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SpmiMasterDokumens = SpmiMasterDokumen::find($id);
        $url = Route('spmi.update', $SpmiMasterDokumens->id);
        return response()->json($SpmiMasterDokumens);
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
        $SpmiMasterDokumens = SpmiMasterDokumen::find($id);
        // return $request->all();
        $rule = [
            'nm_spmi_m' => 'required',
            'no_spmi_m' => 'max:20',
            'mutu_sistem_id_m' => 'required',
            'unit_master_id_m' => 'required',
            'versi_master_id_m' => 'required',
            'status_spmi_m' => 'max:1'
        ];

        $request->validate($rule);
        $SpmiMasterDokumens->nm_spmi = $request->nm_spmi_m;
        $SpmiMasterDokumens->no_spmi = $request->no_spmi_m;
        $SpmiMasterDokumens->mutu_sistem_id = $request->mutu_sistem_id_m;
        $SpmiMasterDokumens->unit_master_id = $request->unit_master_id_m;
        $SpmiMasterDokumens->versi_master_id = $request->versi_master_id_m;
        $SpmiMasterDokumens->status_spmi = $request->status_spmi_m;
        $SpmiMasterDokumens->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('spmi.show', encrypt($request->unit_master_id_m))->with($message);
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
