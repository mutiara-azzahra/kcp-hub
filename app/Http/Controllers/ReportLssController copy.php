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
use App\Models\ModalPartTerjual;
use App\Models\LSS;
use App\Models\MasterLevel4;


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
   
        $bulan              = $request->bulan;
        $tahun              = $request->tahun;

        $date               = Carbon::create(null, $bulan, 1, 0, 0, 0);
        $previousMonth      = $date->subMonth()->month;

        if($previousMonth = 10 && $tahun = 2023 ){
            $awal_amount = 0;
        }

        $getLevel4 = MasterLevel4::all();

        foreach($getLevel4 as $i){

            $getBeli = InvoiceNonHeader::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->get();

            $getHpp = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
                ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
                ->get();

            $getModalTerjual = ModalPartTerjual::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
                ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
                ->get();

            $part       = MasterPart::where('level_2', $i->id_level_2)->where('level_4', $i->id_level_2)->pluck('part_no')->toArray();
            $flattened   = collect($ichidai_I01)->flatten()->toArray();

            $beli = 0;

            foreach($getBeli as $i){
                $beli += $i->details_pembelian->whereIn('part_no', $flattened)->sum('total_amount');
            }

            $hpp     = $getHpp->whereIn('part_no', $flattened)->sum('nominal_total')/1.11;
            $jual    = $getModalTerjual->whereIn('part_no', $flattened)->sum('nominal_modal')/1.11;


       // $created = LSS::create($value);

        }


        $getBeli = InvoiceNonHeader::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->get();

        $getHpp = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->get();

        $getModalTerjual = ModalPartTerjual::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
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

        $jualI01     = $getModalTerjual->whereIn('part_no', $flattened_I01)->sum('nominal_modal')/1.11;
        $jualI02     = $getModalTerjual->whereIn('part_no', $flattened_I02)->sum('nominal_modal')/1.11;
        $jualI03     = $getModalTerjual->whereIn('part_no', $flattened_I03)->sum('nominal_modal')/1.11;
        $jualI04     = $getModalTerjual->whereIn('part_no', $flattened_I04)->sum('nominal_modal')/1.11;
        $jualI05     = $getModalTerjual->whereIn('part_no', $flattened_I05)->sum('nominal_modal')/1.11;
        $jualI06     = $getModalTerjual->whereIn('part_no', $flattened_I06)->sum('nominal_modal')/1.11;
        $jualI07     = $getModalTerjual->whereIn('part_no', $flattened_I07)->sum('nominal_modal')/1.11;
        $jualI08     = $getModalTerjual->whereIn('part_no', $flattened_I08)->sum('nominal_modal')/1.11;
        $jualI09     = $getModalTerjual->whereIn('part_no', $flattened_I09)->sum('nominal_modal')/1.11;

        //IL1
        $ichidai_IL1    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL1')->pluck('part_no')->toArray();
        $flattened_IL1  = collect($ichidai_IL1)->flatten()->toArray();
        //IL2
        $ichidai_IL2    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL2')->pluck('part_no')->toArray();
        $flattened_IL2  = collect($ichidai_IL2)->flatten()->toArray();
        //IL3
        $ichidai_IL3    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL3')->pluck('part_no')->toArray();
        $flattened_IL3  = collect($ichidai_IL3)->flatten()->toArray();
        //IL4
        $ichidai_IL4    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL4')->pluck('part_no')->toArray();
        $flattened_IL4  = collect($ichidai_IL4)->flatten()->toArray();
        //IL5
        $ichidai_IL5    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL5')->pluck('part_no')->toArray();
        $flattened_IL5  = collect($ichidai_IL5)->flatten()->toArray();
        //IL6
        $ichidai_IL6    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL6')->pluck('part_no')->toArray();
        $flattened_IL6  = collect($ichidai_IL6)->flatten()->toArray();
        //I07
        $ichidai_IL7    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL7')->pluck('part_no')->toArray();
        $flattened_IL7  = collect($ichidai_IL7)->flatten()->toArray();
        //I07
        $ichidai_IL8    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL8')->pluck('part_no')->toArray();
        $flattened_IL8  = collect($ichidai_IL8)->flatten()->toArray();
        //IL9
        $ichidai_IL9    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL9')->pluck('part_no')->toArray();
        $flattened_IL9  = collect($ichidai_IL9)->flatten()->toArray();

        $beliIL1 = 0;
        $beliIL2 = 0;
        $beliIL3 = 0;
        $beliIL4 = 0;
        $beliIL5 = 0;
        $beliIL6 = 0;
        $beliIL7 = 0;
        $beliIL8 = 0;
        $beliIL9 = 0;

        foreach($getBeli as $i){
            $beliIL1 += $i->details_pembelian->whereIn('part_no', $flattened_IL1)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliIL2 += $i->details_pembelian->whereIn('part_no', $flattened_IL2)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliIL3 += $i->details_pembelian->whereIn('part_no', $flattened_IL3)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliIL4 += $i->details_pembelian->whereIn('part_no', $flattened_IL4)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliIL5 += $i->details_pembelian->whereIn('part_no', $flattened_IL5)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliIL6 += $i->details_pembelian->whereIn('part_no', $flattened_IL6)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliIL7 += $i->details_pembelian->whereIn('part_no', $flattened_IL7)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliIL8 += $i->details_pembelian->whereIn('part_no', $flattened_IL8)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliIL9 += $i->details_pembelian->whereIn('part_no', $flattened_IL9)->sum('total_amount');
        }

        $hppIL1     = $getHpp->whereIn('part_no', $flattened_IL1)->sum('nominal_total')/1.11;
        $hppIL2     = $getHpp->whereIn('part_no', $flattened_IL2)->sum('nominal_total')/1.11;
        $hppIL3     = $getHpp->whereIn('part_no', $flattened_IL3)->sum('nominal_total')/1.11;
        $hppIL4     = $getHpp->whereIn('part_no', $flattened_IL4)->sum('nominal_total')/1.11;
        $hppIL5     = $getHpp->whereIn('part_no', $flattened_IL5)->sum('nominal_total')/1.11;
        $hppIL6     = $getHpp->whereIn('part_no', $flattened_IL6)->sum('nominal_total')/1.11;
        $hppIL7     = $getHpp->whereIn('part_no', $flattened_IL7)->sum('nominal_total')/1.11;
        $hppIL8     = $getHpp->whereIn('part_no', $flattened_IL8)->sum('nominal_total')/1.11;
        $hppIL9     = $getHpp->whereIn('part_no', $flattened_IL9)->sum('nominal_total')/1.11;

        $jualIL1     = $getModalTerjual->whereIn('part_no', $flattened_IL1)->sum('nominal_modal')/1.11;
        $jualIL2     = $getModalTerjual->whereIn('part_no', $flattened_IL2)->sum('nominal_modal')/1.11;
        $jualIL3     = $getModalTerjual->whereIn('part_no', $flattened_IL3)->sum('nominal_modal')/1.11;
        $jualIL4     = $getModalTerjual->whereIn('part_no', $flattened_IL4)->sum('nominal_modal')/1.11;
        $jualIL5     = $getModalTerjual->whereIn('part_no', $flattened_IL5)->sum('nominal_modal')/1.11;
        $jualIL6     = $getModalTerjual->whereIn('part_no', $flattened_IL6)->sum('nominal_modal')/1.11;
        $jualIL7     = $getModalTerjual->whereIn('part_no', $flattened_IL7)->sum('nominal_modal')/1.11;
        $jualIL8     = $getModalTerjual->whereIn('part_no', $flattened_IL8)->sum('nominal_modal')/1.11;
        $jualIL9     = $getModalTerjual->whereIn('part_no', $flattened_IL9)->sum('nominal_modal')/1.11;


        //IL1
        $ichidai_IM1    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM1')->pluck('part_no')->toArray();
        $flattened_IM1  = collect($ichidai_IM1)->flatten()->toArray();
        //IM2
        $ichidai_IM2    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM2')->pluck('part_no')->toArray();
        $flattened_IM2  = collect($ichidai_IM2)->flatten()->toArray();
        //IM3
        $ichidai_IM3    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IM3')->pluck('part_no')->toArray();
        $flattened_IM3  = collect($ichidai_IM3)->flatten()->toArray();

        $beliIM1 = 0;
        $beliIM2 = 0;
        $beliIM3 = 0;

        foreach($getBeli as $i){
            $beliIM1 += $i->details_pembelian->whereIn('part_no', $flattened_IM1)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliIM2 += $i->details_pembelian->whereIn('part_no', $flattened_IM2)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliIM3 += $i->details_pembelian->whereIn('part_no', $flattened_IM3)->sum('total_amount');
        }

        $hppIM1     = $getHpp->whereIn('part_no', $flattened_IM1)->sum('nominal_total')/1.11;
        $hppIM2     = $getHpp->whereIn('part_no', $flattened_IM2)->sum('nominal_total')/1.11;
        $hppIM3     = $getHpp->whereIn('part_no', $flattened_IM3)->sum('nominal_total')/1.11;

        $jualIM1     = $getModalTerjual->whereIn('part_no', $flattened_IM1)->sum('nominal_modal')/1.11;
        $jualIM2     = $getModalTerjual->whereIn('part_no', $flattened_IM2)->sum('nominal_modal')/1.11;
        $jualIM3     = $getModalTerjual->whereIn('part_no', $flattened_IM3)->sum('nominal_modal')/1.11;

        //B01
        $brio_B01    = MasterPart::where('level_2', 'BP2')->where('level_4', 'B01')->pluck('part_no')->toArray();
        $flattened_B01  = collect($brio_B01)->flatten()->toArray();
        //B02
        $brio_B02    = MasterPart::where('level_2', 'BP2')->where('level_4', 'B02')->pluck('part_no')->toArray();
        $flattened_B02  = collect($brio_B02)->flatten()->toArray();
        //B03
        $brio_B03    = MasterPart::where('level_2', 'BP2')->where('level_4', 'B03')->pluck('part_no')->toArray();
        $flattened_B03  = collect($brio_B03)->flatten()->toArray();


        $beliB01 = 0;
        $beliB02 = 0;
        $beliB03 = 0;

        foreach($getBeli as $i){
            $beliB01 += $i->details_pembelian->whereIn('part_no', $flattened_B01)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliB02 += $i->details_pembelian->whereIn('part_no', $flattened_B02)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliB03 += $i->details_pembelian->whereIn('part_no', $flattened_B03)->sum('total_amount');
        }

        $hppB01     = $getHpp->whereIn('part_no', $flattened_B01)->sum('nominal_total')/1.11;
        $hppB02     = $getHpp->whereIn('part_no', $flattened_B02)->sum('nominal_total')/1.11;
        $hppB03     = $getHpp->whereIn('part_no', $flattened_B03)->sum('nominal_total')/1.11;
        
        $jualB01     = $getModalTerjual->whereIn('part_no', $flattened_B01)->sum('nominal_modal')/1.11;
        $jualB02     = $getModalTerjual->whereIn('part_no', $flattened_B02)->sum('nominal_modal')/1.11;
        $jualB03     = $getModalTerjual->whereIn('part_no', $flattened_B03)->sum('nominal_modal')/1.11;

        //LQ2
        $liquid_L01    = MasterPart::where('level_2', 'LQ2')->where('level_4', 'L01')->pluck('part_no')->toArray();
        $flattened_L01  = collect($liquid_L01)->flatten()->toArray();
        //L02
        $liquid_L02    = MasterPart::where('level_2', 'LQ2')->where('level_4', 'L02')->pluck('part_no')->toArray();
        $flattened_L02  = collect()->flatten()->toArray();
        //L03
        $liquid_L03     = MasterPart::where('level_2', 'LQ2')->where('level_4', 'L03')->pluck('part_no')->toArray();
        $flattened_L03  = collect($liquid_L03)->flatten()->toArray();


        $beliL01 = 0;
        $beliL02 = 0;
        $beliL03 = 0;

        foreach($getBeli as $i){
            $beliL01 += $i->details_pembelian->whereIn('part_no', $flattened_L01)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliL02 += $i->details_pembelian->whereIn('part_no', $flattened_L02)->sum('total_amount');
        }
        foreach($getBeli as $i){
            $beliL03 += $i->details_pembelian->whereIn('part_no', $flattened_L03)->sum('total_amount');
        }

        $hppL01     = $getHpp->whereIn('part_no', $flattened_L01)->sum('nominal_total')/1.11;
        $hppL02     = $getHpp->whereIn('part_no', $flattened_L02)->sum('nominal_total')/1.11;
        $hppL03     = $getHpp->whereIn('part_no', $flattened_L03)->sum('nominal_total')/1.11;
        
        $jualL01     = $getModalTerjual->whereIn('part_no', $flattened_L01)->sum('nominal_modal')/1.11;
        $jualL02     = $getModalTerjual->whereIn('part_no', $flattened_L02)->sum('nominal_modal')/1.11;
        $jualL03     = $getModalTerjual->whereIn('part_no', $flattened_L03)->sum('nominal_modal')/1.11;


        //LEVEL2 IC2
        $getBeliIC2 = $beliI01 + $beliI02 + $beliI03 + $beliI04 + $beliI05 + $beliI06 + $beliI07 + $beliI08 + $beliI09 + $beliIL1 + $beliIL2 + $beliIL3 + $beliIL4 + 
                        $beliIL5 + $beliIL6 + $beliIL7 + $beliIL8 + $beliIL9 + $beliIM1 + $beliIM2 + $beliIM3;

        $getRbpIC2  = $hppI01 + $hppI02 + $hppI03 + $hppI04 + $hppI05 + $hppI06 + $hppI07 + $hppI08 + $hppI09 + $hppIL1 + $hppIL2 + $hppIL3 + $hppIL4 + 
                        $hppIL5 + $hppIL6 + $hppIL7 + $hppIL8 + $hppIL9 + $hppIM1 + $hppIM2 + $hppIM3;

        $getJualIC2 = $jualI01 + $jualI02 + $jualI03 + $jualI04 + $jualI05 + $jualI06 + $jualI07 + $jualI08 + $jualI09 + $jualIL1 + $jualIL2 + $jualIL3 + $jualIL4 + 
                        $jualIL5 + $jualIL6 + $jualIL7 + $jualIL8 + $jualIL9 + $jualIM1 + $jualIM2 + $jualIM3;

        //LEVEL2 BP2
        $getBeliBP2 = $beliB01 + $beliB02 + $beliB03;
        $getRbpBP2  = $hppB01 + $hppB02 + $hppB03;
        $getJualBP2 = $jualB01 + $jualB02 + $jualB03;

        //LEVEL2 LO2
        $getBeliLO2     = $beliL01 + $beliL02 + $beliL03;
        $getRbpLO2      = $hppL01 + $hppL02 + $hppL03;
        $getJualLO2     = $jualL01 + $jualL02 + $jualL03;


        

        return view('report-lss.view', 
        compact(
            'beliI01', 'beliI02', 'beliI03', 'beliI04', 'beliI05', 'beliI06', 'beliI07', 'beliI08', 'beliI09',
            'hppI01', 'hppI02', 'hppI03', 'hppI04', 'hppI05', 'hppI06', 'hppI07', 'hppI08', 'hppI09',
            'jualI01', 'jualI02', 'jualI03', 'jualI04', 'jualI05', 'jualI06', 'jualI07', 'jualI08', 'jualI09',

            'beliIL1', 'beliIL2', 'beliIL3', 'beliIL4', 'beliIL5', 'beliIL6', 'beliIL7', 'beliIL8', 'beliIL9',
            'hppIL1', 'hppIL2', 'hppIL3', 'hppIL4', 'hppIL5', 'hppIL6', 'hppIL7', 'hppIL8', 'hppIL9',
            'jualIL1', 'jualIL2', 'jualIL3', 'jualIL4', 'jualIL5', 'jualIL6', 'jualIL7', 'jualIL8', 'jualIL9',

            'beliIM1', 'beliIM2', 'beliIM3',
            'hppIM1', 'hppIM2', 'hppIM3',
            'jualIM1', 'jualIM2', 'jualIM3',

            'beliB01', 'beliB02', 'beliB03',
            'hppB01', 'hppB02', 'hppB03',
            'jualB01', 'jualB02', 'jualB03',

            'beliL01', 'beliL02', 'beliL03',
            'hppL01', 'hppL02', 'hppL03',
            'jualL01', 'jualL02', 'jualL03',

            'getBeliIC2', 'getRbpIC2', 'getJualIC2',
            'getBeliBP2', 'getRbpBP2', 'getJualBP2',
            'getBeliLO2', 'getRbpLO2', 'getJualLO2',

            'bulan', 'tahun', 'awal_amount'
        ));
    }
}
