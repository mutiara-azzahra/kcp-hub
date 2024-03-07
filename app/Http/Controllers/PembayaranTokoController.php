<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPembayaranPiutangHeader;

class PembayaranTokoController extends Controller
{
    public function index(){

        $piutang_header = TransaksiPembayaranPiutangHeader::orderBy('no_piutang', 'desc')->get();

        return view('pembayaran-toko.index', compact('piutang_header'));
    }
}
