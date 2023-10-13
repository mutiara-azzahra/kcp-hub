<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGroupPart extends Model
{
    use HasFactory;

    protected $table = 'master_part_group';
    protected $primaryKey = 'id';

    protected $fillable = [
        'group_part', 
        'status',
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function part_non(){
        return $this->hasMany(MasterPartNon::class, 'id', 'id_group_part');
    }
}
