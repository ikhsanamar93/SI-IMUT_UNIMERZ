<?php

namespace App\Http\Controllers\admin_institusi;

use App\Http\Controllers\Controller;
use App\Models\UnitKategori;
use App\Models\UnitMaster;
use App\Models\UnitPengelola;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class UnitMasterContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::with(['unit_pengelola'])->orderby('unit_kategori_id', 'asc')->get();
        return view('admin_institusi.index_unit_kerja', compact('UnitMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $UnitKategoris = UnitKategori::all();
        $UnitPengelolas = UnitPengelola::all();
        return view('admin_institusi.add_unit_kerja', compact('UnitKategoris', 'UnitPengelolas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ValidasiData = $request->validate([
            'nm_unit' => 'required|unique:unit_masters,nm_unit|max:255',
            'no_unit' => 'max:20',
            'no_penetapan_unit' => 'max:20',
            'tgl_penetapan_unit' => 'nullable|date',
            'unit_kategori_id' => 'required',
            'unit_pengelola_id' => 'required',
            'ket' => 'max:255'
        ]);

        UnitMaster::create($ValidasiData);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('index_unit_kerja')->with($message);
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
        $UnitMasters = UnitMaster::find($id);
        $UnitKategoris = UnitKategori::all();
        $UnitPengelolas = UnitPengelola::all();
        return view('admin_institusi.edit_unit_kerja', compact('UnitMasters', 'UnitKategoris', 'UnitPengelolas'));
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
        $data = UnitMaster::find($id);
        $rule = [
            'no_unit' => 'max:20',
            'no_penetapan_unit' => 'max:20',
            'tgl_penetapan_unit' => 'nullable|date',
            'unit_kategori_id' => 'required',
            'unit_pengelola_id' => 'required',
            'ket' => 'max:255'
        ];

        if ($request->nm_unit != $data->nm_unit) {
            $rule['nm_unit'] = 'required|unique:unit_masters,nm_unit|max:255';
        }

        $ValidasiData = $request->validate($rule);

        UnitMaster::where('id', $request->id)->update($ValidasiData);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('index_unit_kerja')->with($message);
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
