<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturDetails extends Model
{
    use HasFactory;

    protected $table = 'retur_details';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'id', 'no_retur', 'part_no', 'qty_invoice', 'qty_retur', 'hrg_pcs_invoice', 'disc_invoice', 'nominal_retur', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
}
