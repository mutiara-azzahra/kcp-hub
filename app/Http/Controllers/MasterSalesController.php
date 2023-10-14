<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\MasterSales;

class MasterSalesController extends Controller
{
    public function index(){

        $sales = MasterSales::where('status', 'A')->get();

        return view('master-sales.index', compact('sales'));
    }

    public function create(){

        $master_part = MasterPart::where('status', 'A')->get();

        return view('master-sales.create', compact('master_part'));
    }

    public function store(Request $request){

        $request -> validate([
            'part_no'      => 'required', 
            'stok'         => 'required',
        ]);

        $created = MasterSales::create($request->all());

        if ($created){
            return redirect()->route('master-sales.index')->with('success','Data stok gudang baru berhasil ditambahkan');
        } else{
            return redirect()->route('master-sales.index')->with('danger','Data stok gudang baru gagal ditambahkan');
        }
    }

    public function delete($id)
    {
        $updated = MasterSales::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($updated){
            return redirect()->route('master-sales.index')->with('success','Stok Gudang berhasil dihapus!');
        } else{
            return redirect()->route('master-sales.index')->with('danger','Stok Gudang gagal dihapus');
        }
        
    }

    
}
