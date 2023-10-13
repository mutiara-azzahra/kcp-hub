<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitMasterPart extends Model
{
    use HasFactory;

    protected $table = 'mst_init';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function dbp()
    {
        return $this->belongsTo(DbpAop::class, 'part_no', 'part_no');
    }

    public function master()
    {
        return $this->belongsTo(PartAOPMaster::class, 'part_no', 'part_no');
    }


}
