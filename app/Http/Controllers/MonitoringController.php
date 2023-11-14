<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TargetSpv;
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
        $monthName      = Carbon::parse($awal)->month($bulan)->format('F');

        $getTargetBulanan = TransaksiInvoiceDetails::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->where('created_by', $sales)
            ->get();

        $getTarget = TargetSales::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('sales', $sales)
            ->value('nominal');

        $getTargetActual    = TargetSales::where('sales', $sales)->get();
        $target             = $getTargetBulanan->sum('nominal_total');
        $selisih            = $target - $getTarget;
        $pencapaian_persen  = ($target / $getTarget)/ 100;

        return view('monitoring.spv', compact('target', 'monthName','sales', 'getTarget', 'getTargetActual', 'selisih', 'pencapaian_persen', 'getTargetBulanan'));
    }


    public function spv(){

        $username = User::where('id_role', 11)->get();

        return view('monitoring.monitoring-spv', compact('username'));
    }

    public function spv_store(Request $request){

        $request->validate([
            'spv'           => 'required',
            'tanggal_awal'  => 'required', 
            'tanggal_akhir' => 'required',
        ]);

        $spv    = $request->spv;
        $awal   = $request->tanggal_awal;
        $akhir  = $request->tanggal_akhir;

        $tanggal_awal   = Carbon::parse($awal)->startOfDay();
        $tanggal_akhir  = Carbon::parse($akhir)->endOfDay();
        $bulan          = Carbon::parse($awal)->month;
        $tahun          = Carbon::parse($awal)->year;
        $monthName      = Carbon::parse($awal)->month($bulan)->format('F');

        $getTargetBulanan = TransaksiInvoiceDetails::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->get();

        $getTarget = TargetSpv::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('spv', $spv)
            ->value('nominal');

        $getTargetActual    = TargetSpv::where('spv', $spv)->get();
        $target             = $getTargetBulanan->sum('nominal_total');
        $selisih            = $target - $getTarget;
        $pencapaian_persen  = ($target / $getTarget)/ 100;

        return view('monitoring.sales', compact('target', 'monthName','spv', 'getTarget', 'getTargetActual', 'getTargetBulanan','selisih', 'pencapaian_persen'));
    }

    public function pesanan(){

        return view('monitoring.pesanan');
    }

    public function pesanan_store(Request $request){

        $request->validate([
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
        $monthName      = Carbon::parse($awal)->month($bulan)->format('F');

        $getPesanan = TransaksiInvoiceDetails::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();

        $getPesananIchidai = TransaksiInvoiceDetails::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->whereIn('part_no', function ($query) {
                $query->select('part_no')
                    ->from('master_part')
                    ->where('id_grup', '1');
                })
            ->get();


        $getPesananBrio = TransaksiInvoiceDetails::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->whereIn('part_no', function ($query) {
                $query->select('part_no')
                    ->from('master_part')
                    ->where('id_grup', '2');
            })
            ->get();

        $getPesananAccu = TransaksiInvoiceDetails::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->whereIn('part_no', function ($query) {
                $query->select('part_no')
                    ->from('master_part')
                    ->where('id_grup', '3');
            })
            ->get();

        return view('monitoring.pesanan-terjual', compact('monthName', 'getPesanan', 'getPesananIchidai', 'getPesananBrio', 'getPesananAccu'));
    }

}
