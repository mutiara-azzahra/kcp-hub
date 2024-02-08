<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RincianTagihanController extends Controller
{
    public function index(){

        // $surat_pesanan = TransaksiSpHeader::orderBy('nosp', 'desc')->get();

        return view('rincian-tagihan.index');
    }
}
