<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $villages = Village::paginate(10);
        return view('application.village.index', [
            'active_page' => 'village',
            'villages' => $villages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::get();
        $cities = City::get();
        $districts = District::get();

        return view('application.village.create', [
            'active_page' => 'village',
            'provinces' => $provinces,
            'cities' => $cities,
            'districts' => $districts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'province' => 'required|integer',
            'city' => 'required|integer',
            'district' => 'required|integer',
            'place_code' => 'required|integer',
            'latitude' => 'nullable|max:255',
            'longitude' => 'nullable|max:255',
        ]);

        try {
            Village::create([
                'name' => $request->name,
                'province_id' => $request->province,
                'city_id' => $request->city,
                'district_id' => $request->district,
                'place_code' => $request->place_code,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            return redirect()->route('application.village.index')->with('success_message', 'Successfully created village.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_message', 'Fail when created village.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $village = Village::find($id);
        $provinces = Province::get();
        $cities = City::get();
        $districts = District::get();

        return view('application.village.show', [
            'active_page' => 'village',
            'village' => $village,
            'provinces' => $provinces,
            'cities' => $cities,
            'districts' => $districts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Village $village)
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
            'province' => 'required|integer',
            'city' => 'required|integer',
            'district' => 'required|integer',
            'place_code' => 'required|integer',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ]);

        try {
            $village = Village::find($id);
            
            if (empty($village)) {
                return redirect()->back()->with('error_message', 'Village not found.');
            }

            $village->update([
                'name' => $request->name,
                'province_id' => $request->province,
                'city_id' => $request->city,
                'district_id' => $request->district,
                'place_code' => $request->place_code,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            return redirect()->route('application.village.index')->with('success_message', 'Successfully updated village.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_message', 'Fail when updated village.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $village = Village::find($id);

            if (empty($village)) {
                return redirect()->route('application.village.index')->with('error_message', 'Village not found.');
            }

            $village->delete();

            return redirect()->route('application.village.index')->with('success_message', 'Successfully deleted village.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_message', 'Fail when deleted village.');
        }
    }
}
