<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MasterPart;
use App\Models\MasterKodeRak;

class MasterPartController extends Controller
{
    public function index(){

        $master_part = MasterPart::where('status', 'A')->get();

        return view('master-part.index', compact('master_part'));
    }

    public function create(){

        $kode_rak = MasterKodeRak::where('status', 'A')->get();

        return view('master-part.create', compact('kode_rak'));
    }

    public function show($id){

         $master_part_id = MasterPart::findOrFail($id);

        return view('master-part.show', compact('master_part_id'));
       
    }

    public function store(Request $request){

        $request -> validate([
            'part_no'           => 'required', 
            'part_nama'         => 'required',
            'het'               => 'required',
            'satuan_dus'        => 'required', 
        ]);

        $created = MasterPart::create($request->all());

        if ($created){
            return redirect()->route('master-part.index')->with('success','Data baru berhasil ditambahkan');
        } else{
            return redirect()->route('master-part.index')->with('danger','Data baru gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $master_part_id  = MasterPart::findOrFail($id);
        $kode_rak = MasterKodeRak::where('status', 'A')->get();

        return view('master-part.update',compact('master_part_id', 'kode_rak'));
    }

    public function delete($id)
    {
        $updated = MasterPart::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($updated){
            return redirect()->route('master-part.index')->with('success','Master part berhasil dihapus!');
        } else{
            return redirect()->route('master-part.index')->with('danger','Master part gagal dihapus');
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'part_no'       => 'required',
            'part_nama'     => 'required',
            'het'           => 'required|integer',
            'satuan_dus'    => 'required|integer',
        ]);

        $masterPart = MasterPart::find($id);

        if (!$masterPart) {
            return redirect()->route('master-part.index')->with('danger', 'Data master part tidak ditemukan');
        }

        $masterPart->update($request->all());

        return redirect()->route('master-part.index')->with('success', 'Data master part berhasil diubah');
    }

}
