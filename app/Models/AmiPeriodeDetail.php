<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmiPeriodeDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ami_periode()
    {
        return $this->belongsTo(AmiPeriodeMaster::class, 'ami_periode_id');
    }

    public function ami_periode_master()
    {
        return $this->belongsTo(AmiPeriodeMaster::class, 'ami_periode_master_id');
    }

    public function spmi_standar_master()
    {
        return $this->belongsTo(SpmiStandarMaster::class, 'spmi_standar_master_id');
    }

    public function spmi_standar_detail()
    {
        return $this->belongsTo(SpmiStandarDetail::class, 'spmi_standar_detail_id');
    }
}
