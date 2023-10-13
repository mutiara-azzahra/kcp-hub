<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceNonHeader extends Model
{
    use HasFactory;

    protected $table = 'invoice_non_header';
    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice_non', 
        'txt_invoice',
        'customer_to',
        'supplier',
        'total_harga',
        'flag_ppn',
        'total_ppn',
        'total_disc_persen',
        'total_disc_nominal',
        'total_amount',
        'tanggal_nota',
        'tanggal_jatuh_tempo',
        'status',
        'grup_pembayaran',
        'flag_pembayaran',
        'flag_pembayaran_date',
        'flag_pembayaran_by',
        'flag_pembayaran_via',
        'trx_from',
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function details_pembelian()
    {
        return $this->hasMany(InvoiceNonDetails::class, 'invoice_non', 'invoice_non');
    }

    public static function bayar()
    {
        $now = Carbon::now();
        $currentYear = $now->year;
        $currentMonth = $now->format('m');

        $latestRecord = static::orderBy('grup_pembayaran', 'desc')->first();

        if ($latestRecord) {
            $lastCustomId   = $latestRecord->no_lkh;
            $lastYear       = substr($lastCustomId, 4, 4);
            $lastMonth      = substr($lastCustomId, 8, 2);
            $lastNumber     = (int)substr($lastCustomId, -5);

            if ($lastYear == $currentYear && $lastMonth == $currentMonth) {
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
        } else {
            $newNumber = 1;
        }

        $newCustomId = 'BYR-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomId;
    }
    
}
