<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPart;
use App\Models\InvoiceNonHeader;
use App\Models\InvoiceNonDetails;
use App\Models\TransaksiInvoiceDetails;

class ReportLssController extends Controller
{
    public function index(){

        return view('report-lss.index');
    }

    public function store(Request $request){

        $request->validate([
            'bulan'         => 'required',
            'tahun'         => 'required',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $getBeli = InvoiceNonHeader::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->get();

        $getHpp = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->get();

        //I01
        $ichidai_I01    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I01')->pluck('part_no')->toArray();
        $flattened_I01  = collect($ichidai_I01)->flatten()->toArray();
        //I02
        $ichidai_I02    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I02')->pluck('part_no')->toArray();
        $flattened_I02  = collect($ichidai_I02)->flatten()->toArray();
        //I03
        $ichidai_I03    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I03')->pluck('part_no')->toArray();
        $flattened_I03  = collect($ichidai_I03)->flatten()->toArray();
        //I04
        $ichidai_I04    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I04')->pluck('part_no')->toArray();
        $flattened_I04  = collect($ichidai_I04)->flatten()->toArray();
        //I05
        $ichidai_I05    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I05')->pluck('part_no')->toArray();
        $flattened_I05  = collect($ichidai_I05)->flatten()->toArray();
        //I06
        $ichidai_I06    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I06')->pluck('part_no')->toArray();
        $flattened_I06  = collect($ichidai_I06)->flatten()->toArray();
        //I07
        $ichidai_I07    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I07')->pluck('part_no')->toArray();
        $flattened_I07  = collect($ichidai_I07)->flatten()->toArray();
        //I08
        $ichidai_I08    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I08')->pluck('part_no')->toArray();
        $flattened_I08  = collect($ichidai_I08)->flatten()->toArray();
        //I09
        $ichidai_I09    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I09')->pluck('part_no')->toArray();
        $flattened_I09  = collect($ichidai_I09)->flatten()->toArray();

        $beliI01 = 0;
        $beliI02 = 0;
        $beliI03 = 0;
        $beliI04 = 0;
        $beliI05 = 0;
        $beliI06 = 0;
        $beliI07 = 0;
        $beliI08 = 0;
        $beliI09 = 0;

        foreach($getBeli as $i){
            $beliI01 += $i->details_pembelian->whereIn('part_no', $flattened_I01)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliI02 += $i->details_pembelian->whereIn('part_no', $flattened_I02)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliI03 += $i->details_pembelian->whereIn('part_no', $flattened_I03)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliI04 += $i->details_pembelian->whereIn('part_no', $flattened_I04)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliI05 += $i->details_pembelian->whereIn('part_no', $flattened_I05)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliI06 += $i->details_pembelian->whereIn('part_no', $flattened_I06)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliI07 += $i->details_pembelian->whereIn('part_no', $flattened_I07)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliI08 += $i->details_pembelian->whereIn('part_no', $flattened_I08)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliI09 += $i->details_pembelian->whereIn('part_no', $flattened_I09)->sum('total_amount');
        }

        $hppI01     = $getHpp->whereIn('part_no', $flattened_I01)->sum('nominal_total')/1.11;
        $hppI02     = $getHpp->whereIn('part_no', $flattened_I02)->sum('nominal_total')/1.11;
        $hppI03     = $getHpp->whereIn('part_no', $flattened_I03)->sum('nominal_total')/1.11;
        $hppI04     = $getHpp->whereIn('part_no', $flattened_I04)->sum('nominal_total')/1.11;
        $hppI05     = $getHpp->whereIn('part_no', $flattened_I05)->sum('nominal_total')/1.11;
        $hppI06     = $getHpp->whereIn('part_no', $flattened_I06)->sum('nominal_total')/1.11;
        $hppI07     = $getHpp->whereIn('part_no', $flattened_I07)->sum('nominal_total')/1.11;
        $hppI08     = $getHpp->whereIn('part_no', $flattened_I08)->sum('nominal_total')/1.11;
        $hppI09     = $getHpp->whereIn('part_no', $flattened_I09)->sum('nominal_total')/1.11;


        

        

        


        //IL1
        $ichidai_IL1    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL1')->pluck('part_no')->toArray();
        $flattened_IL1  = collect($ichidai_IL1)->flatten()->toArray();

        $getHppIL1 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL1)
            ->get();

        $beliIL1 = 0;

        foreach($getBeli as $i){
            $beliIL1 += $i->details_pembelian->whereIn('part_no', $flattened_IL1)->sum('total_amount');
        }
        $hppIL1     = $getHppIL1->sum('nominal_total')/1.11;

        //IL2
        $ichidai_IL2    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL2')->pluck('part_no')->toArray();
        $flattened_IL2  = collect($ichidai_IL2)->flatten()->toArray();

        $getHppIL2 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL2)
            ->get();

        $beliIL2 = 0;

        foreach($getBeli as $i){
            $beliIL2 += $i->details_pembelian->whereIn('part_no', $flattened_IL2)->sum('total_amount');
        }
        $hppIL2     = $getHppIL2->sum('nominal_total')/1.11;

        //IL3
        $ichidai_IL3    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL3')->pluck('part_no')->toArray();
        $flattened_IL3  = collect($ichidai_IL3)->flatten()->toArray();

        $getHppIL3 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL3)
            ->get();

