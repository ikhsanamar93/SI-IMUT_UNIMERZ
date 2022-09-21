<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\KabupatenMaster;
use App\Models\ProvinsiMaster;
use App\Models\TahunMaster;
use App\Models\UnitMaster;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create_mahasiswa()
    {
        $UnitMasters = UnitMaster::where('unit_kategori_id', 3)->get();
        $Fakultast = UnitMaster::where('unit_kategori_id', 2)->get();
        $TahunMasters = TahunMaster::orderby('tahun', 'DESC')->limit(15)->get();
        $ProvinsiMasters = ProvinsiMaster::all();
        return view('auth.register_mahasiswa', compact('UnitMasters', 'Fakultast', 'TahunMasters', 'ProvinsiMasters'));
    }

    public function create_alumni()
    {
        $UnitMasters = UnitMaster::where('unit_kategori_id', 3)->get();
        $Fakultast = UnitMaster::where('unit_kategori_id', 2)->get();
        $TahunMasters = TahunMaster::orderby('tahun', 'DESC')->limit(15)->get();
        $ProvinsiMasters = ProvinsiMaster::all();
        return view('auth.register_alumni', compact('UnitMasters', 'Fakultast', 'TahunMasters', 'ProvinsiMasters'));
    }

    public function create_mitra()
    {
        //
    }

    public function store_mahasiswa(Request $request)
    {
        //
    }

    public function store_alumni(Request $request)
    {
        //
    }

    public function store_mitra(Request $request)
    {
        //
    }
}
