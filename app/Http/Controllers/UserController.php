<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\MasterRole;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $user = User::all();

        return view('user.index', compact('user'));

    }

    public function create(){

        $role = MasterRole::all();

        return view('user.create', compact('role'));
        
    }

    public function store(Request $request){

        $request -> validate([
            'nama_user'     => 'required',
            'username'      => 'required',
            'password'      => 'required',
        ]);
    
        $input = $request->all();

        $input['nama_user']         = $request->nama_user;
        $input['username']          = $request->username;
        $input['email']             = $request->email;
        $input['password']          = Hash::make($request['password']);
        $user                       = User::create($input);

        return redirect()->route('user.index')->with('success','Akun baru berhasil ditambahkan!');
        
    }

    public function reset($id){

        $username  = User::where('id', $id)->value('username');

        User::where('id', $id)->update([
                'password'   => Hash::make($username),
                'updated_by' => Auth::user()->nama_user,
                'updated_at' => NOW()
            ]);

        return redirect()->route('user.index')->with('success','Password berhasil di reset!');
        
    }

}
