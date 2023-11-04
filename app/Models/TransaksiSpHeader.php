<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class TransaksiSpHeader extends Model
{
    use HasFactory;

    protected $table = 'trns_sp_header';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'nosp', 
        'area_sp',
        'noso',
        'kd_outlet',
        'nm_outlet',
        'total',
        'keterangan',
        'status',
        'ket_status',
        'user_sales',
        'crea_date',
        'crea_by',
        'modi_date',
        'modi_by'
    ];

    public static function nosp()
    {

        $now = Carbon::now();
        $currentYear    = $now->year;
        $currentMonth   = $now->format('m');

        $latestRecord = static::orderBy('nosp', 'desc')->first();

        if ($latestRecord) {
            $lastCustomId = $latestRecord->nosp;
            $lastYear = substr($lastCustomId, 3, 4);
            $lastMonth = substr($lastCustomId, 7, 2);
            $lastNumber = (int)substr($lastCustomId, -5);

            if ($lastYear == $currentYear && $lastMonth == $currentMonth) {
            
                $newNumber = $lastNumber + 1;
            } else {
               
                $newNumber = 1;
            }
        } else {
            
            $newNumber = 1;
        }

        $newCustomId = 'SP-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomId;
    }
    
    public static function noso()
    {

        $now            = Carbon::now();
        $currentYear    = $now->year;
        $currentMonth   = $now->format('m');

        $latestRecord = static::orderBy('noso', 'desc')->first();

        

        if ($latestRecord) {
            $lastCustomId   = $latestRecord->noso;

            
            $lastYear       = substr($lastCustomId, 3, 4);
            $lastMonth      = substr($lastCustomId, 7, 2);
            $lastNumber     = (int)substr($lastCustomId, -5);
            
            if ($lastYear == $currentYear && $lastMonth == $currentMonth) {
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
                dd($newNumber);
            }
        } else {
            $newNumber = 1;
        }

        $newCustomSO = 'SO-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomSO;
    }

    public function details_sp()
    {
        return $this->hasMany(TransaksiSpDetails::class, 'nosp', 'nosp');
    }

    public function so()
    {
        return $this->hasOne(TransaksiSOHeader::class, 'noso', 'noso');
    }

    public function outlet()
    {
        return $this->belongsTo(MasterOutlet::class, 'kd_outlet', 'kd_outlet');
    }

    public function plafond()
    {
        return $this->belongsTo(TransaksiPlafond::class, 'kd_outlet', 'kd_outlet');
    }
}
