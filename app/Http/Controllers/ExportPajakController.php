<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiInvoiceHeader;
use App\Models\TransaksiInvoiceDetails;

class ExportPajakController extends Controller
{
    public function index(){

        return view('export-pajak.index');
    }

    public function store(Request $request){

        $request->validate([
            'jenis_data'      => 'required',
            'no_faktur_pajak'      => 'required',
            'tanggal_awal'         => 'required',
            'tanggal_akhir'        => 'required',
        ]);

        $no_faktur_pajak    = $request->no_faktur_pajak;
        $jenis_data         = $request->jenis_data;
        $tanggal_awal       = $request->tanggal_awal;
        $tanggal_akhir      = $request->tanggal_akhir;


        if($jenis_data == 'FK'){
            $invoice = TransaksiInvoiceHeader::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
        }

        return view('export-pajak.view', compact('invoice', 'no_faktur_pajak'));
    }
}