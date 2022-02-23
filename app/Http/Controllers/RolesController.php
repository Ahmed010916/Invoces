<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'permission:Roles']);
    }


    public function index()
    {
        $roles = Role::get();
       return view('Roles.index',compact('roles'));
    }


    public function create()
    {
        if (Auth::user()->hasPermission('Roles_create') != 1) {
            abort(404);
        }
        $prem = Permission::select('id','name')->get();
        return view("Roles.create",compact('prem'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:permissions,name'],
            'description' => ['nullable', 'string', 'max:400'],
            'permissions' => ['required', 'array'],
        ]);
        $role_id = DB::table('roles')->insertGetId([
            'name' => $request->name,
        ]);
        Role::findOrFail($role_id)->attachPermissions($request->permissions);
        session()->flash('yes', 'Roles is Created');
        return redirect('/Roles');
    }


    public function show($id)
    {

        $prem = Permission::get();
        $role = Role::findOrFail($id);
        return view('Roles.show',compact('role','prem'));
    }


    public function edit($id)
    {
        if (Auth::user()->hasPermission('Roles_edite') != 1) {
            abort(404);
        }

        if (Auth()->user()->roles[0]->id == $id) {
            return  redirect()->route('Roles.index');
        }
        $prem = Permission::get();
        $role = Role::findOrFail($id);
        return view('Roles.edite',compact('role','prem'));
    }


    public function update(Request $request, $id)
    {
        //return $request;

         $role = Role::findOrFail($id);
         $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:400'],
            'permissions' => ['required', 'array'],
        ]);

          $role->update([
              'name'=> $request->name,
              'description'=> $request->description,
          ]);

        $role->detachPermissions($role->permissions);
        $role->attachPermissions($request->permissions);


        return redirect('/Roles');

     }


    public function destroy($id)
    {
        if (Auth::user()->hasPermission('Roles_delete') != 1) {
            abort(404);
        }
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect('/Roles');
    }
}
