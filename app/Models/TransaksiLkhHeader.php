<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLkhHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lkh_header';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'no_lkh', 'area_lkh', 'kd_gudang', 'driver', 'helper', 'plat_mobil', 'jam_berangkat', 
        'jam_kembali', 'km_berangkat_mobil', 'km_kembali_mobil', 'flag_siap_kirim', 'flag_batal', 
        'flag_batal_date', 'flag_batal_by', 'status', 'ket_status', 'terima_ar', 'created_at', 
        'updated_at', 'created_by', 'updated_by'
    ];

    public static function no_lkh()
    {
        $now = Carbon::now();
        $currentYear = $now->year;
        $currentMonth = $now->format('m');

        $latestRecord = static::orderBy('no_lkh', 'desc')->first();

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

        $newCustomId = 'LKH-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomId;
    }


    public function details_lkh()
    {
        return $this->hasMany(TransaksiLkhDetails::class, 'no_lkh', 'no_lkh');
    }
}
