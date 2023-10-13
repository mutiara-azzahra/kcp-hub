<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSuratJalanHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_sj_header';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'nosj', 'flag_cetak', 'flag_cetak_date', 'status', 'ket_status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public static function nosj()
    {

        $now = Carbon::now();
        $currentYear    = $now->year;
        $currentMonth   = $now->format('m');

        $latestRecord = static::orderBy('nosj', 'desc')->first();

        if ($latestRecord) {
            $lastCustomId   = $latestRecord->nosj;
            $lastYear       = substr($lastCustomId, 3, 4);
            $lastMonth      = substr($lastCustomId, 7, 2);
            $lastNumber     = (int)substr($lastCustomId, -5);

            if ($lastYear == $currentYear && $lastMonth == $currentMonth) {
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
        } else {
            $newNumber = 1;
        }

        $newCustomSO = 'SJ-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomSO;
    }

    public function details_sj()
    {
        return $this->hasMany(TransaksiSuratJalanDetails::class, 'nosj', 'nosj');
    }

}
