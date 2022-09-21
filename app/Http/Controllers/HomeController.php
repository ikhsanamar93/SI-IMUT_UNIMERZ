<?php

namespace App\Http\Controllers;

use App\Models\IndukMasterDokumen;
use App\Models\MonevMaster;
use App\Models\MutuKategori;
use App\Models\SpmiDetailDokumen;
use App\Models\SpmiKalender;
use App\Models\SpmiStandarDetail;
use App\Models\SpmiStandarMaster;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $events = array();
        $MutuKategoris =  MutuKategori::count();
        $SpmiStandarMasters = SpmiStandarMaster::where('unit_master_id', 1)->count();
        $MonevMasters = MonevMaster::count();
        $Users = User::count();
        $kalenders = SpmiKalender::with(['unit_master', 'dosen', 'dosen1', 'dosen2'])->get();

        foreach ($kalenders as $kalender) {
            $events[] = [
                'title' => $kalender->title,
                'unit_master_id' => $kalender->unit_master->nm_unit,
                'auditee_id' => $kalender->dosen->nama,
                'auditor_1' => $kalender->dosen1->nama,
                'auditor_2' => $kalender->dosen2->nama,
                'start' => $kalender->start_date,
                'end' => $kalender->end_date
            ];
        }

        return view(
            'home.home',
            compact(
                'MutuKategoris',
                'SpmiStandarMasters',
                'MonevMasters',
                'Users',
                'events'
            )
        );
    }

    public function spmi()
    {
        $SpmiDetailDokumens = SpmiDetailDokumen::with(['spmi_master_dokumen', 'mutu_kategori'])->where('unit_master_id', 1)->orderby('mutu_kategori_id', 'asc')->get();
        return view('home.dokumen.spmi', compact('SpmiDetailDokumens'));
    }

    public function induk()
    {
        $IndukMasterDokumens = IndukMasterDokumen::with(['unit_master', 'mutu_dokumen'])->where('unit_master_id', 1)->orderby('mutu_dokumen_id', 'asc')->get();
        return view('home.dokumen.induk', compact('IndukMasterDokumens'));
    }

    public function standar()
    {
        $SpmiStandarMasters = SpmiStandarMaster::with(['mutu_kategori', 'unit_master', 'spmi_standar_detail'])->where('unit_master_id', 1)->get();
        return view('home.dokumen.standar', compact('SpmiStandarMasters'));
    }

    public function pernyataan($id)
    {
        $SpmiStandardetails = SpmiStandarDetail::with(['spmi_standar_master'])->where('id', decrypt($id))->first();
        $SpmiStandarMasters = SpmiStandarMaster::with(['unit_master'])->where('id', $SpmiStandardetails->spmi_standar_master_id)->first();
        return view('home.dokumen.standar_detail', compact('SpmiStandardetails', 'SpmiStandarMasters'));
    }
}
