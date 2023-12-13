<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExportPajakController extends Controller
{
    public function index(){

        return view('export-pajak.index');
    }
}
