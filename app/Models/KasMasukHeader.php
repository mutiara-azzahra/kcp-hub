<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasukHeader extends Model
{
    use HasFactory;

    protected $table = 'kas_masuk_header';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [ 
        'no_kas_masuk', 'no_piutang', 'id_transfer', 'tanggal_rincian_tagihan',
        'kd_area','kd_outlet','nominal', 'pembayaran_via','no_bg','jatuh_tempo_bg','flag_transfer_masuk', 'bank', 'flag_potong_bonus',
        'nominal_bonus','flag_kas_manual','terima_dari','keterangan','status','flag_batal', 'trx_date', 'created_at', 'created_by', 'updated_at',
        'updated_by'
    ];
}
