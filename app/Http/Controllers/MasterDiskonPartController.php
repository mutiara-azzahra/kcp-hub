<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MasterPart;
use App\Models\MasterDiskonPart;

class MasterDiskonPartController extends Controller
{
    public function index(){

        $master_diskon = MasterDiskonPart::where('status', 'A')->get();

        return view('master-diskon.index', compact('master_diskon'));
    }

    public function create(){

        $part_diskon = MasterDiskonPart::where('status', 'A')->get();

        $master_part = MasterPart::where('status', 'A')->whereNotIn('part_no', $part_diskon->pluck('part_no'))
            ->get();

        return view('master-diskon.create', compact('master_part'));
    }

    public function show($id){

         $master_diskon_id = MasterDiskonPart::findOrFail($id);

        return view('master-diskon.show', compact('master_diskon_id'));
       
    }

    public function store(Request $request){

        $request -> validate([
            'part_no'           => 'required', 
            'diskon_maksimal'   => 'required',
        ]);

        $created = MasterDiskonPart::create($request->all());

        if ($created){
            return redirect()->route('master-diskon.index')->with('success','Data baru berhasil ditambahkan');
        } else{
            return redirect()->route('master-diskon.index')->with('danger','Data baru gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $master_diskon_id  = MasterDiskonPart::findOrFail($id);

        return view('master-diskon.update',compact('master_diskon_id'));
    }

    public function delete($id)
    {
        try {

            $master_diskon = MasterDiskonPart::findOrFail($id);
            $master_diskon->delete();

            return redirect()->route('master-diskon.index')->with('success', 'Data master diskon berhasil dihapus!');

        } catch (\Exception $e) {

            return redirect()->route('master-diskon.index')->with('danger', 'Data master diskon gagal dihapus');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'part_no'         => 'required',
            'diskon_maksimal' => 'required',
        ]);

        $masterDiskon = MasterDiskonPart::find($id);

        if (!$masterDiskon) {
            return redirect()->route('master-diskon.index')->with('danger', 'Data master diskon tidak ditemukan');
        }

        $masterDiskon->update($request->all());

        return redirect()->route('master-diskon.index')->with('success', 'Data master diskon berhasil diubah');
    }


}
