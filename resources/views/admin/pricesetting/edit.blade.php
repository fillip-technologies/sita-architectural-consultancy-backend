@extends('admin.include.layout')

@section('heading', 'Products')
@section('title', 'Edit Product')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-8 border border-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Product Price</h2>
        <a href="{{ url('price') }}"
           class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
           ← Back to List
        </a>
    </div>

    <form action="{{ route('price.update', $editId->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT') {{-- Important for update --}}

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Product Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $editId->name) }}"
                       class="w-full border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 rounded-lg p-2.5 outline-none transition">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Purity -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Purity</label>
                <select name="purity"
                        class="w-full border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 rounded-lg p-2.5 outline-none transition">
                    <option value="">-- Select Purity --</option>
                    <option value="24k" {{ old('purity', $editId->purity) == '24k' ? 'selected' : '' }}>24K</option>
                    <option value="22k" {{ old('purity', $editId->purity) == '22k' ? 'selected' : '' }}>22K</option>
                    <option value="18k" {{ old('purity', $editId->purity) == '18k' ? 'selected' : '' }}>18K</option>
                </select>
                @error('purity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Price (per gram)</label>
                <input type="number"
                       step="0.01"
                       name="price"
                       value="{{ old('price', $editId->price) }}"
                       class="w-full border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 rounded-lg p-2.5 outline-none transition">
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Making Charges</label>
                <input type="number"
                       step="0.01"
                       name="making_charges"
                       value="{{ old('making_charges', $editId->making_charges) }}"
                       class="w-full border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 rounded-lg p-2.5 outline-none transition">
                @error('making_charges')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">GST (%)</label>
                <input type="number"
                       step="0.01"
                       name="gst"
                       value="{{ old('gst', $editId->gst) }}"
                       class="w-full border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 rounded-lg p-2.5 outline-none transition">
                @error('gst')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        
        <div class="flex justify-end pt-4">
            <button type="submit"
                    class="bg-gradient-to-r from-pink-500 to-rose-400 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:opacity-90 transition">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection
