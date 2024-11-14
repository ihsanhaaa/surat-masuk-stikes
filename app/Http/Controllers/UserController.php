<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-user|create-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        // $data = User::orderBy('id','DESC')->get();
        // $data = User::where('name', '!=', 'User Test PSPIG')->orderBy('id','DESC')->get();
        $data = User::orderBy('id','DESC')->get();
        $now = Carbon::now();

        return view('users.index',compact('data'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $now = Carbon::now();

        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

    
        return redirect()->route('users.index')
                        ->with('success','User berhasil ditambahkan');
    }
    
    public function show($id)
    {
        $user = User::find(decrypt($id));

        return view('users.show',compact('user'));
    }
    
    public function edit($id)
    {
        $user = User::find(decrypt($id));
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'jabatan' => 'nullable',
            'phone_number' => 'nullable',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);

        $user->update($input);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User berhasil diubah');
    }
    
    public function destroy($id)
    {
        if(User::find(decrypt($id))->hasRole('Super Admin')) {
            return back()->with('warning', 'Anda adalah Admin');
        }

        User::find(decrypt($id))->delete();
        return redirect()->route('users.index')
                        ->with('success','User berhasil dihapus');
    }
}