@extends('admin.include.layout')

@section('heading', 'Banners')
@section('title', 'Add Banners')

@section('content')
    <div class=" mx-auto bg-white shadow rounded p-6 mt-6">
        <h2 class="text-2xl font-bold mb-6">Add New Banners</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block font-medium">Section Name</label>
                <input type="text" name="section_name" id="name" value="{{ old('section_name') }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                @error('section_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="slug" class="block font-medium">Section type</label>
                <input type="text" name="section_type" id="slug" value="{{ old('section_type') }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                @error('section_type')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="images" class="block font-medium">Images</label>
                <input type="file" name="images[]" multiple accept="image/*"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">

                @error('images')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-start">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                    + Add Banner
                </button>
            </div>
        </form>
    </div>

@endsection
