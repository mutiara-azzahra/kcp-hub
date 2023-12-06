<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\InvoiceNonHeader;
use App\Models\InvoiceNonDetails;
use App\Models\NotaDetails;
use App\Models\TransaksiKasKeluarHeader;

class PembayaranController extends Controller
{
    public function index(){

        $list_belum_bayar = InvoiceNonHeader::where('flag_pembayaran', 'N')->get();
        $list_sudah_bayar = InvoiceNonHeader::where('flag_pembayaran', 'Y')->get();

        return view('pembayaran-non-aop.index', compact('list_belum_bayar', 'list_sudah_bayar'));
    }

    public function pembayaran($invoice_non){

        $bayar      = InvoiceNonHeader::where('invoice_non', $invoice_non)->get();
        $kas_keluar = TransaksiKasKeluarHeader::orderBy('no_keluar', 'desc')->get();
 
        return view('pembayaran-non-aop.pembayaran',['invoice_non' => $invoice_non, 'bayar' => $bayar,'kas_keluar' => $kas_keluar ]);
    }

    public function store_pembayaran(Request $request){

        $created = InvoiceNonHeader::where('invoice_non', $request->invoice_non)->update([
            'trx_from'               => $request->trx_from,
            'flag_pembayaran_via'    => $request->flag_pembayaran_via,
            'flag_pembayaran'        => 'Y',
            'flag_pembayaran_date'   => NOW(),
            'updated_at'             => NOW(),
            'updated_by'             => Auth::user()->nama_user
        ]);

        if ($created){
            return redirect()->route('pembayaran-non-aop.index')->with('success', 'Data pembayaran berhasil diubah!');
        } else{
            return redirect()->route('pembayaran-non-aop.index')->with('danger','Data pemabayaran gagal diubah');
        }
    }

    public function pembayaran_nota($invoice_non){

        $header       = InvoiceNonHeader::where('invoice_non', $invoice_non)->first();
        $nota_details = InvoiceNonDetails::where('invoice_non', $invoice_non)->get();
        $nota         = NotaDetails::where('invoice_non', $invoice_non)->first();

        return view('pembayaran-non-aop.edit', compact('header', 'nota_details', 'nota'));
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
    
        if ($inserted){
            return redirect()->route('pembayaran-non-aop.index')->with('success', 'Data balancing nota pembayaran berhasil ditambahkan');
        } else{
            return redirect()->route('pembayaran-non-aop.index')->with('danger','Data baru gagal ditambahkan');
        }
    }

    public function cetak($invoice_non)
    {
        $data       = InvoiceNonHeader::where('invoice_non', $invoice_non)->first();
        $details    = NotaDetails::where('invoice_non', $invoice_non)->get();

        $pdf   = PDF::loadView('reports.rekap-pembelian', ['data'=> $data, 'details' => $details]);
        $pdf->setPaper('letter', 'potrait');

        return $pdf->stream('rekap-pembelian.pdf');
    }

    
}
