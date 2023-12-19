<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackOrderController extends Controller
{
    public function index(){

        return view('back-order.index');
    }
    public function create(){

        return view('back-order.create');
    }
    public function store(Request $request){

        return redirect()->route('back-order.index')->with('succes','Data baru berhasil ditambahkan');

    }

    
}
