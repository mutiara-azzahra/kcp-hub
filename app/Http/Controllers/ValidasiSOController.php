<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use PDF;
use Carbon\Carbon;
use App\Models\MasterPart;
use App\Models\MasterDiskonPart;
use App\Models\TransaksiSOHeader;
use App\Models\TransaksiSODetails;

class ValidasiSOController extends Controller
{
    public function index(){

        $validasi_so_gudang = TransaksiSOHeader::where('flag_approve', 'Y')
            ->where('flag_vald_gudang', 'N')
            ->orderBy('noso', 'desc')->get();

        return view('validasi-so.index', compact('validasi_so_gudang'));
    }

    public function details($noso){

        $so = TransaksiSOHeader::where('noso', $noso)->first();

        $validasi_id = TransaksiSOHeader::where('noso', $noso)->first();

        return view('validasi-so.details', compact('validasi_id', 'so'));
    }

    public function validasi($noso){

        $validasi_so = TransaksiSOHeader::where('noso', $noso)->update([
            'flag_vald_gudang'  => 'Y',
            'flag_vald_date'    => NOW()
        ]);

        return redirect()->route('validasi-so.index')->with('success','Data SO berhasil divalidasi, diteruskan ke packingsheet');

    }

    public function cetak($noso)
    {
        $data           = TransaksiSOHeader::where('noso', $noso)->get();
        $data_details   = TransaksiSODetails::where('noso', $noso)->get();
        $header         = TransaksiSOHeader::where('noso', $noso)->first();
        $pdf            = PDF::loadView('reports.sales-order', ['data'=>$data, 'data_details'=>$data_details], ['header'=>$header]);
        $pdf->setPaper('letter', 'potrait');

        return $pdf->stream('sales-order.pdf');
    }

    public function edit_details($id){

        $details       = TransaksiSODetails::findOrFail($id);

        return view('validasi-so.edit', compact('details'));
    }

    public function store_edit($id, Request $request)
    {

        $update         = TransaksiSODetails::where('id', $id)->first();
        $het            = MasterPart::where('part_no', $update->part_no)->value('het');
        $diskon_maks    = MasterDiskonPart::where('part_no', $update->part_no)->value('diskon_maksimal');

            if($diskon_maks != null){
                if($request->disc > $diskon_maks){

                    return redirect()->route('validasi-so.index')->with('danger','Nilai diskon part melebihi diskon maskimal! Silahkan input kembali');
                
                } else{

                    $updated = TransaksiSODetails::where('id', $id)->update([
                        'qty'           => $request->qty,
                        'disc'          => $request->disc,
                        'nominal'       => $request->qty * $het,
                        'nominal_disc'  => $request->qty * $het * $request->disc/100,
                        'nominal_total' => ($request->qty * $het) - $request->qty * $het * $request->disc/100,
                        'modi_date'     => NOW(),
                        'modi_by'       => Auth::user()->nama_user
                    ]);


                    if ($updated){
                        return redirect()->route('validasi-so.index')->with('success','Data SO berhasil diubah!');
                    } else{
                        return redirect()->route('validasi-so.index')->with('danger','Data SO gagal diubah');
                    }

                }
            }
        
    }
}