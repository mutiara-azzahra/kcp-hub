<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BGKeluarController extends Controller
{
    public function index(){

        return view('bg-keluar.index');
    }
}
