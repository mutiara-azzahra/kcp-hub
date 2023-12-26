<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TargetSpv;
use App\Models\TargetSpvProduk;
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

    //sales
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

    //spv
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
        
        $getTargetProduk = TargetSpvProduk::where('spv', $spv)->get();

        // TARGET EACH MONTH, EACH PRODUCT
        $target_ich_jan = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 1)->value('nominal'), 0, ',', '.');
        $target_ich_feb = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 2)->value('nominal'), 0, ',', '.');
        $target_ich_mar = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 3)->value('nominal'), 0, ',', '.');
        $target_ich_apr = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 4)->value('nominal'), 0, ',', '.');
        $target_ich_may = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 5)->value('nominal'), 0, ',', '.');
        $target_ich_jun = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 6)->value('nominal'), 0, ',', '.');
        $target_ich_jul = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 7)->value('nominal'), 0, ',', '.');
        $target_ich_agu = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 8)->value('nominal'), 0, ',', '.');
        $target_ich_sep = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 9)->value('nominal'), 0, ',', '.');
        $target_ich_oct = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 10)->value('nominal'), 0, ',', '.');
        $target_ich_nov = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 11)->value('nominal'), 0, ',', '.');
        $target_ich_dec = number_format($getTargetProduk->where('kode_produk', 'ICH')->where('tahun', $tahun)->where('bulan', 12)->value('nominal'), 0, ',', '.');

        $target_bri_jan = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 1)->value('nominal'), 0, ',', '.');
        $target_bri_feb = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 2)->value('nominal'), 0, ',', '.');
        $target_bri_mar = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 3)->value('nominal'), 0, ',', '.');
        $target_bri_apr = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 4)->value('nominal'), 0, ',', '.');
        $target_bri_may = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 5)->value('nominal'), 0, ',', '.');
        $target_bri_jun = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 6)->value('nominal'), 0, ',', '.');
        $target_bri_jul = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 7)->value('nominal'), 0, ',', '.');
        $target_bri_agu = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 8)->value('nominal'), 0, ',', '.');
        $target_bri_sep = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 9)->value('nominal'), 0, ',', '.');
        $target_bri_oct = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 10)->value('nominal'), 0, ',', '.');
        $target_bri_nov = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 11)->value('nominal'), 0, ',', '.');
        $target_bri_dec = number_format($getTargetProduk->where('kode_produk', 'BRI')->where('tahun', $tahun)->where('bulan', 12)->value('nominal'), 0, ',', '.');

        $target_acc_jan = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 1)->value('nominal'), 0, ',', '.');
        $target_acc_feb = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 2)->value('nominal'), 0, ',', '.');
        $target_acc_mar = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 3)->value('nominal'), 0, ',', '.');
        $target_acc_apr = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 4)->value('nominal'), 0, ',', '.');
        $target_acc_may = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 5)->value('nominal'), 0, ',', '.');
        $target_acc_jun = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 6)->value('nominal'), 0, ',', '.');
        $target_acc_jul = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 7)->value('nominal'), 0, ',', '.');
        $target_acc_agu = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 8)->value('nominal'), 0, ',', '.');
        $target_acc_sep = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 9)->value('nominal'), 0, ',', '.');
        $target_acc_oct = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 10)->value('nominal'), 0, ',', '.');
        $target_acc_nov = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 11)->value('nominal'), 0, ',', '.');
        $target_acc_dec = number_format($getTargetProduk->where('kode_produk', 'ACC')->where('tahun', $tahun)->where('bulan', 12)->value('nominal'), 0, ',', '.');

        $target_pen_jan = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 1)->value('nominal'), 0, ',', '.');
        $target_pen_feb = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 2)->value('nominal'), 0, ',', '.');
        $target_pen_mar = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 3)->value('nominal'), 0, ',', '.');
        $target_pen_apr = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 4)->value('nominal'), 0, ',', '.');
        $target_pen_may = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 5)->value('nominal'), 0, ',', '.');
        $target_pen_jun = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 6)->value('nominal'), 0, ',', '.');
        $target_pen_jul = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 7)->value('nominal'), 0, ',', '.');
        $target_pen_agu = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 8)->value('nominal'), 0, ',', '.');
        $target_pen_sep = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 9)->value('nominal'), 0, ',', '.');
        $target_pen_oct = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 10)->value('nominal'), 0, ',', '.');
        $target_pen_nov = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 11)->value('nominal'), 0, ',', '.');
        $target_pen_dec = number_format($getTargetProduk->where('kode_produk', 'PEN')->where('tahun', $tahun)->where('bulan', 12)->value('nominal'), 0, ',', '.');

        $target_acl_jan = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 1)->value('nominal'), 0, ',', '.');
        $target_acl_feb = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 2)->value('nominal'), 0, ',', '.');
        $target_acl_mar = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 3)->value('nominal'), 0, ',', '.');
        $target_acl_apr = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 4)->value('nominal'), 0, ',', '.');
        $target_acl_may = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 5)->value('nominal'), 0, ',', '.');
        $target_acl_jun = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 6)->value('nominal'), 0, ',', '.');
        $target_acl_jul = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 7)->value('nominal'), 0, ',', '.');
        $target_acl_agu = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 8)->value('nominal'), 0, ',', '.');
        $target_acl_sep = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 9)->value('nominal'), 0, ',', '.');
        $target_acl_oct = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 10)->value('nominal'), 0, ',', '.');
        $target_acl_nov = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 11)->value('nominal'), 0, ',', '.');
        $target_acl_dec = number_format($getTargetProduk->where('kode_produk', 'ACL')->where('tahun', $tahun)->where('bulan', 12)->value('nominal'), 0, ',', '.');

        //VIEW PEMBELIAN BY PRODUK
        //ICHIDAI
        $getActualIchidai = TransaksiInvoiceDetails::whereIn('part_no', function ($query) {
                $query->select('part_no')
                    ->from('master_part')
                    ->where('kode_produk', 'ICH');
                })
            ->get();

        $jan_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-01-01')->where('created_at', '<=', $tahun.'-01-'.Carbon::createFromDate($tahun, 1, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $feb_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-02-01')->where('created_at', '<=', $tahun.'-02-'.Carbon::createFromDate($tahun, 2, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $mar_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-03-01')->where('created_at', '<=', $tahun.'-03-'.Carbon::createFromDate($tahun, 3, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $apr_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-04-01')->where('created_at', '<=', $tahun.'-04-'.Carbon::createFromDate($tahun, 4, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $may_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-05-01')->where('created_at', '<=', $tahun.'-05-'.Carbon::createFromDate($tahun, 5, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jun_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-06-01')->where('created_at', '<=', $tahun.'-06-'.Carbon::createFromDate($tahun, 6, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jul_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-07-01')->where('created_at', '<=', $tahun.'-07-'.Carbon::createFromDate($tahun, 7, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $agu_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-08-01')->where('created_at', '<=', $tahun.'-08-'.Carbon::createFromDate($tahun, 8, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $sep_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-09-01')->where('created_at', '<=', $tahun.'-09-'.Carbon::createFromDate($tahun, 9, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $oct_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-10-01')->where('created_at', '<=', $tahun.'-10-'.Carbon::createFromDate($tahun, 10, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $nov_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-11-01')->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $dec_ich = number_format($getActualIchidai->where('created_at', '>=', $tahun.'-12-01')->where('created_at', '<=', $tahun.'-12-'.Carbon::createFromDate($tahun, 12, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');

        //BRIO
        $getActualBrio = TransaksiInvoiceDetails::whereIn('part_no', function ($query) {
                $query->select('part_no')
                    ->from('master_part')
                    ->where('kode_produk', 'BRI');
                })
            ->get();

        $jan_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-01-01')->where('created_at', '<=', $tahun.'-01-'.Carbon::createFromDate($tahun, 1, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $feb_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-02-01')->where('created_at', '<=', $tahun.'-02-'.Carbon::createFromDate($tahun, 2, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $mar_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-03-01')->where('created_at', '<=', $tahun.'-03-'.Carbon::createFromDate($tahun, 3, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $apr_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-04-01')->where('created_at', '<=', $tahun.'-04-'.Carbon::createFromDate($tahun, 4, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $may_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-05-01')->where('created_at', '<=', $tahun.'-05-'.Carbon::createFromDate($tahun, 5, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jun_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-06-01')->where('created_at', '<=', $tahun.'-06-'.Carbon::createFromDate($tahun, 6, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jul_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-07-01')->where('created_at', '<=', $tahun.'-07-'.Carbon::createFromDate($tahun, 7, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $agu_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-08-01')->where('created_at', '<=', $tahun.'-08-'.Carbon::createFromDate($tahun, 8, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $sep_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-09-01')->where('created_at', '<=', $tahun.'-09-'.Carbon::createFromDate($tahun, 9, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $oct_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-10-01')->where('created_at', '<=', $tahun.'-10-'.Carbon::createFromDate($tahun, 10, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $nov_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-11-01')->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $dec_bri = number_format($getActualBrio->where('created_at', '>=', $tahun.'-12-01')->where('created_at', '<=', $tahun.'-12-'.Carbon::createFromDate($tahun, 12, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
    
        //ACCU
        $getActualAccu = TransaksiInvoiceDetails::whereIn('part_no', function ($query) {
                $query->select('part_no')
                    ->from('master_part')
                    ->where('kode_produk', 'ACC');
                })
            ->get();

        $jan_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-01-01')->where('created_at', '<=', $tahun.'-01-'.Carbon::createFromDate($tahun, 1, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $feb_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-02-01')->where('created_at', '<=', $tahun.'-02-'.Carbon::createFromDate($tahun, 2, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $mar_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-03-01')->where('created_at', '<=', $tahun.'-03-'.Carbon::createFromDate($tahun, 3, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $apr_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-04-01')->where('created_at', '<=', $tahun.'-04-'.Carbon::createFromDate($tahun, 4, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $may_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-05-01')->where('created_at', '<=', $tahun.'-05-'.Carbon::createFromDate($tahun, 5, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jun_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-06-01')->where('created_at', '<=', $tahun.'-06-'.Carbon::createFromDate($tahun, 6, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jul_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-07-01')->where('created_at', '<=', $tahun.'-07-'.Carbon::createFromDate($tahun, 7, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $agu_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-08-01')->where('created_at', '<=', $tahun.'-08-'.Carbon::createFromDate($tahun, 8, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $sep_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-09-01')->where('created_at', '<=', $tahun.'-09-'.Carbon::createFromDate($tahun, 9, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $oct_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-10-01')->where('created_at', '<=', $tahun.'-10-'.Carbon::createFromDate($tahun, 10, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $nov_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-11-01')->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $dec_acc = number_format($getActualAccu->where('created_at', '>=', $tahun.'-12-01')->where('created_at', '<=', $tahun.'-12-'.Carbon::createFromDate($tahun, 12, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
       
        //COOLANT
        $getActualCoolant = TransaksiInvoiceDetails::whereIn('part_no', function ($query) {
                $query->select('part_no')
                    ->from('master_part')
                    ->where('kode_produk', 'ACL');
                })
            ->get();

        $jan_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-01-01')->where('created_at', '<=', $tahun.'-01-'.Carbon::createFromDate($tahun, 1, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $feb_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-02-01')->where('created_at', '<=', $tahun.'-02-'.Carbon::createFromDate($tahun, 2, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $mar_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-03-01')->where('created_at', '<=', $tahun.'-03-'.Carbon::createFromDate($tahun, 3, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $apr_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-04-01')->where('created_at', '<=', $tahun.'-04-'.Carbon::createFromDate($tahun, 4, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $may_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-05-01')->where('created_at', '<=', $tahun.'-05-'.Carbon::createFromDate($tahun, 5, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jun_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-06-01')->where('created_at', '<=', $tahun.'-06-'.Carbon::createFromDate($tahun, 6, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jul_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-07-01')->where('created_at', '<=', $tahun.'-07-'.Carbon::createFromDate($tahun, 7, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $agu_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-08-01')->where('created_at', '<=', $tahun.'-08-'.Carbon::createFromDate($tahun, 8, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $sep_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-09-01')->where('created_at', '<=', $tahun.'-09-'.Carbon::createFromDate($tahun, 9, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $oct_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-10-01')->where('created_at', '<=', $tahun.'-10-'.Carbon::createFromDate($tahun, 10, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $nov_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-11-01')->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $dec_acl = number_format($getActualCoolant->where('created_at', '>=', $tahun.'-12-01')->where('created_at', '<=', $tahun.'-12-'.Carbon::createFromDate($tahun, 12, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
           

        //PENTIL
        $getActualPentil = TransaksiInvoiceDetails::whereIn('part_no', function ($query) {
                $query->select('part_no')
                    ->from('master_part')
                    ->where('kode_produk', 'PEN');
                })
            ->get();

        $jan_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-01-01')->where('created_at', '<=', $tahun.'-01-'.Carbon::createFromDate($tahun, 1, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $feb_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-02-01')->where('created_at', '<=', $tahun.'-02-'.Carbon::createFromDate($tahun, 2, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $mar_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-03-01')->where('created_at', '<=', $tahun.'-03-'.Carbon::createFromDate($tahun, 3, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $apr_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-04-01')->where('created_at', '<=', $tahun.'-04-'.Carbon::createFromDate($tahun, 4, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $may_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-05-01')->where('created_at', '<=', $tahun.'-05-'.Carbon::createFromDate($tahun, 5, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jun_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-06-01')->where('created_at', '<=', $tahun.'-06-'.Carbon::createFromDate($tahun, 6, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $jul_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-07-01')->where('created_at', '<=', $tahun.'-07-'.Carbon::createFromDate($tahun, 7, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $agu_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-08-01')->where('created_at', '<=', $tahun.'-08-'.Carbon::createFromDate($tahun, 8, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $sep_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-09-01')->where('created_at', '<=', $tahun.'-09-'.Carbon::createFromDate($tahun, 9, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $oct_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-10-01')->where('created_at', '<=', $tahun.'-10-'.Carbon::createFromDate($tahun, 10, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $nov_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-11-01')->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');
        $dec_pen = number_format($getActualPentil->where('created_at', '>=', $tahun.'-12-01')->where('created_at', '<=', $tahun.'-12-'.Carbon::createFromDate($tahun, 12, 1)->endOfMonth()->format('d'))->sum('nominal_total'), 0, ',', '.');

        return view('monitoring.sales', compact('target', 'tahun', 'monthName','spv', 'getActual','getTarget', 'getTargetActual', 'getTargetBulanan',
        'selisih', 'pencapaian_persen', 
        'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'agu', 'sep', 'oct', 'nov', 'dec',
        'jan_ich', 'feb_ich', 'mar_ich', 'apr_ich', 'may_ich', 'jun_ich', 'jul_ich', 'agu_ich', 'sep_ich', 'oct_ich', 'nov_ich', 'dec_ich',
        'jan_bri', 'feb_bri', 'mar_bri', 'apr_bri', 'may_bri', 'jun_bri', 'jul_bri', 'agu_bri', 'sep_bri', 'oct_bri', 'nov_bri', 'dec_bri',
        'jan_acc', 'feb_acc', 'mar_acc', 'apr_acc', 'may_acc', 'jun_acc', 'jul_acc', 'agu_acc', 'sep_acc', 'oct_acc', 'nov_acc', 'dec_acc',
        'jan_acl', 'feb_acl', 'mar_acl', 'apr_acl', 'may_acl', 'jun_acl', 'jul_acl', 'agu_acl', 'sep_acl', 'oct_acl', 'nov_acl', 'dec_acl',
        'jan_pen', 'feb_pen', 'mar_pen', 'apr_pen', 'may_pen', 'jun_pen', 'jul_pen', 'agu_pen', 'sep_pen', 'oct_pen', 'nov_pen', 'dec_pen', 
        'target_jan', 'target_feb', 'target_mar', 'target_apr', 'target_may', 'target_jun', 'target_jul', 'target_agu', 'target_sep', 'target_oct', 'target_nov', 'target_dec',
        'target_ich_jan', 'target_ich_feb', 'target_ich_mar', 'target_ich_apr', 'target_ich_may', 'target_ich_jun', 'target_ich_jul', 'target_ich_agu', 'target_ich_sep', 'target_ich_oct', 'target_ich_nov', 'target_ich_dec',
        'target_bri_jan', 'target_bri_feb', 'target_bri_mar', 'target_bri_apr', 'target_bri_may', 'target_bri_jun', 'target_bri_jul', 'target_bri_agu', 'target_bri_sep', 'target_bri_oct', 'target_bri_nov', 'target_bri_dec',
        'target_acc_jan', 'target_acc_feb', 'target_acc_mar', 'target_acc_apr', 'target_acc_may', 'target_acc_jun', 'target_acc_jul', 'target_acc_agu', 'target_acc_sep', 'target_acc_oct', 'target_acc_nov', 'target_acc_dec',
        'target_acl_jan', 'target_acl_feb', 'target_acl_mar', 'target_acl_apr', 'target_acl_may', 'target_acl_jun', 'target_acl_jul', 'target_acl_agu', 'target_acl_sep', 'target_acl_oct', 'target_acl_nov', 'target_acl_dec',
        'target_pen_jan', 'target_pen_feb', 'target_pen_mar', 'target_pen_apr', 'target_pen_may', 'target_pen_jun', 'target_pen_jul', 'target_pen_agu', 'target_pen_sep', 'target_pen_oct', 'target_pen_nov', 'target_pen_dec'
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
