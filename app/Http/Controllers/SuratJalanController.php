<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Auth;
use Carbon\Carbon;
use App\Models\TransaksiSOHeader;
use App\Models\TransaksiSuratJalanHeader;
use App\Models\TransaksiSuratJalanDetails;


class SuratJalanController extends Controller
{
    public function index(){

        $invoice_belum_sj = TransaksiSOHeader::where('flag_approve', 'Y')
        ->where('flag_packingsheet', 'Y')
        ->where('flag_invoice', 'Y')
        ->where('flag_sj', 'N')
        ->get();

        $surat_jalan = TransaksiSuratJalanHeader::all();

        return view('surat-jalan.index', compact('invoice_belum_sj', 'surat_jalan'));
    }

    public function store_sj(Request $request){

        $nosj = TransaksiSuratJalanHeader::nosj();

        $selectedItems = $request->input('selected_items', []);

        $data['nosj']           = $nosj;
        $data['flag_cetak']     = 'N';
        $data['status ']        = 'O';
        $data['created_at']     = NOW();

       TransaksiSuratJalanHeader::create($data);

        foreach ($selectedItems as $noso) {

            //foreach($invoice_belum_sj as $s){

            //update
            TransaksiSOHeader::where('noso', $noso)->update([
                'flag_sj'      => 'Y',
                'flag_sj_date' => NOW(),
            ]);
        }

        foreach ($selectedItems as $noso) {
            $invoice_belum_sj = TransaksiSOHeader::where('noso', $noso)->get();

            foreach($invoice_belum_sj as $h){
                foreach($h->details_so as $s){
                    $details['nosj']       = $nosj;
                    $details['area_sj']    = $s->area_so;
                    $details['nops']       = $h->ps->nops;
                    $details['kd_outlet']  = $s->kd_outlet;
                    $details['koli']       = $h->ps->details_dus->count('no_dus');
                    $details['created_at'] = NOW();

                } 
            }

            TransaksiSuratJalanDetails::create($details);
        }

        return redirect()->route('surat-jalan.index')->with('success','Data SO berhasil diteruskan ke packingsheet');
    }

    public function cetak($nosj)
    {

        TransaksiSuratJalanHeader::where('nosj', $nosj)->update([
                'flag_cetak'      => 'Y',
                'flag_cetak_date' => NOW(),
                'updated_by'      => Auth::user()->nama_user
        ]);

        $data               = TransaksiSuratJalanHeader::where('nosj', $nosj)->get();
        $data_details       = TransaksiSuratJalanDetails::where('nosj', $nosj)->first();

        $pdf                = PDF::loadView('reports.surat-jalan', ['data'=>$data], ['data_details'=>$data_details]);
        $pdf->setPaper('letter', 'potrait');

        return $pdf->stream('surat-jalan.pdf');
    }
}