        $beliIL3 = 0;

        foreach($getBeli as $i){
            $beliIL3 += $i->details_pembelian->whereIn('part_no', $flattened_IL3)->sum('total_amount');
        }

        $hppIL3     = $getHppIL3->sum('nominal_total')/1.11;


        //IL4
        $ichidai_IL4    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL4')->pluck('part_no')->toArray();
        $flattened_IL4  = collect($ichidai_IL4)->flatten()->toArray();

        $getHppIL4 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL4)
            ->get();

        $beliIL4 = 0;

        foreach($getBeli as $i){
            $beliIL4 += $i->details_pembelian->whereIn('part_no', $flattened_IL4)->sum('total_amount');
        }
            
        $hppIL4     = $getHppIL4->sum('nominal_total')/1.11;

        //IL5
        $ichidai_IL5    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL5')->pluck('part_no')->toArray();
        $flattened_IL5  = collect($ichidai_IL5)->flatten()->toArray();

        $getHppIL5 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL5)
            ->get();

        $beliIL5 = 0;

        foreach($getBeli as $i){
            $beliIL5 += $i->details_pembelian->whereIn('part_no', $flattened_IL5)->sum('total_amount');
        }

        $hppIL5    = $getHppIL5->sum('nominal_total')/1.11;

        //IL6
        $ichidai_IL6    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL6')->pluck('part_no')->toArray();
        $flattened_IL6  = collect($ichidai_IL6)->flatten()->toArray();

        $getHppIL6 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL6)
            ->get();

        $beliIL6 = 0;

        foreach($getBeli as $i){
            $beliIL6 += $i->details_pembelian->whereIn('part_no', $flattened_IL6)->sum('total_amount');
        }

        $hppIL6 = $getHppIL6->sum('nominal_total')/1.11;

        //I07
        $ichidai_IL7    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL7')->pluck('part_no')->toArray();
        $flattened_IL7  = collect($ichidai_IL7)->flatten()->toArray();

        $getHppIL7 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL7)
            ->get();

        $beliIL7 = 0;

        foreach($getBeli as $i){
            $beliIL7 += $i->details_pembelian->whereIn('part_no', $flattened_IL7)->sum('total_amount');
        }

        $hppIL7 = $getHppIL7->sum('nominal_total')/1.11;

        //IL8
        $ichidai_IL8    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL8')->pluck('part_no')->toArray();
        $flattened_IL8  = collect($ichidai_IL8)->flatten()->toArray();

        $getHppIL8 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL8)
            ->get();

            

        $beliIL8 = 0;

        foreach($getBeli as $i){
            $beliIL8 += $i->details_pembelian->whereIn('part_no', $flattened_IL8)->sum('total_amount');
        }

        $hppIL8 = $getHppIL8->sum('nominal_total')/1.11;

        //IL9
        $ichidai_IL9    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL9')->pluck('part_no')->toArray();
        $flattened_IL9  = collect($ichidai_IL9)->flatten()->toArray();

        $getHppIL9 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL9)
            ->get();

        $beliIL9 = 0;

        foreach($getBeli as $i){
            $beliIL9 += $i->details_pembelian->whereIn('part_no', $flattened_IL9)->sum('total_amount');
        }
        
        $hppIL9 = $getHppIL9->sum('nominal_total')/1.11;



        //IM1
        $ichidai_IM1    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM1')->pluck('part_no')->toArray();
        $flattened_IM1  = collect($ichidai_IM1)->flatten()->toArray();

        $getHppIM1 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IM1)
            ->get();

        $beliIM1 = 0;

        foreach($getBeli as $i){
            $beliIM1 += $i->details_pembelian->whereIn('part_no', $flattened_IM1)->sum('total_amount');
        }

        $hppIM1     = $getHppIM1->sum('nominal_total')/1.11;
        
        //IM2
        $ichidai_IM2    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM2')->pluck('part_no')->toArray();
        $flattened_IM2  = collect($ichidai_IM2)->flatten()->toArray();

        $getHppIM2 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IM2)
            ->get();

        $beliIM2 = 0;

        foreach($getBeli as $i){
            $beliIM2 += $i->details_pembelian->whereIn('part_no', $flattened_IM2)->sum('total_amount');
        }

        $hppIM2     = $getHppIM2->sum('nominal_total')/1.11;

        //IM3
        $ichidai_IM3    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM3')->pluck('part_no')->toArray();
        $flattened_IM3  = collect($ichidai_IM3)->flatten()->toArray();

        $getHppIM3 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IM3)
            ->get();

        $beliIM3 = 0;

        foreach($getBeli as $i){
            $beliIM3 += $i->details_pembelian->whereIn('part_no', $flattened_IM3)->sum('total_amount');
        }

        $hppIM3     = $getHppIM3->sum('nominal_total')/1.11;

        //IL4
        $ichidai_IM4    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM4')->pluck('part_no')->toArray();
        $flattened_IM4  = collect($ichidai_IM4)->flatten()->toArray();

        $getHppIM4 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IM4)
            ->get();

        $beliIM4 = 0;

        foreach($getBeli as $i){
            $beliIM4 += $i->details_pembelian->whereIn('part_no', $flattened_IM4)->sum('total_amount');
        }

        $hppIM4     = $getHppIL4->sum('nominal_total')/1.11;

        //IM5
        $ichidai_IM5    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM5')->pluck('part_no')->toArray();
        $flattened_IM5  = collect($ichidai_IM5)->flatten()->toArray();

        $getHppIM5 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IM5)
            ->get();

        $beliIM5 = 0;

        foreach($getBeli as $i){
            $beliIM5 += $i->details_pembelian->whereIn('part_no', $flattened_IM5)->sum('total_amount');
        }

        $hppIM5     = $getHppIM5->sum('nominal_total')/1.11;

        //IM6
        $ichidai_IM6    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM6')->pluck('part_no')->toArray();
        $flattened_IM6  = collect($ichidai_IM6)->flatten()->toArray();

        $getHppIM6 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IM6)
            ->get();

        $beliIM6 = 0;

        foreach($getBeli as $i){
            $beliIM6 += $i->details_pembelian->whereIn('part_no', $flattened_IM6)->sum('total_amount');
        }

        $hppIM6     = $getHppIM6->sum('nominal_total')/1.11;

        //IM7
        $ichidai_IM7    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM7')->pluck('part_no')->toArray();
        $flattened_IM7  = collect($ichidai_IM7)->flatten()->toArray();

        $getHppIM7 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IM7)
            ->get();

        $beliIM7 = 0;

        foreach($getBeli as $i){
            $beliIM7 += $i->details_pembelian->whereIn('part_no', $flattened_IM7)->sum('total_amount');
        }

        $hppIM7     = $getHppIM7->sum('nominal_total')/1.11;

        //IM8
        $ichidai_IM8    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM8')->pluck('part_no')->toArray();
        $flattened_IM8  = collect($ichidai_IM8)->flatten()->toArray();

        $getHppIM8 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IM8)
            ->get();

        $beliIM8 = 0;

        foreach($getBeli as $i){
            $beliIM8 += $i->details_pembelian->whereIn('part_no', $flattened_IM8)->sum('total_amount');
        }

        $hppIM8     = $getHppIM8->sum('nominal_total')/1.11;


        //IL9
        $ichidai_IM9    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM9')->pluck('part_no')->toArray();
        $flattened_IM9  = collect($ichidai_IM9)->flatten()->toArray();

        $getHppIM9 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IM9)
            ->get();

        $beliIM9 = 0;

        foreach($getBeli as $i){
            $beliIM9 += $i->details_pembelian->whereIn('part_no', $flattened_IM9)->sum('total_amount');
        }

        $hppIM9     = $getHppIM9->sum('nominal_total')/1.11;

        //B01
        $brio_B01    = MasterPart::where('level_2', 'BP2')->where('level_4', 'B01')->pluck('part_no')->toArray();
        $flattened_B01  = collect($brio_B01)->flatten()->toArray();

        $getHppB01 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_B01)
            ->get();

        $beliB01 = 0;

        foreach($getBeli as $i){
            $beliB01 += $i->details_pembelian->whereIn('part_no', $flattened_B01)->sum('total_amount');
        }

        $hppB01     = $getHppB01->sum('nominal_total')/1.11;
        
        //B02
        $brio_B02    = MasterPart::where('level_2', 'BP2')->where('level_4', 'B02')->pluck('part_no')->toArray();
        $flattened_B02  = collect($brio_B02)->flatten()->toArray();

        $getHppB02 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_B02)
            ->get();

        $beliB02 = 0;

        foreach($getBeli as $i){
            $beliB02 += $i->details_pembelian->whereIn('part_no', $flattened_B02)->sum('total_amount');
        }

        $hppB02     = $getHppB02->sum('nominal_total')/1.11;

        //B03
        $brio_B03    = MasterPart::where('level_2', 'BP2')->where('level_4', 'B03')->pluck('part_no')->toArray();
        $flattened_B03  = collect($brio_B03)->flatten()->toArray();

        $getHppB03 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_B03)
            ->get();

        $beliB03 = 0;

        foreach($getBeli as $i){
            $beliB03 += $i->details_pembelian->whereIn('part_no', $flattened_B03)->sum('total_amount');
        }

        $hppB03     = $getHppB03->sum('nominal_total')/1.11;

        //LQ2
        $liquid_L01    = MasterPart::where('level_2', 'LQ2')->where('level_4', 'L01')->pluck('part_no')->toArray();
        $flattened_L01  = collect($liquid_L01)->flatten()->toArray();

        $getHppL01 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_L01)
            ->get();

        $beliL01 = 0;

        foreach($getBeli as $i){
            $beliL01 += $i->details_pembelian->whereIn('part_no', $flattened_L01)->sum('total_amount');
        }

        $hppL01     = $getHppL01->sum('nominal_total')/1.11;
        
        //L02
        $liquid_L02    = MasterPart::where('level_2', 'LQ2')->where('level_4', 'L02')->pluck('part_no')->toArray();
        $flattened_L02  = collect()->flatten()->toArray();

        $getHppL02 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_L02)
            ->get();

        $beliL02 = 0;

        foreach($getBeli as $i){
            $beliL02 += $i->details_pembelian->whereIn('part_no', $flattened_L02)->sum('total_amount');
        }

        $hppL02 = $getHppL02->sum('nominal_total')/1.11;

        //L03
        $liquid_L03     = MasterPart::where('level_2', 'LQ2')->where('level_4', 'L03')->pluck('part_no')->toArray();
        $flattened_L03  = collect($liquid_L03)->flatten()->toArray();

        $getHppL03 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_L03)
            ->get();

        $beliL03 = 0;

        foreach($getBeli as $i){
            $beliL03 += $i->details_pembelian->whereIn('part_no', $flattened_L03)->sum('total_amount');
        }

        $hppL03     = $getHppL03->sum('nominal_total')/1.11;

        //BELI LEVEL2 IC2
        $getBeliIC2 = $beliI01 + $beliI02 + $beliI03 + $beliI04 + $beliI05 + $beliI06 + $beliI07 + $beliI08 + $beliI09 + $beliIL1 + $beliIL2 + $beliIL3 + $beliIL4 + 
                        $beliIL5 + $beliIL6 + $beliIL7 + $beliIL8 + $beliIL9 + $beliIM1 + $beliIM2 + $beliIM3 + $beliIM4 + 
                        $beliIM5 + $beliIM6 + $beliIM7 + $beliIM8 + $beliIM9;

        $getRbpIC2 = $hppI01 + $hppI02 + $hppI03 + $hppI04 + $hppI05 + $hppI06 + $hppI07 + $hppI08 + $hppI09 + $hppIL1 + $hppIL2 + $hppIL3 + $hppIL4 + 
                        $hppIL5 + $hppIL6 + $hppIL7 + $hppIL8 + $hppIL9 + $hppIM1 + $hppIM2 + $hppIM3 + $hppIM4 + 
                        $hppIM5 + $hppIM6 + $hppIM7 + $hppIM8 + $hppIM9;


        return view('report-lss.view', 
        compact(
            'beliI01', 'beliI02', 'beliI03', 'beliI04', 'beliI05', 'beliI06', 'beliI07', 'beliI08', 'beliI09',
            'hppI01', 'hppI02', 'hppI03', 'hppI04', 'hppI05', 'hppI06', 'hppI07', 'hppI08', 'hppI09',
            'beliIL1', 'beliIL2', 'beliIL3', 'beliIL4', 'beliIL5', 'beliIL6', 'beliIL7', 'beliIL8', 'beliIL9',
            'hppIL1', 'hppIL2', 'hppIL3', 'hppIL4', 'hppIL5', 'hppIL6', 'hppIL7', 'hppIL8', 'hppIL9',
            'beliIM1', 'beliIM2', 'beliIM3', 'beliIM4', 'beliIM5', 'beliIM6', 'beliIM7', 'beliIM8', 'beliIM9',
            'hppIM1', 'hppIM2', 'hppIM3', 'hppIM4', 'hppIM5', 'hppIM6', 'hppIM7', 'hppIM8', 'hppIM9',
            'beliB01', 'beliB02', 'beliB03',
            'hppB01', 'hppB02', 'hppB03',
            'beliL01', 'beliL02', 'beliL03',
            'hppL01', 'hppL02', 'hppL03',
            'getBeliIC2', 'getRbpIC2',
            'bulan', 'tahun'
        ));
    }
}
