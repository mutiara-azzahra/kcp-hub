<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPartModal;
use App\Models\TransaksiInvoiceDetails;
use App\Models\ModalPartTerjual;

class ModalDbpController extends Controller
{
    public function index(){

    $getModal = MasterPartModal::all();

    return view('modal.index', compact('getModal'));

    }

    public function store(Request $request){

        $request->validate([
            'bulan'         => 'required',
            'tahun'         => 'required',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        //if qty_persediaan != 0 && qty_persediaan > qty_terjual'
        $getTerjual = TransaksiInvoiceDetails::where('created_at', '>=', $tahun.'-'.$bulan.'-01')
            ->where('created_at', '<=', $tahun.'-'.$bulan.'-'.Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth()->format('d'))
            ->get();

        foreach($getTerjual as $i){

            $getPersediaan = MasterPartModal::where('part_no', $i->part_no)
                ->where('status', 'A')
                ->first();
        
            $nominalJualDbp     = $getPersediaan->modal * $i->qty;
            $stok_persediaan    = $getPersediaan->qty - $i->qty;

            $value['noinv']          = $i->noinv;
            $value['part_no']        = $i->part_no;
            $value['qty_awal']       = $getPersediaan->qty;
            $value['qty_terjual']    = $i->qty;
            $value['qty_akhir']      = $stok_persediaan;
            $value['modal']          = $getPersediaan->modal;
            $value['nominal_modal']  = $nominalJualDbp;
            $value['status']         = 'A';
            $value['created_at']     = NOW();
            $value['created_by']     = Auth::user()->nama_user;

            $created = ModalPartTerjual::create($value);

            if ($created){
                $updated = $getPersediaan->update([
                    'qty' => $stok_persediaan,
                    'updated_at' => now(),
                ]);
                
                if ($updated){
                    return redirect()->route('modal.index')->with('succes','Data modal berhasil dijalankan');
    
                } else{
                    return redirect()->route('modal.index')->with('danger','Data baru gagal ditambahkan');
                }

            } else{
                return redirect()->route('modal.index')->with('danger','Data baru gagal ditambahkan');

            }
            

        }
        
        //if qty_persediaan < qty_terjual
        //ambil satu data atas dulu yang masih bisa dikurangi dengan qty_terjual
        // $getModalTerjual = MasterPartModal::where('part_no', $part_no)
        //     ->where('status', 'A')
        //     ->first();
        
    }

}
