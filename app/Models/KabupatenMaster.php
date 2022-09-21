<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabupatenMaster extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function provinsi_master()
    {
        return $this->belongsTo(ProvinsiMaster::class, 'provinsi_master_id');
    }

    public function kecamatan_master()
    {
        return $this->hasMany(KecamatanMaster::class);
    }
}
