<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyPeriode extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }

    public function mutu_periode()
    {
        return $this->belongsTo(MutuPeriode::class, 'mutu_periode_id');
    }

    public function kuesioner_master()
    {
        return $this->belongsTo(KuesionerMaster::class, 'kuesioner_master_id');
    }

    public function respon_master()
    {
        return $this->hasOne(ResponMaster::class);
    }

    public function respon_detail()
    {
        return $this->hasOne(ResponDetail::class);
    }

    public function monev_master_dokumen()
    {
        return $this->belongsTo(MonevMasterDokumen::class, 'monev_master_dokumen_id');
    }
}
