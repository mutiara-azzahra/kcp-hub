<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterAreaOutlet;

class MasterAreaOutletController extends Controller
{
    public function index(){

        $list_area = MasterAreaOutlet::all();

        return view('master-area-outlet.index', compact('list_area'));
    }

    public function create(){

        return view('master-area-outlet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_prp'    => 'required',
            'kode_kab'    => 'required',
            'provinsi'    => 'required',
        ]);

        try {
        
            $existingArea = MasterAreaOutlet::where('kode_prp', $request->kode_prp)
                ->where('kode_kab', $request->kode_kab)->first();

            if ($existingArea) {
            
                return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data provinsi. Data sudah ada');
            }

            MasterProvinsi::create($request->all());

            return redirect()->route('master-area-outlet.index')->with('success','Data provinsi baru berhasil ditambahkan!');
            
        } catch (Throwable $e) {

            report($e);

            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data provinsi. Terjadi kesalahan.');
        }
    }

}
