<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsMarketingController extends Controller
{
    public function index(){

        return view('reports-marketing.index');
    }

    
}
