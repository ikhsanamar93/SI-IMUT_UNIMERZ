<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KecamatanMaster extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kabupaten_master()
    {
        return $this->belongsTo(KabupatenMaster::class, 'kabupaten_master_id');
    }
}
