<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class TransaksiPackingsheetHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_packingsheet_header';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'nops', 'area_ps', 'noso', 'kd_outlet', 'nm_outlet', 'flag_cetak', 'flag_cetak_date', 
        'flag_cetak_label', 'flag_cetak_label_date', 'koli', 'flag_lkh', 'no_lkh', 'date_lkh', 
        'status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'flag_sj', 'flag_sj_date'
    ];


    public static function nops()
    {

        $now = Carbon::now();
        $currentYear    = $now->year;
        $currentMonth   = $now->format('m');

        $latestRecord = static::orderBy('nops', 'desc')->first();

        if ($latestRecord) {
            $lastCustomId = $latestRecord->nops;
            $lastYear = substr($lastCustomId, 3, 4);
            $lastMonth = substr($lastCustomId, 7, 2);
            $lastNumber = (int)substr($lastCustomId, -5);

            if ($lastYear == $currentYear && $lastMonth == $currentMonth) {
                // Same year and month, increment the number
                $newNumber = $lastNumber + 1;
            } else {
                // New year or month, reset the number
                $newNumber = 1;
            }
        } else {
            // No previous records, start with 1
            $newNumber = 1;
        }

        $newCustomId = 'PS-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomId;
    }

    public function details_ps()
    {
        return $this->hasMany(TransaksiPackingsheetDetails::class, 'nops', 'nops');
    }

    public function details_dus()
    {
        return $this->hasMany(TransaksiPackingsheetDetailsDus::class, 'nops', 'nops');
    }

    public function outlet()
    {
        return $this->hasOne(MasterOutlet::class, 'kd_outlet', 'kd_outlet');
    }

    public function kode_outlet()
    {
        return $this->hasOne(MasterKodeOutlet::class, 'kd_outlet', 'kd_outlet');
    }

    public function invoice()
    {
        return $this->hasMany(TransaksiInvoiceHeader::class, 'noso', 'noso');
    }

    public function sj()
    {
        return $this->belongsTo(TransaksiSuratJalanHeader::class, 'nops', 'nops');
    }

    public function details_sj()
    {
        return $this->hasMany(TransaksiSuratJalanDetails::class, 'nops', 'nops');
    }

    public function lkh()
    {
        return $this->hasMany(TransaksiLkhDetails::class, 'nops', 'no_packingsheet');
    }

}
