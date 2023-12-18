<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BgMasukHeader extends Model
{
    use HasFactory;

    protected $table = 'trns_bg_header';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'id_bg', 'status_bg', 'from_bg', 'keterangan', 'nominal', 'status','flag_balik', 'flag_batal', 'fla_batal_keterangan','created_at', 'updated_at', 'created_by', 'updated_by'
    ];


    public static function id_bg()
    {

        $now            = Carbon::now();
        $currentYear    = $now->year;
        $currentMonth   = $now->format('m');

        $latestRecord = static::orderBy('id_bg', 'desc')->first();

        if ($latestRecord) {
            $lastCustomId = $latestRecord->id_bg;
            $lastYear     = substr($lastCustomId, 3, 4);
            $lastMonth    = substr($lastCustomId, 7, 2);
            $lastNumber   = (int)substr($lastCustomId, -5);

            if ($lastYear == $currentYear && $lastMonth == $currentMonth) {
            
                $newNumber = $lastNumber + 1;
            } else {
               
                $newNumber = 1;
            }
        } else {
            
            $newNumber = 1;
        }

        $newCustomId = 'BG-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomId;
    }
}
