<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokGudang extends Model
{
    use HasFactory;

    protected $table = 'master_stok_gudang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'part_no', 
        'stok',
        'status', 
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function transaksi_so()
    {
        return $this->hasMany(TransaksiSODetails::class, 'part_no', 'part_no');
    }
}
