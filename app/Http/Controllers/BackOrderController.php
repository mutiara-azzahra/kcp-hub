<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\MasterOutlet;
use App\Models\TransaksiSpHeader;
use App\Models\TransaksiSOHeader;
use App\Models\TransaksiSODetails;
use App\Models\TransaksiBackOrderHeader;
use App\Models\TransaksiBackOrderDetails;

class BackOrderController extends Controller
{
    public function index(){

        $outlet = MasterOutlet::all();

        return view('back-order.index', compact('outlet'));
    }

    public function details($kd_outlet){

        $back_order = TransaksiBackOrderHeader::where('kd_outlet', $kd_outlet)->where('status', 'O')->get();

        return view('back-order.details', compact('back_order'));
    }

    public function show($nobo){

        $back_order = TransaksiBackOrderHeader::where('nobo', $nobo)->first();

        return view('back-order.show', compact('back_order'));
    }

    public function store($id){

        $updated_sp = TransaksiBackOrderHeader::where('id', $id)
            ->update([
            'status'        => 'C',
            'updated_at'    => NOW(),
            'updated_by'    => Auth::user()->nama_user
        ]);

        $newSo          = new TransaksiSOHeader();
        $newSo->noso    = TransaksiSpHeader::noso();
        $store_bo       = TransaksiBackOrderHeader::where('id', $id)->first();
        $area_sp        = MasterOutlet::where('kd_outlet', $store_bo->kd_outlet)->first();

        $area = '';

        if($area_sp->kode_prp == '6300'){
            $area = 'KS';
        } elseif ($area_sp->kode_prp == '6200') {
            $area = 'KT';
        }

        $data = [
            'noso'      => $newSo->noso,
            'status'    => 'O',
            'area_so'   => $area,
            'kd_outlet' => $store_bo->kd_outlet,
            'nm_outlet' => $store_bo->nm_outlet,
            'user_sales'=> $store_bo->user_sales,
            'crea_date' => NOW(),
            'crea_by'   => Auth::user()->nama_user
        ];

        $created_header = TransaksiSOHeader::create($data);

        foreach($store_bo->details as $i){

            // dd($i);

            $nominal      = $i->qty * $i->hrg_pcs;
            $nominal_disc = $i->qty * $i->hrg_pcs * $i->disc / 100;
            $stok_ready   = MasterStokGudang::where('part_no', $i->part_no)->value('stok');

            $details = [
                'noso'              => $created_header->noso,
                'area_so'           => $area,
                'kd_outlet'         => $store_bo->kd_outlet,
                'part_no'           => $i->part_no,
                'qty'               => $i->qty,
                'hrg_pcs'           => $i->hrg_pcs,
                'disc'              => $i->disc,
                'nominal'           => $nominal,
                'nominal_disc'      => $nominal_disc,
                'nominal_total'     => $nominal - $nominal_disc,
                'qty_gudang'        => $stok_ready,
                'status'            => 'O', 
                'ket_status'        => 'OPEN',
                'user_sales'        => $store_bo->user_sales,
                'flag_approve_date' => NOW(),
                'crea_date'         => NOW(),
                'crea_by'           => Auth::user()->nama_user,
            ];
    
            TransaksiSODetails::create($details);

        }

        return redirect()->route('back-order.index')->with('success','Data Back Order berhasil diteruskan menjadi SO!');
        // return redirect()->route('back-order.index')->with('danger','Data Back Order gagal diteruskan menjadi SO');
        
    }

    public function delete($id)
    {
        $details    = TransaksiBackOrderDetails::findOrFail($id);
        $nobo       = TransaksiBackOrderHeader::where('nobo', $details->nobo)->value('nobo');

        $details->delete();

        return redirect()->route('back-order.show', $nobo)->with('success', 'Data detail BO berhasil dihapus');
    }
    
}
