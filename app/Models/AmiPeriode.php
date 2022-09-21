<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmiPeriode extends Model
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

    public function dosen()
    {
        return $this->belongsTo(DosenMaster::class, 'auditee_id', 'id');
    }

    public function dosen1()
    {
        return $this->belongsTo(DosenMaster::class, 'auditor1_id', 'id');
    }

    public function dosen2()
    {
        return $this->belongsTo(DosenMaster::class, 'auditor2_id', 'id');
    }

    public function dosen3()
    {
        return $this->belongsTo(DosenMaster::class, 'observer_id', 'id');
    }

    public function ami_periode_master()
    {
        return $this->hasMany(AmiPeriodeMaster::class);
    }

    public function ami_periode_detail()
    {
        return $this->hasMany(AmiPeriodeDetail::class);
    }
}
