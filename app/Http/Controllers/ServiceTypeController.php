<?php

namespace App\Http\Controllers;

use App\Models\ServiceType\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $serviceTypes = ServiceType::all();
        return view('service-types.index-service-type', compact('serviceTypes'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service-types.create');
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
        ServiceType::create($validated);
        return redirect('service-types');
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
        return view('service-types.edit');
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
        ServiceType::where('service_type_id', $id)->update($validated);
        return redirect('service-types');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
