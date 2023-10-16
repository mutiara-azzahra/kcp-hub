<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDiskonPart extends Model
{
    use HasFactory;

    protected $table = 'master_part_diskon';
    protected $primaryKey = 'id';

    protected $fillable = [
        'part_no', 'diskon_maksimal', 'diskon_retail', 'diskon_semi', 'diskon_grosir', 
        'status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
