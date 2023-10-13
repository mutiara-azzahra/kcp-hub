<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterProdukPart;

class MasterPartProdukController extends Controller
{
    public function index(){

        $part_produk = MasterProdukPart::all();

        return view('part-produk.index', compact('part_produk'));
    }

    public function create(){

        return view('part-produk.create');
    }

    public function show($id){

         $part_produk_id = MasterProdukPart::findOrFail($id);

        return view('part-produk.show', compact('part_produk_id'));
       
    }

    public function store(Request $request){

        $request -> validate([
            'produk_part'        => 'required',
        ]);

        $created = MasterProdukPart::create($request->all());

        if ($created){
            return redirect()->route('part-produk.index')->with('success','Data baru berhasil ditambahkan');
        } else{
            return redirect()->route('part-produk.index')->with('danger','Data baru gagal ditambahkan');
        }
    }


    public function edit($id)
    {
        $part_produk_id  = MasterProdukPart::findOrFail($id);

        return view('part-produk.edit',compact('part_produk_id'));
    }

    public function update(Request $request, MasterProdukPart $part_produk)
    {
        $request->validate([
            'produk_part'        => 'required',
            
        ]);
         
        $updated = $part_produk->update($request->all());
         
        if ($updated){
            return redirect()->route('part-produk.index')->with('success','Data master part berhasil diubah');
        } else{
            return redirect()->route('part-produk.index')->with('danger','Data master part gagal diubah');
        }
    }
    
}
