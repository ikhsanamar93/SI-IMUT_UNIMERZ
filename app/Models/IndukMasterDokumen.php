<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndukMasterDokumen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mutu_dokumen()
    {
        return $this->belongsTo(MutuDokumen::class, 'mutu_dokumen_id');
    }
    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }
}
