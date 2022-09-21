<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinsiMaster extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kabupaten_master()
    {
        return $this->hasMany(KabupatenMaster::class);
    }
}
