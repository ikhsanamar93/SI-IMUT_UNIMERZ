<?php

namespace App\Http\Controllers\survey;

use App\Http\Controllers\Controller;
use App\Models\KuesionerMaster;
use App\Models\MonevMasterDokumen;
use App\Models\MutuPeriode;
use App\Models\SurveyPeriode;
use App\Models\UnitMaster;
use Illuminate\Http\Request;

class SurveyPeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::orderby('unit_kategori_id', 'asc')->get();
        return view('periode_survey.home_survey', compact('UnitMasters'));
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
            'kuesioner_master_id' => 'required',
            'monev_master_dokumen_id' => 'required',
            'semester' => 'required',
            'status' => 'nullable',
            'responden_mahasiswa' => 'nullable',
            'responden_dosen' => 'nullable',
            'responden_tendik' => 'nullable',
            'responden_alumni' => 'nullable',
            'responden_mitra' => 'nullable',
            'unit_master_id' => 'required',
            'mutu_periode_id' => 'required'
        ]);

        SurveyPeriode::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('survey_periode.show', encrypt($request->monev_master_dokumen_id))->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $MonevMasterDokumens = MonevMasterDokumen::find(decrypt($id));

        $UnitMasters = UnitMaster::where('id', $MonevMasterDokumens->unit_master_id)->get();
        $MutuPeriodes = MutuPeriode::where('id', $MonevMasterDokumens->mutu_periode_id)->get();
        $KuesionerMasters = KuesionerMaster::with('monev_master')->where('unit_master_id', $MonevMasterDokumens->unit_master_id)->orderby('monev_master_id', 'ASC')->get();
        $SurveyPeriodes = SurveyPeriode::with(['mutu_periode', 'unit_master', 'kuesioner_master'])->where('unit_master_id', $MonevMasterDokumens->unit_master_id)->where('semester', $MonevMasterDokumens->semester)->where('mutu_periode_id', $MonevMasterDokumens->mutu_periode_id)->latest()->get();
        return view('periode_survey.periode_survey', compact('UnitMasters', 'MutuPeriodes', 'KuesionerMasters', 'SurveyPeriodes', 'MonevMasterDokumens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SurveyPeriodes = SurveyPeriode::find($id);
        $url = Route('survey_periode.update', $SurveyPeriodes->id);
        return response()->json($SurveyPeriodes);
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
        $SurveyPeriodes = SurveyPeriode::find($id);
        $request->validate([
            'kuesioner_master_id_m' => 'required',
            'monev_master_dokumen_id_m' => 'required',
            'semester_m' => 'required',
            'status_m' => 'nullable',
            'responden_mahasiswa_m' => 'nullable',
            'responden_dosen_m' => 'nullable',
            'responden_tendik_m' => 'nullable',
            'responden_alumni_m' => 'nullable',
            'responden_mitra_m' => 'nullable',
            'unit_master_id_m' => 'required',
            'mutu_periode_id_m' => 'required'
        ]);

        // $request->validate($rule);

        $SurveyPeriodes->unit_master_id = $request->unit_master_id_m;
        $SurveyPeriodes->monev_master_dokumen_id = $request->monev_master_dokumen_id_m;
        $SurveyPeriodes->mutu_periode_id = $request->mutu_periode_id_m;
        $SurveyPeriodes->kuesioner_master_id = $request->kuesioner_master_id_m;
        $SurveyPeriodes->semester = $request->semester_m;
        $SurveyPeriodes->responden_mahasiswa = $request->responden_mahasiswa_m;
        $SurveyPeriodes->responden_dosen = $request->responden_dosen_m;
        $SurveyPeriodes->responden_tendik = $request->responden_tendik_m;
        $SurveyPeriodes->responden_alumni = $request->responden_alumni_m;
        $SurveyPeriodes->responden_mitra = $request->responden_mitra_m;
        $SurveyPeriodes->status = $request->status_m;
        $SurveyPeriodes->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('survey_periode.show', encrypt($request->monev_master_dokumen_id_m))->with($message);
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

    public function show_index($id)
    {
        $UnitMasters = UnitMaster::where('id', decrypt($id))->get();
        $MutuPeriodes = MutuPeriode::orderby('id', 'desc')->get();
        $MonevMasterDokumens = MonevMasterDokumen::with(['unit_master', 'mutu_periode'])->where('unit_master_id', decrypt($id))->latest()->get();
        return view('periode_survey.index_survey', compact('MonevMasterDokumens', 'UnitMasters', 'MutuPeriodes'));
    }

    public function save_index(Request $request)
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
        return redirect()->route('show_periode_survey', encrypt($request->unit_master_id))->with($message);
    }

    public function edit_index($id)
    {
        $MonevMasterDokumens = MonevMasterDokumen::find($id);
        $url = Route('update_periode_survey', $MonevMasterDokumens->id);
        return response()->json($MonevMasterDokumens);
    }

    public function update_index(Request $request, $id)
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

        return redirect()->route('show_periode_survey', encrypt($request->unit_master_id_m))->with($message);
    }
}
