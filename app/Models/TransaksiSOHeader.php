<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSOHeader extends Model
{
    use HasFactory;

    protected $table = 'trns_so_header';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

        'noso', 'area_so', 'kd_outlet', 'nm_outlet', 'total', 'keterangan', 'status', 'ket_status', 
        'user_sales', 'flag_selesai', 'flag_selesai_date', 'flag_unlock_ar', 'flag_unlock_disc', 
        'flag_approve', 'flag_approve_date', 'flag_approve_by', 'flag_reject', 'flag_reject_date', 'flag_reject_by', 
        'flag_reject_keterangan', 'flag_cetak_gudang', 'flag_cetak_gudang_date', 'flag_vald_gudang', 'flag_vald_date', 
        'no_packingsheet', 'flag_packingsheet', 'flag_packingsheet_date', 'flag_lock', 'no_invoice', 'flag_invoice', 'flag_invoice_date',
        'no_sj', 'flag_sj', 'flag_sj_date', 'crea_date', 'crea_by', 'modi_date', 'modi_by'
       
    ];

    public function details_so()
    {
        return $this->hasMany(TransaksiSODetails::class, 'noso', 'noso');
    }

    public function sp()
    {
        return $this->hasOne(TransaksiSpHeader::class, 'noso', 'noso');
    }

    public function sj()
    {
        return $this->belongsTo(TransaksiSuratJalanHeader::class, 'noso', 'noso');
    }

    public function ps()
    {
        return $this->hasOne(TransaksiPackingsheetHeader::class, 'noso', 'noso');
    }
    
    public function invoice()
    {
        return $this->belongsTo(TransaksiInvoiceHeader::class, 'noso', 'noso');
    }

    public function outlet()
    {
        return $this->hasOne(MasterOutlet::class, 'kd_outlet', 'kd_outlet');
    }
    
}
