<?php

namespace App\Http\Controllers\ami;

use App\Http\Controllers\Controller;
use App\Models\AmiPeriode;
use App\Models\AmiPeriodeDetail;
use App\Models\AmiPeriodeMaster;
use App\Models\SpmiStandarDetail;
use App\Models\SpmiStandarMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class AmiMasterContoller extends Controller
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
                ->where('auditee_id', Auth::user()->user_id)
                ->orWhere('observer_id', Auth::user()->user_id)
                ->get();
        } else {
            $AmiPeriodes = AmiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])
                ->where('unit_master_id', Auth::user()->unit_master_id)
                ->get();
        }

        return view('ami.audite.audite', compact('AmiPeriodes'));
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
            'ami_periode_id' => 'required',
            'spmi_standar_master_id' => 'required'
        ]);

        $validasistandar = AmiPeriodeMaster::where('spmi_standar_master_id', $request->spmi_standar_master_id)->where('ami_periode_id', $request->ami_periode_id)->first();
        // dd($validasistandar);
        if ($validasistandar == null) {
            AmiPeriodeMaster::create($validasi);

            $message = [
                'alert-type' => 'success',
                'message' => 'Data Tersimpan.'
            ];
            return redirect()->route('ami_master.show', encrypt($request->ami_periode_id))->with($message);
        } else {
            $message = [
                'alert-type' => 'error',
                'message' => 'Gagal Tersimpan.'
            ];
            return redirect()->route('ami_master.show', encrypt($request->ami_periode_id))->with($message);
        }
    }

    public function save_ami(Request $request)
    {
        $id = $request->ami_periode;
        $validasistandar = AmiPeriodeMaster::where('ami_periode_id', $id)->first();
        // dd($validasistandar);
        if ($validasistandar == null || $request->ami_periode != $validasistandar->ami_periode_id) {
            $ami_periode_id = $request->ami_periode_id;
            $spmi_standar_master_id = $request->spmi_standar_master_id;

            for ($i = 0; $i < count($ami_periode_id); $i++) {
                $data = new AmiPeriodeMaster();
                $data->ami_periode_id = $ami_periode_id[$i];
                $data->spmi_standar_master_id = $spmi_standar_master_id[$i];
                $data->save();
            }

            $message = [
                'alert-type' => 'success',
                'message' => 'Data Tersimpan.'
            ];
            return redirect()->route('ami_master.show', encrypt($request->ami_periode))->with($message);
        } else {
            $message = [
                'alert-type' => 'error',
                'message' => 'Gagal Tersimpan.'
            ];
            return redirect()->route('ami_master.show', encrypt($request->ami_periode))->with($message);
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
        // $AmiPeriodes = AmiPeriode::find($id);
        $AmiPeriodes = AmiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])->where('id', decrypt($id))->first();
        $SpmiStandarMasters = SpmiStandarMaster::with(['spmi_standar_detail', 'mutu_kategori', 'unit_master'])->where('unit_master_id', '=', $AmiPeriodes->unit_master_id, 'and')->where('status_spmi', '=', '1')->get();
        // dd($SpmiStandarMasters);
        $AmiPeriodeMasters = AmiPeriodeMaster::with('ami_periode', 'spmi_standar_master', 'ami_periode_detail')->where('ami_periode_id', '=', decrypt($id))->orderBy('spmi_standar_master_id')->get();
        // dd($AmiPeriodeMasters);
        return view('ami.audite.ami_master', compact('SpmiStandarMasters', 'AmiPeriodeMasters', 'AmiPeriodes'));
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
        return view('ami.audite.show', compact('AmiPeriodeDetails'));
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
            'rtk' => 'required'
        ]);

        AmiPeriodeDetail::where('id', $id)->update($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('ami_master.show', encrypt($request->ami_periode_id))->with($message);
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
