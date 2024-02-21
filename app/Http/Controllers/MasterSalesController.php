<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MasterSales;
use App\Models\MasterAreaOutlet;
use App\Models\MasterAreaSales;

class MasterSalesController extends Controller
{
    public function index(){

        $sales = MasterSales::where('status', 'A')->get();

        return view('master-sales.index', compact('sales'));
    }

    public function create(){

        $username = User::where('id_role', 20)->get();

        return view('master-sales.create', compact('username'));
    }

    public function store(Request $request){

        $request -> validate([
            'sales'      => 'required|unique:master_sales,sales',
        ]);

        $created = MasterSales::create($request->all());

        if ($created){
            return redirect()->route('master-sales.index')->with('success','Data sales baru berhasil ditambahkan');
        } else{
            return redirect()->route('master-sales.index')->with('danger','Data sales baru gagal ditambahkan');
        }
    }

    public function details($id){

        $sales  = MasterSales::findOrFail($id);

        return view('master-sales.details', compact('sales'));

    }

    public function tambah_wilayah($id){

        $sales       = MasterSales::findOrFail($id);
        $master_area = MasterAreaOutlet::where('status', 'A')->get();
        $area        = MasterAreaSales::where('id_sales', $id)->get();

        return view('master-sales.details', compact('sales', 'master_area', 'area'));

    }

    public function store_details(Request $request){

        $request->validate([
                'inputs.*.kode_kabupaten'  => 'required',
                'inputs.*.id_sales'        => 'required',
        ]);

        foreach($request->inputs as $key => $value){

            $value['kode_kabupaten']    = $value['kode_kabupaten'];
            $value['id_sales']          = $value['id_sales'];
            $value['created_at']        = NOW();
            $value['created_by']        = Auth::user()->nama_user;

           MasterAreaSales::create($value);
        }        
        
        return redirect()->route('master-sales.index')->with('success','Data area sales berhasil ditambahkan!');

    }

    public function destroy($id)
    {
        try {
            $master_area_outlet = MasterAreaSales::findOrFail($id);
            $master_area_outlet->delete();

            return redirect()->route('master-sales.tambah-wilayah', ['id' => $master_area_outlet->id_sales])->with('success', 'Data area outlet sales berhasil dihapus!');

        } catch (\Exception $e) {

            return redirect()->route('master-sales.tambah-wilayah', ['id' => $master_area_outlet->id_sales])->with('danger', 'Terjadi kesalahan saat menghapus data area outlet sales.');
        }
    }

    public function nonaktif_area($id){

        try {
            
            MasterAreaSales::where('id', $id)->update([
                'status'        => 'N',
                'updated_at'    => NOW(),
                'updated_by'    => NOW()
            ]);

            return redirect()->route('master-sales.tambah-wilayah', ['id' => $master_area_outlet->id_sales])->with('success', 'Data area outlet sales berhasil dinonaktifkan!');

        } catch (\Exception $e) {

            return redirect()->route('master-sales.tambah-wilayah', ['id' => $master_area_outlet->id_sales])->with('danger', 'Terjadi kesalahan saat menonaktifkan data area outlet sales.');
        }
    }

}
