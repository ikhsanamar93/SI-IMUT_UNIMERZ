<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkreditasiPeriodeDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function akreditasi_kategori()
    {
        return $this->belongsTo(AkreditasiKategori::class, 'akreditasi_kategori_id');
    }

    public function akreditasi_master()
    {
        return $this->belongsTo(AkreditasiMaster::class, 'akreditasi_master_id');
    }

    public function akreditasi_periode()
    {
        return $this->belongsTo(AkreditasiPeriode::class, 'akreditasi_periode_id');
    }
}
