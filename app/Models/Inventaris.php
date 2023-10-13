<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'trns_barang_inventaris';
    public $primaryKey = 'kode';

    public $timestamps = false;

}
