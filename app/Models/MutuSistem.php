<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutuSistem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function mutu_kategori()
    {
        return $this->hasMany(MutuKategori::class);
    }

    public function spmi_master_dokumen()
    {
        return $this->hasMany(SpmiMasterDokumen::class);
    }
}
