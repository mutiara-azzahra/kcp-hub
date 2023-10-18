<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use Auth;
use Carbon\Carbon;
use App\Models\TransaksiSOHeader;
use App\Models\TransaksiSODetails;
use App\Models\TransaksiPackingsheetHeader;
use App\Models\TransaksiPackingsheetDetails;
use App\Models\TransaksiPackingsheetDetailsDus;
use App\Models\KategoriDusPackingsheet;
use App\Models\MasterStokGudang;

class PackingSheetController extends Controller
{
    public function index(){

        $so_validated = TransaksiSOHeader::where('flag_vald_gudang', 'Y')
            ->where('flag_packingsheet', 'N')
            ->orderBy('flag_vald_date', 'desc')->get();

        $list_packingsheet = TransaksiPackingsheetHeader::where('status', 'A')->orderBy('nops', 'desc')->get();

        return view('packingsheet.index', compact('so_validated', 'list_packingsheet'));
    }

    public function store_packingsheet(Request $request){

        $nops = TransaksiPackingsheetHeader::nops();

        $selectedItems = $request->input('selected_items', []);

        foreach ($selectedItems as $noso) {

            $so_validated = TransaksiSOHeader::where('noso', $noso)->get();

            foreach($so_validated as $s){

                $data['nops']       = $nops;
                $data['area_ps']    = $s->area_so;
                $data['noso']       = $s->noso;
                $data['kd_outlet']  = $s->kd_outlet;
                $data['nm_outlet']  = $s->nm_outlet;
                $data['created_at'] = NOW();
                $data['created_by'] = Auth::user()->nama_user;

                TransaksiPackingsheetHeader::create($data);
            }
        }

        foreach ($selectedItems as $noso) {
            
            foreach($so_validated as $h){
                foreach($h->details_so as $s){

                    $stok_ready = MasterStokGudang::where('part_no', $s->part_no)->value('stok');

                    if($stok_ready != 0){
                        $details['nops']       = $nops;
                        $details['area_ps']    = $s->area_so;
                        $details['noso']       = $s->noso;
                        $details['kd_outlet']  = $s->kd_outlet;
                        $details['part_no']    = $s->part_no;
                        $details['qty']        = $s->qty;
                        $details['created_at'] = NOW();
                        $details['created_by'] = Auth::user()->nama_user;

                        TransaksiPackingsheetDetails::create($details);
                    }

                }
            }
        }

        //update flag_packingsheet_status jadi Y
        foreach ($selectedItems as $noso) {

            TransaksiSOHeader::where('noso', $noso)->update([
                'flag_packingsheet'         => 'Y',
                'flag_packingsheet_date'    => NOW(),
                'modi_date'                 => NOW(),
                'modi_by'                   => Auth::user()->nama_user
            ]);
        }

        return redirect()->route('packingsheet.index')->with('success','Data SO berhasil diteruskan ke packingsheet');
    }


    public function details($nops){

        $header_ps          = TransaksiPackingsheetHeader::where('nops', $nops)->first();
        $check              = TransaksiPackingsheetDetailsDus::where('nops', $nops)->first();
        $header_ps_details  = TransaksiPackingsheetHeader::where('nops', $nops)->get();

        return view('packingsheet.details', compact('header_ps', 'header_ps_details', 'check'));
    }

    public function koli($nops){

        $header_ps      = TransaksiPackingsheetHeader::where('nops', $nops)->first();
        $kategori       = KategoriDusPackingsheet::all();
        $check          = TransaksiPackingsheetDetailsDus::where('nops', $nops)->first();
        $details_dus    = TransaksiPackingsheetDetailsDus::where('nops', $nops)->get();

        return view('packingsheet.koli', compact('header_ps', 'kategori', 'check', 'details_dus'));
    }

    public function store_dus(Request $request){

        $request->validate([
                'inputs.*.nops'         => 'required',
                'inputs.*.kd_kategori'  => 'required',
                'inputs.*.koli'         => 'required',
        ]);

        foreach ($request->inputs as $key => $value) {
            $nops           = $value['nops'];
            $kd_kategori    = $value['kd_kategori'];
            $koli           = $value['koli'];

            for ($i = 0; $i < $koli; $i++) {
                $no_dus = TransaksiPackingsheetDetailsDus::no_dus();

                TransaksiPackingsheetDetailsDus::create([
                    'nops'          => $nops,
                    'no_dus'        => $no_dus,
                    'kd_kategori'   => $kd_kategori,
                    'status'        => 'A',
                    'created_at'    => NOW(),
                ]);
            }
        }
        
        return redirect()->route('packingsheet.index')->with('success','Data baru berhasil ditambahkan');
        
    }

    public function cetak($nops)
    {
        $data       = TransaksiPackingsheetHeader::where('nops', $nops)->first();
        $ps_details = TransaksiPackingsheetDetails::where('nops', $nops)->get();
        $pdf        = PDF::loadView('reports.packingsheet', ['data'=>$data], ['ps_details'=>$ps_details]);
        $pdf->setPaper('letter', 'potrait');

        return $pdf->stream('packingsheet.pdf');
    }

    public function cetak_label($nops)
    {
        $data_dus = TransaksiPackingsheetDetailsDus::where('nops', $nops)->get();
        $pdf      = PDF::loadView('reports.label', ['data_dus'=>$data_dus]);
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('label.pdf');
    }
}
