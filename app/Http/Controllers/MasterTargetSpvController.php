<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TargetSpv;
use App\Models\User;

class MasterTargetSpvController extends Controller
{
    public function index(){

        $target = TargetSpv::all();

        return view('master-target-spv.index', compact('target'));
    }

    public function create(){

        $username = User::where('id_role', 24)->get();

        return view('master-target-spv.create', compact('username'));
    }

    public function store(Request $request){

        $request -> validate([
            'spv'      => 'required',
            'bulan'      => 'required',
            'tahun'      => 'required',
            'nominal'    => 'required',
        ]);

        $created = TargetSpv::create($request->all());

        if ($created){
            return redirect()->route('master-target-spv.index')->with('success','Data target sales berhasil ditambahkan');
        } else{
            return redirect()->route('master-target-spv.index')->with('danger','Data target sales gagal ditambahkan');
        }
    }


    public function edit($id){

        $target_spv = TargetSpv::findOrFail($id);

        return view('master-target-spv.edit', compact('target_spv'));

    }

    public function update(Request $request, $id)
    {

        $nominal = str_replace('.', '', $request->nominal);
        $nominal = str_replace(',', '.', $nominal);

        $updated = TargetSpv::where('id', $id)->update([
            'spv'           => $request->spv,
            'bulan'         => $request->bulan,
            'tahun'         => $request->tahun,
            'nominal'       => $nominal
        ]);

        if ($updated){
            return redirect()->route('master-target-spv.index')->with('success','Data target spv berhasil diubah!');
        } else{
            return redirect()->route('master-target-spv.index')->with('danger','Data target spv gagal diubah');
        }
         
    }

    public function destroy($id)
    {
        try {

            $target_spv = TargetSpv::findOrFail($id);
            $target_spv->delete();

            return redirect()->route('master-target-spv.index')->with('success', 'Data target SPV berhasil dihapus!');

        } catch (\Exception $e) {

            return redirect()->route('master-target-spv.index')->with('danger', 'Terjadi kesalahan saat menghapus data target SPV.');
        }
    }
    
}
