<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterKodeRak;

class KodeRakLokasiController extends Controller
{
    public function index(){

        $kode_rak = MasterKodeRak::where('status', 'A')->get();

        return view('kode-rak-lokasi.index', compact('kode_rak'));
    }
}
