<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturHeader extends Model
{
    use HasFactory;

    protected $table = 'retur_header';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'no_retur', 'noinv', 'kd_toko', 'nm_toko', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
