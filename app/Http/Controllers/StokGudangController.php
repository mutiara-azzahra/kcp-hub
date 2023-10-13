<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterStokGudang;

class StokGudangController extends Controller
{
    public function index(){

        $stok_gudang = MasterStokGudang::where('status', 'A')->get();

        return view('stok-gudang.index', compact('stok_gudang'));
    }
}
