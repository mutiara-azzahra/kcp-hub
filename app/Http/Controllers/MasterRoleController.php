<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MasterRole;

class MasterRoleController extends Controller
{
    public function index(){

        $master_role = MasterRole::where('status', 'A')->get();

        return view('master-role.index', compact('master_role'));
    }

    public function create(){

        return view('master-role.create');
    }

    public function show($id){

         $master_role_id = MasterRole::findOrFail($id);

        return view('master-role.show', compact('master_role_id'));
       
    }

    public function store(Request $request){

        $request -> validate([
            'role'          => 'required'
        ]);

        $request->merge([
            'created_at' => now(),
            'created_by' => Auth::user()->nama_user,
        ]);

        $created = MasterRole::create($request->all());

        if ($created){
            return redirect()->route('master-role.index')->with('success','Data role berhasil ditambahkan!');
        } else{
            return redirect()->route('master-role.index')->with('danger','Data role gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $master_role_id = MasterRole::findOrFail($id);

        return view('master-role.update',compact('master_role_id'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'role' => 'required',
        ]);

        $updated = MasterRole::where('id', $id)->update([
                'role'          => $request->role,
                'updated_at'    => NOW(),
                'updated_by'    => Auth::user()->nama_user
            ]);
        
        if ($updated){
            return redirect()->route('master-role.index')->with('success','Master role berhasil dihapus!');
        } else{
            return redirect()->route('master-role.index')->with('danger','Master role gagal dihapus');
        }   
    }

    public function delete($id)
    {
        $updated = MasterRole::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($updated){
            return redirect()->route('master-role.index')->with('success','Master role berhasil dihapus!');
        } else{
            return redirect()->route('master-role.index')->with('danger','Master role gagal dihapus');
        }
        
    }
}
