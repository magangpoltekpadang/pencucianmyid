@extends('layout.main')

@section('content')
    <div class="max-w-xl mx-auto px-4">
        <form action="/expenses" method="POST" class="max-w-xl mx-auto p-6 bg-white rounded shadow">
            @csrf

            <div class="mb-4">
                <h1 class="text-xl font-bold text-gray-900 mb-4">Input Data Expense</h1>

                <!-- Expense Code -->
                <label for="expense_code" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Expense Code</label>
                <input type="text" name="expense_code" id="expense_code" autocomplete="expense_code"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="expense_code" value="{{ old('expense_code') }}" required>
                @error('expense_code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Outlet ID -->
            <div class="mb-4">
                <label for="outlet_id" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Outlet</label>
                <select name="outlet_id" id="outlet_id" autocomplete="outlet_id"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none">
                    <option value="">Pilih Outlet</option>
                    @foreach ($outlets as $outlet)
                        <option value="{{ $outlet->outlet_id }}">{{ $outlet->outlet_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- expense date -->
            <div class="mb-4">
                <label for="expense_date" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Expense Date</label>
                <input type="date" name="expense_date" id="expense_date" autocomplete="expense_date"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="expense_date" value="{{ old('expense_date') }}" required>
                @error('expense_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- AMount -->
            <div class="mb-4">
                <label for="amount" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Amount</label>
                <input type="text" name="amount" id="amount" autocomplete="amount"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="amount" value="{{ old('amount') }}" required>
                @error('amount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- category -->
            <div class="mb-4">
                <label for="category"
                    class="flex items-center mb-1 text-gray-600 text-sm font-medium">Category</label>
                <input type="text" name="category" id="category" autocomplete="category"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="category" value="{{ old('category') }}" required>
                @error('category')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="flex items-center mb-1 text-gray-600 text-sm font-medium">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="block w-full px-4 py-2.5 text-base leading-7 font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-2xl placeholder-gray-400 focus:outline-none resize-none"
                    placeholder="Write description..." required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


             <!-- Shift ID -->
            <div class="mb-4">
                <label for="shift_id" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Shift Id</label>
                <select name="shift_id" id="shift_id" autocomplete="shift_id"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none">
                    <option value="">Pilih Shift</option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->shift_id }}">{{ $shift->shift_name }}</option>
                    @endforeach
                </select>
            </div>

             <!-- Staff ID -->
            <div class="mb-4">
                <label for="staff_id" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Staff Id</label>
                <select name="staff_id" id="staff_id" autocomplete="staff_id"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none">
                    <option value="">Pilih Staff</option>
                    @foreach ($staffs as $staff)
                        <option value="{{ $staff->staff_id }}">{{ $staff->name }}</option>
                    @endforeach
                </select>
            </div>



            <!-- Submit Button -->
            <button
                class="w-fit px-6 h-12 bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 rounded-full shadow-xs text-white text-base font-semibold leading-6 mx-auto block">
                Submit
            </button>
        </form>
    </div>
@endsection
