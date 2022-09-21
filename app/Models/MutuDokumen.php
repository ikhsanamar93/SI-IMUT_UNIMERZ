<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutuDokumen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function induk_master_dokumen()
    {
        return $this->hasMany(IndukMasterDokumen::class);
    }

    public function mutu_detail_dokumen()
    {
        return $this->hasMany(MutuDetailDokumen::class);
    }
}
