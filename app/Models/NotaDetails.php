<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaDetails extends Model
{
    use HasFactory;

    protected $table = 'nota_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice_non',
        'part_no',
        'part_nama',
        'qty',
        'harga',
        'diskon_persen',
        'diskon_nominal',
        'total_harga',
        'ppn_persen',
        'total_ppn',
        'total_diskon_persen',
        'total_amount',
        'amount_nota',
        'created_at',
        'updated_at',
        'created_by', 
        'updated_by'
    ];
}
