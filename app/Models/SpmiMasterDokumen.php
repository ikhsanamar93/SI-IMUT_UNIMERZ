<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmiMasterDokumen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function mutu_sistem()
    {
        return $this->belongsTo(MutuSistem::class, 'mutu_sistem_id');
    }

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }

    public function versi_master()
    {
        return $this->belongsTo(VersiMaster::class, 'versi_master_id');
    }

    public function spmi_detail_dokumen()
    {
        return $this->hasMany(SpmiDetailDokumen::class);
    }
}
