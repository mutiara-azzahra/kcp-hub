<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBackOrderDetails extends Model
{
    use HasFactory;

    protected $table = 'transaksi_bo_details';
    public $primaryKey = 'id';

    protected $fillable = [

        'nobo', 'area_bo', 'kd_outlet', 'part_no', 'nm_part', 'qty', 'hrg_pcs', 'disc', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'
       
    ];
}
