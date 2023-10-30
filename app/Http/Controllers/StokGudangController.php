<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MasterStokGudang;
use App\Models\MasterPart;
use App\Models\BarangMasukHeader;
use App\Models\MasterKodeRak;

class StokGudangController extends Controller
{
    public function index(){

        $stok_gudang = MasterStokGudang::where('status', 'A')->get();

        return view('stok-gudang.index', compact('stok_gudang'));
    }

    public function create(){

        $master_part = MasterPart::where('status', 'A')->get();

        return view('stok-gudang.create', compact('master_part'));
    }

    public function create_barang_masuk(){

        return view('stok-gudang.tambah');
    }

    public function store_barang_masuk(Request $request){

        $request -> validate([
            'invoice_non'  => 'required', 
            'customer_to'  => 'required',
            'supplier'     => 'required',
            'tanggal_nota' => 'required',
        ]);

        $created = BarangMasukHeader::create($request->all());
        $created->update(['created_by' => Auth::user()->nama_user]);

        if ($created){
            return redirect()->route('stok-gudang.add-details',['id' => $created->id])->with('success','Data stok gudang baru berhasil ditambahkan');
        } else{
            return redirect()->route('stok-gudang.index')->with('danger','Data stok gudang baru gagal ditambahkan');
        }

        return view('stok-gudang.tambah');
    }

    public function add_details($id)
    {
        $header         = BarangMasukHeader::findOrFail($id);
        $master_part    = MasterPart::all();
        $rak            = MasterKodeRak::all();

        return view('stok-gudang.add-details',compact('header', 'master_part', 'rak'));
    } 
    //store_add_details
    // MasterKodeRak

    public function store_add_details(Request $request){

        $request->validate([
            'inputs.*.part_no' => 'required',
            'inputs.*.qty'     => 'required',
            'inputs.*.id_rak'  => 'required',
        ]);

        foreach($request->inputs as $key => $value){
                    $value['part_no']       = $value['part_no'];
                    $value['qty']           = $value['qty'];
                    $value['id_rak']        = $value['id_rak'];
                    $value['crea_by']       = $value['crea_by'];
                    $value['crea_date']     = NOW();

                    dd($value);

                   // BarangMasukHeader::create($value);
            }       
        
        return redirect()->route('surat-pesanan.index')->with('success','Data baru berhasil ditambahkan!');
        
    }
    

    public function store(Request $request){

        $request -> validate([
            'part_no'      => 'required', 
            'stok'         => 'required',
        ]);

        $created = MasterStokGudang::create($request->all());

        if ($created){
            return redirect()->route('stok-gudang.index')->with('success','Data stok gudang baru berhasil ditambahkan');
        } else{
            return redirect()->route('stok-gudang.index')->with('danger','Data stok gudang baru gagal ditambahkan');
        }
    }

    public function delete($id)
    {
        $updated = MasterStokGudang::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($updated){
            return redirect()->route('stok-gudang.index')->with('success','Stok Gudang berhasil dihapus!');
        } else{
            return redirect()->route('stok-gudang.index')->with('danger','Stok Gudang gagal dihapus');
        }
        
    }

    public function edit($id)
    {
        $stok_id  = MasterStokGudang::findOrFail($id);

        return view('stok-gudang.update',compact('stok_id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'stok'     => 'required|integer',
        ]);

        $stok_gudang = MasterStokGudang::find($id);

        if (!$stok_gudang) {
            return redirect()->route('stok-gudang.index')->with('danger', 'Data master part tidak ditemukan');
        }

        $stok_gudang->update($request->all());

        return redirect()->route('stok-gudang.index')->with('success', 'Data master part berhasil diubah');
    }

    public function show($id)
    {
        $stok_id  = MasterStokGudang::findOrFail($id);

        return view('stok-gudang.show',compact('stok_id'));
    }

    
}
