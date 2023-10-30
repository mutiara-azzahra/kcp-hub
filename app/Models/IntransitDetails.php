<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntransitDetails extends Model
{
    use HasFactory;

    protected $table = 'intransit_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_surat_pesanan',
        'no_packingsheet',
        'no_doos',
        'part_no',
        'qty',
        'harga_pcs',
        'status',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    public function header()
    {
        return $this->hasOne(IntransitHeader::class, 'no_surat_pesanan', 'no_surat_pesanan');
    }

    public function nama()
    {
        return $this->hasOne(MasterPart::class, 'part_no', 'part_no');
    }
}
