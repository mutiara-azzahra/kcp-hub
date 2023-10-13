<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPlafond extends Model
{
    use HasFactory;

    protected $table = 'transaksi_plafond';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [ 
        'kd_outlet', 'nm_outlet', 'target_per_bulan', 'nominal_plafond', 'status', 'created_at', 
        'updated_at', 'created_by', 'updated_by'
    ];
}
