<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRole extends Model
{
    use HasFactory;

    protected $table = 'master_role_karyawan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'role', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    
}
