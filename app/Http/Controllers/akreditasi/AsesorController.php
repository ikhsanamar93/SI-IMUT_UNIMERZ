<?php

namespace App\Http\Controllers\akreditasi;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiPeriode;
use App\Models\AkreditasiPeriodeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsesorController extends Controller
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
                ->Where('asesor1_id', Auth::user()->user_id)
                ->orWhere('asesor2_id', Auth::user()->user_id)
                ->orWhere('observer_id', Auth::user()->user_id)
                ->get();
        } else {
            $AkreditasiPeriodes = AkreditasiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])
                ->where('unit_master_id', Auth::user()->unit_master_id)
                ->get();
        }

        return view('akreditasi.asesor.periode_asesor', compact('AkreditasiPeriodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $AkreditasiPeriodes = AkreditasiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2'])->where('id', $id)->first();
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
    public function store(Request $request, $id)
    {
        $validasi = $request->validate([
            'id' => 'required',
            'akreditasi_periode_id' => 'required',
            'akreditasi_kategori_id' => 'required',
            'akreditasi_master_id' => 'required',
            'daftar_tilik' => 'nullable',
            'observasi' => 'nullable',
            'temuan' => 'nullable',
            'uraian_temuan' => 'nullable',
            'skor' => 'nullable',
            'bobot_penilaian' => 'nullable',
            'perolehan_skor' => 'nullable',
            'rekomendasi' => 'nullable',
            'praktek_baik' => 'nullable',
            'efektifitas_rtk' => 'nullable'
        ]);

        AkreditasiPeriodeDetail::where('id', $id)->update($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('show_akreditasi_asesor', encrypt($request->akreditasi_periode_id))->with($message);
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
        $AkreditasiPeriodeDetails = AkreditasiPeriodeDetail::with(['akreditasi_master',])->where('akreditasi_periode_id', decrypt($id))->get();
        // dd($AkreditasiMasters);
        return view('akreditasi.asesor.asesor_master', compact('AkreditasiPeriodeDetails', 'AkreditasiPeriodes', 'AkreditasiPeriodeDetails'));
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
        return view('akreditasi.asesor.form_asesor', compact('AkreditasiPeriodeDetails'));
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
