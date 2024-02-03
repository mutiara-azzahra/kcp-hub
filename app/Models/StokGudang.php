<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokGudang extends Model
{
    use HasFactory;

    protected $table = 'stok_part';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'invoice_non', 'id_rak','part_no' ,'stok' ,'status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function rak()
    {
        return $this->belongsTo(MasterKodeRak::class, 'id_rak', 'id');
    }

    public function part_rak()
    {
        return $this->hasOne(MasterPart::class, 'part_no', 'part_no');
    }
}
