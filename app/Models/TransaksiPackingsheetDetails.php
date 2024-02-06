<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPackingsheetDetails extends Model
{
    use HasFactory;

    protected $table = 'transaksi_packingsheet_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [ 
        'nops', 'area_ps', 'noso', 'kd_outlet', 'part_no', 'qty','id_rak', 'dus', 'no_dus', 
        'status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function master_part()
    {
        return $this->belongsTo(MasterPart::class, 'part_no', 'part_no');
    }
    public function stok()
    {
        return $this->belongsTo(MasterStokGudang::class, 'part_no', 'part_no');
    }
    public function outlet()
    {
        return $this->hasOne(MasterOutlet::class, 'kd_outlet', 'kd_outlet');
    }

    public function invoice()
    {
        return $this->hasOne(TransaksiInvoiceHeader::class, 'noso', 'noso');
    }
    public function so()
    {
        return $this->belongsTo(TransaksiSOHeader::class, 'noso', 'noso');
    }
    public function rak()
    {
        return $this->hasMany(StokGudang::class, 'id_rak', 'id_rak');
    }
    
}
