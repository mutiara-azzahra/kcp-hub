<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterKelompokPart;

class MasterPartKelompokController extends Controller
{
    public function index(){

        $part_kelompok = MasterKelompokPart::all();

        return view('part-kelompok.index', compact('part_kelompok'));
    }

    public function create(){

        return view('part-kelompok.create');
    }

    public function show($id){

         $part_kelompok_id = MasterKelompokPart::findOrFail($id);

        return view('part-kelompok.show', compact('part_kelompok_id'));
       
    }

    public function store(Request $request){

        $request -> validate([
            'kelompok_part' => 'required',
        ]);

        $created = MasterKelompokPart::create($request->all());

        if ($created){
            return redirect()->route('part-kelompok.index')->with('success','Data baru berhasil ditambahkan');
        } else{
            return redirect()->route('part-kelompok.index')->with('danger','Data baru gagal ditambahkan');
        }
    }


    public function edit($id)
    {
        $part_kelompok_id  = MasterKelompokPart::findOrFail($id);

        return view('part-kelompok.edit',compact('part_kelompok_id'));
    }

    public function update(Request $request, MasterKelompokPart $part_kelompok)
    {
        $request->validate([
            'kelompok_part' => 'required',
            
        ]);
         
        $updated = $part_kelompok->update($request->all());
         
        if ($updated){
            return redirect()->route('part-kelompok.index')->with('success','Data master part berhasil diubah');
        } else{
            return redirect()->route('part-kelompok.index')->with('danger','Data master part gagal diubah');
        }
    }
    
}
