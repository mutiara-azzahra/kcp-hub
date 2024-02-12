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

    public function edit($id){

        $area_outlet = MasterAreaOutlet::findOrFail($id);

        return view('master-area-outlet.edit', compact('area_outlet'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'kode_prp'    => 'required',
            'kode_kab'    => 'required',
            'nm_area'     => 'required',
        ]);

        try {
        
            $existingArea = MasterAreaOutlet::where('kode_prp', $request->kode_prp)->where('kode_kab', $request->kode_kab)->first();

            if ($existingArea) {
            
                return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data area. Data sudah ada');
            }

            MasterAreaOutlet::create($request->all());

            return redirect()->route('master-area-outlet.index')->with('success','Data area baru berhasil ditambahkan!');
            
        } catch (Throwable $e) {

            report($e);

            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data area. Terjadi kesalahan.');
        }
    }

    public function update(Request $request, MasterAreaOutlet $master_area)
    {

        $request->validate([
            'kode_prp'    => 'required',
            'kode_kab'    => 'required',
            'nm_area'     => 'required',
        ]);

        try {

            $master_area->update($request->all());

            return redirect()->route('master-area-outlet.index')->with('success', 'Data master area berhasil diubah!');

        } catch (\Exception $e) {

            report($e);

            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data master area. Terjadi kesalahan.');
        }
    }


    public function delete($id)
    {
        $area_outlet    = MasterAreaOutlet::findOrFail($id);

        $area_outlet->delete();

        return redirect()->route('back-order.index')->with('success', 'Data detail BO berhasil dihapus');
    }
  

}
