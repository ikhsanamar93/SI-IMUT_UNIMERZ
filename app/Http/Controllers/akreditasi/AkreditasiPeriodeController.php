<?php

namespace App\Http\Controllers\akreditasi;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiKategori;
use App\Models\AkreditasiPeriode;
use App\Models\AkreditasiPeriodeDetail;
use App\Models\DosenMaster;
use App\Models\MutuPeriode;
use App\Models\SpmiKalender;
use App\Models\UnitMaster;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkreditasiPeriodeController extends Controller
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
        return view('akreditasi.periode_akreditasi', compact('UnitMasters', 'UnitMasters1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //Cetak Periode
        $AkreditasiPeriodes = AkreditasiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2'])->where('id', decrypt($id))->first();
        $AkreditasiPeriodeDetails = AkreditasiPeriodeDetail::with(['akreditasi_periode', 'akreditasi_kategori', 'akreditasi_master'])->where('akreditasi_periode_id', decrypt($id))->get();
        $nilai = AkreditasiPeriodeDetail::where('akreditasi_periode_id', $id)->sum('perolehan_skor');
        $pdf = Pdf::loadView('akreditasi.cetak_periode', compact('AkreditasiPeriodes', 'AkreditasiPeriodeDetails', 'nilai'))->setPaper('A4', 'landscape');
        return $pdf->stream();
        return $pdf;
        // return view('akreditasi.cetak_periode', compact('AkreditasiPeriodes', 'AkreditasiPeriodeDetails', 'nilai'));
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
            'akreditasi_kategori_id' => 'required',
            'auditee_id' => 'required',
            'asesor1_id' => 'required',
            'asesor2_id' => 'required',
            'observer_id' => 'required',
            'tgl_periode_akreditasi' => 'required|date',
            'unit_master_id' => 'required',
            'mutu_periode_id' => 'required'
        ]);
        DB::beginTransaction();
        $data = AkreditasiPeriode::create($validasi);
        $getid = $data->id;
        SpmiKalender::create([
            'title' => 'Audit Akreditasi',
            'ami_id' => '0',
            'akreditasi_id' => $getid,
            'unit_master_id' => $request->unit_master_id,
            'auditee_id' => $request->auditee_id,
            'auditor_1' => $request->asesor1_id,
            'auditor_2' => $request->asesor2_id,
            'start_date' => $request->tgl_periode_akreditasi,
            'end_date' => $request->tgl_periode_akreditasi
        ]);
        DB::commit();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('show_akreditasi_periode', encrypt($request->unit_master_id))->with($message);
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
        $MutuPeriodes = MutuPeriode::orderby('siklus', 'DESC')->limit(10)->get();
        $DosenMasters = DosenMaster::all();
        $AkreditasiKategoris = AkreditasiKategori::all();
        $AkreditasiPeriodes = AkreditasiPeriode::with(['akreditasi_kategori', 'mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2'])->where('unit_master_id', decrypt($id))->get();
        return view('akreditasi.add_periode', compact('UnitMasters', 'MutuPeriodes', 'DosenMasters', 'AkreditasiPeriodes', 'AkreditasiKategoris'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AkreditasiPeriodes = AkreditasiPeriode::find($id);
        $url = Route('update_akreditasi_periode', $AkreditasiPeriodes->id);
        return response()->json($AkreditasiPeriodes);
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
        $AkreditasiPeriodes = AkreditasiPeriode::find($id);

        $rule = [
            'akreditasi_kategori_id_m' => 'required',
            'auditee_id_m' => 'required',
            'asesor1_id_m' => 'required',
            'asesor2_id_m' => 'required',
            'observer_id_m' => 'required',
            'tgl_periode_akreditasi_m' => 'required|date',
            'unit_master_id_m' => 'required',
            'mutu_periode_id_m' => 'required'
        ];

        $request->validate($rule);

        DB::beginTransaction();
        $AkreditasiPeriodes->akreditasi_kategori_id = $request->akreditasi_kategori_id_m;
        $AkreditasiPeriodes->auditee_id = $request->auditee_id_m;
        $AkreditasiPeriodes->asesor1_id = $request->asesor1_id_m;
        $AkreditasiPeriodes->asesor2_id = $request->asesor2_id_m;
        $AkreditasiPeriodes->observer_id = $request->observer_id_m;
        $AkreditasiPeriodes->tgl_periode_akreditasi = $request->tgl_periode_akreditasi_m;
        $AkreditasiPeriodes->unit_master_id = $request->unit_master_id_m;
        $AkreditasiPeriodes->mutu_periode_id = $request->mutu_periode_id_m;
        $AkreditasiPeriodes->save();

        SpmiKalender::where('akreditasi_id', $id)->update([
            'unit_master_id' => $request->unit_master_id_m,
            'auditee_id' => $request->auditee_id_m,
            'auditor_1' => $request->asesor1_id_m,
            'auditor_2' => $request->asesor2_id_m,
            'start_date' => $request->tgl_periode_akreditasi_m,
            'end_date' => $request->tgl_periode_akreditasi_m
        ]);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        DB::commit();

        return redirect()->route('show_akreditasi_periode', encrypt($request->unit_master_id_m))->with($message);
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
