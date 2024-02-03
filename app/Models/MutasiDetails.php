<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiDetails extends Model
{
    use HasFactory;

    protected $table = 'mutasi_rak_details';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'no_mutasi', 'part_no', 'qty','invoice_non', 'keterangan', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function header()
    {
        return $this->hasOne(MutasiHeader::class, 'no_mutasi', 'no_mutasi');
    }
    
}
