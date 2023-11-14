<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetSpv extends Model
{
    use HasFactory;

    protected $table = 'target_spv';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'spv', 'bulan', 'tahun', 'nominal', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
