<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitMaster extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function unit_kategori()
    {
        return $this->belongsTo(UnitKategori::class, 'unit_kategori_id');
    }

    public function unit_pengelola()
    {
        return $this->belongsTo(UnitPengelola::class, 'unit_pengelola_id');
    }

    public function standar_spmi_master()
    {
        return $this->hasMany(SpmiStandarMaster::class);
    }

    public function standar_spmi_detail()
    {
        return $this->hasMany(SpmiStandarDetail::class);
    }

    public function spmi_master_dokumen()
    {
        return $this->hasMany(SpmiMasterDokumen::class);
    }

    public function induk_master_dokumen()
    {
        return $this->hasMany(IndukMasterDokumen::class);
    }

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

    public function kuesioner_master()
    {
        return $this->hasMany(KuesionerMaster::class);
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
    public function mahasiswa_master()
    {
        return $this->hasMany(MahasiswaMaster::class);
    }

    public function dosen_master()
    {
        return $this->hasMany(DosenMaster::class);
    }

    public function tendik_master()
    {
        return $this->hasMany(TendikMaster::class);
    }

    public function alumni_master()
    {
        return $this->hasMany(AlumniMaster::class);
    }

    public function mitra_master()
    {
        return $this->hasMany(MitraMaster::class);
    }

    public function spmi_kalender()
    {
        return $this->hasMany(SpmiKalender::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function akreditasi_master_dokumen()
    {
        return $this->hasMany(AkreditasiMasterDokumen::class);
    }
}
