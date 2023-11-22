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

            $part       = MasterPart::where('level_2', $i->id_level_2)->where('level_4', $i->level_4)->pluck('part_no')->toArray();
            $flattened   = collect($part)->flatten()->toArray();

            $beli = 0;

            foreach($getBeli as $s){
                $beli += $s->details_pembelian->whereIn('part_no', $flattened)->sum('total_amount');
            }

            $hpp     = $getHpp->whereIn('part_no', $flattened)->sum('nominal_total')/1.11;
            $jual    = $getModalTerjual->whereIn('part_no', $flattened)->sum('nominal_modal')/1.11;

            //INSERT LSS TO DB
            $value = [
                'bulan'                 => $bulan,
                'tahun'                 => $tahun,
                'sub_kelompok_part'     => $i->level_4,
                'produk_part'           => $i->id_level_2,
                'awal_amount'           => $awal_amount,
                'beli'                  => $beli,
                'jual_rbp'              => $hpp,
                'jual_dbp'              => $jual,
                'akhir_amount'          => ($awal_amount + $beli) - $jual,
                'status'                => 'A',
                'created_at'            => NOW(),
                'created_by'            => Auth::user()->nama_user,
            ];

            $created = LSS::create($value);

        }


    }
}
