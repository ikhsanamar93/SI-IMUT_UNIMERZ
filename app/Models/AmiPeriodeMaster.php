<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmiPeriodeMaster extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ami_periode()
    {
        return $this->belongsTo(AmiPeriode::class, 'ami_periode_id');
    }

    public function ami_periode_detail()
    {
        return $this->hasMany(AmiPeriodeDetail::class);
    }

    public function spmi_standar_master()
    {
        return $this->belongsTo(SpmiStandarMaster::class, 'spmi_standar_master_id');
    }
}
