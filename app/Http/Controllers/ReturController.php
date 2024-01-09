<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ReturHeader;
use App\Models\ReturDetails;
use App\Models\TransaksiInvoiceHeader;

class ReturController extends Controller
{
    public function index(){

        $retur = ReturHeader::orderBy('created_at', 'desc')->get();

        return view('retur.index', compact('retur'));
    }

    public function create(){

        $invoice = TransaksiInvoiceHeader::orderBy('created_at', 'desc')->get();

        return view('retur.create', compact('invoice'));
    }

    public function store(Request $request){

        $request -> validate([
            'noinv'      => 'required',
        ]);

        $noinv = $request->noinv;

        $toko = TransaksiInvoiceHeader::where('noinv', $noinv)->first();

        $newRt           = new ReturHeader();
        $newRt->no_retur = ReturHeader::no_retur();

        $value['no_retur']      = $newRt->no_retur;
        $value['noinv']         = $noinv;
        $value['kd_outlet']     = $toko->kd_outlet;
        $value['nm_outlet']     = $toko->nm_outlet;
        $value['created_by']    = Auth::user()->nama_user;

        $created = ReturHeader::create($value);

        if ($created){
            return redirect()->route('retur.details', ['no_retur' => $created->no_retur])->with('success','Data retur baru berhasil ditambahkan');
        } else{
            return redirect()->route('retur.index')->with('danger','Data retur baru gagal ditambahkan');
        }
    }

    public function detail($no_retur)
    {

        dd($no_retur);
        
        $header      = ReturHeader::where('no_retur', $no_retur)->first();
        $master_part = TransaksiInvoiceDetails::where('noinv', $header->noinv)->get();
        $check       = ReturDetails::where('no_retur', $no_retur)->get();
        
        return view('surat-pesanan.details', ['header' => $header] ,compact('header', 'check', 'master_part'));
    }
}
