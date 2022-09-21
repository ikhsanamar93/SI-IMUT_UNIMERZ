<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonevMaster extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function monev_kategori()
    {
        return $this->belongsTo(MonevKategori::class, 'monev_kategori_id');
    }

    public function monev_detail_dokumen()
    {
        return $this->hasMany(MonevDetailDokumen::class);
    }

    public function kuesioner_master()
    {
        return $this->hasMany(KuesionerMaster::class);
    }
}
