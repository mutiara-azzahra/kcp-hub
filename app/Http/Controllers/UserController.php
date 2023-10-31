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
            'id_role'       => 'required',
        ]);
    
        $input = $request->all();

        $input['nama_user']         = $request->nama_user;
        $input['username']          = $request->username;
        $input['email']             = $request->email;
        $input['id_role']           = $request->id_role;
        $input['password']          = Hash::make($request['password']);
        $input['created_at']        = NOW();
        $input['created_by']        = Auth::user()->nama_user;
        
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

    public function nonaktif($id)
    {
        $nonaktif = User::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($nonaktif){
            return redirect()->route('user.index')->with('success','Data user berhasil dinonaktifkan!');
        } else{
            return redirect()->route('user.index')->with('danger','Data user gagal dinonaktifkan');
        }
        
    }
    public function show($id)
    {

        $user = User::where('id', $id)->first();

        return view('profil.show',compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $input = $request->all();

        $request->validate([
            'password'          => 'required',
            'password_baru'     => 'required'
        ]);

        $input['password_baru']  = Hash::make($request['password_baru']);
        if(Hash::check($request->password, $user->password))
        {
            $user->password = $input['password_baru'];
            
            $user->update();

            return redirect()->route('profil.show')->with('success','Password user berhasil diubah!');           
        }
        else{
            return redirect()->route('profil.show')->with('error','Password lama tidak sama');           

        }
         
        $user->update($request->all());
    }

}
