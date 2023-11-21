<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPartModal extends Model
{
    use HasFactory;

    protected $table = 'master_part_modal';
    protected $primaryKey = 'id';

    protected $fillable = [
        'part_no', 
        'qty',
        'modal',
        'status',
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function het()
    {
        return $this->hasOne(MasterPart::class, 'part_no', 'part_no');
    }
}
