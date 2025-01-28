<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::with('province')->paginate(10);

        return view('application.city.index', [
            'cities' => $cities,
            'active_page' => 'city',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::get();

        return view('application.city.create', [
            'provinces' => $provinces,
            'active_page' => 'city',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'province' => ['required', 'integer'],
            'place_code' => ['required', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ]);

        try {
            City::create([
                'name' => $request->name,
                'province_id' => $request->province,
                'place_code' => $request->place_code,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
    
            return redirect()->route('application.city.index')->with('success_message', 'Successfully created city,');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_message', 'Failed to store city.');
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $city = City::find($id);
        $provinces = Province::get();

        if (empty($city)) {
            return redirect()->back()->with('error_message', 'City not found.');
        }

        return view('application.city.show', [
            'city' => $city,
            'provinces' => $provinces,
            'active_page' => 'city',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'province' => ['required', 'integer'],
            'place_code' => ['required','string','max:255'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ]);

        try {
            $city = City::find($id);

            if (empty($city)) {
                return redirect()->back()->with('error_message', 'City not found.');
            }

            $city->update([
                'name' => $request->name,
                'province_id' => $request->province,
                'place_code' => $request->place_code,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            return redirect()->route('application.city.index')->with('success_message', 'Successfully updated city.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error_message', 'Failed to update city.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $city = City::find($id);

            if (empty($city)) {
                return redirect()->back()->with('error_message', 'City not found.');
            }

            $city->delete();
            
            return redirect()->route('application.city.index')->with('success_message', 'Successfully deleted city.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error_message', 'Failed to delete city.');
        }
    }
}
