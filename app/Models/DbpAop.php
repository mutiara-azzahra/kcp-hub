<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DbpAop extends Model
{
    use HasFactory;

    protected $table = 'part_aop_modal';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'het',
        'modi_date'
    ];

    public function part_no()
    {
        return $this->hasMany(InitMasterPart::class, 'part_no', 'part_no');
    }

    public function details()
    {
        return $this->hasMany(InvoiceAOPDetails::class, 'part_no', 'part_no');
    }
}
