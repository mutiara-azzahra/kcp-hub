<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterPartNon;
use App\Models\MasterGroupPart;
use App\Models\MasterKategoriPart;
use App\Models\MasterKelompokPart;
use App\Models\MasterProdukPart;

class MasterPartNonController extends Controller
{
    public function index(){

        $master_part = MasterPartNon::all();

        return view('master-part.index', compact('master_part'));
    }

    public function create(){

        $group = MasterGroupPart::all();
        $kategori = MasterKategoriPart::all();
        $kelompok = MasterKelompokPart::all();
        $produk = MasterProdukPart::all();

        return view('master-part.create', compact('group', 'kategori', 'kelompok', 'produk'));
    }

    public function show($id){

         $master_part_id = MasterPartNon::findOrFail($id);

        return view('master-part.show', compact('master_part_id'));
       
    }

    public function store(Request $request){

        $request -> validate([
            'part_no'           => 'required', 
            'part_nama'         => 'required', 
            'id_kategori_part'  => 'required', 
            'id_group_part'     => 'required', 
            'id_produk_part'    => 'required', 
            'id_kelompok_part'  => 'required', 
        ]);

        $created = MasterPartNon::create($request->all());

        if ($created){
            return redirect()->route('master-part.index')->with('success','Data baru berhasil ditambahkan');
        } else{
            return redirect()->route('master-part.index')->with('danger','Data baru gagal ditambahkan');
        }
    }


    public function edit($id)
    {
        $master_part_id  = MasterPartNon::findOrFail($id);

        return view('master-part.edit',compact('master_part_id'));
    }

    public function update(Request $request, MasterPartNon $master_part)
    {
        $request->validate([
            'part_no'           => 'required', 
            'part_nama'         => 'required', 
            'id_kategori_part'  => 'required', 
            'id_group_part'     => 'required', 
            'id_produk_part'    => 'required', 
            'id_kelompok_part'  => 'required', 
        ]);
         
        $updated = $master_part->update($request->all());
         
        if ($updated){
            return redirect()->route('master-part.index')->with('success','Data master part berhasil diubah');
        } else{
            return redirect()->route('master-part.index')->with('danger','Data master part gagal diubah');
        }
    }
    
}
