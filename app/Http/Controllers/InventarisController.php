<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inventaris;

class InventarisController extends Controller
{
    public function index(){

        $inventaris = Inventaris::all();

        return view('inventaris.index', compact('inventaris'));
    }

    public function create(){

        return view('inventaris.create');
    }

    public function show($id){

         $inventaris = Inventaris::findOrFail($id);

        return view('inventaris.show', compact('inventaris'));
       
    }
}
