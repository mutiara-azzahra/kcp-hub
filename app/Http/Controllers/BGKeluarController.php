<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPerkiraan;

class BGKeluarController extends Controller
{
    public function index(){

        return view('bg-keluar.index');
    }

    public function create(){

        $perkiraan  = MasterPerkiraan::all();

        return view('bg-keluar.create', compact('perkiraan'));
    }

    public function store(Request $request){

        return redirect()->route('bg-keluar.index')->with('success', 'BG keluar baru berhasil ditambahkan!');
    }
}
