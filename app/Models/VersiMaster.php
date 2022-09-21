<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersiMaster extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function standar_spmi_master()
    {
        return $this->hasMany(StandarSpmiMaster::class);
    }

    public function spmi_master_dokumen()
    {
        return $this->hasMany(SpmiMasterDokumen::class);
    }
}
