<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiSpHeader;

class HistoryPesananController extends Controller
{
    public function index(){

        $surat_pesanan = TransaksiSpHeader::orderBy('crea_date', 'desc')->get();

        return view('history-pesanan.index', compact('surat_pesanan'));
    }
}
