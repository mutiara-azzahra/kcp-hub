<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterArea extends Model
{
    protected $table = 'master_area';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_provinsi',
        'kode_kabupaten',
        'status', 
        'crea_date',
        'modi_date',
        'crea_by', 
        'modi_by'
    ];

    public function area_sales()
    {
        return $this->hasOne(MasterAreaSales::class, 'kode_kabupaten', 'kode_kabupaten');
    }

    public function outlet()
    {
        return $this->hasMany(MasterOutlet::class, 'kode_kab', 'kode_kabupaten');
    }
}
