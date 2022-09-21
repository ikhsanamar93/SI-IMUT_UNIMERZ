<?php

namespace App\Http\Controllers\ami;

use App\Http\Controllers\Controller;
use App\Models\AmiPeriode;
use App\Models\AmiPeriodeDetail;
use App\Models\AmiPeriodeMaster;
use App\Models\SpmiStandarDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmiDetailContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_kategori == '1') {
            $AmiPeriodes = AmiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])
                ->Where('auditor1_id', Auth::user()->user_id)
                ->orWhere('auditor2_id', Auth::user()->user_id)
                ->orWhere('observer_id', Auth::user()->user_id)
                ->get();
        } else {
            $AmiPeriodes = AmiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])
                ->where('unit_master_id', Auth::user()->unit_master_id)
                ->get();
        }

        return view('ami.auditor.auditor', compact('AmiPeriodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SpmiStandarDetails = SpmiStandarDetail::with(['spmi_standar_master'])->where('id', $request->spmi_standar_detail_id)->first();
        $AmiPeriodeMasters = AmiPeriodeMaster::where('id', decrypt($request->ami_periode_master_id))->first();
        $AmiPeriodeDetails = AmiPeriodeDetail::with(['ami_periode', 'ami_periode_master', 'spmi_standar_master', 'spmi_standar_detail'])->where('ami_periode_master_id', decrypt($request->ami_periode_master_id))->where('spmi_standar_detail_id', $request->spmi_standar_detail_id)->first();
        if ($AmiPeriodeDetails != null) {
            return view('ami.auditor.edit', compact('AmiPeriodeDetails'));
        } else {
            return view('ami.auditor.add', compact('SpmiStandarDetails', 'AmiPeriodeMasters'));
        }

        // dd($AmiPeriodeDetails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validasi = $request->validate([
            'ami_periode_id' => 'required',
            'ami_periode_master_id' => 'required',
            'spmi_standar_master_id' => 'required',
            'spmi_standar_detail_id' => 'required',
            'daftar_tilik' => 'required',
            'observasi' => 'nullable',
            'temuan' => 'nullable',
            'uraian_temuan' => 'nullable',
            'akar_masalah' => 'nullable',
            'peluang_peningkatan' => 'nullable',
            'rekomendasi' => 'nullable'
        ]);
        $cek = AmiPeriodeDetail::where('ami_periode_master_id', '=', $request->ami_periode_master_id, 'and')->where('spmi_standar_detail_id', '=', $request->spmi_standar_detail_id)->first();
        if ($cek != null) {
            $message = [
                'alert-type' => 'error',
                'message' => 'Gagal Tersimpan, Poin Standar Telah Diaudit!!!'
            ];
            return redirect()->route('show_ami_detail', encrypt($request->ami_periode_id))->with($message);
        } else {
            AmiPeriodeDetail::create($validasi);

            $message = [
                'alert-type' => 'success',
                'message' => 'Data Tersimpan.'
            ];
            return redirect()->route('show_ami_detail', encrypt($request->ami_periode_id))->with($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $AmiPeriodeMasters = AmiPeriodeMaster::with('ami_periode', 'spmi_standar_master', 'ami_periode_detail')->where('ami_periode_id', '=', decrypt($id))->orderBy('spmi_standar_master_id')->get();
        // dd($AmiPeriodeMasters); 
        return view('ami.auditor.ami_master', compact('AmiPeriodeMasters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AmiPeriodeDetails = AmiPeriodeDetail::with(['ami_periode', 'ami_periode_master', 'spmi_standar_master', 'spmi_standar_detail'])->where('id', decrypt($id))->first();
        return view('ami.auditor.edit', compact('AmiPeriodeDetails'));
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
        $validasi = $request->validate([
            'ami_periode_id' => 'required',
            'ami_periode_master_id' => 'required',
            'spmi_standar_master_id' => 'required',
            'spmi_standar_detail_id' => 'required',
            'daftar_tilik' => 'required',
            'observasi' => 'required',
            'temuan' => 'required',
            'uraian_temuan' => 'required',
            'akar_masalah' => 'required',
            'peluang_peningkatan' => 'required',
            'rekomendasi' => 'required'
        ]);

        AmiPeriodeDetail::where('id', $request->id)->update($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('show_ami_detail', encrypt($request->ami_periode_id))->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $AmiPeriodeDetails = AmiPeriodeDetail::find($id);
        $data = $AmiPeriodeDetails->ami_periode_id;
        $AmiPeriodeDetails::destroy($id);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Telah Dihapus.'
        ];
        return redirect()->route('show_ami_detail', encrypt($data))->with($message);
    }
}
