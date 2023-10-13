<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembayaranPiutangHeader extends Model
{
   
    use HasFactory;

    protected $table        = 'transaksi_pembayaran_piutang_header';
    protected $primaryKey   = 'id';
    public $timestamps      = false;

    protected $fillable = [ 
        'no_piutang', 'area_piutang', 'kd_outlet', 'nm_outlet', 'nominal_potong', 'nominal_total', 'pembayaran_via', 
        'no_bg', 'jatuh_tempo_bg', 'id_bank', 'flag_cetak_penerimaan', 'flag_cetak_penerimaan_date', 'flag_terima_kasir', 
        'flag_terima_kasir_date', 'no_kasir_masuk', 'flag_batal', 'flag_batal_date', 'flag_batal_keterangan', 'status', 
        'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public static function no_piutang()
    {
        $now = Carbon::now();
        $currentYear = $now->year;
        $currentMonth = $now->format('m');

        $latestRecord = static::orderBy('no_piutang', 'desc')->first();

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

        $newCustomId = 'PUT-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomId;
    }
}
