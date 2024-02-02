<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiHeader extends Model
{
    use HasFactory;

    protected $table = 'mutasi_rak_header';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'no_mutasi', 'rak_asal', 'rak_tujuan', 'approval_head_gudang', 'tanggal_approval', 'cetak_sj_mutasi', 
        'tanggal_cetak_sj_mutasi', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public static function no_mutasi()
    {
        $now            = Carbon::now();
        $currentYear    = $now->year;
        $currentMonth   = $now->format('m');

        $latestRecord   = static::orderBy('no_mutasi', 'desc')->first();

        if ($latestRecord) {
            $lastCustomId   = $latestRecord->no_mutasi;
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

        $newCustomId = 'MUT-' . $currentYear . $currentMonth . '-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

        return $newCustomId;
    }


    public function details()
    {
        return $this->hasMany(MutasiDetails::class, 'no_mutasi', 'no_mutasi');
    }

    public function rak1()
    {
        return $this->belongsTo(MasterKodeRak::class, 'rak_asal','id');
    }

    public function rak2()
    {
        return $this->belongsTo(MasterKodeRak::class, 'rak_tujuan', 'id');
    }
}
