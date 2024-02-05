<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MasterKodeRak;
use App\Models\MutasiHeader;
use App\Models\MutasiDetails;
use App\Models\StokGudang;
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
        // $rak_gudang = BarangMasukDetails::where('id', $kode_rak->id)->get();
        $rak_gudang = StokGudang::where('id_rak', $kode_rak->id)->get();
        // dd($rak_gudang);

        return view('kode-rak-lokasi.show', compact('kode_rak', 'rak_gudang'));

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

        return view('kode-rak-lokasi.edit', compact('kode_rak'));

    }

    public function mutasi($id){

        $barang_rak = StokGudang::findOrFail($id);
        $all_rak    = MasterKodeRak::all();

        return view('kode-rak-lokasi.mutasi', compact('barang_rak', 'all_rak'));
        
    }

    public function store_mutasi(Request $request)
    {

        // dd($request->all());

        $request -> validate([
            'part_no'       => 'required',
            'qty_mutasi'    => 'required',
            'rak_asal'      => 'required',
            'rak_tujuan'    => 'required',
            'invoice_non'   => 'required',
        ]);

        $newMut             = new MutasiHeader();
        $newMut->no_mutasi  = MutasiHeader::no_mutasi();

        $value['no_mutasi']    = $newMut->no_mutasi;
        $value['rak_asal']     = $request->rak_asal;
        $value['rak_tujuan']   = $request->rak_tujuan;
        $value['invoice_non']  = $request->invoice_non;
        $value['keterangan']   = $request->keterangan;
        $value['created_at']   = NOW();
        $value['created_by']   = Auth::user()->nama_user;

        MutasiHeader::create($value);

        $details['no_mutasi']    = $newMut->no_mutasi;
        $details['part_no']      = $request->part_no;
        $details['qty']          = $request->qty_mutasi;
        $details['invoice_non']  = $request->invoice_non;
        $details['keterangan']   = $request->keterangan;
        $details['created_at']   = NOW();
        $details['created_by']   = Auth::user()->nama_user;

        MutasiDetails::create($details);

        return redirect()->route('kode-rak-lokasi.index')->with('success','Stok gudang berhasil ditambahkan pada mutasi.
            Silahkan lakukan approval mutasi!');
    }


}
