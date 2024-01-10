<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ReturHeader;
use App\Models\ReturDetails;
use App\Models\TransaksiInvoiceHeader;
use App\Models\TransaksiInvoiceDetails;

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

    public function details($no_retur)
    {
        
        $header             = ReturHeader::where('no_retur', $no_retur)->first();
        $invoice_details    = TransaksiInvoiceDetails::where('noinv', $header->noinv)->get();
        $check              = ReturDetails::where('no_retur', $no_retur)->first();
        
        return view('retur.details', ['header' => $header] ,compact('header', 'check', 'invoice_details'));
    }


     public function store_details(Request $request){

        $request->validate([
            'inputs.*.no_retur'    => 'required',
            'inputs.*.noinv'       => 'required',
            'inputs.*.part_no'     => 'required',
            'inputs.*.qty_invoice' => 'required',
            'inputs.*.qty_retur'   => 'required',
        ]);

        foreach($request->inputs as $key => $value){

            $invoice = TransaksiInvoiceDetails::where('noinv', $value['noinv'])->where('part_no', $value['part_no'])->first();

            $value['no_retur']        = $value['no_retur'];
            $value['part_no']         = $value['part_no'];
            $value['qty_invoice']     = $value['qty_invoice'];
            $value['qty_retur']       = $value['qty_retur'];
            $value['hrg_pcs_invoice'] = $invoice->hrg_pcs;
            $value['disc_invoice']    = $invoice->disc;
            $value['nominal_retur']   = $value['id_rak'];
            $value['created_by']      = Auth::user()->nama_user;
            $value['created_at']      = NOW();

            $created = BarangMasukDetails::create($value);
        }       
                    
        if ($created){
            return redirect()->route('retur.list')->with('success','Silahkan Validasi Barang Masuk pada Menu Intransit!');
        } else{
            return redirect()->route('retur.index')->with('danger','Data stok gudang baru gagal ditambahkan');
        }
        
    }

}
