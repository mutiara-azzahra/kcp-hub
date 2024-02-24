<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasukDetails extends Model
{
    use HasFactory;

    protected $table = 'kas_masuk_details';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'no_kas_masuk', 'perkiraan', 'sub_perkiraan','akuntansi_to', 'total',
        'status','created_at', 'created_by', 'updated_at',
        'updated_by'
    ];

    public function details_perkiraan()
    {
        return $this->belongsTo(MasterPerkiraan::class, 'perkiraan', 'id_perkiraan');
    }
}
