<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBackOrderHeader extends Model
{
    use HasFactory;

    protected $table = 'transaksi_bo_header';
    public $primaryKey = 'id';

    protected $fillable = [

        'nobo', 'kd_outlet', 'nm_outlet', 'keterangan', 'status', 'ket_status', 'ket_batal', 
        'noso_out', 'noso_in', 'user_sales', 'gudang_bo', 'created_at', 'created_by', 'updated_at', 'updated_by'
       
    ];

    public static function nobo()
    {

        $now            = Carbon::now();
        $currentYear    = $now->year;
        $currentMonth   = $now->format('m');

        $latestRecord = static::orderBy('nobo', 'desc')->first();

        if ($latestRecord) {
            $lastCustomId   = $latestRecord->nobo;

            $lastYear       = substr($lastCustomId, 3, 4);
            $lastMonth      = substr($lastCustomId, 7, 2);
            $lastNumber     = (int)substr($lastCustomId, -5);
            
            if ($lastYear == $currentYear) {
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
        } else {
            $newNumber = 1;
        }

        $newCustomBO = 'BO-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomBO;
    }

    public function details()
    {
        return $this->hasMany(TransaksiBackOrderDetails::class, 'nobo', 'nobo');
    }
}
