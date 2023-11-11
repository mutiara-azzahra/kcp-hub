<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiInvoiceHeader;
use App\Models\TransaksiInvoiceDetails;

class MonitoringController extends Controller
{
    public function index(){

        return view('monitoring.index');
    }


    public function store(Request $request){

        $request->validate([
            'tanggal_awal'  => 'required', 
            'tanggal_akhir' => 'required',
        ]);
        
        $awal   = $request->tanggal_awal;
        $akhir  = $request->tanggal_akhir;

        $tanggal_awal   = Carbon::parse($awal)->startOfDay();
        $tanggal_akhir  = Carbon::parse($akhir)->endOfDay();

        //$target_bulanan = TransaksiInvoiceHeader::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();

        $getTargetBulanan = TransaksiInvoiceDetails::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();

        $target = $getTargetBulanan->sum('nominal_total');

        return redirect()->route('monitoring.view')->with('target', $target);
    }

    public function view()
    {
        $test = session('target');

        return view('monitoring.spv', compact('test'));
    }
}
