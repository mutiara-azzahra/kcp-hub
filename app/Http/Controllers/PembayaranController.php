<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\InvoiceNonHeader;
use App\Models\InvoiceNonDetails;
use App\Models\NotaDetails;

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

        $header       = InvoiceNonHeader::where('invoice_non', $invoice_non)->first();
        $nota_details = InvoiceNonDetails::where('invoice_non', $invoice_non)->get();

        return view('pembayaran-non-aop.edit', compact('header', 'nota_details'));
    }

    public function store_pembayaran_balance(Request $request) {

        $invoice_nons   = $request->input('invoice_non');
        $part_nos       = $request->input('part_no');
        $qtys           = $request->input('qty');
        $discs          = $request->input('diskon_nominal');
        $total_amounts  = $request->input('total_amount');
        $amount_notas   = $request->input('amount_nota');
    
        $details        = [];

        foreach ($part_nos as $index => $part_no) {
            $invoice_non  = $invoice_nons[$index];
            $part_no      = $part_nos[$index];
            $qty          = $qtys[$index];
            $disc         = $discs[$index];
            $total_amount = $total_amounts[$index];
            $amount_nota    = str_replace('.', '', $amount_notas[$index]);
    
            $detail = [
                'invoice_non'    => $invoice_non,
                'part_no'        => $part_no,
                'qty'            => $qty,
                'diskon_nominal' => $disc,
                'total_amount'   => $total_amount,
                'amount_nota'    => str_replace(',', '.', $amount_nota),
                'created_at'     => NOW(),
                'updated_at'     => NOW(),
            ];
    
            $details[] = $detail;

        }
    
        $inserted = NotaDetails::insert($details);
    
        if ($created){
            return redirect()->route('pembayaran-non-aop.index')->with('success', 'Data balancing nota pembayaran berhasil ditambahkan');
        } else{
            return redirect()->route('pembayaran-non-aop.index')->with('danger','Data baru gagal ditambahkan');
        }
    }

    
}
