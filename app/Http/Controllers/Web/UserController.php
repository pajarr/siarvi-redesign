<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(10);

        return view('application.users.index', [
            'active_page' => 'users',
            'users' => $users,
        ]);
    }

    public function create(): View
    {
        $roles = Role::get();
        $provinces = Province::get();
        $districts = District::get();
        $cities = City::get();
        $villages = Village::get();

        return view('application.users.create', [
            'active_page' => 'users',
            'roles' => $roles,
            'provinces' => $provinces,
            'districts' => $districts,
            'cities' => $cities,
            'villages' => $villages,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'username' =>'required|max:255|unique:users',
                'name' =>'required|max:255',
                'email' =>'required|email|max:255|unique:users',
                'province_id' =>'required|exists:provinces,id',
                'city_id' =>'required|exists:cities,id',
                'district_id' =>'required|exists:districts,id',
                'village_id' =>'required|exists:villages,id',
                'password' => 'required|min:8',
                'role_id' =>'required|exists:roles,id',
            ]);

            User::create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'province_id' => $request->province,
                'city_id' => $request->city,
                'district_id' => $request->district,
                'village_id' => $request->village,
            ]);

            return redirect()->route('application.users.index')->with('success_message', 'Successfully created user.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_message', 'Failed to store user.');
        }
    }
}
