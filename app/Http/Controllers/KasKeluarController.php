<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TransaksiKasKeluarHeader;

class KasKeluarController extends Controller
{
    public function index(){

        $keluar_header = TransaksiKasKeluarHeader::all();

        return view('kas-keluar.index', compact('keluar_header'));
    }

    public function create(){

        return view('kas-keluar.create');
    }
}
