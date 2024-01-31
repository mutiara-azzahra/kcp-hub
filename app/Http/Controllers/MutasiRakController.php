<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiHeader;

class MutasiRakController extends Controller
{
    public function index(){

        $mutasi_approved = MutasiHeader::where('approval_head_gudang', 'Y')->get();
        $mutasi          = MutasiHeader::where('approval_head_gudang', 'N')->get();

        return view('mutasi-part.index', compact('mutasi_approved', 'mutasi'));
    }
}
