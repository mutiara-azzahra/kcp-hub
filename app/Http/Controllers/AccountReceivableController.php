<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterOutlet;
use App\Models\TransaksiInvoiceHeader;
use App\Models\TransaksiPembayaranPiutangHeader;

class AccountReceivableController extends Controller
{
    public function index(){

        $piutang_header = TransaksiPembayaranPiutangHeader::all();

        $invoice        = TransaksiInvoiceHeader::orderBy('noinv', 'asc')->get();

        return view('account-receivable.index', compact('piutang_header', 'invoice'));
    }

    public function create(){

        $outlet = MasterOutlet::where('status', 'Y')->get();

        return view('account-receivable.create', compact('outlet'));
    }

    public function store(Request $request){

        $newPiutang              = new TransaksiPembayaranPiutangHeader();
        $newPiutang->no_piutang  = TransaksiPembayaranPiutangHeader::no_piutang();

        $request -> validate([
            'kd_outlet' => 'required',
            'nominal'   => 'required',
        ]);

        $nama_outlet    = MasterOutlet::where('kd_outlet', $request->kd_outlet)->value('nm_outlet');
        $area_piutang   = MasterOutlet::where('kd_outlet', $request->kd_outlet)->value('kode_prp');

        if($area_piutang == '6300'){
            $area_piutang = 'KS';
        } elseif ($area_piutang == '6200'){
            $area_piutang = 'KT';
        }

        $request->merge([
            'no_piutang'      => $newPiutang,
            'area_piutang'    => $area_piutang,
            'kd_outlet'       => $request->kd_outlet,
            'nm_outlet'       => $nama_outlet,
            'nominal_potong'  => $request->nominal,
            'status'          => 'O',
            'created_by'     => Auth::user()->nama_user
        ]);

        $created = TransaksiPembayaranPiutang::create($request->all());

        if ($created){
            return redirect()->route('account-receivable.details', ['no_piutang' => $created->no_piutang])->with('success','Invoice header Berhasil ditambahkan, silahkan input details Invoice');
        } else{
            return redirect()->route('account-receivable.index')->with('danger','Data baru gagal ditambahkan');
        }
    }

    public function details($no_piutang){
        $data = TransaksiPembayaranPiutangHeader::where('no_piutang', $no_piutang)->first();

        $invoice = TransaksiInvoiceHeader::where('status', 'O')->get();

        return view('account-receivable.details', compact('data', 'invoice'));
    }

    
}
