<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDusPackingsheet extends Model
{
    use HasFactory;

    protected $table = 'kategori_dus_packingsheet';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kd_kategori', 
        'kategori', 
        'status',
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function part_non(){
        return $this->hasMany(MasterPartNon::class, 'id', 'id_kategori_part');
    }
    public function dus()
    {
        return $this->belongsTo(TransaksiPackingsheetDetailsDus::class, 'kd_kategori', 'kd_kategori');
    }
}
