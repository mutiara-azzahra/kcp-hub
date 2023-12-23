<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterOutlet;
use App\Models\TransaksiSOHeader;
use App\Models\TransaksiSODetails;
use App\Models\TransaksiBackOrderHeader;

class BackOrderController extends Controller
{
    public function index(){

        $outlet = MasterOutlet::where('status', 'Y')->get();

        return view('back-order.index', compact('outlet'));
    }

    public function details($kd_outlet){

        $back_order = TransaksiBackOrderHeader::where('kd_outlet', $kd_outlet)->get();

        return view('back-order.details', compact('back_order'));
    }

    public function show($nobo){

        $back_order = TransaksiBackOrderHeader::where('nobo', $nobo)->first();

        return view('back-order.show', compact('back_order'));
    }

    public function store(Request $request){


        $newSo          = new TransaksiSOHeader();
        $newSo->noso    = TransaksiSOHeader::noso();


        

        return redirect()->route('back-order.index')->with('succes','Data baru berhasil ditambahkan');

    }

    
}
