<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPartModal;

class ModalDbpController extends Controller
{
    public function index(){

    $getModal = MasterPartModal::all();

    return view('modal.index', compact('getModal'));

    }

}
