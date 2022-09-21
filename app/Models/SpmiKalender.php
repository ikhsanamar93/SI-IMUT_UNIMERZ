<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmiKalender extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function unit_master()
    {
        return $this->belongsTo(UnitMaster::class, 'unit_master_id');
    }

    public function dosen()
    {
        return $this->belongsTo(DosenMaster::class, 'auditee_id', 'id');
    }

    public function dosen1()
    {
        return $this->belongsTo(DosenMaster::class, 'auditor_1', 'id');
    }

    public function dosen2()
    {
        return $this->belongsTo(DosenMaster::class, 'auditor_2', 'id');
    }
}
