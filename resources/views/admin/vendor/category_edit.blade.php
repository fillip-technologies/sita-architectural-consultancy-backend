@extends('admin.include.layout')

@section('heading', 'Categories')
@section('title', 'Add Category')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded p-6 mt-6">
    <h2 class="text-2xl font-bold mb-6">Add New Category</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Category Name --}}
        <div>
            <label for="name" class="block font-medium">Category Name</label>
            <input type="text" name="name" id="name" value="{{ old('name',$category->name) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" >
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Slug --}}
        <div>
            <label for="slug" class="block font-medium">Slug (optional)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug',$category->slug) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            @error('slug') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block font-medium">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">{{ old('description',$category->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Submit --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                + Update Category
            </button>
        </div>
    </form>
</div>
@endsection
