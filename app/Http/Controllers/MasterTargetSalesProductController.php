<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TargetSalesProduk;
use App\Models\User;


class MasterTargetSalesProductController extends Controller
{
    public function index(){

        $target = TargetSalesProduk::orderBy('id', 'desc')->get();

        return view('master-target-sales-produk.index', compact('target'));
    }

    public function create(){

        $username = User::where('id_role', 24)->get();

        return view('master-target-sales-produk.create', compact('username'));
    }

    public function store(Request $request){

        $request -> validate([
            'sales'        => 'required',
            'kode_produk'=> 'required',
            'bulan'      => 'required',
            'tahun'      => 'required',
            'nominal'    => 'required',
        ]);

        $nominal = str_replace('.', '', $request->input('nominal'));
        $nominal = str_replace(',', '.', $nominal);
        $request->merge(['nominal' => $nominal]);
    
        $created = TargetSalesProduk::create($request->all());

        if ($created){
            return redirect()->route('master-target-sales-produk.index')->with('success','Data target produk Sales berhasil ditambahkan');
        } else{
            return redirect()->route('master-target-sales-produk.index')->with('danger','Data target produk Sales gagal ditambahkan');
        }
    }

    public function edit($id){

        $target_sales = TargetSalesProduk::findOrFail($id);

        return view('master-target-sales-produk.edit', compact('target_sales'));

    }

    public function update(Request $request, $id)
    {

        $nominal = str_replace('.', '', $request->nominal);
        $nominal = str_replace(',', '.', $nominal);

        $updated = TargetSalesProduk::where('id', $id)->update([
            'sales'         => $request->sales,
            'kode_produk'   => $request->kode_produk,
            'bulan'         => $request->bulan,
            'tahun'         => $request->tahun,
            'nominal'       => $nominal
        ]);

        if ($updated){
            return redirect()->route('master-target-sales-produk.index')->with('success','Data berhasil dihapus!');
        } else{
            return redirect()->route('master-target-sales-produk.index')->with('danger','Data gagal diubah');
        }
         
    }

    public function delete( $id)
    {
      
        TargetSalesProduk::destroy($id);

        return redirect()->route('master-target-sales-produk.index')->with('success', 'Data berhasil dihapus');
    }
}
