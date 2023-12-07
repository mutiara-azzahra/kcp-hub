<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use Auth;
use Carbon\Carbon;
use App\Models\KasMasukHeader;
use App\Models\MasterOutlet;
use App\Models\TransaksiInvoiceHeader;
use App\Models\TransaksiPembayaranPiutang;
use App\Models\TransaksiPembayaranPiutangHeader;

class PembayaranPiutangTokoController extends Controller
{
    public function index(){

        $piutang_header = TransaksiPembayaranPiutangHeader::orderBy('no_piutang', 'desc')->get();
        $kas_masuk = KasMasukHeader::orderBy('no_kas_masuk', 'desc')->get();

        return view('piutang-toko.index', compact('piutang_header', 'kas_masuk'));
    }

    public function create(){

        $outlet = MasterOutlet::where('status', 'Y')->get();

        return view('piutang-toko.create', compact('outlet'));
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
            'no_piutang'      => $newPiutang->no_piutang,
            'tanggal_piutang' => $request->tanggal_piutang,
            'area_piutang'    => $area_piutang,
            'kd_outlet'       => $request->kd_outlet,
            'nm_outlet'       => $nama_outlet,
            'nominal_potong'  => $request->nominal,
            'status'          => 'O',
            'created_by'      => Auth::user()->nama_user
        ]);

        $created = TransaksiPembayaranPiutangHeader::create($request->all());

        if ($created){
            return redirect()->route('piutang-toko.details', ['no_piutang' => $newPiutang->no_piutang])->with('success','Piutang baru berhasil ditambahkan, silahkan input details Invoice');
        } else{
            return redirect()->route('piutang-toko.index')->with('danger','Data baru gagal ditambahkan');
        }
    }

    public function details($no_piutang){

        $check          = TransaksiPembayaranPiutang::where('no_piutang', $no_piutang)->first();
        $data           = TransaksiPembayaranPiutangHeader::where('no_piutang', $no_piutang)->first();
        $invoice_toko   = TransaksiInvoiceHeader::where('kd_outlet', $data->kd_outlet)->where('status', 'O')->get();
        $invoice        = TransaksiInvoiceHeader::where('status', 'O')->get();

        return view('piutang-toko.details', compact('data', 'invoice', 'invoice_toko', 'check'));
    }


    public function edit($no_piutang){

        $check          = KasMasukHeader::where('no_piutang', $no_piutang)->first();
        $data           = TransaksiPembayaranPiutangHeader::where('no_piutang', $no_piutang)->first();
        $kas_masuk      = KasMasukHeader::where('kd_outlet', $data->kd_outlet)->where('status', 'C')->get();

        return view('piutang-toko.edit', compact('data', 'kas_masuk', 'check'));
    }

    public function store_kas(Request $request)
    {

        $selectedItems  = $request->input('selected_items', []);

        for ($i = 0; $i < count($selectedItems); $i++) {
            $itemKasMasuk = $selectedItems[$i];

            KasMasukHeader::where('no_kas_masuk', $itemKasMasuk)->update([
                'no_piutang'         => $request->no_piutang,
                'updated_at'         => NOW(),
                'updated_by'         => Auth::user()->nama_user
            ]);

        }

        return redirect()->route('piutang-toko.index')->with('success', 'Kas masuk baru berhasil ditambahkan kedalam Piutang!');
    }

    public function store_details(Request $request)
    {

        $selectedItems  = $request->input('selected_items', []);

        for ($i = 0; $i < count($selectedItems); $i++) {
            $itemInvoice = $selectedItems[$i];

            $invoice  = TransaksiInvoiceHeader::where('noinv', $itemInvoice)->first();

            $value = [
                'noinv'                 => $invoice->noinv,
                'no_piutang'            => $request->no_piutang,
                'nominal'               => $invoice->details_invoice->sum('nominal_total'),
                'status'                => 'O',
                'created_at'            => NOW(),
                'created_by'            => Auth::user()->nama_user,
            ];

            $created = TransaksiPembayaranPiutang::create($value);
        }

        return redirect()->route('piutang-toko.index')->with('success', 'Piutang baru berhasil ditambahkan, silahkan input details Invoice');
    }

    public function cetak($no_piutang)
    {
        $data  = TransaksiPembayaranPiutangHeader::where('no_piutang', $no_piutang)->first();
        $pdf   = PDF::loadView('reports.bukti-terima-piutang', ['data'=> $data]);
        $pdf->setPaper('letter', 'potrait');

        return $pdf->stream('piutang.pdf');
    }
}
