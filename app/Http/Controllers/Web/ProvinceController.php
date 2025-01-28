<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $provinces = Province::paginate(10);

        return view('application.province.index', [
            'active_page' => 'province',
            'provinces' => $provinces,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('application.province.create', [
            'active_page' => 'province'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'place_code' => 'required|integer|unique:provinces',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ]);

        try {
            Province::create([
                'name' => $request->name,
                'place_code' => $request->place_code,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            return redirect()->route('application.province.index')->with('success_message', 'Successfully created province.');
        } catch (\Throwable $th) {
            return back()->with('error_message', 'Failed to create province. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $province = Province::find($id);

        if (empty($province)) {
            return back()->with('error_message', 'Province not found.');
        }

        return view('application.province.show', [
            'active_page' => 'province',
            'province' => $province,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'place_code' => 'required|integer',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ]);

        try {

            $province = Province::find($id);

            if (empty($province)) {
                return back()->with('error_message', 'Province not found.');
            }

            $province->update([
                'name' => $request->name,
                'place_code' => $request->place_code,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            return redirect()->route('application.province.index')->with('success_message', 'Successfully updated province.');
        } catch (\Throwable $th) {
            return back()->with('error_message', 'Failed to update province. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $province = Province::find($id);

            if (empty($province)) {
                return back()->with('error_message', 'Province not found.');
            }

            $province->delete();

            return redirect()->route('application.province.index')->with('success_message', 'Successfully deleted province.');
        } catch (\Throwable $th) {
            return back()->with('error_message', 'Failed to delete province. Please try again.');
        }
    }
}
