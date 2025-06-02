@extends('layout.main')

@section('content')
    <form action="{{ ('vehicle-types/' . $vehicle_types->vehicle_type_id) }}" method="POST" class="max-w-xl mx-auto p-6 bg-white rounded shadow">
        @method('PUT')
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <div class="mb-4 border-b pb-2 pt-3 flex flex-wrap justify-between items-center">
                <h1 class="text-xl font-bold text-gray-900">Edit Data Vehicle Type</h1>
            </div>
            <label for="name" class="block text-sm font-medium text-gray-700">Type Name</label>
            <input type="text" name="type_name" id="type_name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('type_name', $vehicle_types->type_name) }}">
            @error('type_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Code -->
        <div class="mb-4">
            <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
            <input type="text" name="code" id="code"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('code', $vehicle_types->code) }}">
            @error('code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $vehicle_types->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="is_active" id="is_active"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="1" {{ $vehicle_types->is_active == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $vehicle_types->is_active == 1 ? 'selected' : '' }}>Inactive</option>
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
    </form>
@endsection
