<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmiStandarMaster extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function mutu_kategori()
    {
        return $this->belongsTo(MutuKategori::class, 'mutu_kategori_id');
    }

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }

    public function versi_master()
    {
        return $this->belongsTo(VersiMaster::class, 'versi_master_id');
    }

    public function spmi_standar_detail()
    {
        return $this->hasMany(SpmiStandarDetail::class);
    }

    public function ami_periode_detail()
    {
        return $this->hasMany(AmiPeriodeDetail::class);
    }
}
