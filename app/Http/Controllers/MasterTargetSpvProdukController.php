<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TargetSpvProduk;
use App\Models\User;

class MasterTargetSpvProdukController extends Controller
{
    public function index(){

        $target = TargetSpvProduk::all();

        return view('master-target-spv-produk.index', compact('target'));
    }

    public function create(){

        $username = User::where('id_role', 24)->get();

        return view('master-target-spv-produk.create', compact('username'));
    }

    public function update(Request $request, TargetSpvProduk $target_spv)
    {
        $target_spv->update($request->all());
         
        return redirect()->route('master-target-spv-produk.index')->with('success','Data Transaksi Pembayaran berhasil diubah!');
    }

    public function store(Request $request){

        $request -> validate([
            'spv'        => 'required',
            'kode_produk'=> 'required',
            'bulan'      => 'required',
            'tahun'      => 'required',
            'nominal'    => 'required',
        ]);

        $created = TargetSpvProduk::create($request->all());

        if ($created){
            return redirect()->route('master-target-spv-produk.index')->with('success','Data target produk SPV berhasil ditambahkan');
        } else{
            return redirect()->route('master-target-spv-produk.index')->with('danger','Data target produk SPV gagal ditambahkan');
        }
    }
}
