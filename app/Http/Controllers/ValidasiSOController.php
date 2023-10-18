<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use PDF;
use Carbon\Carbon;
use App\Models\TransaksiSOHeader;
use App\Models\TransaksiSODetails;

class ValidasiSOController extends Controller
{
    public function index(){

        $validasi_so_gudang = TransaksiSOHeader::where('flag_approve', 'Y')
            ->where('flag_vald_gudang', 'N')
            ->orderBy('noso', 'desc')->get();

        return view('validasi-so.index', compact('validasi_so_gudang'));
    }

    public function details($noso){

        $so = TransaksiSOHeader::where('noso', $noso)->first();

        $validasi_id = TransaksiSOHeader::where('noso', $noso)->get();

        return view('validasi-so.details', compact('validasi_id', 'so'));
    }

    public function validasi($noso){

        
        $validasi_so = TransaksiSOHeader::where('noso', $noso)->update([
            'flag_vald_gudang'  => 'Y',
            'flag_vald_date'    => NOW()
        ]);

        return redirect()->route('validasi-so.index')->with('success','Data SO berhasil divalidasi, diteruskan ke packingsheet');

    }

    public function cetak($noso)
    {
        $data           = TransaksiSOHeader::where('noso', $noso)->get();
        $data_details   = TransaksiSODetails::where('noso', $noso)->get();
        $header         = TransaksiSOHeader::where('noso', $noso)->first();
        $pdf            = PDF::loadView('reports.sales-order', ['data'=>$data, 'data_details'=>$data_details], ['header'=>$header]);
        $pdf->setPaper('letter', 'potrait');

        return $pdf->stream('sales-order.pdf');
    }
}
