<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TargetSales;
use App\Models\User;

class MasterTargetController extends Controller
{
    public function index(){

        $target = TargetSales::all();

        return view('master-target.index', compact('target'));
    }

    public function create(){

        $username = User::where('id_role', 20)->get();

        return view('master-target.create', compact('username'));
    }

    public function store(Request $request){

        $request -> validate([
            'sales'      => 'required',
            'bulan'      => 'required',
            'tahun'      => 'required',
            'nominal'    => 'required',
        ]);

        //dd($request->all());

        $created = TargetSales::create($request->all());

        if ($created){
            return redirect()->route('master-target.index')->with('success','Data target sales berhasil ditambahkan');
        } else{
            return redirect()->route('master-target.index')->with('danger','Data target sales gagal ditambahkan');
        }
    }

    public function details($id){

        $sales  = MasterSales::findOrFail($id);

        return view('master-target.details', compact('sales'));

    }

    public function tambah_wilayah($id){

        $sales       = MasterSales::findOrFail($id);
        $master_area = MasterAreaOutlet::where('status', 'Y')->get();
        $area        = MasterAreaSales::where('id_sales', $id)->get();

        return view('master-target.details', compact('sales', 'master_area', 'area'));

    }

    public function store_details(Request $request){

        $request->validate([
                'inputs.*.kode_kabupaten'  => 'required',
                'inputs.*.id_sales'        => 'required',
        ]);

        foreach($request->inputs as $key => $value){

            $value['kode_kabupaten']    = $value['kode_kabupaten'];
            $value['id_sales']          = $value['id_sales'];
            $value['crea_date']         = NOW();
            $value['crea_by']           = Auth::user()->nama_user;

           MasterAreaSales::create($value);
        }        
        
        return redirect()->route('master-target.index')->with('success','Data area sales berhasil ditambahkan!');

    }

    public function delete($id)
    {
        $updated = MasterSales::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($updated){
            return redirect()->route('master-target.index')->with('success','Stok Gudang berhasil dihapus!');
        } else{
            return redirect()->route('master-target.index')->with('danger','Stok Gudang gagal dihapus');
        }
        
    }

    
}
