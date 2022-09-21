<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmiStandarDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }

    public function spmi_standar_master()
    {
        return $this->belongsTo(SpmiStandarMaster::class, 'spmi_standar_master_id');
    }

    public function ami_periode_detail()
    {
        return $this->hasMany(AmiPeriodeDetail::class);
    }
}
