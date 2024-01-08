<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukHeader extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_gudang_header';
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'invoice_non', 'customer_to', 'supplier', 'tanggal_nota', 'status', 
        'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function details()
    {
        return $this->hasMany(BarangMasukDetails::class, 'invoice_non', 'invoice_non');
    }
}
