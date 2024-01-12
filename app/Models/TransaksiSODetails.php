<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSODetails extends Model
{
    use HasFactory;

    protected $table = 'trns_so_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [ 
        'noso', 'area_so', 'kd_outlet', 'part_no', 'nm_part', 'qty', 'hrg_pcs', 'disc', 'nominal', 
        'nominal_disc', 'nominal_total', 'qty_gudang', 'ket_gudang', 'flag_stock_tt', 'nominal_gudang', 
        'nominal_disc_gudang', 'nominal_total_gudang', 'status', 'crea_date', 'crea_by', 'modi_date', 'modi_by'
    
    ];

    public function header_so()
    {
        return $this->belongsTo(TransaksiSOHeader::class, 'noso', 'noso');
    }

    public function nama_part()
    {
        return $this->hasOne(MasterPart::class, 'part_no', 'part_no');
    }

    public function stok_ready()
    {
        return $this->belongsTo(MasterStokGudang::class, 'part_no', 'part_no');
    }

    public function rak()
    {
        return $this->hasMany(BarangMasukDetails::class, 'part_no', 'part_no');
    }

}
