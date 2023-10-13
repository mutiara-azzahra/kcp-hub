<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKategoriPart extends Model
{
    use HasFactory;

    protected $table = 'master_part_kategori';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kategori_part', 
        'status',
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function part_non(){
        return $this->hasMany(MasterPartNon::class, 'id', 'id_kategori_part');
    }
}
