<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\InvoiceNonHeader;
use App\Models\InvoiceNonDetails;
use App\Models\IntransitHeader;
use App\Models\IntransitDetails;
use App\Models\MasterPart;


class PembelianController extends Controller
{
    public function index(){

        $pembelian = InvoiceNonHeader::all();

        return view('pembelian-non-aop.index', compact('pembelian'));
    }

    public function create(){

        $intransit = IntransitHeader::where('status', 'T')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pembelian-non-aop.create', compact('intransit') );
    }

    public function show($id){

         $pembelian_id = InvoiceNonHeader::findOrFail($id);

        return view('pembelian-non-aop.show', compact('pembelian_id'));
       
    }

    public function store(Request $request){

        $request -> validate([
            'invoice_non'              => 'required', 
            'tanggal_nota'             => 'required', 
            'customer_to'              => 'required', 
            'supplier'                 => 'required', 
            'tanggal_jatuh_tempo'      => 'required',
        ]);

        $request['flag_ppn']            = 'N';
        $request['status']              = 'A';
        $request['flag_pembayaran']     = 'N';

        $created = InvoiceNonHeader::create($request->all());

        if ($created){
            return redirect()->route('pembelian-non-aop.detail', ['id' => $created->id ])->with('success','Invoice header Berhasil ditambahkan, silahkan input details Invoice');
        } else{
            return redirect()->route('pembelian-non-aop.index')->with('danger','Data baru gagal ditambahkan');
        }
    }

    public function detail($id)
    {
        $pembelian          = InvoiceNonHeader::findOrFail($id);
        $intransit_details  = IntransitDetails::where('no_surat_pesanan', $pembelian->invoice_non)->get();
        $master_part        = MasterPart::all();

        return view('pembelian-non-aop.details',compact('pembelian', 'master_part', 'intransit_details'));
    }


    public function detail_pembelian($id)
    {
        $pembelian_header  = InvoiceNonHeader::where('invoice_non', $invoice_non)->get();

        return view('pembelian-non-aop.details-pembelian',compact( 'pembelian_header'));
    }

    public function update(Request $request, MasterPartNon $pembelian)
    {
        $request->validate([
            'no_nota'           => 'required', 
            'tanggal_nota'      => 'required', 
            'customer_to'       => 'required', 
            'supplier'          => 'required', 
            'top'               => 'required',
        ]);
         
        $updated = $pembelian->update($request->all());
         
        if ($updated){
            return redirect()->route('pembelian-non-aop.detail')->with('success','Data master part berhasil diubah');
        } else{
            return redirect()->route('pembelian-non-aop.index')->with('danger','Data master part gagal diubah');
        }
    }

   
    public function store_details(Request $request) {
        $invoice_non = $request->input('invoice_non');
        $part_nos = $request->input('part_no');
        $qtys = $request->input('qty');
        $hets = $request->input('harga');
        $discs = $request->input('disc');
    
        $details = [];
    
        foreach ($part_nos as $index => $part_no) {
            $qty = $qtys[$index];
            $het = $hets[$index];
            $disc = $discs[$index];
    
            $total_diskon_persen = $disc * $het;
            $total_amount = ($het * $qty )- $total_diskon_persen;
    
            $detail = [
                'invoice_non' => $invoice_non, // Use the common value for each row
                'part_no' => $part_no,
                'qty' => $qty,
                'harga' => $het,
                'diskon_nominal' => $disc,
                'total_diskon_persen' => $total_diskon_persen,
                'total_amount' => $total_amount,
            ];
    
            $details[] = $detail;
        }
    
        // Now you have an array of details that you can save to the database
        // Uncomment this line when you want to save the details
        InvoiceNonDetails::insert($details);
    
        return redirect()->route('pembelian-non-aop.index')->with('success', 'Data baru berhasil ditambahkan');
    }
    
    
    
}
