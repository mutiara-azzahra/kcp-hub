<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\FlowStokGudang;
use App\Models\MasterStokGudang;
use App\Models\ReturHeader;
use App\Models\ReturDetails;
use App\Models\TransaksiInvoiceHeader;
use App\Models\TransaksiInvoiceDetails;

class ReturController extends Controller
{
    public function index(){

        $retur = ReturHeader::orderBy('created_at', 'desc')->where('status', 'O')->get();

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

            $success = true;

            $invoice = TransaksiInvoiceDetails::where('noinv', $value['noinv'])->where('part_no', $value['part_no'])->first();

            if($invoice){

                $returDetail                  = new ReturDetails();
                $returDetail->no_retur        = $value['no_retur'];
                $returDetail->part_no         = $value['part_no'];
                $returDetail->qty_invoice     = $value['qty_invoice'];
                $returDetail->qty_retur       = $value['qty_retur'];
                $returDetail->hrg_pcs_invoice = $invoice->hrg_pcs;
                $returDetail->disc_invoice    = $invoice->disc;
                $returDetail->keterangan      = $value['keterangan'];
                $returDetail->nominal_retur   = $invoice->nominal_total / $invoice->qty * $value['qty_retur'];
                $returDetail->created_by      = Auth::user()->nama_user;
                $returDetail->created_at      = now();
                $returDetail->updated_at      = now();

                $returDetail->save();

            } else {
                $success = false;
            }
        }       
                    
        if ($success){
            return redirect()->route('retur.details', ['no_retur' => $returDetail->no_retur])->with('success','Data retur baru berhasil ditambahkan');
        } else{
            return redirect()->route('retur.index')->with('danger','Data list retur baru gagal ditambahkan');
        }
        
    }

    public function approve($id){

        $retur_approved = ReturHeader::where('id', $id)->first();

        foreach($retur_approved->details as $i){

            $stok_akhir = FlowStokGudang::where('part_no', $i->part_no)->first();

            if(isset($stok_akhir)){
                $stok_awal = $stok_akhir->stok_akhir;
            } else{
                $stok_awal = 0;
            }

            $flow_stok                          = new FlowStokGudang();
            $flow_stok->tanggal_barang_masuk    = now();
            $flow_stok->tanggal_barang_keluar   = null;
            $flow_stok->part_no                 = $i->part_no;
            $flow_stok->stok_awal               = $stok_awal;
            $flow_stok->stok_masuk              = $i->qty_retur;
            $flow_stok->stok_keluar             = 0;
            $flow_stok->stok_akhir              = $flow_stok->stok_awal + $flow_stok->stok_masuk - $flow_stok->stok_keluar;
            $flow_stok->created_by              = Auth::user()->nama_user;
            $flow_stok->save();
            
        }

        ReturHeader::where('id', $id)->update([
            'status'        => 'C',
            'updated_at'    => NOW()
        ]);

        return redirect()->route('retur.index')->with('success','Data retur berhasil diapprove');

    }

    public function history(){

        $history_retur = ReturHeader::orderBy('created_at', 'desc')->where('status', 'C')->get();

        return view('retur.history', compact('history_retur'));
    }

}
