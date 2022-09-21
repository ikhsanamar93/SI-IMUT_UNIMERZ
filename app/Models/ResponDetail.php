<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }

    public function respon_master()
    {
        return $this->belongsTo(ResponMaster::class, 'respon_master_id');
    }

    public function mutu_periode()
    {
        return $this->belongsTo(MutuPeriode::class, 'mutu_periode_id');
    }

    public function kuesioner_master()
    {
        return $this->belongsTo(KuesionerMaster::class, 'kuesioner_master_id');
    }

    public function kuesioner_detail()
    {
        return $this->belongsTo(KuesionerDetail::class, 'kuesioner_detail_id');
    }

    public function survey_periode()
    {
        return $this->belongsTo(SurveyPeriode::class, 'survey_periode_id');
    }
}
