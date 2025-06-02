@extends('layout.main')

@section('content')
    <div class="max-w-xl mx-auto px-4">
        <form action="{{ url('shifts/' . $shifts->shift_id) }}" method="POST"
            class="max-w-xl mx-auto p-6 bg-white rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <h1 class="text-xl font-bold text-gray-900 mb-4">Tambah Data Shift</h1>

                <!-- Type Name -->
                <label for="shift_name" class="flex items-center mb-1 text-gray-600 text-sm font-medium"> Shift Name</label>
                <input type="text" name="shift_name" id="shift_name" autocomplete="shift_name"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="shift name" value="{{ old('shift_name', $shifts->shift_name) }}" required>
                @error('shift_name')
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
                        <option value="{{ $outlet->outlet_id }}" {{ $shifts->outlet_id == $outlet->outlet_id ? 'selected' : '' }}>
                        {{ $outlet->outlet_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Start Time -->
            <div class="mb-4">
                <label for="start_time" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Start Time</label>
                <input type="time" step="1" name="start_time" id="start_time"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="start_time" value="{{ old('start_time', $shifts->start_time) }}" required>
                @error('start_time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>



            <!-- End Time -->
            <div class="mb-4">
                <label for="end_time" class="flex items-center mb-1 text-gray-600 text-sm font-medium">End Time</label>
                <input type="time" step="1" name="end_time" id="end_time"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    placeholder="end_time" value="{{ old('end_time', $shifts->end_time) }}" required>
                @error('end_time')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="is_active" class="flex items-center mb-1 text-gray-600 text-sm font-medium">Status</label>
                <select name="is_active" id="is_active" autocomplete="is_active"
                    class="block w-full h-11 px-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-full focus:outline-none">
                    <option value="1" {{ $shifts->is_active == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $shifts->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('is_active')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button
                class="w-fit px-6 h-12 bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 rounded-full shadow-xs text-white text-base font-semibold leading-6 mx-auto block">
                Update
            </button>
        </form>
    </div>
@endsection
