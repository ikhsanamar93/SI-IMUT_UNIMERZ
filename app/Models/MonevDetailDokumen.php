<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonevDetailDokumen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function monev_master_dokumen()
    {
        return $this->belongsTo(MonevMasterDokumen::class, 'monev_master_dokumen_id');
    }

    public function spmi_standar_master()
    {
        return $this->belongsTo(SpmiStandarMaster::class, 'spmi_standar_master_id');
    }

    public function mutu_dokumen()
    {
        return $this->belongsTo(MutuDokumen::class, 'mutu_dokumen_id');
    }

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }
}
