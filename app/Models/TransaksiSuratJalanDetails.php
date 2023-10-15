<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSuratJalanDetails extends Model
{
    use HasFactory;

    protected $table = 'transaksi_sj_details';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'nosj', 'area_sj', 'nops', 'kd_outlet', 'nm_outlet', 'koli', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function header_sj()
    {
        return $this->belongsTo(TransaksiSuratJalanHeader::class, 'nosj', 'nosj');
    }

    public function header_ps()
    {
        return $this->hasOne(TransaksiPackingsheetHeader::class, 'nops', 'nops');
    }

    public function outlet()
    {
        return $this->hasOne(MasterOutlet::class, 'kd_outlet', 'kd_outlet');
    }
}
