<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportKasController extends Controller
{
    public function index(){

        return view('report-kas.index');
    }

    public function store(Request $request){

        $request->validate([
            'kas'           => 'required',
            'tanggal_awal'  => 'required',
            'tanggal_akhir' => 'required',
        ]);

        dd($request->all());

        $tanggal_awal       = $request->tanggal_awal;
        $tanggal_akhir      = $request->tanggal_akhir;
    
        if($kas == 1){
            $getReport = KasMasukHeader::where('created_at', '>=', $tanggal_awal)->where('created_at', $tanggal_akhir)->get();

            $pdf   = PDF::loadView('reports.report-kas', ['getReport'=> $getReport, 'tanggal_awal'=> $tanggal_awal,'tanggal_akhir'=> $tanggal_akhir]);
            $pdf->setPaper('letter', 'potrait');

            return $pdf->stream('report-kas.pdf');

        } elseif($kas == 2){
            $getReport = TransaksiKasKeluar::where('created_at', '>=', $tanggal_awal)->where('created_at', $tanggal_akhir)->get();

            $pdf   = PDF::loadView('reports.report-kas', ['getReport'=> $getReport, 'tanggal_awal'=> $tanggal_awal, 'tanggal_akhir'=> $tanggal_akhir]);
            $pdf->setPaper('letter', 'potrait');

            return $pdf->stream('report-kas.pdf');
        }

    }
}
