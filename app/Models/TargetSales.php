<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetSales extends Model
{
    use HasFactory;

    protected $table = 'target_sales';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'sales', 'bulan', 'tahun', 'nominal', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
