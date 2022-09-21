<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutuKategori extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function mutu_sistem()
    {
        return $this->belongsTo(MutuSistem::class, 'mutu_sistem_id');
    }

    public function standar_spmi_master()
    {
        return $this->hasMany(StandarSpmiMaster::class);
    }

    public function spmi_detail_dokumen()
    {
        return $this->hasMany(SpmiDetailDokumen::class);
    }
}
