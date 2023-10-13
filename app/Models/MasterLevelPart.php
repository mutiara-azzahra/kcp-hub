<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterLevelPart extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'master_part_level_4';
    protected $primaryKey = 'id';

    protected $fillable = [
        'level_4', 
        'status',
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function part_non(){
        return $this->hasMany(MasterPartNon::class, 'id', 'id_level_4');
    }
}
