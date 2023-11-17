<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TargetSpv;
use App\Models\User;

class MasterTargetSpvController extends Controller
{
    public function index(){

        $target = TargetSpv::all();

        return view('master-target-spv.index', compact('target'));
    }

    public function create(){

        $username = User::where('id_role', 24)->get();

        return view('master-target-spv.create', compact('username'));
    }

    public function store(Request $request){

        $request -> validate([
            'spv'      => 'required',
            'bulan'      => 'required',
            'tahun'      => 'required',
            'nominal'    => 'required',
        ]);

        $created = TargetSpv::create($request->all());

        if ($created){
            return redirect()->route('master-target-spv.index')->with('success','Data target sales berhasil ditambahkan');
        } else{
            return redirect()->route('master-target-spv.index')->with('danger','Data target sales gagal ditambahkan');
        }
    }
    
}
