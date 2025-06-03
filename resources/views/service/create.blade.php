@extends('layout.main')

@section('content')
    <div class="max-w-xl mx-auto px-4">
        <form action="/services" method="POST" class="max-w-xl mx-auto p-6 bg-white rounded shadow">
            @csrf

            <div class="mb-4">
                <h1 class="text-xl font-bold text-gray-900 mb-4">Input Data Service</h1>

                <!-- Service Name -->
                <label for="service_name" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Service
                    Name</label>
                <input type="text" name="service_name" id="service_name" autocomplete="service_name"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="service_name" value="{{ old('service_name') }}" required>
                @error('service_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Service Type ID -->
            <div class="mb-4">
                <label for="service_type_id" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Service
                    Type</label>
                <select name="service_type_id" id="service_type_id" autocomplete="service_type_id"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none">
                    <option value="">Pilih Service Type</option>
                    @foreach ($service_types as $service_type)
                        <option value="{{ $service_type->service_type_id }}">{{ $service_type->type_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Price</label>
                <input type="text" name="price" id="price" autocomplete="price"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="price" value="{{ old('price') }}" required>
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Duration -->
            <div class="mb-4">
                <label for="estimated_duration"
                    class="flex items-center mb-1 text-gray-600 text-sm font-medium">Duration</label>
                <input type="text" name="estimated_duration" id="estimated_duration" autocomplete="estimated_duration"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="estimated_duration" value="{{ old('estimated_duration') }}" required>
                @error('estimated_duration')
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
@endsection
