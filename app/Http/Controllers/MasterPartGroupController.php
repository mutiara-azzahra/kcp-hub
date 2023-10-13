<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterGroupPart;

class MasterPartGroupController extends Controller
{
    public function index(){

        $part_group = MasterGroupPart::all();

        return view('part-group.index', compact('part_group'));
    }

    public function create(){

        return view('part-group.create');
    }

    public function show($id){

         $part_kategori_id = MasterGroupPart::findOrFail($id);

        return view('part-group.show', compact('part_kategori_id'));
       
    }

    public function store(Request $request){

        $request -> validate([
            'group_part'        => 'required',
        ]);

        $created = MasterGroupPart::create($request->all());

        if ($created){
            return redirect()->route('part-group.index')->with('success','Data baru berhasil ditambahkan');
        } else{
            return redirect()->route('part-group.index')->with('danger','Data baru gagal ditambahkan');
        }
    }


    public function edit($id)
    {
        $part_kategori_id  = MasterGroupPart::findOrFail($id);

        return view('part-group.edit',compact('part_kategori_id'));
    }

    public function update(Request $request, MasterGroupPart $part_group)
    {
        $request->validate([
            'group_part'        => 'required',
            
        ]);
         
        $updated = $part_group->update($request->all());
         
        if ($updated){
            return redirect()->route('part-group.index')->with('success','Data master part berhasil diubah');
        } else{
            return redirect()->route('part-group.index')->with('danger','Data master part gagal diubah');
        }
    }
    
}
