<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MasterPerkiraan;

class MasterPerkiraanController extends Controller
{
    public function index(){

        $list_perkiraan = MasterPerkiraan::where('status', 'AKTIF')->get();

        return view('master-perkiraan.index', compact('list_perkiraan'));
    }

    public function create(){

        return view('master-perkiraan.create');
    }

    public function edit($id){

        return view('master-perkiraan.edit');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'perkiraan'         => 'required',
            'sub_perkiraan'     => 'required',
            'nm_perkiraan'      => 'required',
            'nm_sub_perkiraan'  => 'required',
            'flag_head'         => 'required',
            'kategori'          => 'required',
            'saldo'             => 'required',
            'sts_perkiraan'     => 'required',
            'head_kategori'     => 'required',
        ]);
        
        // $created = MasterPerkiraan::create($request->all());

        $value['perkiraan']         = $request->perkiraan;
        $value['sub_perkiraan']     = $request->sub_perkiraan;
        $value['nm_perkiraan']      = $request->nm_perkiraan;
        $value['nm_sub_perkiraan']  = $request->nm_sub_perkiraan;
        $value['flag_head']         = $request->flag_head;
        $value['kategori']          = $request->kategori;
        $value['head_kategori']     = $request->head_kategori; // Add this line

        $created = MasterPerkiraan::create($value);
    
        return redirect()->route('master-perkiraan.index')->with('success','Data perkiraan baru berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'role' => 'required',
        ]);

        $updated = MasterPerkiraan::where('id', $id)->update([
                'role'          => $request->role,
                'updated_at'    => NOW(),
                'updated_by'    => Auth::user()->nama_user
            ]);
        
        if ($updated){
            return redirect()->route('master-perkiraan.index')->with('success','Master perkiraan berhasil diubah!');
        } else{
            return redirect()->route('master-perkiraan.index')->with('danger','Master perkiraan gagal diubah');
        }   
    }


    public function nonaktif($id)
    {
        try {

            $perkiraan = MasterPerkiraan::findOrFail($id);

            $perkiraan->update([
                'status'        => 'NON_AKTIF',
                'modi_date'     => now(),
                'modi_by'       => Auth::user()->nama_user
            ]);

            return redirect()->route('master-perkiraan.index')->with('success', 'Data master perkiraan berhasil dinonaktifkan!');

        } catch (\Exception $e) {

            return redirect()->route('master-perkiraan.index')->with('danger', 'Data master perkiraan gagal dinonaktifkan');
        }
    }
}
