<?php

namespace App\Http\Controllers;

use App\Models\Expense\Expense;
use App\Models\Outlet\Outlet;
use App\Models\Shift\Shift;
use App\Models\Staff\Staff;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('expense.index-expense', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expense.create', ['outlets'=>Outlet::all(), 'shifts'=>Shift::all(), 'staffs'=>Staff::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_code' => 'required',
            'outlet_id' => 'required',
            'expense_date' => 'required',
            'amount' => 'required',
            'category' => 'required',
            'description' => 'required',
            'shift_id' => 'required',
            'staff_id' => 'required',


        ]);
        Expense::create($validated);
        return redirect('expenses');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
