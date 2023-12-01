<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LssStok extends Model
{
    use HasFactory;

    protected $table = 'lss_stok';
    protected $primaryKey = 'id';

    protected $fillable = [
        'bulan',
        'tahun',
        'sub_kelompok_part',
        'produk_part',
        'awal_stok',
        'beli',
        'jual',
        'akhir_stok',
        'status', 
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];
}
