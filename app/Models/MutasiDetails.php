<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiDetails extends Model
{
    use HasFactory;

    protected $table = 'mutasi_details';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'no_mutasi', 'rak_asal', 'rak_tujuan', 'approval_head_gudang', 'tanggal_approval', 'cetak_sj_mutasi', 
        'tanggal_cetak_sj_mutasi', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
