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
        'nops', 'area_ps', 'noso', 'kd_outlet', 'part_no', 'qty', 'dus', 'no_dus', 
        'status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function master_part()
    {
        return $this->belongsTo(MasterPart::class, 'part_no', 'part_no');
    }
}