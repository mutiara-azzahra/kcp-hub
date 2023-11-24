<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use App\Models\TransaksiKasKeluarHeader;


class KasKeluarController extends Controller
{
    public function index(){

        $kas_keluar = TransaksiKasKeluarHeader::all();

        return view('kas-keluar.index', compact('kas_keluar'));
    }

    public function create(){

        return view('kas-keluar.create');
    }

    public function store(Request $request){

        $request -> validate([
            'tanggal_rincian_tagihan'   => 'required',
        ]);

        $newKeluar              = new TransaksiKasKeluarHeader();
        $newKeluar->no_keluar   = TransaksiKasKeluarHeader::no_keluar();

        
        $request->merge([
            'no_keluar'         => $newKeluar->no_keluar,
            'terima_dari'       => $request->terima_dari,
            'keterangan'        => $request->keterangan,
            'status'            => 'A',
            'created_by'        => Auth::user()->nama_user
        ]);

        $created = TransaksiKasKeluarHeader::create($request->all());

        if ($created){
            return redirect()->route('kas-keluar.details', ['no_keluar' => $newKeluar->no_keluar])->with('success', 'Bukti bayar baru berhasil ditambahkan');
        } else{
            return redirect()->route('kas-keluar.index')->with('danger','Kas Keluar baru gagal ditambahkan');
        }
    }
}
