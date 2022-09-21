<?php

namespace App\Http\Controllers\dokumen_akreditasi;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiMaster;
use App\Models\AkreditasiMasterDokumen;
use App\Models\AkreditasiPeriode;
use App\Models\IndukMasterDokumen;
use App\Models\MonevDetailDokumen;
use App\Models\MutuDetailDokumen;
use App\Models\MutuDokumen;
use App\Models\UnitMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkreditasiDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UnitMasters = UnitMaster::with(['unit_pengelola'])->orderby('unit_kategori_id', 'asc')->get();
        return view('dokumen_akreditasi.home', compact('UnitMasters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $AkreditasiPeriodes = AkreditasiPeriode::with(['akreditasi_kategori', 'mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2'])->where('id', decrypt($id))->first();
        $AkreditasiMasters = AkreditasiMaster::with(['akreditasi_kategori', 'monev_kategori'])->where('akreditasi_kategori_id', $AkreditasiPeriodes->akreditasi_kategori_id)->orderby('monev_kategori_id', 'ASC')->get();
        // dd($AkreditasiMasters);
        return view('dokumen_akreditasi.dokumen_master', compact('AkreditasiMasters', 'AkreditasiPeriodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'akreditasi_periode_id' => 'required',
            'akreditasi_master_id' => 'required',
            'unit_master_id' => 'required',
            'mutu_periode_id' => 'required',
            'dokumen_kategori' => 'required',
            'dokumen_id' => 'required'
        ]);

        $master = $request->akreditasi_master_id;
        $periode = $request->akreditasi_periode_id;

        if ($request->dokumen_kategori == 1) {
            for ($i = 0; $i < count($request->dokumen_id); $i++) {
                $data = new AkreditasiMasterDokumen();
                $data->akreditasi_periode_id = $request->akreditasi_periode_id;
                $data->akreditasi_master_id = $request->akreditasi_master_id;
                $data->unit_master_id = $request->unit_master_id;
                $data->mutu_periode_id = $request->mutu_periode_id;
                $data->dokumen_kategori = $request->dokumen_kategori;
                $data->induk_master_dokumen_id = $request->dokumen_id[$i];
                $data->save();
            }
        } elseif ($request->dokumen_kategori == 2) {
            for ($i = 0; $i < count($request->dokumen_id); $i++) {
                $data = new AkreditasiMasterDokumen();
                $data->akreditasi_periode_id = $request->akreditasi_periode_id;
                $data->akreditasi_master_id = $request->akreditasi_master_id;
                $data->unit_master_id = $request->unit_master_id;
                $data->mutu_periode_id = $request->mutu_periode_id;
                $data->dokumen_kategori = $request->dokumen_kategori;
                $data->mutu_detail_dokumen_id = $request->dokumen_id[$i];
                $data->save();
            }
        } elseif ($request->dokumen_kategori == 3) {
            for ($i = 0; $i < count($request->dokumen_id); $i++) {
                $data = new AkreditasiMasterDokumen();
                $data->akreditasi_periode_id = $request->akreditasi_periode_id;
                $data->akreditasi_master_id = $request->akreditasi_master_id;
                $data->unit_master_id = $request->unit_master_id;
                $data->mutu_periode_id = $request->mutu_periode_id;
                $data->dokumen_kategori = $request->dokumen_kategori;
                $data->monev_detail_dokumen_id = $request->dokumen_id[$i];
                $data->save();
            }
        }

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('add_dokumen_akreditasi', [encrypt($master), $periode])->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $AkreditasiPeriodes = AkreditasiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])
            ->where('unit_master_id', decrypt($id))
            ->get();
        return view('dokumen_akreditasi.periode_akreditasi', compact('AkreditasiPeriodes'));
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
        $AkreditasiMasterDokumens = AkreditasiMasterDokumen::find($id);
        $AkreditasiMasterDokumens->delete();
        $master = $AkreditasiMasterDokumens->akreditasi_master_id;
        $periode = $AkreditasiMasterDokumens->akreditasi_periode_id;
        $message = [
            'alert-type' => 'success',
            'message' => 'Data Telah dihapus.'
        ];
        return redirect()->route('add_dokumen_akreditasi', [encrypt($master), $periode])->with($message);
    }

    public function add_dokumen($id, $periode)
    {
        $IndukDokumens = MutuDokumen::where('jenis_dokumen_mutu', 'Dokumen Induk')->get();
        $KinerjaDokumens = MutuDokumen::where('jenis_dokumen_mutu', 'Dokumen Kinerja')->get();
        $AkreditasiPeriode = AkreditasiPeriode::with(['mutu_periode', 'unit_master', 'dosen', 'dosen1', 'dosen2', 'dosen3'])->where('id', $periode)->first();
        $AkreditasiMaster = AkreditasiMaster::with(['akreditasi_kategori', 'monev_kategori'])->where('id', decrypt($id))->first();
        $DokInduks = AkreditasiMasterDokumen::with('induk_master_dokumen')->where('akreditasi_periode_id', $periode)->where('akreditasi_master_id', decrypt($id))->where('dokumen_kategori', 1)->get();
        $DokMutus = AkreditasiMasterDokumen::with('mutu_detail_dokumen')->where('akreditasi_periode_id', $periode)->where('akreditasi_master_id', decrypt($id))->where('dokumen_kategori', 2)->get();
        $DokMonevs = AkreditasiMasterDokumen::with('monev_detail_dokumen')->where('akreditasi_periode_id', $periode)->where('akreditasi_master_id', decrypt($id))->where('dokumen_kategori', 3)->get();
        // dd($DokMonevs);
        return view(
            'dokumen_akreditasi.dokumen_detail',
            compact(
                'IndukDokumens',
                'KinerjaDokumens',
                'AkreditasiPeriode',
                'AkreditasiMaster',
                'DokInduks',
                'DokMutus',
                'DokMonevs'
            )
        );
    }

    public function cari_dokumen(Request $request)
    {
        if ($request->kategori == 1) {
            $IndukMasterDokumens = IndukMasterDokumen::with(['mutu_dokumen'])
                ->where('mutu_dokumen_id', $request->mutu_dokumen_id)
                ->where('unit_master_id', $request->unit_master_id)
                ->get();
            return response()->json($IndukMasterDokumens);
            // return view('dokumen_akreditasi.dokumen_kategori.induk', compact('IndukMasterDokumens', 'master', 'periode'));
        } elseif ($request->kategori == 2) {
            $MutuDetailDokumens = MutuDetailDokumen::with(['mutu_dokumen', 'mutu_master_dokumen'])
                ->where('mutu_dokumen_id', $request->mutu_dokumen_id)
                ->where('unit_master_id', $request->unit_master_id)
                ->where('mutu_periode_id', $request->mutu_periode_id)
                ->get();
            return response()->json($MutuDetailDokumens);
            // return view('dokumen_akreditasi.dokumen_kategori.mutu', compact('MutuDetailDokumens', 'master', 'periode'));
        } elseif ($request->kategori == 3) {
            $MonevDetailDokumens = MonevDetailDokumen::with(['mutu_dokumen', 'spmi_standar_master'])
                ->where('mutu_dokumen_id', $request->mutu_dokumen_id)
                ->where('unit_master_id', $request->unit_master_id)
                ->where('mutu_periode_id', $request->mutu_periode_id)
                ->where('kinerja_kategori', $request->kinerja)
                ->get();
            return response()->json($MonevDetailDokumens);
            // return view('dokumen_akreditasi.dokumen_kategori.monev', compact('MonevDetailDokumens', 'master', 'periode', 'kinerja'));
        }
    }
}
