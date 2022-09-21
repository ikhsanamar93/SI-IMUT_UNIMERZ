<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkreditasiMasterDokumen extends Model
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

    public function akreditasi_master()
    {
        return $this->belongsTo(AkreditasiMaster::class, 'akreditasi_master_id');
    }

    public function akreditasi_periode()
    {
        return $this->belongsTo(AkreditasiPeriode::class, 'akreditasi_periode_id');
    }

    public function induk_master_dokumen()
    {
        return $this->belongsTo(IndukMasterDokumen::class, 'induk_master_dokumen_id');
    }

    public function mutu_detail_dokumen()
    {
        return $this->belongsTo(MutuDetailDokumen::class, 'mutu_detail_dokumen_id');
    }

    public function monev_detail_dokumen()
    {
        return $this->belongsTo(MonevDetailDokumen::class, 'monev_detail_dokumen_id');
    }
}
