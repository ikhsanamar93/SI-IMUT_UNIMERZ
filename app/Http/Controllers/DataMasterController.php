<?php

namespace App\Http\Controllers;

use App\Models\KabupatenMaster;
use App\Models\ProvinsiMaster;
use App\Models\TahunMaster;
use Illuminate\Http\Request;

class DataMasterController extends Controller
{
    public function index()
    {
        $TahunMasters = TahunMaster::orderby('tahun', 'DESC')->get();
        $ProvinsiMasters = ProvinsiMaster::all();
        return view('data_master', compact('TahunMasters', 'ProvinsiMasters'));
    }

    public function simpan_tahun(Request $request)
    {
        $validasi = $request->validate([
            'tahun' => 'required|unique:tahun_masters,tahun'
        ]);

        TahunMaster::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('data_master')->with($message);
    }

    public function simpan_provinsi(Request $request)
    {
        $validasi = $request->validate([
            'no_provinsi' => 'required|unique:provinsi_masters,no_provinsi',
            'nm_provinsi' => 'required|unique:provinsi_masters,nm_provinsi'
        ]);

        ProvinsiMaster::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('data_master')->with($message);
    }

    public function simpan_kabupaten(Request $request)
    {
        $validasi = $request->validate([
            'no_kabupaten' => 'required|unique:kabupaten_masters,no_kabupaten',
            'nm_kabupaten' => 'required|unique:kabupaten_masters,nm_kabupaten',
            'provinsi_master_id' => 'required'
        ]);

        KabupatenMaster::create($validasi);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('show_kabupaten', encrypt($request->provinsi_master_id))->with($message);
    }

    public function edit_tahun($id)
    {
        $TahunMasters = TahunMaster::find($id);
        $url = Route('update_tahun', $TahunMasters->id);
        return response()->json($TahunMasters);
    }

    public function edit_provinsi($id)
    {
        $ProvinsiMasters = ProvinsiMaster::find($id);
        $url = Route('update_provinsi', $ProvinsiMasters->id);
        return response()->json($ProvinsiMasters);
    }

    public function edit_kabupaten($id)
    {
        $KabupatenMasters = KabupatenMaster::find($id);
        $url = Route('update_kabupaten', $KabupatenMasters->id);
        return response()->json($KabupatenMasters);
    }

    public function update_tahun(Request $request, $id)
    {
        $request->validate([
            'tahun_m' => 'required|unique:tahun_masters,tahun'
        ]);

        TahunMaster::where('id', $id)->update([
            'tahun' => $request->tahun_m
        ]);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('data_master')->with($message);
    }

    public function update_provinsi(Request $request, $id)
    {
        $request->validate([
            'no_provinsi_m' => 'required',
            'nm_provinsi_m' => 'required'
        ]);

        ProvinsiMaster::where('id', $id)->update([
            'no_provinsi' => $request->no_provinsi_m,
            'nm_provinsi' => $request->nm_provinsi_m
        ]);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];

        return redirect()->route('data_master')->with($message);
    }

    public function update_kabupaten(Request $request, $id)
    {
        $request->validate([
            'no_kabupaten_m' => 'required',
            'nm_kabupaten_m' => 'required',
            'provinsi_master_id' => 'required'
        ]);

        KabupatenMaster::where('id', $id)->update([
            'no_kabupaten' => $request->no_kabupaten_m,
            'nm_kabupaten' => $request->nm_kabupaten_m,
            'provinsi_master_id' => $request->provinsi_master_id
        ]);

        $message = [
            'alert-type' => 'success',
            'message' => 'Data Tersimpan.'
        ];
        return redirect()->route('show_kabupaten', encrypt($request->provinsi_master_id))->with($message);
    }

    public function show_kabupaten($id)
    {
        $ProvinsiMaster = ProvinsiMaster::where('no_provinsi', decrypt($id))->first();
        $KabupatenMasters = KabupatenMaster::where('provinsi_master_id', decrypt($id))->get();
        return view('data_kabupaten', compact('ProvinsiMaster', 'KabupatenMasters'));
    }
}
