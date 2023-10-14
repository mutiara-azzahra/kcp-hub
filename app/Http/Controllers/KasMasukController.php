<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\KasMasukHeader;
use App\Models\MasterKodeRak;
use App\Models\MasterOutlet;

class KasMasukController extends Controller
{
    public function index(){

        $kas_masuk = KasMasukHeader::all();

        return view('kas-masuk.index', compact('kas_masuk'));
    }

    public function bukti_bayar(){

        $master_outlet = MasterOutlet::all();

        return view('kas-masuk.create', compact('master_outlet'));
    }
    public function bayar_manual(){

        $master_outlet = MasterOutlet::all();

        return view('kas-masuk.bayar-manual', compact('master_outlet'));
    }

    public function show($id){

         $master_part_id = KasMasukHeader::findOrFail($id);

        return view('kas-masuk.show', compact('master_part_id'));
       
    }

    public function store_bukti_bayar(Request $request){

        $request -> validate([
            'tanggal_rincian_tagihan'   => 'required', 
            'kd_outlet'                 => 'required', 
            'pembayaran_via'            => 'required',
            'nominal'                   => 'required',
            'bank'                      => 'required',
        ]);

        $newKas                 = new KasMasukHeader();
        $newKas->no_kas_masuk   = KasMasukHeader::no_kas_masuk();

        $request->merge([
            'no_kas_masuk'      => $newKas->no_kas_masuk,
            'status'            => 'O', //O open | C close
            'crea_date'         => NOW(),
            'crea_by'           => Auth::user()->nama_user
        ]);

        $created = KasMasukHeader::create($request->all());

        if ($created){
            return redirect()->route('kas-masuk.index')->with('success','Bukti bayar baru berhasil ditambahkan');
        } else{
            return redirect()->route('kas-masuk.index')->with('danger','Bukti bayar baru gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $master_part_id  = KasMasukHeader::findOrFail($id);
        $kode_rak = MasterKodeRak::where('status', 'A')->get();

        return view('kas-masuk.update',compact('master_part_id', 'kode_rak'));
    }

    public function delete($id)
    {
        $updated = KasMasukHeader::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($updated){
            return redirect()->route('master-part.index')->with('success','Master part berhasil dihapus!');
        } else{
            return redirect()->route('master-part.index')->with('danger','Master part gagal dihapus');
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'part_no'       => 'required',
            'part_nama'     => 'required',
            'het'           => 'required|integer',
            'satuan_dus'    => 'required|integer',
        ]);

        $masterPart = KasMasukHeader::find($id);

        if (!$masterPart) {
            return redirect()->route('master-part.index')->with('danger', 'Data master part tidak ditemukan');
        }

        $masterPart->update($request->all());

        return redirect()->route('master-part.index')->with('success', 'Data master part berhasil diubah');
    }


}
