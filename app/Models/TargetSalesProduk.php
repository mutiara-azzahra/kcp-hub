<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetSalesProduk extends Model
{
    use HasFactory;

    protected $table = 'target_sales_by_produk';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'sales', 'kode_produk', 'bulan', 'tahun', 'nominal', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
