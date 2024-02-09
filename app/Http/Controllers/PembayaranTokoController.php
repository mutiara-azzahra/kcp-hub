<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranTokoController extends Controller
{
    public function index(){

        return view('pembayaran-toko.index');
    }
}
