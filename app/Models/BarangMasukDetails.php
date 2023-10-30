<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukDetails extends Model
{

    use HasFactory;

    protected $table = 'barang_masuk_gudang_details';
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'invoice_non', 'part_no', 'qty', 'id_rak', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
