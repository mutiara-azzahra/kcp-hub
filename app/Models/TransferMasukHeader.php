<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferMasukHeader extends Model
{
    use HasFactory;

    protected $table = 'trns_transfer_header';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'id_header', 'status_transfer', 'tanggal_bank', 'bank', 'keterangan', 'flag_by_toko', 'catatan', 'status','flag_kas_ar','flag_batal','flag_batal_date','created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
