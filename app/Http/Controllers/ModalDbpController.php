<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceNonDetails;

class ModalDbpController extends Controller
{
    public function index(){

    $getModal = InvoiceNonDetails::all();

    return view('modal.index', compact('getModal'));

    }

}
