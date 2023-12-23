<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\ExportPajak;
use App\Models\TransaksiInvoiceHeader;
use App\Models\TransaksiInvoiceDetails;

class ExportPajakController extends Controller
{
    public function index(){

        return view('export-pajak.index');
    }

    public function store(Request $request){

        $request->validate([
            'jenis_data'           => 'required',
            'no_faktur_pajak'      => 'required',
            'tanggal_awal'         => 'required',
            'tanggal_akhir'        => 'required',
        ]);

        $no_faktur_pajak    = $request->no_faktur_pajak;
        $jenis_data         = $request->jenis_data;
        $tanggal_awal       = $request->tanggal_awal;
        $tanggal_akhir      = $request->tanggal_akhir;

        $invoice = null; 
        $details = null; 

        if($jenis_data == 'FK'){
            $invoice = TransaksiInvoiceHeader::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();

        }

        if($jenis_data == 'OF'){
            $details = TransaksiInvoiceDetails::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
        }

        return view('export-pajak.view-fk', compact('invoice', 'details', 'no_faktur_pajak', 'jenis_data'));
        
    }

    public function cetak(Request $request)
    {
        $tanggal_awal       = $request->tanggal_awal;
        $tanggal_akhir      = $request->tanggal_akhir;
        $no_faktur_pajak    = $request->no_faktur_pajak;

        return Excel::download(new ExportPajak($tanggal_awal, $tanggal_akhir, $no_faktur_pajak), 'ICH_FakturPajakKeluaran_'.$request->tanggal_awal.'_'.$request->tanggal_akhir.'.csv');

    }

}
