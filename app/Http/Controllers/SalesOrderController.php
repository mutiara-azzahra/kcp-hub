<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\TransaksiSpHeader;
use App\Models\TransaksiSOHeader;
use App\Models\TransaksiSODetails;


class SalesOrderController extends Controller
{
    public function index(){

        $surat_pesanan = TransaksiSpHeader::where('status', 'C')->get();

        return view('sales-order.index', compact('surat_pesanan'));
    }

    public function so_approved(){

        $so_approved = TransaksiSOHeader::where('flag_approve', 'Y')->get();

        return view('sales-order.approved', compact('so_approved'));
    }

    public function so_rejected(){

        $so_rejected = TransaksiSOHeader::where('flag_reject', 'Y')->get();

        return view('sales-order.rejected', compact('so_rejected'));
    }

    public function details($nosp){

        $surat_pesanan_id = TransaksiSpHeader::where('nosp', $nosp)->get();        

        
        return view('sales-order.details', ['nosp' => $nosp] , compact('surat_pesanan_id'));
    }

    public function create(){

        return view('sales-order.create');
    }
    public function store(Request $request){

        return redirect()->route('sales-order.index')->with('success','Data SO baru berhasil ditambahkan!');

    }

    public function approve($nosp){

        //move to header so Approve
        $approve_so = TransaksiSpHeader::where('nosp', $nosp)->get();

        foreach($approve_so as $a){
            $data['noso']               = $a->noso;
            $data['area_so']            = $a->area_sp;
            $data['kd_outlet']          = $a->kd_outlet;
            $data['nm_outlet']          = $a->nm_outlet;
            $data['status']             = 'O';
            $data['ket_status']         = 'OPEN';
            $data['user_sales']         = $a->user_sales;
            $data['flag_approve']       = 'Y';
            $data['flag_approve_date']  = NOW();
            $data['crea_date']          = NOW();
            $data['crea_by']            = Auth::user()->nama_user;

            TransaksiSOHeader::create($data);
        }

        //move to details so Approve
        foreach($approve_so as $a){
            foreach($a->details_sp as $d){
                $details['noso']               = $a->noso;
                $details['area_so']            = $a->area_sp;
                $details['kd_outlet']          = $a->kd_outlet;
                $details['part_no']            = $d->part_no;
                $details['qty']                = $d->qty;
                $details['hrg_pcs']            = $d->hrg_pcs;
                $details['disc']               = $d->disc;
                $details['nominal']            = $d->nominal;
                $details['nominal_disc']       = $d->nominal_disc;
                $details['nominal_total']      = $d->nominal_total;
                $details['status']             = 'O';
                $details['ket_status']         = 'OPEN';
                $details['user_sales']         = $d->user_sales;
                $details['flag_approve_date']  = NOW();
                $details['crea_date']          = NOW();
                $details['crea_by']            = Auth::user()->nama_user;

                TransaksiSODetails::create($details);
            }
        }
        
        return redirect()->route('sales-order.index')->with('success','Data SO berhasil di Approve!');

    }

    public function reject($nosp){

        //move to header so Tolak
        $tolak_so = TransaksiSpHeader::where('nosp', $nosp)->get();

        foreach($tolak_so as $a){
            $data['noso']               = $a->noso;
            $data['area_so']            = $a->area_sp;
            $data['kd_outlet']          = $a->kd_outlet;
            $data['nm_outlet']          = $a->nm_outlet;
            $data['status']             = 'O';
            $data['ket_status']         = 'OPEN';
            $data['user_sales']         = $a->user_sales;
            $data['flag_approve']       = 'N';
            $data['flag_approve_date']  = NOW();
            $data['crea_date']          = NOW();
            $data['crea_by']            = Auth::user()->nama_user;

            TransaksiSOHeader::create($data);
        }

        //move to details so Tolak
        foreach($tolak_so as $a){
            foreach($a->details_sp as $d){
                $details['noso']               = $a->noso;
                $details['area_so']            = $a->area_sp;
                $details['kd_outlet']          = $a->kd_outlet;
                $details['part_no']            = $d->part_no;
                $details['qty']                = $d->qty;
                $details['hrg_pcs']            = $d->hrg_pcs;
                $details['disc']               = $d->disc;
                $details['nominal']            = $d->nominal;
                $details['nominal_disc']       = $d->nominal_disc;
                $details['nominal_total']      = $d->nominal_total;
                $details['status']             = 'O';
                $details['ket_status']         = 'OPEN';
                $details['user_sales']         = $d->user_sales;
                $details['flag_reject_date']   = NOW();
                $details['crea_date']          = NOW();
                $details['crea_by']            = Auth::user()->nama_user;

                TransaksiSODetails::create($details);
            }
        }

        return redirect()->route('sales-order.index')->with('success','Data SO berhasil ditolak');

    }
}
