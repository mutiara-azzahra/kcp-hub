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

        //I01
        $ichidai_I01    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I01')->pluck('part_no')->toArray();
        $flattened_I01  = collect($ichidai_I01)->flatten()->toArray();

        $getBeliI01 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppI01 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_I01)
            ->get();

        $beliI01 = 0;

        foreach($getBeliI01 as $i){
            $beliI01 += $i->details_pembelian->whereIn('part_no', $flattened_I01)->sum('total_amount');
        }

        $hppI01     = $getHppI01->sum('nominal_total')/1.11;

        //I02
        $ichidai_I02    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I02')->pluck('part_no')->toArray();
        $flattened_I02  = collect($ichidai_I02)->flatten()->toArray();

        $getBeliI02 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppI02 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_I02)
            ->get();

        $beliI02 = 0;

        foreach($getBeliI02 as $i){
            $beliI02 += $i->details_pembelian->whereIn('part_no', $flattened_I02)->sum('total_amount');
        }
        $hppI02     = $getHppI02->sum('nominal_total')/1.11;

        //I03
        $ichidai_I03    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I03')->pluck('part_no')->toArray();
        $flattened_I03  = collect($ichidai_I03)->flatten()->toArray();

        $getBeliI03 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppI03 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_I03)
            ->get();

        $beliI03 = 0;

        foreach($getBeliI03 as $i){
            $beliI03 += $i->details_pembelian->whereIn('part_no', $flattened_I03)->sum('total_amount');
        }
        $hppI03     = $getHppI03->sum('nominal_total')/1.11;

        //I04
        $ichidai_I04    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I04')->pluck('part_no')->toArray();
        $flattened_I04  = collect($ichidai_I04)->flatten()->toArray();

        $getBeliI04 = InvoiceNonDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppI04 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_I04)
            ->get();

        $beliI04 = 0;

        foreach($getBeliI04 as $i){
            $beliI04 += $i->details_pembelian->whereIn('part_no', $flattened_I04)->sum('total_amount');
        }
        $hppI04     = $getHppI04->sum('nominal_total')/1.11;

        //I05
        $ichidai_I05    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I05')->pluck('part_no')->toArray();
        $flattened_I05  = collect($ichidai_I05)->flatten()->toArray();

        $getBeliI05 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppI05 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_I05)
            ->get();

        $beliI05 = 0;

        foreach($getBeliI05 as $i){
            $beliI05 += $i->details_pembelian->whereIn('part_no', $flattened_I05)->sum('total_amount');
        }
        $hppI05    = $getHppI05->sum('nominal_total')/1.11;

        //I06
        $ichidai_I06    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I06')->pluck('part_no')->toArray();
        $flattened_I06  = collect($ichidai_I06)->flatten()->toArray();

        $getBeliI06 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppI06 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_I06)
            ->get();

        $beliI06 = 0;

        foreach($getBeliI06 as $i){
            $beliI06 += $i->details_pembelian->whereIn('part_no', $flattened_I06)->sum('total_amount');

        }
        $hppI06 = $getHppI06->sum('nominal_total')/1.11;

        //I07
        $ichidai_I07    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I07')->pluck('part_no')->toArray();
        $flattened_I07  = collect($ichidai_I07)->flatten()->toArray();

        $getBeliI07 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppI07 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_I07)
            ->get();

        $beliI07 = 0;

        foreach($getBeliI07 as $i){
            $beliI07 += $i->details_pembelian->whereIn('part_no', $flattened_I07)->sum('total_amount');
        }
        $hppI07 = $getHppI07->sum('nominal_total')/1.11;

        //I08
        $ichidai_I08    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I08')->pluck('part_no')->toArray();
        $flattened_I08  = collect($ichidai_I08)->flatten()->toArray();

        $getBeliI08 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppI08 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_I08)
            ->get();

        $beliI08 = 0;

        foreach($getBeliI08 as $i){
            $beliI08 += $i->details_pembelian->whereIn('part_no', $flattened_I08)->sum('total_amount');
        }
        
        $hppI08 = $getHppI08->sum('nominal_total')/1.11;

        //I09
        $ichidai_I09    = MasterPart::where('level_2', 'IC2')->where('level_4', 'I09')->pluck('part_no')->toArray();
        $flattened_I09  = collect($ichidai_I09)->flatten()->toArray();

        $getBeliI09 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppI09 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_I09)
            ->get();

        $beliI09 = 0;

        foreach($getBeliI09 as $i){
            $beliI09 += $i->details_pembelian->whereIn('part_no', $flattened_I09)->sum('total_amount');
        }
        $hppI09 = $getHppI09->sum('nominal_total')/1.11;


        //IL1
        $ichidai_IL1    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL1')->pluck('part_no')->toArray();
        $flattened_IL1  = collect($ichidai_IL1)->flatten()->toArray();

        $getBeliIL1 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL1 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL1)
            ->get();

        $beliIL1 = 0;

        foreach($getBeliIL1 as $i){
            $beliIL1 += $i->details_pembelian->whereIn('part_no', $flattened_IL1)->sum('total_amount');
        }
        $hppIL1     = $getHppIL1->sum('nominal_total')/1.11;

        //IL2
        $ichidai_IL2    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL2')->pluck('part_no')->toArray();
        $flattened_IL2  = collect($ichidai_IL2)->flatten()->toArray();

        $getBeliIL2 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL2 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL2)
            ->get();

        $beliIL2 = 0;

        foreach($getBeliIL2 as $i){
            $beliIL2 += $i->details_pembelian->whereIn('part_no', $flattened_IL2)->sum('total_amount');
        }
        $hppIL2     = $getHppIL2->sum('nominal_total')/1.11;

        //IL3
        $ichidai_IL3    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL3')->pluck('part_no')->toArray();
        $flattened_IL3  = collect($ichidai_IL3)->flatten()->toArray();

        $getBeliIL3 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL3 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL3)
            ->get();

        $beliIL3 = 0;

        foreach($getBeliIL3 as $i){
            $beliIL3 += $i->details_pembelian->whereIn('part_no', $flattened_IL3)->sum('total_amount');
        }

        $hppIL3     = $getHppIL3->sum('nominal_total')/1.11;


        //IL4
        $ichidai_IL4    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL4')->pluck('part_no')->toArray();
        $flattened_IL4  = collect($ichidai_IL4)->flatten()->toArray();

        $getBeliIL4 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL4 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL4)
            ->get();

        $beliIL4 = 0;

        foreach($getBeliIL4 as $i){
            $beliIL4 += $i->details_pembelian->whereIn('part_no', $flattened_IL4)->sum('total_amount');
        }
            
        $hppIL4     = $getHppIL4->sum('nominal_total')/1.11;

        //IL5
        $ichidai_IL5    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL5')->pluck('part_no')->toArray();
        $flattened_IL5  = collect($ichidai_IL5)->flatten()->toArray();

        $getBeliIL5 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL5 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL5)
            ->get();

        $beliIL5 = 0;

        foreach($getBeliIL5 as $i){
            $beliIL5 += $i->details_pembelian->whereIn('part_no', $flattened_IL5)->sum('total_amount');
        }

        $hppIL5    = $getHppIL5->sum('nominal_total')/1.11;

        //IL6
        $ichidai_IL6    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL6')->pluck('part_no')->toArray();
        $flattened_IL6  = collect($ichidai_IL6)->flatten()->toArray();

        $getBeliIL6 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL6 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL6)
            ->get();

        $beliIL6 = 0;

        foreach($getBeliIL6 as $i){
            $beliIL6 += $i->details_pembelian->whereIn('part_no', $flattened_IL6)->sum('total_amount');
        }

        $hppIL6 = $getHppIL6->sum('nominal_total')/1.11;

        //I07
        $ichidai_IL7    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL7')->pluck('part_no')->toArray();
        $flattened_IL7  = collect($ichidai_IL7)->flatten()->toArray();

        $getBeliIL7 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL7 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL7)
            ->get();

        $beliIL7 = 0;

        foreach($getBeliIL7 as $i){
            $beliIL7 += $i->details_pembelian->whereIn('part_no', $flattened_IL7)->sum('total_amount');
        }

        $hppIL7 = $getHppIL7->sum('nominal_total')/1.11;

        //IL8
        $ichidai_IL8    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL8')->pluck('part_no')->toArray();
        $flattened_IL8  = collect($ichidai_IL8)->flatten()->toArray();


        $getBeliIL8 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL8 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL8)
            ->get();

            

        $beliIL8 = 0;

        foreach($getBeliIL8 as $i){
            $beliIL8 += $i->details_pembelian->whereIn('part_no', $flattened_IL8)->sum('total_amount');
        }

        $hppIL8 = $getHppIL8->sum('nominal_total')/1.11;

        //IL9
        $ichidai_IL9    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL9')->pluck('part_no')->toArray();
        $flattened_IL9  = collect($ichidai_IL9)->flatten()->toArray();

        $getBeliIL9 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL9 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL9)
            ->get();

        $beliIL9 = 0;

        foreach($getBeliIL9 as $i){
            $beliIL9 += $i->details_pembelian->whereIn('part_no', $flattened_IL9)->sum('total_amount');
        }
        
        $hppIL9 = $getHppIL9->sum('nominal_total')/1.11;



        //IL1
        $ichidai_IL1    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL1')->pluck('part_no')->toArray();
        $flattened_IL1  = collect($ichidai_IL1)->flatten()->toArray();

        $getBeliIL1 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL1 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL1)
            ->get();

        $beliIL1 = 0;

        foreach($getBeliIL1 as $i){
            $beliIL1 += $i->details_pembelian->whereIn('part_no', $flattened_IL1)->sum('total_amount');
        }

        $hppIL1     = $getHppIL1->sum('nominal_total')/1.11;
        
        //IL2
        $ichidai_IL2    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL2')->pluck('part_no')->toArray();
        $flattened_IL2  = collect($ichidai_IL2)->flatten()->toArray();

        $getBeliIL2 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL2 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL2)
            ->get();

        $beliIL2 = 0;

        foreach($getBeliIL2 as $i){
            $beliIL2 += $i->details_pembelian->whereIn('part_no', $flattened_IL2)->sum('total_amount');
        }

        $hppIL2     = $getHppIL2->sum('nominal_total')/1.11;

        //IL3
        $ichidai_IL3    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL3')->pluck('part_no')->toArray();
        $flattened_IL3  = collect($ichidai_IL3)->flatten()->toArray();

        $getBeliIL3 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL3 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL3)
            ->get();

        $beliIL3 = 0;

        foreach($getBeliIL3 as $i){
            $beliIL3 += $i->details_pembelian->whereIn('part_no', $flattened_IL3)->sum('total_amount');
        }

        $hppIL3     = $getHppIL3->sum('nominal_total')/1.11;

        //IL4
        $ichidai_IL4    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL4')->pluck('part_no')->toArray();
        $flattened_IL4  = collect($ichidai_IL4)->flatten()->toArray();

        $getBeliIL4 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL4 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL4)
            ->get();

        $beliIL4 = 0;

        foreach($getBeliIL4 as $i){
            $beliIL4 += $i->details_pembelian->whereIn('part_no', $flattened_IL4)->sum('total_amount');
        }

        $hppIL4     = $getHppIL4->sum('nominal_total')/1.11;

        //IL5
        $ichidai_IL5    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL5')->pluck('part_no')->toArray();
        $flattened_IL5  = collect($ichidai_IL5)->flatten()->toArray();

        $getBeliIL5 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL5 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL5)
            ->get();

        $beliIL5 = 0;

        foreach($getBeliIL5 as $i){
            $beliIL5 += $i->details_pembelian->whereIn('part_no', $flattened_IL5)->sum('total_amount');
        }

        $hppIL5     = $getHppIL5->sum('nominal_total')/1.11;

        //IL6
        $ichidai_IL6    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL6')->pluck('part_no')->toArray();
        $flattened_IL6  = collect($ichidai_IL6)->flatten()->toArray();

        $getBeliIL6 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL6 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL6)
            ->get();

        $beliIL6 = 0;

        foreach($getBeliIL6 as $i){
            $beliIL6 += $i->details_pembelian->whereIn('part_no', $flattened_IL6)->sum('total_amount');
        }

        $hppIL6     = $getHppIL6->sum('nominal_total')/1.11;

        //IL7
        $ichidai_IL7    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL7')->pluck('part_no')->toArray();
        $flattened_IL7  = collect($ichidai_IL7)->flatten()->toArray();

        $getBeliIL7 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL7 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL7)
            ->get();

        $beliIL7 = 0;

        foreach($getBeliIL7 as $i){
            $beliIL7 += $i->details_pembelian->whereIn('part_no', $flattened_IL7)->sum('total_amount');
        }

        $hppIL7     = $getHppIL7->sum('nominal_total')/1.11;

        //IL8
        $ichidai_IL8    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL8')->pluck('part_no')->toArray();
        $flattened_IL8  = collect($ichidai_IL8)->flatten()->toArray();
        // dd($flattened_IL8);

        $getBeliIL8 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL8 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL8)
            ->get();

        $beliIL8 = 0;

        foreach($getBeliIL8 as $i){
            $beliIL8 += $i->details_pembelian->whereIn('part_no', $flattened_IL8)->sum('total_amount');
        }
        // dd($getHppIL8);

        $hppIL8     = $getHppIL8->sum('nominal_total')/1.11;


        //IL9
        $ichidai_IL9    = MasterPart::where('level_2', 'IC2')->where('level_4', 'IL9')->pluck('part_no')->toArray();
        $flattened_IL9  = collect($ichidai_IL9)->flatten()->toArray();

        $getBeliIL9 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppIL9 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_IL9)
            ->get();

        $beliIL9 = 0;

        foreach($getBeliIL9 as $i){
            $beliIL9 += $i->details_pembelian->whereIn('part_no', $flattened_IL9)->sum('total_amount');
        }

        $hppIL9     = $getHppIL9->sum('nominal_total')/1.11;

        // $ichidai_IM1    = MasterPart::where('level2', 'IC2')->where('level4', 'IM1')->get();
        // $ichidai_IM2    = MasterPart::where('level2', 'IC2')->where('level4', 'IM2')->get();
        // $ichidai_IM3    = MasterPart::where('level2', 'IC2')->where('level4', 'IM3')->get();
        // $ichidai_IM4    = MasterPart::where('level2', 'IC2')->where('level4', 'IM4')->get();
        // $ichidai_IM5    = MasterPart::where('level2', 'IC2')->where('level4', 'IM5')->get();
        // $ichidai_IM6    = MasterPart::where('level2', 'IC2')->where('level4', 'IM6')->get();
        // $ichidai_IM7    = MasterPart::where('level2', 'IC2')->where('level4', 'IM7')->get();
        // $ichidai_IM8    = MasterPart::where('level2', 'IC2')->where('level4', 'IM8')->get();
        // $ichidai_IM9    = MasterPart::where('level2', 'IC2')->where('level4', 'IM9')->get();

        //B01
        $ichidai_B01    = MasterPart::where('level_2', 'BP2')->where('level_4', 'B01')->pluck('part_no')->toArray();
        $flattened_B01  = collect($ichidai_B01)->flatten()->toArray();

        $getBeliB01 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppB01 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_B01)
            ->get();

        $beliB01 = 0;

        foreach($getBeliB01 as $i){
            $beliB01 += $i->details_pembelian->whereIn('part_no', $flattened_B01)->sum('total_amount');
        }

        $hppB01     = $getHppB01->sum('nominal_total')/1.11;
        
        //B02
        $ichidai_B02    = MasterPart::where('level_2', 'BP2')->where('level_4', 'B02')->pluck('part_no')->toArray();
        $flattened_B02  = collect($ichidai_B02)->flatten()->toArray();

        $getBeliB02 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppB02 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_B02)
            ->get();

        $beliB02 = 0;

        foreach($getBeliB02 as $i){
            $beliB02 += $i->details_pembelian->whereIn('part_no', $flattened_B02)->sum('total_amount');
        }

        $hppB02     = $getHppB02->sum('nominal_total')/1.11;

        //B03
        $ichidai_B03    = MasterPart::where('level_2', 'BP2')->where('level_4', 'B03')->pluck('part_no')->toArray();
        $flattened_B03  = collect($ichidai_B03)->flatten()->toArray();

        $getBeliB03 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppB03 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_B03)
            ->get();

        $beliB03 = 0;

        foreach($getBeliB03 as $i){
            $beliB03 += $i->details_pembelian->whereIn('part_no', $flattened_B03)->sum('total_amount');
        }

        $hppB03     = $getHppB03->sum('nominal_total')/1.11;

        // $liquid_L02     = MasterPart::where('level2', 'LQ2')->where('level4', 'L02')->get();
        // $liquid_L03     = MasterPart::where('level2', 'LQ2')->where('level4', 'L03')->get();

        //LQ2
        $ichidai_L01    = MasterPart::where('level_2', 'LQ2')->where('level_4', 'L01')->pluck('part_no')->toArray();
        $flattened_L01  = collect($ichidai_L01)->flatten()->toArray();

        $getBeliL01 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppL01 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_L01)
            ->get();

        $beliL01 = 0;

        foreach($getBeliL01 as $i){
            $beliL01 += $i->details_pembelian->whereIn('part_no', $flattened_L01)->sum('total_amount');
        }

        $hppL01     = $getHppL01->sum('nominal_total')/1.11;
        
        //L02
        $ichidai_L02    = MasterPart::where('level_2', 'LQ2')->where('level_4', 'L02')->pluck('part_no')->toArray();
        $flattened_L02  = collect()->flatten()->toArray();

        $getBeliL02 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppL02 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_L02)
            ->get();

        $beliL02 = 0;

        foreach($getBeliL02 as $i){
            $beliL02 += $i->details_pembelian->whereIn('part_no', $flattened_L02)->sum('total_amount');
        }

        $hppL02     = $getHppL02->sum('nominal_total')/1.11;

        //L03
        $ichidai_L03    = MasterPart::where('level_2', 'LQ2')->where('level_4', 'L03')->pluck('part_no')->toArray();

        $flattened_L03  = collect($ichidai_L03)->flatten()->toArray();

        $getBeliL03 = InvoiceNonHeader::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->get();

        $getHppL03 = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-11-01')
            ->where('created_at', '<=', $tahun.'-11-'.Carbon::createFromDate($tahun, 11, 1)->endOfMonth()->format('d'))
            ->whereIn('part_no', $flattened_L03)
            ->get();

        $beliL03 = 0;

        foreach($getBeliL03 as $i){
            $beliL03 += $i->details_pembelian->whereIn('part_no', $flattened_L03)->sum('total_amount');
        }

        $hppL03     = $getHppL03->sum('nominal_total')/1.11;


        return view('report-lss.view', 
        compact(
            'beliI01', 'beliI02', 'beliI03', 'beliI04', 'beliI05', 'beliI06', 'beliI07', 'beliI08', 'beliI09',
            'hppI01', 'hppI02', 'hppI03', 'hppI04', 'hppI05', 'hppI06', 'hppI07', 'hppI08', 'hppI09',
            'beliIL1', 'beliIL2', 'beliIL3', 'beliIL4', 'beliIL5', 'beliIL6', 'beliIL7', 'beliIL8', 'beliIL9',
            'hppIL1', 'hppIL2', 'hppIL3', 'hppIL4', 'hppIL5', 'hppIL6', 'hppIL7', 'hppIL8', 'hppIL9',
            'beliB01', 'beliB02', 'beliB03',
            'hppB01', 'hppB02', 'hppB03',
            'beliL01', 'beliL02', 'beliL03',
            'hppL01', 'hppL02', 'hppL03'
        ));
    }
}
