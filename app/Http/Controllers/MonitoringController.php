<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TargetSales;
use App\Models\TransaksiInvoiceHeader;
use App\Models\TransaksiInvoiceDetails;
use App\Models\User;

class MonitoringController extends Controller
{
    public function index(){

        $username = User::where('id_role', 20)->get();

        return view('monitoring.index', compact('username'));
    }

    public function store(Request $request){

        $request->validate([
            'sales'         => 'required',
            'tanggal_awal'  => 'required', 
            'tanggal_akhir' => 'required',
        ]);
        
        $sales  = $request->sales;
        $awal   = $request->tanggal_awal;
        $akhir  = $request->tanggal_akhir;

        $tanggal_awal   = Carbon::parse($awal)->startOfDay();
        $tanggal_akhir  = Carbon::parse($akhir)->endOfDay();
        $bulan          = Carbon::parse($awal)->month;
        $tahun          = Carbon::parse($awal)->year;

        $getTargetBulanan = TransaksiInvoiceDetails::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->where('created_by', $sales)
            ->get();

        $getTarget = TargetSales::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('sales', $sales)
            ->value('nominal');

        $target = $getTargetBulanan->sum('nominal_total');

        $selisih = $target - $getTarget;

        $pencapaian_persen = ($target / $getTarget)/ 100;

        return view('monitoring.spv', compact('target', 'sales', 'getTarget', 'selisih', 'pencapaian_persen'));
    }

    // public function view()
    // {
        
    //     return view('monitoring.spv');
    // }
}
