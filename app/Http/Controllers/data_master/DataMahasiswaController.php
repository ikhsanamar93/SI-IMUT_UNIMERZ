<?php

namespace App\Http\Controllers\data_master;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaMaster;
use App\Models\UnitMaster;
use Illuminate\Http\Request;

class DataMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Fakultast = UnitMaster::where('unit_kategori_id', 2)->get();
        $Prodis = UnitMaster::where('unit_kategori_id', 3)->orderby('unit_pengelola_id', 'ASC')->get();
        $MahasiswaMasters = MahasiswaMaster::orderby('unit_master_id', 'ASC')->get();
        return view('data_master.data_mahasiswa', compact('MahasiswaMasters', 'Fakultast', 'Prodis'));
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
        //
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
        //
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
        //
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
