<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowStokGudang extends Model
{
    use HasFactory;

    protected $table = 'flow_stok_gudang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'part_no',
        'tanggal_barang_masuk',
        'tanggal_barang_keluar',
        'keterangan',
        'referensi',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'stok_akhir',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    //keterangan => RETUR (+) / BARANG_MASUK (+) / BARANG_KELUAR atau INVOICE (-) / CLAIM (-)
    //referensi =>trx from

}
