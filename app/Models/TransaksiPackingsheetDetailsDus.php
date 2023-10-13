<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class TransaksiPackingsheetDetailsDus extends Model
{
    use HasFactory;

    protected $table = 'transaksi_packingsheet_details_dus';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [ 
        'nops', 'dus', 'no_dus', 'area_dus', 'kd_outlet', 'kd_kategori',
        'kategori', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public static function no_dus()
    {
        $now = Carbon::now();
        $currentYear = $now->year;
        $currentMonth = $now->format('m');

        $latestRecord = static::orderBy('no_dus', 'desc')->first();

        if ($latestRecord) {
            $lastCustomId = $latestRecord->no_dus;
            $lastYear = substr($lastCustomId, 4, 4); // Adjust the starting position
            $lastMonth = substr($lastCustomId, 8, 2); // Adjust the starting position
            $lastNumber = (int)substr($lastCustomId, -5);

            if ($lastYear == $currentYear && $lastMonth == $currentMonth) {
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
        } else {
            $newNumber = 1;
        }

        $newCustomId = 'DUS-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomId;
    }


    public function header_ps()
    {
        return $this->hasOne(TransaksiPackingsheetHeader::class, 'nops', 'nops');
    }
    public function kategori()
    {
        return $this->hasOne(KategoriDusPackingsheet::class, 'kd_kategori', 'kd_kategori');
    }

}
