<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TransaksiPackingsheetHeader;
use App\Models\TransaksiLkhHeader;
use App\Models\TransaksiLkhDetails;

class LkhController extends Controller
{
    public function index(){

        $packingsheet = TransaksiPackingsheetHeader::where('flag_lkh', 'N')->get();

        $lkh = TransaksiLkhHeader::all();

        return view('laporan-kiriman-harian.index', compact('packingsheet', 'lkh'));
    }

    public function store(Request $request){

        $no_lkh = TransaksiLkhHeader::no_lkh();

        $selectedItems = $request->input('selected_items', []);

        foreach ($selectedItems as $nops) {
            $packingsheet_belum_lkh = TransaksiPackingsheetHeader::where('nops', $nops)->get();

            foreach($packingsheet_belum_lkh as $s){

                $data['no_lkh']         = $no_lkh;
                $data['created_at']     = NOW();

                TransaksiLkhHeader::create($data);
            }

            TransaksiPackingsheetHeader::where('nops', $nops)->update([
                'no_lkh'      => $no_lkh,
                'flag_lkh'    => 'Y',
                'date_lkh'    => NOW(),
            ]);
        }

        foreach ($selectedItems as $nops) {

            foreach($packingsheet_belum_lkh as $h){
                foreach($h->details_ps as $s){
                    $details['no_lkh']          = $no_lkh;
                    $details['area_lkh']        = $s->area_lkh;
                    $details['kd_outlet']       = $s->kd_outlet;
                    $details['koli']            = $h->details_dus->count('no_dus');
                    $details['no_packingsheet'] = $nops;
                    $details['created_at']      = NOW();

                    TransaksiLkhDetails::create($details);
                }
            }
        }

        return redirect()->route('laporan-kiriman-harian.index')->with('success','Packingsheet berhasil diteruskan ke LKH!');
    }

    public function details($no_lkh)
    {
        $details     = TransaksiLkhHeader::where('no_lkh', $no_lkh)->first();
        $lkh_details  = TransaksiLkhHeader::where('no_lkh', $no_lkh)->get();
        $driver  = User::where('id_role', 22)->get();

        return view('laporan-kiriman-harian.details', ['no_lkh' => $no_lkh] ,compact('details', 'lkh_details', 'driver'));
    }

    public function store_details(Request $request, $no_lkh)
    {

        $request -> validate([
            'driver'            => 'required', 
            'helper'            => 'required',
            'plat_mobil'        => 'required',
            'jam_berangkat'     => 'required',
        ]);

        TransaksiLkhHeader::where('no_lkh', $no_lkh)->update([
                'driver'            => $request->driver,
                'helper'            => $request->helper,
                'plat_mobil'        => $request->plat_mobil,
                'jam_berangkat'     => $request->jam_berangkat,
            ]);
        
        return redirect()->route('laporan-kiriman-harian.index')->with('success','Details LKH berhasil ditambahkan!');
    }

    public function cetak($no_lkh)
    {
        $data           = TransaksiLkhHeader::where('no_lkh', $no_lkh)->get();
        $data_no_lkh    = TransaksiLkhHeader::where('no_lkh', $no_lkh)->first();
        $pdf            = PDF::loadView('reports.lkh', ['data'=>$data, 'data_no_lkh' => $data_no_lkh]);
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('lkh.pdf');
    }
}
