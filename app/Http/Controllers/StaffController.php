<?php

namespace App\Http\Controllers;

use App\Models\Outlet\Outlet;
use App\Models\Role\Role;
use App\Models\Staff\Staff;
use Hash;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::all();
        return view('staff.index-staff', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create',['outlets'=>Outlet::all(), 'roles'=>Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password_hash' => 'required',
            'outlet_id' => 'required',
            'role_id' => 'required',
            'is_active' => 'nullable|in:1,0',


        ]);
        Staff::create($validated);
        return redirect('staffs');
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
        $staffs = Staff::findOrFail($id);
        $outlets = Outlet::where('is_active', 1)->get();
        $roles = Role::all();
        return view('staff.edit', compact('staffs', 'outlets', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $staffs = Staff::findOrFail($id);

        $validated = $request->validate([
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
            'outlet_id' => 'nullable|exists:outlets,outlet_id',
            'role_id' => 'nullable|exists:roles,role_id',
            'is_active' => 'nullable|boolean',
        ]);

        if (!empty($validated['password'])) {
            $validated['password_hash'] = Hash::make($validated['password']);
        }
        unset($validated['password']);

        $staffs->update($validated);

        return redirect('staffs')->with('success', 'Staff updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
