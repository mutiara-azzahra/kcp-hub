<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStokGudangHet extends Model
{
    use HasFactory;

    protected $table = 'master_stok_gudang_het';
    protected $primaryKey = 'id';

    protected $fillable = [
        'part_no', 
        'het',
        'status', 
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function harga_het()
    {
        return $this->belongsTo(MasterPartNon::class, 'part_no', 'part_no');
    }

    public function stok()
    {
        return $this->belongsTo(MasterStokGudang::class, 'part_no', 'part_no');
    }

    public function ready()
    {
        return $this->belongsTo(StokGudang::class, 'part_no', 'part_no');
    }
}
