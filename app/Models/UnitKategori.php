<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKategori extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function unit_master()
    {
        return $this->hasMany(UnitMaster::class);
    }
}
