<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\InvoiceNonHeader;

class PembayaranController extends Controller
{
    public function index(){

        $list_belum_bayar = InvoiceNonHeader::where('flag_pembayaran', 'N')->get();
        $list_sudah_bayar = InvoiceNonHeader::where('flag_pembayaran', 'Y')->get();

        return view('pembayaran-non-aop.index', compact('list_belum_bayar', 'list_sudah_bayar'));
    }

    public function pembayaran($invoice_non){

        $bayar = InvoiceNonHeader::where('invoice_non', $invoice_non)->get();

        return view('pembayaran-non-aop.pembayaran', compact('bayar'));
    }

    public function store_pembayaran($invoice_non){

        $bayar = InvoiceNonHeader::where('invoice_non', $invoice_non)->first();

        $bayar = InvoiceNonHeader::bayar();

        return view('pembayaran-non-aop.index', compact('list_belum_bayar', 'list_sudah_bayar'));
    }

    public function pembayaran_nota($invoice_non){

        $bayar = InvoiceNonHeader::where('invoice_non', $invoice_non)->get();

        return view('pembayaran-non-aop.edit', compact('bayar'));
    }

    public function store_pembayaran_balance($invoice_non){

        $bayar = InvoiceNonHeader::where('invoice_non', $invoice_non)->first();

        $bayar = InvoiceNonHeader::bayar();

        return view('pembayaran-non-aop.index', compact('list_belum_bayar', 'list_sudah_bayar'));
    }

    
}
