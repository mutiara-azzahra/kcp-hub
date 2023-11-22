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

        $username = User::where('id_role', 20)->where('status', 'A')->get();

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

        $target =0;
        
        $getTargetBulanan = TransaksiInvoiceHeader::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->where('user_sales', $sales)
            ->get();

        foreach ($getTargetBulanan as $invoice) {
            $target += $invoice->details_invoice()->sum('nominal_total');
        }
        
        //ACTUAL EACH MONTH
        $sum1 = 0;
        $sum2 = 0;
        $sum3 = 0;
        $sum4 = 0;
        $sum5 = 0;
        $sum6 = 0;
        $sum7 = 0;
        $sum8 = 0;
        $sum9 = 0;
        $sum10 = 0;
        $sum11 = 0;
        $sum12 = 0;

        $getActualSales1 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-01-01')
            ->where('created_at', '<=', $tahun.'-01-'.Carbon::createFromDate($tahun, 1, 1)->endOfMonth()->format('d'))
            ->get();

        $getActualSales2 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-02-01')
            ->where('created_at', '<=', $tahun.'-02-'.Carbon::createFromDate($tahun, 2, 1)->endOfMonth()->format('d'))
            ->get();
        
        $getActualSales3 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-03-01')
            ->where('created_at', '<=', $tahun.'-03-'.Carbon::createFromDate($tahun, 3, 1)->endOfMonth()->format('d'))
            ->get();

        $getActualSales4 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-04-01')
            ->where('created_at', '<=', $tahun.'-04-'.Carbon::createFromDate($tahun, 4, 1)->endOfMonth()->format('d'))
            ->get();

        $getActualSales5 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-05-01')
            ->where('created_at', '<=', $tahun.'-05-'.Carbon::createFromDate($tahun, 5, 1)->endOfMonth()->format('d'))
            ->get();

        $getActualSales6 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-06-01')
            ->where('created_at', '<=', $tahun.'-06-'.Carbon::createFromDate($tahun, 6, 1)->endOfMonth()->format('d'))
            ->get();
        
        $getActualSales7 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-07-01')
            ->where('created_at', '<=', $tahun.'-07-'.Carbon::createFromDate($tahun, 7, 1)->endOfMonth()->format('d'))
            ->get();

        $getActualSales8 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-08-01')
            ->where('created_at', '<=', $tahun.'-08-'.Carbon::createFromDate($tahun, 8, 1)->endOfMonth()->format('d'))
            ->get();

        $getActualSales9 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-09-01')
            ->where('created_at', '<=', $tahun.'-09-'.Carbon::createFromDate($tahun, 9, 1)->endOfMonth()->format('d'))
            ->get();
        
        $getActualSales10 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-10-01')
            ->where('created_at', '<=', $tahun.'-10-'.Carbon::createFromDate($tahun, 10, 1)->endOfMonth()->format('d'))
            ->get();

        $getActualSales11 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();
        
        $getActualSales12 = TransaksiInvoiceHeader::where('user_sales', $sales)
            ->where('created_at', '>=', $tahun.'-12-01')
            ->where('created_at', '<=', $tahun.'-12-'.Carbon::createFromDate($tahun, 12, 1)->endOfMonth()->format('d'))
            ->get();

        foreach ($getActualSales1 as $invoice) {
            $sum1 += $invoice->details_invoice()->sum('nominal_total');
        }
        foreach ($getActualSales2 as $invoice) {
            $sum2 += $invoice->details_invoice()->sum('nominal_total');
        }
        foreach ($getActualSales3 as $invoice) {
            $sum3 += $invoice->details_invoice()->sum('nominal_total');
        }
        foreach ($getActualSales4 as $invoice) {
            $sum4 += $invoice->details_invoice()->sum('nominal_total');
        }
        foreach ($getActualSales5 as $invoice) {
            $sum5 += $invoice->details_invoice()->sum('nominal_total');
        }
        foreach ($getActualSales6 as $invoice) {
            $sum6 += $invoice->details_invoice()->sum('nominal_total');
        }

        foreach ($getActualSales7 as $invoice) {
            $sum7 += $invoice->details_invoice()->sum('nominal_total');
        }

        foreach ($getActualSales8 as $invoice) {
            $sum8 += $invoice->details_invoice()->sum('nominal_total');
        }
        foreach ($getActualSales9 as $invoice) {
            $sum9 += $invoice->details_invoice()->sum('nominal_total');
        }
        foreach ($getActualSales10 as $invoice) {
            $sum10 += $invoice->details_invoice()->sum('nominal_total');
        }
        foreach ($getActualSales11 as $invoice) {
            $sum11 += $invoice->details_invoice()->sum('nominal_total');
        }
        foreach ($getActualSales12 as $invoice) {
            $sum12 += $invoice->details_invoice()->sum('nominal_total');
        }

        $jan = number_format($sum1, 0, ',', '.');
        $feb = number_format($sum2, 0, ',', '.');
        $mar = number_format($sum3, 0, ',', '.');
        $apr = number_format($sum4, 0, ',', '.');
        $may = number_format($sum5, 0, ',', '.');
        $jun = number_format($sum6, 0, ',', '.');
        $jul = number_format($sum7, 0, ',', '.');
        $agu = number_format($sum8, 0, ',', '.');
        $sep = number_format($sum9, 0, ',', '.');
        $oct = number_format($sum10, 0, ',', '.');
        $nov = number_format($sum11, 0, ',', '.');
        $dec = number_format($sum12, 0, ',', '.');


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

        $selisih            = $target - $getTarget;
        $pencapaian_persen  = ($target / $getTarget) * 100;

        return view('monitoring.spv', compact('target', 'monthName','sales', 'getTarget', 'getTargetActual', 'selisih', 'pencapaian_persen', 
        'getTargetBulanan', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'agu', 'sep', 'oct', 'nov', 'dec', 
        'target_jan', 'target_feb', 'target_mar', 'target_apr', 'target_may', 'target_jun', 'target_jul', 'target_agu', 'target_sep', 'target_oct', 'target_nov', 'target_dec'    
        ));
    }


    public function spv(){

        $username = User::where('id_role', 24)->get();

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
