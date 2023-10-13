<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSales extends Model
{
    use HasFactory;

    protected $table = 'master_sales';
    protected $primaryKey = 'id';

    protected $fillable = [
        'sales', 
        'status', 
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'sales', 'username');
    }

    public function area_sales()
    {
        return $this->hasMany(MasterAreaSales::class, 'id_sales', 'id');
    }
}
