<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\MasterStokGudang;
use App\Models\MasterPart;

class StokGudangController extends Controller
{
    public function index(){

        $stok_gudang = MasterStokGudang::where('status', 'A')->get();

        return view('stok-gudang.index', compact('stok_gudang'));
    }

    public function create(){

        $master_part = MasterPart::where('status', 'A')->get();

        return view('stok-gudang.create', compact('master_part'));
    }

    public function store(Request $request){

        $request -> validate([
            'part_no'      => 'required', 
            'stok'         => 'required',
        ]);

        $created = MasterStokGudang::create($request->all());

        if ($created){
            return redirect()->route('stok-gudang.index')->with('success','Data stok gudang baru berhasil ditambahkan');
        } else{
            return redirect()->route('stok-gudang.index')->with('danger','Data stok gudang baru gagal ditambahkan');
        }
    }

    public function delete($id)
    {
        $updated = MasterStokGudang::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($updated){
            return redirect()->route('stok-gudang.index')->with('success','Stok Gudang berhasil dihapus!');
        } else{
            return redirect()->route('stok-gudang.index')->with('danger','Stok Gudang gagal dihapus');
        }
        
    }

    
}
