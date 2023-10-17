<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\TransaksiSpHeader;
use App\Models\MasterPart;
use App\Models\MasterSales;
use App\Models\MasterOutlet;
use App\Models\MasterStokGudang;
use App\Models\TransaksiSpDetails;
use App\Models\MasterAreaSales;


class SuratPesananController extends Controller
{
    public function index(){

        $surat_pesanan = TransaksiSpHeader::orderBy('nosp', 'desc')->get();

        return view('surat-pesanan.index', compact('surat_pesanan'));
    }

    public function create(){

        $sales  = MasterSales::where('sales', Auth::user()->username)->value('id');
        $toko   = MasterAreaSales::where('id_sales', $sales)->first();
        
        return view('surat-pesanan.create', compact('sales', 'toko'));
    }

    public function store(Request $request){

        $newSp          = new TransaksiSpHeader();
        $newSp->nosp    = TransaksiSpHeader::nosp();
        $nama_sales     = MasterSales::where('sales', Auth::user()->username)->value('sales');

        $request -> validate([
            'kd_outlet' => 'required',
        ]);

        $nama_outlet    = MasterOutlet::where('kd_outlet', $request->kd_outlet)->value('nm_outlet');
        $area_sp        = MasterOutlet::where('kd_outlet', $request->kd_outlet)->value('kode_prp');

        if($area_sp == '6300'){
            $area_sp = 'KS';
        } elseif ($area_sp == '6200'){
            $area_sp = 'KT';
        }

        $request->merge([
            'nosp'      => $newSp->nosp,
            'status'    => 'O', //O open | C close
            'area_sp'   => $area_sp,
            'nm_outlet' => $nama_outlet,
            'user_sales'=> $nama_sales,
            'crea_date' => NOW(),
            'crea_by'   => Auth::user()->nama_user
        ]);

        $created = TransaksiSpHeader::create($request->all());

        if ($created){
            return redirect()->route('surat-pesanan.detail', ['nosp' => $created->nosp])->with('success','Invoice header Berhasil ditambahkan, silahkan input details Invoice');
        } else{
            return redirect()->route('surat-pesanan.index')->with('danger','Data baru gagal ditambahkan');
        }
    }

    public function detail($nosp)
    {
        $details     = TransaksiSpHeader::where('nosp', $nosp)->first();
        $master_part = MasterPart::all();
        $check       = TransaksiSpDetails::where('nosp', $nosp)->first();

        return view('surat-pesanan.details', ['nosp' => $nosp] ,compact('master_part', 'details', 'check'));
    }

    public function detail_sp($nosp)
    {
        $details        = TransaksiSpHeader::where('nosp', $nosp)->first();
        $master_part    = MasterPart::all();

        return view('surat-pesanan.details-sp', ['nosp' => $nosp] ,compact('master_part', 'details'));
    }

    public function store_details(Request $request){

        $request->validate([
                'inputs.*.nosp'    => 'required',
                'inputs.*.part_no' => 'required',
                'inputs.*.qty'     => 'required',
        ]);

        foreach($request->inputs as $key => $value){

            $harga_het = MasterPart::where('part_no', $value['part_no'])->value('het');
            
            $value['hrg_pcs'] = $harga_het;

            if($value['disc'] == null){
                $value['disc'] = 0;
            }

            $value['disc']          = $value['disc'];
            $value['nominal']       = $harga_het * $value['qty'];
            $value['nominal_disc']  = ($harga_het * $value['qty'] * $value['disc'])/100;
            $value['nominal_total'] = $value['nominal'] - $value['nominal_disc'];
            $value['crea_date']     = NOW();


            $newSo          = new TransaksiSpHeader();
            $newSo->noso    = TransaksiSpHeader::noso();
            
            TransaksiSpHeader::where('nosp', $value['nosp'])->update([
                'noso'      => TransaksiSpHeader::noso(),
                'status'    => 'C',
                'modi_date' => NOW()
            ]);

            TransaksiSpDetails::create($value);
        }        
        
        return redirect()->route('surat-pesanan.index')->with('success','Data baru berhasil ditambahkan');
        
    }
}
