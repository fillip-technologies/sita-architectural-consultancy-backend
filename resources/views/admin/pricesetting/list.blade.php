@extends('admin.include.layout')
@section('heading', 'Products')
@section('title', 'Products List')

@section('content')
    <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-2xl p-8 mt-8 border border-gray-100">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-3 sm:mb-0">Products Price List</h1>
            <a href="{{ url('price/create') }}"
                class="inline-flex items-center bg-gradient-to-r from-green-500 to-emerald-400 text-white font-medium px-5 py-2.5 rounded-lg shadow hover:opacity-90 transition">
                <span class="text-lg mr-1">+</span> Add Product Price
            </a>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('sms'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-3 rounded mb-4">
                {{ session('sms') }}
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-50 uppercase text-gray-700 font-semibold">
                    <tr>
                        <th class="px-5 py-3 border-b">#</th>
                        <th class="px-5 py-3 border-b">Product Name</th>
                        <th class="px-5 py-3 border-b">Purity</th>
                        <th class="px-5 py-3 border-b">Rating</th>
                        <th class="px-5 py-3 border-b">Making Charges</th>
                        <th class="px-5 py-3 border-b">GST (Amounts)</th>
                        <th class="px-5 py-3 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prices as $data)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 border-b">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 border-b font-medium">{{ $data->name }}</td>
                            <td class="px-5 py-3 border-b">{{ $data->purity }}</td>
                            <td class="px-5 py-3 border-b">₹{{ $data->price }}</td>
                            <td class="px-5 py-3 border-b">₹{{ $data->making_charges }}</td>
                            <td class="px-5 py-3 border-b">{{ $data->gst }}%</td>
                            <td class="px-5 py-3 border-b text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('price.edit',$data->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium px-3 py-1.5 rounded transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('price.delete',$data->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white text-xs font-medium px-3 py-1.5 rounded transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-end">
            {{ $prices->links() }}
        </div>
    </div>
@endsection
