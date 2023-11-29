<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetSpvProduk extends Model
{
    use HasFactory;

    protected $table = 'target_spv_by_produk';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'spv', 'kode_produk', 'bulan', 'tahun', 'nominal', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
