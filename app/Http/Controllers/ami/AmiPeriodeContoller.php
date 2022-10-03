<?php

namespace App\Http\Controllers\ami;

use App\Http\Controllers\Controller;
use App\Models\AmiPeriode;
use App\Models\AmiPeriodeDetail;
use App\Models\AmiPeriodeMaster;
use App\Models\DosenMaster;
use App\Models\MutuPeriode;
use App\Models\SpmiKalender;
use App\Models\UnitMaster;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmiPeriodeContoller extends Controller
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
        return view('ami.index_ami', compact('UnitMasters', 'UnitMasters1'));
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

    public function periode($id)
    {
        $UnitMasters = UnitMaster::where('id', decrypt($id))->get();
        $MutuPeriodes = MutuPeriode::orderby('siklus', 'DESC')->limit(10)->get();
        $DosenMasters = DosenMaster::all();
        $AmiPeriodes = AmiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])->where('unit_master_id', decrypt($id))->get();
        return view('ami.ami_periode', compact('UnitMasters', 'MutuPeriodes', 'DosenMasters', 'AmiPeriodes'));
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
            'auditee_id' => 'required',
            'auditor1_id' => 'required',
            'auditor2_id' => 'required',
            'observer_id' => 'required',
            'tgl_periode_ami' => 'required|date',
            'unit_master_id' => 'required',
            'mutu_periode_id' => 'required'
        ]);
        DB::beginTransaction();
        $data = AmiPeriode::create($validasi);
        $getid = $data->id;
        SpmiKalender::create([
            'title' => 'Audit Mutu Internal',
            'ami_id' => $getid,
            'akreditasi_id' => '0',
            'unit_master_id' => $request->unit_master_id,
            'auditee_id' => $request->auditee_id,
            'auditor_1' => $request->auditor1_id,
            'auditor_2' => $request->auditor2_id,
            'start_date' => $request->tgl_periode_ami,
            'end_date' => $request->tgl_periode_ami
        ]);
        DB::commit();
        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('show_ami_periode', encrypt($request->unit_master_id))->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $AmiPeriodes = AmiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])->where('id', decrypt($id))->first();
        $AmiPeriodeMasters = AmiPeriodeMaster::with('ami_periode', 'spmi_standar_master', 'ami_periode_detail')->where('ami_periode_id', '=', decrypt($id))->orderBy('spmi_standar_master_id')->get();
        $AmiPeriodeDetails = AmiPeriodeDetail::with('ami_periode', 'spmi_standar_master', 'spmi_standar_detail', 'ami_periode_master')->where('ami_periode_id', '=', $id)->orderBy('spmi_standar_master_id')->get();
        $pdf = Pdf::loadView('ami.cetak_lembar_temuan', compact('AmiPeriodes', 'AmiPeriodeMasters'))->setPaper('A4', 'landscape');
        return $pdf->stream();
        return $pdf;
        // return view('ami.cetak_lembar_temuan', compact('AmiPeriodes', 'AmiPeriodeMasters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AmiPeriodes = AmiPeriode::find($id);
        $url = Route('ami_periode.update', $AmiPeriodes->id);
        return response()->json($AmiPeriodes);
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
        $AmiPeriodes = AmiPeriode::find($id);

        $rule = [
            'auditee_id_m' => 'required',
            'auditor1_id_m' => 'required',
            'auditor2_id_m' => 'required',
            'observer_id_m' => 'required',
            'tgl_periode_ami_m' => 'required|date',
            'unit_master_id_m' => 'required',
            'mutu_periode_id_m' => 'required'
        ];

        $request->validate($rule);

        DB::beginTransaction();
        $AmiPeriodes->auditee_id = $request->auditee_id_m;
        $AmiPeriodes->auditor1_id = $request->auditor1_id_m;
        $AmiPeriodes->auditor2_id = $request->auditor2_id_m;
        $AmiPeriodes->observer_id = $request->observer_id_m;
        $AmiPeriodes->tgl_periode_ami = $request->tgl_periode_ami_m;
        $AmiPeriodes->unit_master_id = $request->unit_master_id_m;
        $AmiPeriodes->mutu_periode_id = $request->mutu_periode_id_m;
        $AmiPeriodes->save();

        SpmiKalender::where('ami_id', $id)->update([
            'unit_master_id' => $request->unit_master_id_m,
            'auditee_id' => $request->auditee_id_m,
            'auditor_1' => $request->auditor1_id_m,
            'auditor_2' => $request->auditor2_id_m,
            'start_date' => $request->tgl_periode_ami_m,
            'end_date' => $request->tgl_periode_ami_m
        ]);
        DB::commit();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('show_ami_periode', encrypt($request->unit_master_id_m))->with($message);
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
