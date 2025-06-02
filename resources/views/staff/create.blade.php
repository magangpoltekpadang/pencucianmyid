@extends('layout.main')

@section('content')
    <div class="max-w-xl mx-auto px-4">
        <form action="/staffs" method="POST" class="max-w-xl mx-auto p-6 bg-white rounded shadow">
            @csrf

            <div class="mb-4">
                <h1 class="text-xl font-bold text-gray-900 mb-4">Input Data Staff</h1>

                <!-- Type Name -->
                <label for="name" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" autocomplete="name"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="Name" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Email</label>
                <input type="text" name="email" id="email" autocomplete="email"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="email" value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Email -->
            <div class="mb-4">
                <label for="phone_number" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" autocomplete="phone_number"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="phone_number" value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_hash" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Phone Number</label>
                <input type="text" name="password_hash" id="password_hash"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="password_hash" value="{{ old('password_hash') }}" required>
                @error('password_hash')
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


            <!-- ROle ID -->
            <div class="mb-4">
                <label for="role_id" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Status</label>
                <select name="role_id" id="role_id" autocomplete="role_id"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none">
                    <option value="">Pilih Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                    @endforeach
                    </select>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="is_active" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Status</label>
                <select name="is_active" id="is_active" autocomplete="is_active"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none">
                    <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('is_active')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button
                class="w-fit px-6 h-12 bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 rounded-full shadow-xs text-white text-base font-semibold leading-6 mx-auto block">
                Submit
            </button>
        </form>
    </div>



    {{-- <form action="/vehicle-types" method="POST" class="max-w-xl mx-auto p-6 bg-white rounded shadow">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <div class="mb-4 border-b pb-2 pt-3 flex flex-wrap justify-between items-center">
                <h1 class="text-xl font-bold text-gray-900">Input Data Vehicle Type</h1>
            </div>
            <label for="name" class="block text-sm font-medium text-gray-700">Type Name</label>
            <input type="text" name="type_name" id="type_name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('type_name') }}">
            @error('type_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Code -->
        <div class="mb-4">
            <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
            <input type="text" name="code" id="code"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('code') }}">
            @error('code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="is_active" id="is_active"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            @error('is_active')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                Submit
            </button>
        </div>
    </form> --}}
@endsection
