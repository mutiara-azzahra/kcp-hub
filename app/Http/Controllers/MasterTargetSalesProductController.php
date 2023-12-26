<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function update(Request $request, TargetSalesProduk $target_spv)
    {
        $target_spv->update($request->all());
         
        return redirect()->route('master-target-sales-produk.index')->with('success','Data Transaksi Pembayaran berhasil diubah!');
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
            return redirect()->route('master-target-sales-produk.index')->with('success','Data target produk SPV berhasil ditambahkan');
        } else{
            return redirect()->route('master-target-sales-produk.index')->with('danger','Data target produk SPV gagal ditambahkan');
        }
    }

    public function delete( $id)
    {
      
        TargetSalesProduk::destroy($id);

        return redirect()->route('master-target-sales-produk.index')->with('success', 'Data berhasil dihapus');
    }
}
