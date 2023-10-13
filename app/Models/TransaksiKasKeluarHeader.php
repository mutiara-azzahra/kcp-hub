<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKasKeluarHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_kas_keluar_header';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [ 
        'no_keluar', 'divisi', 'pembayaran', 'keterangan', 'amount_total', 'flag_cetak', 'flag_batal', 'trx_date', 'status', 
        'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
