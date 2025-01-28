<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(5);

        return view('application.role.index', [
            'roles' => $roles,
            'active_page' => 'user_role',
        ]);
    }

    public function create()
    {
        return view('application.role.create', [
            'active_page' => 'user_role',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255','unique:roles'],
        ]);

        try {
            Role::create(['name' => $request->name]);

            return redirect()->route('application.role.index')->with('success_message', 'Successfully create role.');
        } catch (\Throwable $th) {
            return redirect()->route('application.role.index')->with('error_message', 'Failed when creating role.');
        }

        
    }
}
