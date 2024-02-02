<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\StokGudang;
use App\Models\MutasiHeader;
use App\Models\MutasiDetails;
use Illuminate\Http\Request;

class MutasiPartController extends Controller
{
    public function index(){

        $mutasi_approved = MutasiHeader::where('approval_head_gudang', 'Y')->get();
        $mutasi          = MutasiHeader::where('approval_head_gudang', 'N')->get();

        return view('mutasi-part.index', compact('mutasi_approved', 'mutasi'));
    }

    public function details($no_mutasi){

        $header = MutasiHeader::where('no_mutasi', $no_mutasi)->first();

        return view('mutasi-part.details', compact('header'));
    }

    public function approve($no_mutasi){

        //Ubah status Mutasi
        MutasiHeader::where('no_mutasi', $no_mutasi)->update([
            'approval_head_gudang' => 'Y',
            'tanggal_approval'     => now(),
            'updated_at'           => now(),
            'updated_by'           => Auth::user()->nama_user
        ]);

        $data          = MutasiHeader::where('no_mutasi', $no_mutasi)->get();
        $check_details = MutasiDetails::where('no_mutasi', $no_mutasi)->first();

        if ($check_details->part_no && $check_details->id_rak && StokGudang::where('part_no', $check_details->part_no)->where('id_rak', $check_details->id_rak)->exists()) {

            $sumStock = StokGudang::where('part_no', $check_details->part_no)->where('id_rak', $check_details->id_rak)->sum('stok');

        } else{

            $value = [
                'invoice_non'       => $check_details->invoice_non,
                'part_non'          => $check_details->part_non,
                'stok'              => $check_details->stok,
                'id_rak'            => $check_details->rak_tujuan,
                'status'            => 'A',
                'created_at'        => now(),
                'created_by'        => Auth::user()->nama_user,
                'updated_at'        => now(),
            ];
        
            StokGudang::create($value);
        }   

        return redirect()->route('mutasi-part.index')->with('success','Mutasi part berhasil dijalankan!');
    } 

    public function reject($no_mutasi){

        //Ubah status Mutasi
        MutasiHeader::where('no_mutasi', $no_mutasi)->update([
            'approval_head_gudang' => 'N',
            'tanggal_approval'     => now(),
            'updated_at'          => now(),
            'updated_by'          => Auth::user()->nama_user
        ]);
    }

}
