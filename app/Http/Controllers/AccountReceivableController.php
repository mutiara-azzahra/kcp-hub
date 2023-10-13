<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TransaksiPembayaranPiutangHeader;

class AccountReceivableController extends Controller
{
    public function index(){

        $piutang_header = TransaksiPembayaranPiutangHeader::all();

        return view('account-receivable.index', compact('piutang_header'));
    }
}
