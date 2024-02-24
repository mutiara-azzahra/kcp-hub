<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiAkuntansiJurnalHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_akuntansi_jurnal_header';
    public $primaryKey = 'id';

    protected $fillable = [
        'trx_date', 
        'trx_from',
        'keterangan',
        'catatan',
        'kategori',
        'flag_batal',
        'keterangan_batal',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    public function details()
    {
        return $this->hasMany(TransaksiAkuntansiJurnalDetails::class, 'id', 'id_header');
    }
}
