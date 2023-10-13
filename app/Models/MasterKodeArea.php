<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKodeArea extends Model
{
    use HasFactory;

    protected $table = 'mst_area';
    protected $primaryKey = 'id';


    protected $fillable = [
        'kode_prp', 'kode_kab', 'nm_area', 'status', 'crea_date', 'crea_by', 'modi_date', 'modi_by'
    ];

    public function invoice_header(){
        return $this->hasMany(TransaksiInvoiceHeader::class, 'kode_kab', 'kode_kab');
    }

    public function packingsheet(){
        return $this->hasMany(MasterArea::class, 'kode_kab', 'kode_kab');
    }

    public function provinsi()
    {
        return $this->belongsTo(MasterProvinsi::class, 'kode_prp', 'kode_prp');
    }
}
