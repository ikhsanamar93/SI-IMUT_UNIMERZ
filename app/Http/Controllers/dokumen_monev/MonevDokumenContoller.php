<?php

namespace App\Http\Controllers\dokumen_monev;

use App\Http\Controllers\Controller;
use App\Models\MonevMasterDokumen;
use App\Models\MutuPeriode;
use App\Models\UnitMaster;
use Illuminate\Http\Request;

class MonevDokumenContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::orderby('unit_kategori_id', 'asc')->get();
        return view('dokumen_monev.home_monev', compact('UnitMasters'));
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
            'semester' => 'required',
            'unit_master_id' => 'required',
            'mutu_periode_id' => 'required'
        ]);

        MonevMasterDokumen::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('monev_master_dokumen.show', encrypt($request->unit_master_id))->with($message);
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
        // $MonevKategoris = MonevKategori::all();
        $MutuPeriodes = MutuPeriode::orderby('siklus', 'DESC')->limit(10)->get();
        $MonevMasterDokumens = MonevMasterDokumen::with(['unit_master', 'mutu_periode'])->where('unit_master_id', decrypt($id))->latest()->get();
        return view('dokumen_monev.index_monev', compact('MonevMasterDokumens', 'UnitMasters', 'MutuPeriodes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $MonevMasterDokumens = MonevMasterDokumen::find($id);
        $url = Route('monev_master_dokumen.update', $MonevMasterDokumens->id);
        return response()->json($MonevMasterDokumens);
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
        $MonevMasterDokumens = MonevMasterDokumen::find($id);

        $rule = [
            'semester_m' => 'required',
            'unit_master_id_m' => 'required',
            'mutu_periode_id_m' => 'required'
        ];

        $request->validate($rule);

        $MonevMasterDokumens->semester = $request->semester_m;
        $MonevMasterDokumens->unit_master_id = $request->unit_master_id_m;
        $MonevMasterDokumens->mutu_periode_id = $request->mutu_periode_id_m;
        $MonevMasterDokumens->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('monev_master_dokumen.show', encrypt($request->unit_master_id_m))->with($message);
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
