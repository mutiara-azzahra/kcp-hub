<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProduk extends Model
{
    use HasFactory;

    protected $table = 'master_produk';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_part',
        'keterangan', 
        'status',
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];
}
