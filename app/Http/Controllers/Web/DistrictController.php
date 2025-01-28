<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::paginate(10);
        return view('application.district.index', [
            'active_page' => 'district',
            'districts' => $districts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::get();
        $cities = City::get();

        return view('application.district.create', [
            'active_page' => 'district',
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'province' =>'required',
            'city' =>'required',
            'place_code' => 'required|integer',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ]);

        try {
            District::create([
                'name' => $request->name,
                'province_id' => $request->province,
                'city_id' => $request->city,
                'place_code' => $request->place_code,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
            ]);
    
            return redirect()->route('application.district.index')->with('success_message', 'Successfully created district.');
        } catch (\Throwable $th) {
            return redirect()->route('application.district.index')->with('error_message', 'Fail when create district.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $district = District::find($id);
        $provinces = Province::get();
        $cities = City::get();

        return view('application.district.show', [
            'active_page' => 'district',
            'district' => $district,
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>'required',
            'province' =>'required',
            'city' =>'required',
            'place_code' => 'required|integer',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
        ]);

        try {
            $district = District::find($id);

            if (empty($district)) {
                return redirect()->route('application.district.index')->with('error_message', 'District not found.');
            }

            $district->update([
                'name' => $request->name,
                'province_id' => $request->province,
                'city_id' => $request->city,
                'place_code' => $request->place_code,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
            ]);

            return redirect()->route('application.district.index')->with('success_message', 'Successfully updated district.');
        } catch (\Throwable $th) {
            return redirect()->route('application.district.index')->with('error_message', 'Fail when update district.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $district = District::find($id);

            if (empty($district)) {
                return redirect()->back()->with('error_message', 'District not found.');
            }

            $district->delete();

            return redirect()->route('application.district.index')->with('success_message', 'Successfully deleted district.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_message', 'Fail when delete district.');
        }
    }
}
