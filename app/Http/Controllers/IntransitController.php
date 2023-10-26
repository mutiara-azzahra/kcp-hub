<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IntransitHeader;
use App\Models\IntransitDetails;
use App\Models\MasterPart;
use App\Models\MasterStokGudang;


class IntransitController extends Controller
{
    public function index(){

        $intransit_header = IntransitHeader::all();

        return view('intransit.index', compact('intransit_header'));
    }

    public function create(){

        return view('intransit.create');
    }

    public function store(Request $request){

        $request -> validate([
            'no_surat_pesanan'     => 'required', 
            'tanggal_packingsheet' => 'required', 
        ]);

        $request['status']  = 'I';

        $created = IntransitHeader::create($request->all());

        if ($created){
            return redirect()->route('intransit.details', ['id' => $created->id])->with('success','Intransit header Berhasil ditambahkan, silahkan input details Intrasit');
        } else{
            return redirect()->route('intransit.index')->with('danger','Data baru gagal ditambahkan');
        }
    }

    public function details($id)
    {
        $intransit_header  = IntransitHeader::findOrFail($id);
        $master_part       = MasterPart::all();

        return view('intransit.details',compact('intransit_header', 'master_part'));
    }


    public function store_details(Request $request){

        $request->validate([
                'inputs.*.no_surat_pesanan' => 'required',
                'inputs.*.no_packingsheet'  => 'required',
                'inputs.*.part_no'          => 'required', 
                'inputs.*.qty'              => 'required', 
                'inputs.*.harga_pcs'        => 'required',
        ]);

        foreach($request->inputs as $key => $value){

            $value['status'] = 'I';

           IntransitDetails::create($value);
        }
        
        return redirect()->route('intransit.index')->with('success','Barang intransit berhasil ditambahkan!');
        
    }

    public function tambah_gudang($id)
    {
        $intransit_header  = IntransitHeader::findOrFail($id);

        return view('intransit.validasi',compact('intransit_header'));
    }

    public function validasi($id)
    {
        $intransit_header  = IntransitHeader::findOrFail($id);

        return view('intransit.validasi',compact('intransit_header'));
    }

    public function validasi_barang($id)
    {

        $intransit_header       = IntransitHeader::where('id', $id)->update(["status" => "T"]);
        $id_intransit_header    = IntransitHeader::where('id',$id)->value('no_surat_pesanan');

        return redirect()->route('intransit.stok_masuk', ['id_intransit_header' => $id_intransit_header])->with('success', 'Data berhasil divalidasi');
        
    }

    public function stok_masuk($no_surat_pesanan)
    {
        $intransit_details = IntransitDetails::where('no_surat_pesanan', $no_surat_pesanan)->get();

        return view('intransit.stok-masuk',compact('intransit_details'))->with('success', 'Data berhasil divalidasi, silahkan tambahkan barang ke gudang');
        
    }

    public function store_stok_gudang(Request $request, $part_no)
    {

        $selectedItems      = $request->input('selected_items', []);
        $no_doos            = $request->input('no_doos', []);
        $no_packingsheet    = $request->input('no_packingsheet', []);

        foreach ($selectedItems as $itemPartNo) {
            $stok_lama = MasterStokGudang::where('part_no', $itemPartNo)->value('stok');
            
            $stok_masuk = IntransitDetails::where('part_no', $itemPartNo)
                ->where('no_doos', $no_doos)
                ->where('no_packingsheet', $no_packingsheet)
                ->value('qty');
            
            MasterStokGudang::where('part_no', $itemPartNo)->update(['stok' => $stok_lama + $stok_masuk]);
        }

        return redirect()->route('intransit.index')->with('success', 'Barang berhasil dimasukkan ke gudang');
    }








}
