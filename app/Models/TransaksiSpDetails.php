<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class TransaksiSpDetails extends Model
{
    use HasFactory;

    protected $table = 'trns_sp_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [ 
        'nosp', 
        'area_sp',
        'kd_outlet',
        'part_no',
        'nm_part',
        'qty',
        'disc',
        'hrg_pcs',
        'nominal',
        'nominal_disc',
        'nominal_total',
        'status',
        'crea_at',
        'crea_by',
        'modi_date',
        'modi_by'
    ];

    public function header_sp()
    {
        return $this->belongsTo(TransaksiSpHeader::class, 'nosp', 'nosp');
    }

}
