<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStokGudang extends Model
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

    public function het()
    {
        return $this->hasOne(MasterStokGudangHet::class, 'part_no', 'part_no');
    }

    

}
