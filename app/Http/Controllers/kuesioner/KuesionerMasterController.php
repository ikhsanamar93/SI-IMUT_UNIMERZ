<?php

namespace App\Http\Controllers\kuesioner;

use App\Http\Controllers\Controller;
use App\Models\KuesionerMaster;
use App\Models\MonevMaster;
use App\Models\UnitMaster;
use Illuminate\Http\Request;

class KuesionerMasterController extends Controller
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
        return view('kuesioner.kuesioner', compact('UnitMasters', 'UnitMasters1'));
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
            'monev_master_id' => 'required'
        ]);

        KuesionerMaster::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('kuesioner.show', encrypt($request->unit_master_id))->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $UnitMaster = UnitMaster::where('id', decrypt($id))->first();
        $MonevMasters = MonevMaster::with(['monev_kategori'])->orderby('monev_kategori_id', 'ASC')->get();
        $KuesionerMasters = KuesionerMaster::with(['unit_master', 'monev_master'])->where('unit_master_id', decrypt($id))->orderby('monev_master_id', 'ASC')->get();
        return view('kuesioner.kuesioner_master', compact('KuesionerMasters', 'UnitMaster', 'MonevMasters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $KuesionerMasters = KuesionerMaster::find($id);
        $url = Route('kuesioner.update', $KuesionerMasters->id);
        return response()->json($KuesionerMasters);
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
        $KuesionerMasters = KuesionerMaster::find($id);
        $rule = [
            'unit_master_id_m' => 'required',
            'monev_master_id_m' => 'required'
        ];

        $request->validate($rule);
        $KuesionerMasters->monev_master_id = $request->monev_master_id_m;
        $KuesionerMasters->unit_master_id = $request->unit_master_id_m;
        $KuesionerMasters->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('kuesioner.show', encrypt($request->unit_master_id_m))->with($message);
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
