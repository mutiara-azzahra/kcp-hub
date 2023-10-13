<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class TransaksiInvoiceHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_invoice_header';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'noinv', 'noso', 'kd_outlet', 'nm_outlet', 'amount_dpp', 'amount_ppn', 'amount', 'amount_disc', 
        'amount_dpp_disc', 'amount_ppn_disc', 'amount_total', 'status', 'ket_status', 'catatan', 'user_sales', 
        'tgl_jatuh_tempo', 'count_cetak', 'flag_batal', 'flag_batal_date', 'flag_pembayaran_lunas', 'created_at', 
        'updated_at', 'created_by', 'updated_by'
    ];


    public static function noinv()
    {
        $now = Carbon::now();
        $currentYear = $now->year;
        $currentMonth = $now->format('m');

        $latestRecord = static::orderBy('noinv', 'desc')->first();

        if ($latestRecord) {
            $lastCustomId = $latestRecord->noinv;
            $lastYear = substr($lastCustomId, 4, 4); 
            $lastMonth = substr($lastCustomId, 8, 2);
            $lastNumber = (int)substr($lastCustomId, -5);

            if ($lastYear == $currentYear && $lastMonth == $currentMonth) {
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
        } else {
            $newNumber = 1;
        }

        $newCustomId = 'INV-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomId;
    }

    public function outlet()
    {
        return $this->hasOne(MasterOutlet::class, 'kd_outlet', 'kd_outlet');
    }

    public function packingsheet()
    {
        return $this->hasOne(TransaksiPackingsheetHeader::class, 'noso', 'noso');
    }

    public function sj()
    {
        return $this->hasMany(TransaksiSuratJalan::class, 'noso', 'noso');
    }



    
}
