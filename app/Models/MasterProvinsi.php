<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProvinsi extends Model
{

    use HasFactory;

    protected $table    = 'mst_provinsi';
    public $primaryKey  = 'kode_prp';
    public $timestamps  = false;

    protected $fillable = [
        'kode_prp', 
        'provinsi',
        'crea_by',
        'modi_by',
        'crea_date', 
        'modi_date'
    ];


    public function invoice()
    {
        return $this->hasOne(MasterOutlet::class, 'kode_prp', 'kode_prp');
    }

    public function test()
    {
        return $this->hasMany(MasterKodeArea::class, 'kode_prp', 'kode_prp');
    }
}
