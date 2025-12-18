@extends('admin.include.layout')
@section('heading', 'Products')
@section('title', 'Products List')

@section('content')
    <div class="mx-auto bg-white shadow rounded p-6 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Products</h1>
            <a href="{{ route('admin.venue.add') }}" class="bg-green-600 text-white px-4 py-2 rounded">
                + Add Product
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('sms'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('sms') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Image</th>
                        <th class="border px-4 py-2">Category</th>
                        <th class="border px-4 py-2">Price</th>
                        <th class="border px-4 py-2">Stock</th>
                        <th class="border px-4 py-2">Variants</th>
                        <th class="border px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $index = 1; @endphp
                    @forelse($products as $product)
                        <tr>
                            <td class="border px-4 py-2">{{ $index++ }}</td>
                            <td class="border px-4 py-2">{{ $product->name }}</td>
                            <td class="border px-4 py-2">
                                @if ($product->image && file_exists(public_path($product->image)))
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                        class="h-12 w-12 object-cover rounded">
                                @else
                                    <span class="text-gray-500 italic">No Image</span>
                                @endif
                            </td>

                            <td class="border px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $product->price }}</td>
                            <td class="border px-4 py-2">{{ $product->stock }}</td>
                            <td class="border px-4 py-2">{{ $product->variants->count() }}</td>
                            <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('product.edit', $product->id) }}"
                                    class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>

                                <form action="{{ route('product.delete', $product->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-4">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
