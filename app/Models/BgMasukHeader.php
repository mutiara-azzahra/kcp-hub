<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BgMasukHeader extends Model
{
    use HasFactory;

    protected $table = 'trns_bg_header';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'id_bg', 'status_bg', 'from_bg', 'keterangan', 'nominal', 'status','flag_balik', 'flag_batal', 'fla_batal_keterangan','created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
