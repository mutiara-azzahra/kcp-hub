<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\InvoiceNonHeader;
use App\Models\InvoiceNonDetails;
use App\Models\MasterPart;


class PembelianController extends Controller
{
    public function index(){

        $pembelian = InvoiceNonHeader::all();

        return view('pembelian-non-aop.index', compact('pembelian'));
    }

    public function create(){

        return view('pembelian-non-aop.create');
    }

    public function show($id){

         $pembelian_id = InvoiceNonHeader::findOrFail($id);

        return view('pembelian-non-aop.show', compact('pembelian_id'));
       
    }

    public function store(Request $request){

        $request -> validate([
            'txt_invoice'              => 'required', 
            'tanggal_nota'             => 'required', 
            'customer_to'              => 'required', 
            'supplier'                 => 'required', 
            'tanggal_jatuh_tempo'      => 'required',
        ]);

        $request['flag_ppn']            = 'N';
        $request['status']              = 'A';
        $request['flag_pembayaran']     = 'N';
        $request['invoice_non'] = str_replace('/', '', $request['txt_invoice']);

        $created = InvoiceNonHeader::create($request->all());

        if ($created){
            return redirect()->route('pembelian-non-aop.detail', ['id' => $created->id])->with('success','Invoice header Berhasil ditambahkan, silahkan input details Invoice');
        } else{
            return redirect()->route('pembelian-non-aop.index')->with('danger','Data baru gagal ditambahkan');
        }
    }


    public function detail_pembelian($invoice_non)
    {
      //  $pembelian_details  = InvoiceNonDetails::where('invoice_non', $invoice_non)->get();
        $pembelian_header  = InvoiceNonHeader::where('invoice_non', $invoice_non)->get();

      //  dd($pembelian_header);

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

    public function detail($id)
    {
        $pembelian   = InvoiceNonHeader::findOrFail($id);
        $master_part = MasterPart::all();

        return view('pembelian-non-aop.details',compact('pembelian', 'master_part'));
    }

    public function store_details(Request $request){

        $request->validate([
                'inputs.*.invoice_non' => 'required',
                'inputs.*.part_no'     => 'required',
                'inputs.*.qty'         => 'required', 
                'inputs.*.harga'       => 'required',
        ]);

        foreach($request->inputs as $key => $value){

            //ppn_persen
            // if($value['ppn_persen'] == null){
            //     $value['ppn_persen'] = 0;
            // }

            //diskon_nominal
            if($value['diskon_nominal'] == null){
                $value['diskon_nominal'] = 0;
            }
            $value['diskon_nominal'] = $value['diskon_nominal'];

            //total_harga
            $value['total_harga'] = $value['qty'] * $value['harga'];

            //total_ppn
            // if($value['ppn_persen'] == 0){
            //     $value['total_ppn'] = 0;
            // }
            //$value['total_ppn'] = ($value['ppn_persen']*$value['total_harga'])/100;

            //total_diskon_persen
            if($value['diskon_nominal'] == 0){
                $value['total_diskon_persen'] = 0;

            }
            $value['total_diskon_persen'] = ($value['diskon_nominal'] * $value['qty'] * $value['harga'])/100 ;

            //total_amount
            // $value['total_amount'] = $value['total_harga'] - $value['total_diskon_persen'] - $value['total_ppn'];

            $value['total_amount'] = $value['total_harga'] - $value['total_diskon_persen'];

            // dd($value);

            InvoiceNonDetails::create($value);
        }
        
            return redirect()->route('pembelian-non-aop.index')->with('success','Data baru berhasil ditambahkan');
        
    }
    
}
