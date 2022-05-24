<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //

    public function index(Request $request)
    {
        //call users from DB
        $data = User::orderBy('id','DESC')->paginate(5);

        //call roles from DB
        $roles = Role::pluck('name','name')->all();
        return view('pages.datatables',compact('data', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }




    /*Role Functions*/
    public function addRole(Request $request){

        //call roles from DB
        $roles = Role::orderBy('id','DESC')->paginate(5);

        //permission
        $permission = Permission::get();

        return view('pages.roles',compact('roles', 'permission'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
