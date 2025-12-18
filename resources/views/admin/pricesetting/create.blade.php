@extends('admin.include.layout')

@section('heading', 'Products')
@section('title', 'Add Product')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-8 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Add Product Price</h2>
        </div>

        <form action="{{ route('price.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Product Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 rounded-lg p-2.5 outline-none transition">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- GST -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">GST (Amount)</label>
                    <input type="number" name="gst" value="{{ old('gst') }}"
                        class="w-full border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 rounded-lg p-2.5 outline-none transition">
                    @error('gst')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Price</label>
                    <input type="number" name="price" value="{{ old('price') }}"
                        class="w-full border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 rounded-lg p-2.5 outline-none transition">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Making Charges -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Making Charges</label>
                    <input type="number" name="making_charges" value="{{ old('making_charges') }}"
                        class="w-full border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 rounded-lg p-2.5 outline-none transition">
                    @error('making_charges')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- <!-- Purity -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Purity</label>
                    <input type="text" name="purity[]" placeholder="e.g. 22K"
                        class="w-full border border-gray-300 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 rounded-lg p-2.5 outline-none transition">
                    @error('purity')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <button type="button" class="bg-blue-600 text-white px-3 py-1 mt-3 rounded text-sm" id="addpurity">Add
                        Purity</button>
                </div> --}}


            </div>

            <!-- Submit -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="bg-gradient-to-r from-pink-500 to-rose-400 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md hover:opacity-90 transition">
                    Save Product
                </button>
            </div>
        </form>
    </div>

@endsection
