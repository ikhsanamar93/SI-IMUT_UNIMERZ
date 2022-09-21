<?php

namespace App\Http\Controllers\survey;

use App\Http\Controllers\Controller;
use App\Models\KuesionerDetail;
use App\Models\MitraMaster;
use App\Models\SurveyPeriode;
use App\Models\UnitMaster;
use Illuminate\Http\Request;

class SurveyMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::all();
        return view('home.survey.mitra', compact('UnitMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = MitraMaster::where('nomor', decrypt($request->nomor))->first();
        $unit_master_id = $data->unit_master_id;
        $target = '5';

        $SurveyPeriodes = SurveyPeriode::with(['mutu_periode', 'unit_master', 'kuesioner_master'])
            ->where('unit_master_id', $unit_master_id)
            ->where('responden_mitra', '=', 1)
            ->where('status', '=', 1)
            ->get();

        return view(
            'home.survey.periode_mitra',
            compact(
                'SurveyPeriodes',
                'data',
                'target'
            )
        );
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
            'nama' => 'required',
            'nomor' => 'required',
            'unit_master_id' => 'required'
        ]);

        $cari = MitraMaster::where('nomor', $request->nomor)->first();
        if ($cari == null) {
            MitraMaster::create(
                $validasi
            );
            $unit_master_id = $request->unit_master_id;
        }
        $data = MitraMaster::where('nomor', $request->nomor)->first();
        $unit_master_id = $data->unit_master_id;
        $target = '5';

        $SurveyPeriodes = SurveyPeriode::with(['mutu_periode', 'unit_master', 'kuesioner_master'])
            ->where('unit_master_id', $unit_master_id)
            ->where('responden_mitra', '=', 1)
            ->where('status', '=', 1)
            ->get();

        return view(
            'home.survey.periode_mitra',
            compact(
                'SurveyPeriodes',
                'data',
                'target'
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $KuesionerDetails = KuesionerDetail::where('kuesioner_master_id', $id)->get();
        // return $KuesionerDetails;
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
