<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterStokGudangHet;

class MasterPartHetController extends Controller
{
    public function index(){

        $part_het = MasterStokGudangHet::where('status', 'A')->get();

        return view('master-part-het.index', compact('part_het'));
    }
}
