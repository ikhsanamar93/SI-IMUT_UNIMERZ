<?php

namespace App\Http\Controllers\akreditasi;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiMaster;
use App\Models\AkreditasiPeriode;
use App\Models\AkreditasiPeriodeDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AuditeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_kategori == '1') {
            $AkreditasiPeriodes = AkreditasiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])
                ->where('auditee_id', Auth::user()->user_id)
                ->orWhere('observer_id', Auth::user()->user_id)
                ->get();
        } else {
            $AkreditasiPeriodes = AkreditasiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])
                ->where('unit_master_id', Auth::user()->unit_master_id)
                ->get();
        }
        return view('akreditasi.audite.periode_audite', compact('AkreditasiPeriodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $AkreditasiPeriodes = AkreditasiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])->where('id', $id)->first();
        $AkreditasiPeriodeDetails = AkreditasiPeriodeDetail::with(['akreditasi_periode', 'akreditasi_kategori', 'akreditasi_master'])->where('akreditasi_periode_id', $id)->get();
        $nilai = AkreditasiPeriodeDetail::where('akreditasi_periode_id', $id)->sum('perolehan_skor');
        // $pdf = PDF::loadView('akreditasi.cetak_periode', compact('AkreditasiPeriodes', 'AkreditasiPeriodeDetails', 'nilai'));
        // return $pdf->stream();
        // return $pdf;
        return view('akreditasi.cetak_periode', compact('AkreditasiPeriodes', 'AkreditasiPeriodeDetails', 'nilai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->akreditasi_periode;
        $validasi = AkreditasiPeriodeDetail::where('akreditasi_periode_id', $id)->first();
        // dd($id);
        if ($validasi == null || $id != $validasi->akreditasi_periode_id) {
            $akreditasi_periode_id = $request->akreditasi_periode_id;
            $akreditasi_kategori_id = $request->akreditasi_kategori_id;
            $akreditasi_master_id = $request->akreditasi_master_id;

            for ($i = 0; $i < count($akreditasi_periode_id); $i++) {
                $data = new AkreditasiPeriodeDetail();
                $data->akreditasi_periode_id = $akreditasi_periode_id[$i];
                $data->akreditasi_kategori_id = $akreditasi_kategori_id[$i];
                $data->akreditasi_master_id = $akreditasi_master_id[$i];
                $data->save();
            }

            $message = [
                'alert-type' => 'success',
                'message' => 'Data Tersimpan.'
            ];
            return redirect()->route('show_akreditasi_audite', encrypt($id))->with($message);
        } else {
            $message = [
                'alert-type' => 'error',
                'message' => 'Gagal Tersimpan.'
            ];
            return redirect()->route('show_akreditasi_audite', encrypt($id))->with($message);
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
        $AkreditasiPeriodes = AkreditasiPeriode::find(decrypt($id));
        $AkreditasiMasters = AkreditasiMaster::with(['akreditasi_kategori', 'monev_kategori'])->where('akreditasi_kategori_id', $AkreditasiPeriodes->akreditasi_kategori_id)->get();
        $AkreditasiPeriodeDetails = AkreditasiPeriodeDetail::with(['akreditasi_master'])->where('akreditasi_periode_id', decrypt($id))->get();
        // dd($AkreditasiMasters);
        return view('akreditasi.audite.audite_master', compact('AkreditasiMasters', 'AkreditasiPeriodes', 'AkreditasiPeriodeDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AkreditasiPeriodeDetails = AkreditasiPeriodeDetail::with(['akreditasi_periode', 'akreditasi_kategori', 'akreditasi_master'])->where('id', decrypt($id))->first();
        // dd($AkreditasiPeriodeDetails);
        return view('akreditasi.audite.show_audite', compact('AkreditasiPeriodeDetails'));
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
            'rtk' => 'nullable'
        ]);

        AkreditasiPeriodeDetail::where('id', $id)->update($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('edit_akreditasi_audite', encrypt($id))->with($message);
        // $AkreditasiPeriodeDetails = AkreditasiPeriodeDetail::with(['akreditasi_periode', 'akreditasi_kategori', 'akreditasi_master'])->where('akreditasi_periode_id', $id)->get();
        // $pdf = Pdf::loadView('akreditasi.cetak_periode');
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
