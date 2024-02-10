<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterProvinsi;

class MasterProvinsiController extends Controller
{
    public function index(){

        $list_provinsi = MasterProvinsi::all();

        return view('master-provinsi.index', compact('list_provinsi'));
    }

    public function create(){

        return view('master-provinsi.create');
    }

     public function store(Request $request)
    {
        $request -> validate([
            'kode_prp'    => 'required',
            'provinsi'    => 'required',
        ]);

        MasterProvinsi::create($request->all());
        
        return redirect()->route('master-provinsi.index')->with('success','Data provinsi baru berhasil ditambahkan!');
    }

}
