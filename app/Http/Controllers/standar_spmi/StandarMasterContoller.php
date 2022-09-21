<?php

namespace App\Http\Controllers\standar_spmi;

use App\Http\Controllers\Controller;
use App\Models\MutuKategori;
use App\Models\SpmiStandarDetail;
use App\Models\SpmiStandarMaster;
use App\Models\UnitMaster;
use App\Models\VersiMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StandarMasterContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::with(['unit_pengelola'])->orderby('unit_kategori_id', 'asc')->get();
        return view('standar_spmi.index_standar', compact('UnitMasters'));
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
            'mutu_kategori_id' => 'required',
            'versi_master_id' => 'required',
            'unit_master_id' => 'required',
            'nm_standar_spmi' => 'required',
            'no_standar_spmi' => 'required',
            'status_spmi' => 'max:1'
        ]);

        SpmiStandarMaster::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('standar_master.show', Crypt::encrypt($request->unit_master_id))->with($message);
        //return redirect()->back()->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $MutuKategoris = MutuKategori::all();
        $VersiMasters = VersiMaster::all();
        $UnitMaster = UnitMaster::where('id', decrypt($id))->first();
        $SpmiStandarMasters = SpmiStandarMaster::with(['mutu_kategori', 'unit_master', 'spmi_standar_detail'])->where('unit_master_id', decrypt($id))->get();
        //dd($SpmiStandarMasters);
        return view('standar_spmi.standar_master', compact('SpmiStandarMasters', 'MutuKategoris', 'VersiMasters', 'UnitMaster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SpmiStandarMasters = SpmiStandarMaster::find($id);
        $url = Route('standar_master.update', $SpmiStandarMasters->id);
        return response()->json($SpmiStandarMasters);
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
        $SpmiStandarMasters = SpmiStandarMaster::find($id);
        $rule = [
            'mutu_kategori_id_m' => 'required',
            'versi_master_id_m' => 'required',
            'unit_master_id_m' => 'required',
            'nm_standar_spmi_m' => 'required',
            'no_standar_spmi_m' => 'required',
            'status_spmi_m' => 'max:1'
        ];

        $request->validate($rule);

        $SpmiStandarMasters->mutu_kategori_id = $request->mutu_kategori_id_m;
        $SpmiStandarMasters->versi_master_id = $request->versi_master_id_m;
        $SpmiStandarMasters->unit_master_id = $request->unit_master_id_m;
        $SpmiStandarMasters->nm_standar_spmi = $request->nm_standar_spmi_m;
        $SpmiStandarMasters->no_standar_spmi = $request->no_standar_spmi_m;
        $SpmiStandarMasters->status_spmi = $request->status_spmi_m;
        $SpmiStandarMasters->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('standar_master.show', Crypt::encrypt($request->unit_master_id_m))->with($message);
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
