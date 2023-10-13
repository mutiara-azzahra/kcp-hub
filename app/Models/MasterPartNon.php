<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPartNon extends Model
{
    use HasFactory;

    protected $table = 'master_part_non';
    protected $primaryKey = 'id';

    protected $fillable = [
        'part_no', 
        'part_nama', 
        'id_diskon', 
        'id_supplier', 
        'id_kategori_part', 
        'id_group_part', 
        'id_produk_part', 
        'id_kelompok_part', 
        'id_master_stok', 
        'status',
        'create_at',
        'update_at',
        'created_by', 
        'updated_by'
    ];

    public function level(){
        return $this->belongsTo(MasterLevelPart::class, 'id_level_4', 'id');
    }
    public function kelompok(){
        return $this->belongsTo(MasterKelompokPart::class, 'id_kelompok_part', 'id');
    }
    public function kategori(){
        return $this->belongsTo(MasterKategoriPart::class, 'id_kategori_part', 'id');
    }
    public function group(){
        return $this->belongsTo(MasterGroupPart::class, 'id_group_part', 'id');
    }
    public function produk(){
        return $this->belongsTo(MasterProdukPart::class, 'id_produk_part', 'id');
    }
    public function het()
    {
        return $this->hasOne(MasterStokGudangHet::class, 'part_no', 'part_no');
    }
    public function validasi_so()
    {
        return $this->hasMany(TransaksiSODetails::class, 'part_no', 'part_no');
    }
    public function packingsheet_details()
    {
        return $this->hasMany(TransaksiPackingsheetDetails::class, 'part_no', 'part_no');
    }
    

}
