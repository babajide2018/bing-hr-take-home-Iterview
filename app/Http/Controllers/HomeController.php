<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //call users from DB
        $data = User::orderBy('id','DESC')->paginate(5);

        //call roles from DB
        $roles = Role::pluck('name','name')->all();
        return view('pages.datatables',compact('data', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
