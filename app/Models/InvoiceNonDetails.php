<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceNonDetails extends Model
{
    use HasFactory;

    protected $table = 'invoice_non_details';
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
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function header_pembelian()
    {
        return $this->belongsTo(InvoiceNonHeader::class, 'invoice_non', 'invoice_non');
    }
}
