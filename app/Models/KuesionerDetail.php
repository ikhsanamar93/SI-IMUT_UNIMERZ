<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kuesioner_master()
    {
        return $this->belongsTo(KuesionerMaster::class, 'kuesioner_master_id');
    }

    public function respon_detail()
    {
        return $this->hasMany(ResponDetail::class);
    }
}
