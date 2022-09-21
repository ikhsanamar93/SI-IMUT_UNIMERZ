<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkreditasiMaster extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function akreditasi_periode_detail()
    {
        return $this->hasMany(AkreditasiPeriodeDetail::class);
    }

    public function akreditasi_master_dokumen()
    {
        return $this->hasMany(AkreditasiMasterDokumen::class);
    }

    public function akreditasi_kategori()
    {
        return $this->belongsTo(AkreditasiKategori::class, 'akreditasi_kategori_id');
    }

    public function monev_kategori()
    {
        return $this->belongsTo(MonevKategori::class, 'monev_kategori_id');
    }
}
