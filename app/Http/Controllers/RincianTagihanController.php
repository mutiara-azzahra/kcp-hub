<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\TransaksiRincianAccountReceiveable;

class RincianTagihanController extends Controller
{
    public function index(){

        $ar_belum_diterima = TransaksiRincianAccountReceiveable::where('flag_terima', 'N')->get();

        return view('rincian-tagihan.index', compact('ar_belum_diterima'));
    }

    public function approve($id)
    {

        $updated = TransaksiRincianAccountReceiveable::where('id', $id)->update([
                'flag_terima'    => 'Y',
                'tanggal_terima' => now(),
                'updated_at'     => now(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($updated){
            return redirect()->route('rincian-tagihan.index')->with('success','Rincian Tagihan berhasil diterima!');
        } else{
            return redirect()->route('rincian-tagihan.index')->with('danger','Rincian Tagihan gagal diterima. Periksa kembali');
        }
        
    }
}
