<?php

namespace App\Http\Controllers;

use App\Models\VehicleTyp\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleTypes = VehicleType::all();
        return view('vehicles.index-vehicle-type', compact('vehicleTypes'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'is_active' => 'nullable|in:1,0',


        ]);
        VehicleType::create($validated);
        return redirect('vehicle-types');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('vehicles.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'type_name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'is_active' => 'nullable|in:1,0',

        ]);
        VehicleType::where('vehicle_type_id', $id)->update($validated);
        return redirect('vehicle-types');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicleType = VehicleType::findOrFail($id);
        $vehicleType->delete();
        // VehicleType::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
