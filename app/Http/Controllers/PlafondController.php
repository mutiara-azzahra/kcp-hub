<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\TransaksiPlafond;

class PlafondController extends Controller
{
    public function index(){

        $plafond = TransaksiPlafond::all();

        return view('master-plafond.index', compact('plafond'));
    }

    public function tambah($id){

        $plafond = TransaksiPlafond::findOrFail($id);

        return view('master-plafond.tambah', compact('plafond'));
    }

    public function kurang($id){

        $plafond = TransaksiPlafond::findOrFail($id);

        return view('master-plafond.tambah', compact('plafond'));
    }
}