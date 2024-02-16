<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiRincianAccountReceiveable extends Model
{
    use HasFactory;

    protected $table        = 'transaksi_rincian_account_receiveable';
    protected $primaryKey   = 'id';

    protected $fillable = [ 
        'kd_outlet', 'noinv', 'keterangan', 'flag_terima', 'tanggal_terima', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function header_invoice()
    {
        return $this->hasOne(TransaksiInvoiceHeader::class, 'noinv', 'noinv');
    }

    public function outlet()
    {
        return $this->hasOne(MasterOutlet::class, 'kd_outlet', 'kd_outlet');
    }
}
