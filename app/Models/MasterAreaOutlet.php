<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAreaOutlet extends Model
{
    use HasFactory;

    protected $table = 'master_area_outlet';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_prp',
        'kode_kab',
        'nm_area',
        'status', 
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];
}
