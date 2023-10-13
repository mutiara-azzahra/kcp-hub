<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterArea extends Model
{
    protected $table = 'master_area';
    protected $primaryKey = 'id';

    //`kode_provinsi`, `kode_kabupaten`, `nama_area`, `status`,
    protected $fillable = [
        'kode_provinsi',
        'kode_kabupaten',
        'status', 
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
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
