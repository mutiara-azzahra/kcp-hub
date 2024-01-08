<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturHeader extends Model
{
    use HasFactory;

    protected $table = 'retur_header';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'no_retur', 'noinv', 'kd_toko', 'nm_toko', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public static function no_retur()
    {
        $now            = Carbon::now();
        $currentYear    = $now->year;
        $currentMonth   = $now->format('m');

        $latestRecord = static::orderBy('no_retur', 'desc')->first();

        if ($latestRecord) {
            $lastCustomId   = $latestRecord->no_retur;
            $lastYear       = substr($lastCustomId, 4, 4);
            $lastMonth      = substr($lastCustomId, 8, 2);
            $lastNumber     = (int)substr($lastCustomId, -5);

            if ($lastYear == $currentYear) {
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
        } else {
            $newNumber = 1;
        }

        $newCustomId = 'RTU-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomId;
    }
}
