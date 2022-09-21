<?php

namespace App\Http\Controllers;

use App\Models\MonevMaster;
use App\Models\MutuKategori;
use App\Models\MutuPeriode;
use App\Models\SpmiKalender;
use App\Models\SpmiStandarMaster;
use App\Models\UnitMaster;
use App\Models\User;
use App\Models\VersiMaster;

class IndexController extends Controller
{
    public function index()
    {
        $events = array();
        $UnitMasters = UnitMaster::count();
        $MutuPeriodes = MutuPeriode::count();
        $VersiMasters = VersiMaster::count();
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
            'index',
            compact(
                'UnitMasters',
                'MutuPeriodes',
                'VersiMasters',
                'MutuKategoris',
                'SpmiStandarMasters',
                'MonevMasters',
                'Users',
                'events'
            )
        );
    }
}
