<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKelompokPart extends Model
{
    use HasFactory;
    protected $table = 'master_part_kelompok';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kelompok_part', 
        'status',
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];


}
