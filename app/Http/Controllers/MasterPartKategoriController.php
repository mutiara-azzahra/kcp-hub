<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterKategoriPart;

class MasterPartKategoriController extends Controller
{
    public function index(){

        $part_kategori = MasterKategoriPart::all();

        return view('part-kategori.index', compact('part_kategori'));
    }

    public function create(){

        return view('part-kategori.create');
    }

    public function show($id){

         $part_kategori_id = MasterKategoriPart::findOrFail($id);

        return view('part-kategori.show', compact('part_kategori_id'));
       
    }

    public function store(Request $request){

        $request -> validate([
            'kategori_part'        => 'required',
        ]);

        $created = MasterKategoriPart::create($request->all());

        if ($created){
            return redirect()->route('part-kategori.index')->with('success','Data baru berhasil ditambahkan');
        } else{
            return redirect()->route('part-kategori.index')->with('danger','Data baru gagal ditambahkan');
        }
    }


    public function edit($id)
    {
        $part_kategori_id  = MasterKategoriPart::findOrFail($id);

        return view('part-kategori.edit',compact('part_kategori_id'));
    }

    public function update(Request $request, MasterKategoriPart $part_kategori)
    {
        $request->validate([
            'kategori_part'        => 'required',
            
        ]);
         
        $updated = $part_kategori->update($request->all());
         
        if ($updated){
            return redirect()->route('part-kategori.index')->with('success','Data master part berhasil diubah');
        } else{
            return redirect()->route('part-kategori.index')->with('danger','Data master part gagal diubah');
        }
    }
    
}
