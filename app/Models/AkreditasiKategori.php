<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkreditasiKategori extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function akreditasi_master()
    {
        return $this->hasMany(AkreditasiMaster::class);
    }

    public function akreditasi_periode()
    {
        return $this->hasMany(AkreditasiPeriode::class);
    }

    public function akreditasi_periode_detail()
    {
        return $this->hasMany(AkreditasiPeriodeDetail::class);
    }
}
