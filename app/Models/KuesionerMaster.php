<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerMaster extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function monev_master()
    {
        return $this->belongsTo(MonevMaster::class, 'monev_master_id');
    }

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }

    public function survey_periode()
    {
        return $this->hasMany(SurveyPeriode::class);
    }

    public function kuesioner_detail()
    {
        return $this->hasMany(KuesionerDetail::class);
    }

    public function respon_master()
    {
        return $this->hasMany(KuesionerDetail::class);
    }

    public function respon_detail()
    {
        return $this->hasMany(ResponDetail::class);
    }
}
