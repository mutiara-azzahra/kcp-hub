<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\StokGudang;
use App\Models\MutasiHeader;
use App\Models\MutasiDetails;
use App\Models\FlowStokGudang;
use App\Models\MasterStokGudang;
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
                'part_no'           => $check_details->part_no,
                'stok'              => $check_details->qty,
                'id_rak'            => $check_details->header->rak_tujuan,
                'status'            => 'A',
                'created_at'        => now(),
                'created_by'        => Auth::user()->nama_user,
                'updated_at'        => now(),
            ];
        
            StokGudang::create($value);

            $stok_awal = StokGudang::where('part_no', $check_details->part_no)->where('id_rak', $check_details->header->rak_asal)
            ->value('stok');

            //Potong stok sebelumnya
            StokGudang::where('part_no', $check_details->part_no)->where('id_rak', $check_details->header->rak_asal)
                ->update([
                'stok'          => $stok_awal - $check_details->qty,
                'updated_at'    => now(),
                'updated_by'    => Auth::user()->nama_user
            ]);

            $stok_akhir = MasterStokGudang::where('part_no', $check_details->part_no)->latest()->first();

            if(isset($stok_akhir)){
                $stok_awal = $stok_akhir->stok_akhir;
            } else{
                $stok_awal = 0;
            }

            //Mutasi Keluar
            $flow_stok                          = new FlowStokGudang();
            $flow_stok->tanggal_barang_masuk    = null;
            $flow_stok->tanggal_barang_keluar   = now();
            $flow_stok->id_rak                  = $check_details->header->rak_asal;
            $flow_stok->keterangan              = 'MUTASI_KELUAR';
            $flow_stok->referensi               = $check_details->invoice_non;
            $flow_stok->part_no                 = $check_details->part_no;
            $flow_stok->stok_awal               = $stok_awal;
            $flow_stok->stok_masuk              = 0;
            $flow_stok->stok_keluar             = $check_details->qty;
            $flow_stok->stok_akhir              = $flow_stok->stok_awal + $flow_stok->stok_masuk - $flow_stok->stok_keluar;
            $flow_stok->created_by              = Auth::user()->nama_user;
            $flow_stok->save();

            //Mutasi Masuk
            $flow_stok_masuk                          = new FlowStokGudang();
            $flow_stok_masuk->tanggal_barang_masuk    = now();
            $flow_stok_masuk->tanggal_barang_keluar   = null;
            $flow_stok_masuk->id_rak                  = $check_details->header->rak_tujuan;
            $flow_stok_masuk->keterangan              = 'MUTASI_MASUK';
            $flow_stok_masuk->referensi               = $check_details->invoice_non;
            $flow_stok_masuk->part_no                 = $check_details->part_no;
            $flow_stok_masuk->stok_awal               = $stok_awal;
            $flow_stok_masuk->stok_masuk              = $check_details->qty;
            $flow_stok_masuk->stok_keluar             = 0;
            $flow_stok_masuk->stok_akhir              = $flow_stok_masuk->stok_awal + $flow_stok_masuk->stok_masuk - $flow_stok_masuk->stok_keluar;
            $flow_stok_masuk->created_by              = Auth::user()->nama_user;
            $flow_stok_masuk->save();

        }

        return redirect()->route('mutasi-part.index')->with('success','Mutasi part berhasil dijalankan!');
    } 

    public function reject($no_mutasi){

        MutasiHeader::where('no_mutasi', $no_mutasi)->update([
            'approval_head_gudang' => 'N',
            'tanggal_approval'     => now(),
            'updated_at'           => now(),
            'updated_by'           => Auth::user()->nama_user
        ]);
    }

}
