<?php

namespace App\Http\Controllers\dokumen_monev;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiMasterDokumen;
use App\Models\MonevDetailDokumen;
use App\Models\MonevMasterDokumen;
use App\Models\MutuDokumen;
use App\Models\SpmiStandarMaster;
use App\Models\UnitMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MonevDetailContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($monevid, $standarid, $kategori)
    {
        $kinerja_kategoris =  $kategori;
        // $UnitMasters = UnitMaster::where('id', $request->unit_master_id)->first();
        $MonevMasterDokumens = MonevMasterDokumen::with(['mutu_periode', 'unit_master'])->where('id', decrypt($monevid))->first();
        $SpmiStandarMasters = SpmiStandarMaster::where('id', $standarid)->first();
        $MutuDokumens = MutuDokumen::where('jenis_dokumen_mutu', 'Dokumen Kinerja')->get();
        $MonevDetailDokumens = MonevDetailDokumen::where('monev_master_dokumen_id', decrypt($monevid), 'and')->where('spmi_standar_master_id', $standarid, 'and')->where('kinerja_kategori', $kategori)->get();
        return view('dokumen_monev.add_monev', compact('MonevDetailDokumens', 'MonevMasterDokumens', 'SpmiStandarMasters', 'kinerja_kategoris', 'MutuDokumens'));
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
            'monev_master_dokumen_id' => 'required',
            'spmi_standar_master_id' => 'required',
            'unit_master_id' => 'required',
            'mutu_dokumen_id' => 'required',
            'mutu_periode_id' => 'required',
            'kinerja_kategori' => 'required',
            'nm_dokumen_monev' => 'required',
            'file_dokumen' => 'mimes:pdf|file|max:5120',
            'link_dokumen' => 'nullable|url'
        ]);

        $file_dokumen = null;
        if ($request->file('file_dokumen')) {
            $file_dokumen = $request->file_dokumen->store('Dok_Monev');
        }

        MonevDetailDokumen::create([
            'monev_master_dokumen_id' => $request->monev_master_dokumen_id,
            'spmi_standar_master_id' => $request->spmi_standar_master_id,
            'mutu_dokumen_id' => $request->mutu_dokumen_id,
            'unit_master_id' => $request->unit_master_id,
            'mutu_periode_id' => $request->mutu_periode_id,
            'kinerja_kategori' => $request->kinerja_kategori,
            'nm_dokumen_monev' => $request->nm_dokumen_monev,
            'file_dokumen' => $file_dokumen,
            'link_dokumen' => $request->link_dokumen
        ]);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        // return redirect()->route('create_monev', [
        //     'monev_master_dokumen_id' => $request->monev_master_dokumen_id,
        //     'spmi_standar_master_id' => $request->spmi_standar_master_id,
        //     'kinerja_kategori' => $request->kinerja_kategori
        // ])->with($message);
        return redirect()->route('create_monev', [
            encrypt($request->monev_master_dokumen_id),
            $request->spmi_standar_master_id,
            $request->kinerja_kategori
        ])->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $MonevMasterDokumens = MonevMasterDokumen::where('id', decrypt($id))->first();
        $SpmiStandarMasters = SpmiStandarMaster::with(['spmi_standar_detail', 'mutu_kategori', 'unit_master'])->where('unit_master_id', '=', $MonevMasterDokumens->unit_master_id, 'and')->where('status_spmi', '=', '1')->get();
        // dd($SpmiStandarMasters);
        return view('dokumen_monev.detail_monev', compact('SpmiStandarMasters', 'MonevMasterDokumens'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $MonevDetailDokumens = MonevDetailDokumen::find($id);
        $url = Route('update_monev', $MonevDetailDokumens->id);
        return response()->json($MonevDetailDokumens);
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
        $MonevDetailDokumens = MonevDetailDokumen::find($id);

        $request->validate([
            'monev_master_dokumen_id_m' => 'required',
            'spmi_standar_master_id_m' => 'required',
            'mutu_dokumen_id_m' => 'required',
            'mutu_periode_id_m' => 'required',
            'unit_master_id_m' => 'required',
            'kinerja_kategori_m' => 'required',
            'nm_dokumen_monev_m' => 'required',
            'file_dokumen_m' => 'mimes:pdf|file|max:5120',
            'link_dokumen_m' => 'nullable|url'
        ]);

        $file_dokumen = null;
        if ($request->file('file_dokumen_m')) {
            if ($request->old_file) {
                Storage::delete($request->old_file);
            }
            $file_dokumen = $request->file_dokumen_m->store('Dok_Monev');
        } else {
            $file_dokumen = $request->old_file;
        }
        //return $file_dokumen;
        $MonevDetailDokumens->monev_master_dokumen_id = $request->monev_master_dokumen_id_m;
        $MonevDetailDokumens->spmi_standar_master_id = $request->spmi_standar_master_id_m;
        $MonevDetailDokumens->mutu_dokumen_id = $request->mutu_dokumen_id_m;
        $MonevDetailDokumens->mutu_periode_id = $request->mutu_periode_id_m;
        $MonevDetailDokumens->unit_master_id = $request->unit_master_id_m;
        $MonevDetailDokumens->kinerja_kategori = $request->kinerja_kategori_m;
        $MonevDetailDokumens->nm_dokumen_monev = $request->nm_dokumen_monev_m;
        $MonevDetailDokumens->file_dokumen = $file_dokumen;
        $MonevDetailDokumens->link_dokumen = $request->link_dokumen_m;
        $MonevDetailDokumens->save();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('create_monev', [
            encrypt($request->monev_master_dokumen_id_m),
            $request->spmi_standar_master_id_m,
            $request->kinerja_kategori_m
        ])->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $MonevDetailDokumens = MonevDetailDokumen::find($id);
        $AkreditasiMasterDokumens = AkreditasiMasterDokumen::where('monev_detail_dokumen_id', $id)->first();
        DB::beginTransaction();

        if ($MonevDetailDokumens->file_dokumen) {
            Storage::delete($MonevDetailDokumens->file_dokumen);
        }

        $MonevDetailDokumens::destroy($id);

        if ($AkreditasiMasterDokumens != null) {
            $AkreditasiMasterDokumens->delete();
        }

        DB::commit();

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Telah di Hapus.'
        ];

        return redirect()->route('create_monev', [
            encrypt($request->monev_master_dokumen_id),
            $request->spmi_standar_master_id,
            $request->kinerja_kategori
        ])->with($message);
    }
}
