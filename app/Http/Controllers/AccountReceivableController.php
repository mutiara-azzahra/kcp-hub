<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TransaksiInvoiceHeader;
use App\Models\TransaksiPembayaranPiutangHeader;

class AccountReceivableController extends Controller
{
    public function index(){

        $piutang_header = TransaksiPembayaranPiutangHeader::all();

        $invoice = TransaksiInvoiceHeader::all();

        return view('account-receivable.index', compact('piutang_header', 'invoice'));
    }
}
