<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutuPeriode extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function mutu_master_dokumen()
    {
        return $this->hasMany(MutuMasterDokumen::class);
    }

    public function monev_master_dokumen()
    {
        return $this->hasMany(MonevMasterDokumen::class);
    }

    public function ami_periode()
    {
        return $this->hasMany(AmiPeriode::class);
    }

    public function akreditasi_periode()
    {
        return $this->hasMany(AkreditasiPeriode::class);
    }

    public function survey_periode()
    {
        return $this->hasMany(SurveyPeriode::class);
    }

    public function respon_master()
    {
        return $this->hasMany(ResponMaster::class);
    }

    public function respon_detail()
    {
        return $this->hasMany(ResponDetail::class);
    }

    public function akreditasi_master_dokumen()
    {
        return $this->hasMany(AkreditasiMasterDokumen::class);
    }
}
