<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmiDetailDokumen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mutu_kategori()
    {
        return $this->belongsTo(MutuKategori::class, 'mutu_kategori_id');
    }

    public function spmi_master_dokumen()
    {
        return $this->belongsTo(SpmiMasterDokumen::class, 'spmi_master_dokumen_id');
    }

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }
}
