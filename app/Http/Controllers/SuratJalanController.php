<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Auth;
use Carbon\Carbon;
use App\Models\TransaksiSOHeader;
use App\Models\TransaksiSuratJalanHeader;
use App\Models\TransaksiSuratJalanDetails;
use App\Models\TransaksiPackingsheetHeader;
use App\Models\TransaksiPackingsheetDetails;

class SuratJalanController extends Controller
{
    public function index(){
        
        $invoice_belum_sj = TransaksiPackingsheetHeader::where('flag_sj', 'N')->get();
        $surat_jalan      = TransaksiSuratJalanHeader::all();

        return view('surat-jalan.index', compact('invoice_belum_sj', 'surat_jalan'));
    }

    public function store_sj(Request $request){

        $nosj = TransaksiSuratJalanHeader::nosj();

        $data['nosj']           = $nosj;
        $data['flag_cetak']     = 'N';
        $data['status ']        = 'O';
        $data['created_at']     = NOW();

       TransaksiSuratJalanHeader::create($data);
        
        $selectedItems = $request->input('selected_items', []);

        foreach ($selectedItems as $nops) {

            $ps_details = TransaksiPackingsheetDetails::where('nops', $nops)->get();

            foreach($ps_details as $so){
                TransaksiSOHeader::where('noso', $so->noso)->update([
                    'flag_sj'      => 'Y',
                    'flag_sj_date' => NOW(),
                ]);
            }
        }

        foreach ($selectedItems as $nops) {
            $ps = TransaksiPackingsheetHeader::where('nops', $nops)->first();

            $details['nosj']       = $nosj;
            $details['area_sj']    = $ps->area_ps;
            $details['nops']       = $ps->nops;
            $details['kd_outlet']  = $ps->kd_outlet;
            $details['koli']       = $ps->details_dus->count('no_dus');
            $details['created_at'] = NOW();

            TransaksiSuratJalanDetails::create($details);

            TransaksiPackingsheetHeader::where('nops', $nops)->update([
                'flag_sj'      => 'Y',
                'flag_sj_date' => NOW(),
            ]);
        }

        return redirect()->route('surat-jalan.index')->with('success','Data Packingsheet berhasil diteruskan menjadi Surat Jalan');
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
