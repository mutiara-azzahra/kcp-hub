<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntransitHeader extends Model
{
    use HasFactory;

    protected $table = 'intransit_header';
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_surat_pesanan',
        'tanggal_packingsheet',
        'status',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    public function details()
    {
        return $this->hasMany(IntransitDetails::class, 'no_surat_pesanan', 'no_surat_pesanan');
    }
}
