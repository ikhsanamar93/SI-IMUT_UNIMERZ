<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkreditasiPeriode extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function akreditasi_periode_detail()
    {
        return $this->hasMany(AkreditasiPeriodeDetail::class);
    }

    public function akreditasi_master_dokumen()
    {
        return $this->hasMany(AkreditasiMasterDokumen::class);
    }

    public function akreditasi_kategori()
    {
        return $this->belongsTo(AkreditasiKategori::class, 'akreditasi_kategori_id');
    }

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }

    public function mutu_periode()
    {
        return $this->belongsTo(MutuPeriode::class, 'mutu_periode_id');
    }

    public function dosen()
    {
        return $this->belongsTo(DosenMaster::class, 'auditee_id', 'id');
    }

    public function dosen1()
    {
        return $this->belongsTo(DosenMaster::class, 'asesor1_id', 'id');
    }

    public function dosen2()
    {
        return $this->belongsTo(DosenMaster::class, 'asesor2_id', 'id');
    }

    public function dosen3()
    {
        return $this->belongsTo(DosenMaster::class, 'observer_id', 'id');
    }
}
