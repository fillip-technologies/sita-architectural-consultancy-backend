@extends('admin.include.layout')

@section('heading', 'Edit SubCategory')
@section('title', 'Edit SubCategory')

@section('content')
    <div class="mx-auto bg-white shadow rounded p-6 mt-6">
        <h2 class="text-2xl font-bold mb-6">Edit SubCategory</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('update.subcate', $data->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Category Name --}}
            <div>
                <label for="category_id" class="block font-medium py-1">Category Name</label>
                <select name="category_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                    <option value="">Select Category</option>
                    @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ $data->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- SubCategory Name --}}
            <div>
                <label for="slug" class="block font-medium">SubCategory Name</label>
                <input type="text" name="name" id="slug" value="{{ old('name', $data->name) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-start">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Update SubCategory
                </button>
            </div>
        </form>
    </div>
@endsection
