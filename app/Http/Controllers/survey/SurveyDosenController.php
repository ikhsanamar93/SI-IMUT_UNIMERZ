<?php

namespace App\Http\Controllers\survey;

use App\Http\Controllers\Controller;
use App\Models\DosenMaster;
use App\Models\SurveyPeriode;
use App\Models\UnitMaster;
use Illuminate\Http\Request;

class SurveyDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::orderby('unit_kategori_id', 'ASC')->get();
        $UnitMastersP = UnitMaster::where('unit_kategori_id', 3)->orderby('unit_pengelola_id', 'ASC')->get();
        $UnitMastersF = UnitMaster::where('unit_kategori_id', 2)->get();
        return view('home.survey.dosen', compact('UnitMasters', 'UnitMastersP', 'UnitMastersF'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = DosenMaster::where('nomor', decrypt($request->nomor))->first();
        $unit_master_id = $data->prodi_id;
        $fakultas_id = $data->fakultas_id;
        $target = '2';

        $SurveyPeriodes = SurveyPeriode::with(['mutu_periode', 'unit_master', 'kuesioner_master'])
            ->where('unit_master_id', $unit_master_id)
            ->where('responden_dosen', '=', 1)
            ->where('status', '=', 1)
            ->get();

        $SurveyPeriodesF = SurveyPeriode::with(['mutu_periode', 'unit_master', 'kuesioner_master'])
            ->where('unit_master_id', $fakultas_id)
            ->where('responden_dosen', '=', 1)
            ->where('status', '=', 1)
            ->get();

        $SurveyPeriodesI = SurveyPeriode::with(['mutu_periode', 'unit_master', 'kuesioner_master'])
            ->where('unit_master_id', 1)
            ->where('responden_dosen', '=', 1)
            ->where('status', '=', 1)
            ->get();

        return view(
            'home.survey.periode',
            compact(
                'SurveyPeriodes',
                'SurveyPeriodesF',
                'SurveyPeriodesI',
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
            'unit_master_id' => 'required',
            'fakultas_id' => 'nullable',
            'prodi_id' => 'required'
        ]);

        $cari = DosenMaster::where('nomor', $request->nomor)->first();
        if ($cari == null) {
            DosenMaster::create(
                $validasi
            );
            $unit_master_id = $request->prodi_id;
            $fakultas_id = $request->fakultas_id;
        }
        $data = DosenMaster::where('nomor', $request->nomor)->first();
        $unit_master_id = $data->prodi_id;
        $fakultas_id = $data->fakultas_id;
        $target = '2';

        $SurveyPeriodes = SurveyPeriode::with(['mutu_periode', 'unit_master', 'kuesioner_master'])
            ->where('unit_master_id', $unit_master_id)
            ->where('responden_dosen', '=', 1)
            ->where('status', '=', 1)
            ->get();

        $SurveyPeriodesF = SurveyPeriode::with(['mutu_periode', 'unit_master', 'kuesioner_master'])
            ->where('unit_master_id', $fakultas_id)
            ->where('responden_dosen', '=', 1)
            ->where('status', '=', 1)
            ->get();

        $SurveyPeriodesI = SurveyPeriode::with(['mutu_periode', 'unit_master', 'kuesioner_master'])
            ->where('unit_master_id', 1)
            ->where('responden_dosen', '=', 1)
            ->where('status', '=', 1)
            ->get();

        return view(
            'home.survey.periode',
            compact(
                'SurveyPeriodes',
                'SurveyPeriodesF',
                'SurveyPeriodesI',
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
