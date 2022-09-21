<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaMaster extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }

    public function unit_master2()
    {
        return $this->belongsTo(UnitMaster::class, 'fakultas_id');
    }

    public function mutu_periode()
    {
        return $this->belongsTo(MutuPeriode::class, 'angkatan_id');
    }
}
