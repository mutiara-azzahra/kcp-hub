<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturHeader;

class ReturController extends Controller
{
    public function index(){

        $retur = ReturHeader::orderBy('created_at', 'desc')->get();

        return view('retur.index', compact('retur'));
    }
}
