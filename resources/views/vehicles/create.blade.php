@extends('layout.main')

@section('content')
    <div class="max-w-xl mx-auto px-4">
    <form action="/vehicle-types" method="POST" class="max-w-xl mx-auto p-6 bg-white rounded shadow">
        @csrf

        <div class="mb-4">
            <h1 class="text-xl font-bold text-gray-900 mb-4">Input Data Vehicle Type</h1>

            <!-- Type Name -->
            <label class="flex items-center mb-1 text-gray-600 text-sm font-medium">Type Name
                <svg width="7" height="7" class="ml-1" viewBox="0 0 7 7" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="..." fill="#EF4444" />
                </svg>
            </label>
            <input type="text" name="type_name" id="type_name"
                class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                placeholder="Type Name" value="{{ old('type_name') }}" required>
            @error('type_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Code -->
        <div class="mb-4">
            <label class="flex items-center mb-1 text-gray-600 text-sm font-medium">Code</label>
            <input type="text" name="code" id="code"
                class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                placeholder="Code" value="{{ old('code') }}" required>
            @error('code')
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

        <!-- Status -->
        <div class="mb-4">
            <label class="flex items-center mb-1 text-gray-600 text-sm font-medium">Status</label>
            <select name="is_active" id="is_active"
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
