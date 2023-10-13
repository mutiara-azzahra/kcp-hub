<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLkhDetails extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lkh_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [ 
        'no_lkh', 'area_lkh', 'no_urut', 'kd_gudang', 'kd_outlet', 'nm_outlet', 'koli', 'no_packingsheet', 
        'expedisi', 'keterangan', 'status', 'ket_status', 'terima_ar', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];


    public function lkh()
    {
        return $this->hasOne(TransaksiLkhHeader::class, 'no_lkh', 'no_lkh');
    }

    public function outlet()
    {
        return $this->hasMany(MasterOutlet::class, 'kd_outlet', 'kd_outlet');
    }

    public function ps()
    {
        return $this->belongsTo(TransaksiPackingsheetHeader::class, 'no_packingsheet', 'nops');
    }
}
