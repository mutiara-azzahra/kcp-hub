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

        $username = User::where('id_role', 24)->get();

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

        
        //ACTUAL EACH MONTH
        $getActualSales = TransaksiInvoiceDetails::where('created_by', $sales)->get();
        
        $jan = number_format($getActualSales->where('created_at', '>=', $tahun.'-01-01')->where('created_at', '<=', $tahun.'-01-'.Carbon::createFromDate($tahun, 1, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $feb = number_format($getActualSales->where('created_at', '>=', $tahun.'-02-01')->where('created_at', '<=', $tahun.'-02-'.Carbon::createFromDate($tahun, 2, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $mar = number_format($getActualSales->where('created_at', '>=', $tahun.'-03-01')->where('created_at', '<=', $tahun.'-03-'.Carbon::createFromDate($tahun, 3, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $apr = number_format($getActualSales->where('created_at', '>=', $tahun.'-04-01')->where('created_at', '<=', $tahun.'-04-'.Carbon::createFromDate($tahun, 4, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $may = number_format($getActualSales->where('created_at', '>=', $tahun.'-05-01')->where('created_at', '<=', $tahun.'-05-'.Carbon::createFromDate($tahun, 5, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jun = number_format($getActualSales->where('created_at', '>=', $tahun.'-06-01')->where('created_at', '<=', $tahun.'-06-'.Carbon::createFromDate($tahun, 6, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jul = number_format($getActualSales->where('created_at', '>=', $tahun.'-07-01')->where('created_at', '<=', $tahun.'-07-'.Carbon::createFromDate($tahun, 7, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $agu = number_format($getActualSales->where('created_at', '>=', $tahun.'-08-01')->where('created_at', '<=', $tahun.'-08-'.Carbon::createFromDate($tahun, 8, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $sep = number_format($getActualSales->where('created_at', '>=', $tahun.'-09-01')->where('created_at', '<=', $tahun.'-09-'.Carbon::createFromDate($tahun, 9, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $oct = number_format($getActualSales->where('created_at', '>=', $tahun.'-10-01')->where('created_at', '<=', $tahun.'-10-'.Carbon::createFromDate($tahun, 10, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $nov = number_format($getActualSales->where('created_at', '>=', $tahun.'-11-01')->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $dec = number_format($getActualSales->where('created_at', '>=', $tahun.'-12-01')->where('created_at', '<=', $tahun.'-12-'.Carbon::createFromDate($tahun, 12, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.'); 
   

        $getTarget = TargetSales::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('sales', $sales)
            ->value('nominal');

        $getTargetActual    = TargetSales::where('sales', $sales)->get();
        // TARGET EACH MONTH
        $target_jan = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 1)->value('nominal'), 0, ',', '.');
        $target_feb = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 2)->value('nominal'), 0, ',', '.');
        $target_mar = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 3)->value('nominal'), 0, ',', '.');
        $target_apr = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 4)->value('nominal'), 0, ',', '.');
        $target_may = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 5)->value('nominal'), 0, ',', '.');
        $target_jun = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 6)->value('nominal'), 0, ',', '.');
        $target_jul = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 7)->value('nominal'), 0, ',', '.');
        $target_agu = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 8)->value('nominal'), 0, ',', '.');
        $target_sep = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 9)->value('nominal'), 0, ',', '.');
        $target_oct = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 10)->value('nominal'), 0, ',', '.');
        $target_nov = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 11)->value('nominal'), 0, ',', '.');
        $target_dec = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 12)->value('nominal'), 0, ',', '.');

        $target             = $getTargetBulanan->sum('nominal_total');
        $selisih            = $target - $getTarget;
        $pencapaian_persen  = ($target / $getTarget)/ 100;

        return view('monitoring.spv', compact('target', 'monthName','sales', 'getTarget', 'getTargetActual', 'selisih', 'pencapaian_persen', 'getTargetBulanan',
        'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'agu', 'sep', 'oct', 'nov', 'dec', 
        'target_jan', 'target_feb', 'target_mar', 'target_apr', 'target_may', 'target_jun', 'target_jul', 'target_agu', 'target_sep', 'target_oct', 'target_nov', 'target_dec'    
        ));
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
       
            $target             = $getTargetBulanan->sum('nominal_total');
            $selisih            = $target - $getTarget;
            $pencapaian_persen  = ($target / $getTarget)/ 100;


        $getActual = TransaksiInvoiceDetails::all();

        $getTargetActual = TargetSpv::where('spv', $spv)->get();

        // TARGET EACH MONTH
        $target_jan = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 1)->value('nominal'), 0, ',', '.');
        $target_feb = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 2)->value('nominal'), 0, ',', '.');
        $target_mar = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 3)->value('nominal'), 0, ',', '.');
        $target_apr = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 4)->value('nominal'), 0, ',', '.');
        $target_may = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 5)->value('nominal'), 0, ',', '.');
        $target_jun = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 6)->value('nominal'), 0, ',', '.');
        $target_jul = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 7)->value('nominal'), 0, ',', '.');
        $target_agu = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 8)->value('nominal'), 0, ',', '.');
        $target_sep = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 9)->value('nominal'), 0, ',', '.');
        $target_oct = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 10)->value('nominal'), 0, ',', '.');
        $target_nov = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 11)->value('nominal'), 0, ',', '.');
        $target_dec = number_format($getTargetActual->where('tahun', $tahun)->where('bulan', 12)->value('nominal'), 0, ',', '.');

        //ACTUAL EACH MONTH
        $jan = number_format($getActual->where('created_at', '>=', $tahun.'-01-01')->where('created_at', '<=', $tahun.'-01-'.Carbon::createFromDate($tahun, 1, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $feb = number_format($getActual->where('created_at', '>=', $tahun.'-02-01')->where('created_at', '<=', $tahun.'-02-'.Carbon::createFromDate($tahun, 2, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $mar = number_format($getActual->where('created_at', '>=', $tahun.'-03-01')->where('created_at', '<=', $tahun.'-03-'.Carbon::createFromDate($tahun, 3, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $apr = number_format($getActual->where('created_at', '>=', $tahun.'-04-01')->where('created_at', '<=', $tahun.'-04-'.Carbon::createFromDate($tahun, 4, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $may = number_format($getActual->where('created_at', '>=', $tahun.'-05-01')->where('created_at', '<=', $tahun.'-05-'.Carbon::createFromDate($tahun, 5, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jun = number_format($getActual->where('created_at', '>=', $tahun.'-06-01')->where('created_at', '<=', $tahun.'-06-'.Carbon::createFromDate($tahun, 6, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jul = number_format($getActual->where('created_at', '>=', $tahun.'-07-01')->where('created_at', '<=', $tahun.'-07-'.Carbon::createFromDate($tahun, 7, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $agu = number_format($getActual->where('created_at', '>=', $tahun.'-08-01')->where('created_at', '<=', $tahun.'-08-'.Carbon::createFromDate($tahun, 8, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $sep = number_format($getActual->where('created_at', '>=', $tahun.'-09-01')->where('created_at', '<=', $tahun.'-09-'.Carbon::createFromDate($tahun, 9, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $oct = number_format($getActual->where('created_at', '>=', $tahun.'-10-01')->where('created_at', '<=', $tahun.'-10-'.Carbon::createFromDate($tahun, 10, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $nov = number_format($getActual->where('created_at', '>=', $tahun.'-11-01')->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $dec = number_format($getActual->where('created_at', '>=', $tahun.'-12-01')->where('created_at', '<=', $tahun.'-12-'.Carbon::createFromDate($tahun, 12, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.'); 
        
        return view('monitoring.sales', compact('target', 'tahun', 'monthName','spv', 'getActual','getTarget', 'getTargetActual', 'getTargetBulanan',
        'selisih', 'pencapaian_persen', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'agu', 'sep', 'oct', 'nov', 'dec', 
        'target_jan', 'target_feb', 'target_mar', 'target_apr', 'target_may', 'target_jun', 'target_jul', 'target_agu', 'target_sep', 'target_oct', 'target_nov', 'target_dec'
        ));
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
