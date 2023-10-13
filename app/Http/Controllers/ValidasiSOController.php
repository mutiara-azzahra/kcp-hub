<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TransaksiSOHeader;

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

        $validasi_id = TransaksiSOHeader::where('noso', $noso)->get();

        return view('validasi-so.details', compact('validasi_id', 'so'));
    }

    public function validasi($noso){

        
        $validasi_so = TransaksiSOHeader::where('noso', $noso)->update([
            'flag_vald_gudang'  => 'Y',
            'flag_vald_date'    => NOW()
        ]);

        return redirect()->route('validasi-so.index')->with('success','Data SO berhasil divalidasi, diteruskan ke packingsheet');

    }
}
