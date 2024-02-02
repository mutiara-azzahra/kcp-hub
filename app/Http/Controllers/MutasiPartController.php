<?php

namespace App\Http\Controllers;

use App\Models\MutasiHeader;
use Illuminate\Http\Request;

class MutasiPartController extends Controller
{
    public function index(){

        $mutasi_approved = MutasiHeader::where('approval_head_gudang', 'Y')->get();
        $mutasi          = MutasiHeader::where('approval_head_gudang', 'N')->get();

        return view('mutasi-part.index', compact('mutasi_approved', 'mutasi'));
    }
}
