<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'permission:Users']);
    }

    public function index()
    {
        // if (Auth::user()->hasPermission('Invoces_show')) {
        //     return "Ahmed";
        // }
        //  $perm = Permission::get();
        //  Role::find(2)->attachPermission('Invoces_show');
        // Hash::swap()
        $users = User::with('roles:name')->get();
        return view('Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission('Users_create') != 1) {
            abort(404);
        }
        $roles = Role::select('id', 'name')->get();
        return view('Users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        if ($request->password != $request->confirm_password) {
            session()->flash('confirm_password', 'Error the password is not = confirm password');
            return redirect('/Users/create');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:30'],
            'Role' => ['required', 'numeric', 'max:30'],
            'state' => ['required', 'numeric', 'max:2'],
        ]);

        $user_id = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'state' => $request->state,
            'password' => Hash::make($request->password),
        ]);

        User::find($user_id)->attachRole($request->Role);
        session()->flash('yes', 'User is Created');
        return redirect('Users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasPermission('Users_edite') != 1) {
            abort(404);
        }

        if (Auth()->user()->id == $id) {
            return  redirect()->route('Users.index');
        }

        $user =  User::with('roles:id,name')->findOrFail($id);
        $roles = Role::get();
        return view('Users.edite', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth()->user()->id == $id) {
            return  redirect()->route('Users.index');
        }

        //return $userroles =  User::findOrFail($id)->getRoles();
        if ($request->password != $request->confirm_password) {
            session()->flash('confirm_password', 'Error the password is not = confirm password');
            return redirect('/Users');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:30'],
            'Role' => ['required', 'numeric','max:30'],
            'state' => ['required', 'numeric','max:2'],
        ]);

        $user_id = User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'state' => $request->state,
            'password' => Hash::make($request->password),
        ]);

        $userroles =  User::findOrFail($id)->getRoles();
        User::findOrFail($id)->detachRoles($userroles);//attachRole
        User::findOrFail($id)->attachRole($request->Role);


        session()->flash('yes', 'User is Created');
        return redirect('Users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasPermission('Users_delete') != 1) {
            abort(404);
        }
        $user =  User::findOrFail($id);
        $user->delete();
        return redirect('/Users');
    }
}
