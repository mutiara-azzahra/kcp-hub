<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferMasukDetails extends Model
{
    use HasFactory;

    protected $table = 'trns_transfer_details';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'id_transfer', 'status_transfer', 'perkiraan', 'akuntansi_to', 'total', 'status','created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function header()
    {
        return $this->belongsTo(TransferMasukHeader::class, 'id_transfer', 'id_transfer');
    }
}
