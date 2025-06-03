<?php

namespace App\Http\Controllers;

use App\Models\Outlet\Outlet;
use App\Models\Service\Service;
use App\Models\ServiceType\ServiceType;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('service.index-service', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service.create', ['outlets' => Outlet::all(), 'service_types' => ServiceType::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required',
            'service_type_id' => 'required',
            'price' => 'required',
            'estimated_duration' => 'required',
            'description' => 'required',
            'outlet_id' => 'required',
            'is_active' => 'nullable|in:1,0',


        ]);
        Service::create($validated);
        return redirect('services');
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
        $services = Service::findOrFail($id);
        $outlets = Outlet::all();
        $service_types = ServiceType::all();
        return view('service.edit', compact('services', 'outlets','service_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $services = Service::findOrFail($id);
        $validated = $request->validate([
            'service_name' => 'required',
            'service_type_id' => 'required',
            'price' => 'required',
            'estimated_duration' => 'required',
            'description' => 'required',
            'outlet_id' => 'required',
            'is_active' => 'nullable|in:1,0',


        ]);

        $services->update($validated);
        return redirect('services');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
