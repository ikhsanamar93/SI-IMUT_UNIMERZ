<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonevKategori extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function monev_master()
    {
        return $this->hasMany(MonevMaster::class);
    }

    public function akreditasi_master()
    {
        return $this->hasMany(AkreditasiMaster::class);
    }

    // public function monev_master_dokumen()
    // {
    //     return $this->hasMany(MonevMasterDokumen::class);
    // }
}
