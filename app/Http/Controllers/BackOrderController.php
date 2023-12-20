<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterOutlet;

class BackOrderController extends Controller
{
    public function index(){

        $outlet = MasterOutlet::where('status', 'Y')->get();

        return view('back-order.index', compact('outlet'));
    }
    public function create(){

        return view('back-order.create');
    }
    public function store(Request $request){

        return redirect()->route('back-order.index')->with('succes','Data baru berhasil ditambahkan');

    }

    
}
