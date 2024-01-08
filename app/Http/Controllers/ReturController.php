<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturHeader;
use App\Models\TransaksiInvoiceHeader;

class ReturController extends Controller
{
    public function index(){

        $retur = ReturHeader::orderBy('created_at', 'desc')->get();

        return view('retur.index', compact('retur'));
    }

    public function create(){

        $invoice = TransaksiInvoiceHeader::orderBy('created_at', 'desc')->get();

        return view('retur.create', compact('invoice'));
    }
}
