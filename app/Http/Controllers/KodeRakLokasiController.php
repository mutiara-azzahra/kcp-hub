<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\MasterKodeRak;
use App\Models\BarangMasukDetails;
use App\Models\IntransitDetails;

class KodeRakLokasiController extends Controller
{
    public function index(){

        $kode_rak = MasterKodeRak::where('status', 'A')->get();

        return view('kode-rak-lokasi.index', compact('kode_rak'));
    }

    public function create(){

        return view('kode-rak-lokasi.create');
    }

    public function show($id){

        $kode_rak   = MasterKodeRak::findOrFail($id);

        $barang_rak = BarangMasukDetails::where('id', $kode_rak->id)->get();

        return view('kode-rak-lokasi.show', compact('kode_rak', 'barang_rak'));

    }

    public function store(Request $request)
    {
        $request -> validate([
            'kode_rak_lokasi' => 'required',
        ]);

        MasterKodeRak::create($request->all());

        return redirect()->route('kode-rak-lokasi.index')->with('success','Data baru berhasil ditambahkan!');
    }

    public function delete($id)
    {
        MasterKodeRak::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);
         
        return redirect()->route('kode-rak-lokasi.index')->with('success','Kode Rak berhasil dihapus!');
    }

    public function edit($id){

        $kode_rak   = MasterKodeRak::findOrFail($id);

        dd($kode_rak);

        return view('kode-rak-lokasi.edit', compact('kode_rak'));

    }

    public function mutasi($id){

        $barang_rak = IntransitDetails::findOrFail($id);

        dd($barang_rak);


        
    }


}
