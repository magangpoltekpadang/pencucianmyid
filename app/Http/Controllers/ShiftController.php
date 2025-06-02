<?php

namespace App\Http\Controllers;

use App\Models\Outlet\Outlet;
use App\Models\Shift\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all();
        return view('shift.index-shift', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shift.create',['outlets'=>Outlet::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shift_name' => 'required',
            'outlet_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'is_active' => 'nullable|in:1,0',


        ]);
        Shift::create($validated);
        return redirect('shifts');
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
        $shifts = Shift::findOrFail($id);
        $outlets = Outlet::all();
        return view('shift.edit', compact('shifts','outlets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shifts = Shift::findOrFail($id);
        $validated = $request->validate([
            'shift_name' => 'nullable|string',
            'outlet_id' => 'nullable|exists:outlets,outlet_id',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'is_active' => 'nullable|in:1,0',


        ]);

        $shifts->update($validated);
        return redirect('shifts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
