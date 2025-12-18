@extends('admin.include.layout')
@section('heading', 'Categories')
@section('title', 'Categories List')

@section('content')
    <div class=" mx-auto bg-white shadow rounded p-6 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Shipping List</h1>
            <a href="{{ url('shipping') }}" class="bg-green-600 text-white px-4 py-2 rounded">
                + Add Shipping
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">OrderId</th>
                        <th class="border px-4 py-2">Customer Name</th>
                        <th class="border px-4 py-2">Courier Name</th>
                        <th class="border px-4 py-2">Tracking Number</th>
                        <th class="border px-4 py-2">Shipped_at</th>
                        <th class="border px-4 py-2">Delivered_at</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $index = 1; @endphp
                    @forelse($shipping_list as $shippings)
                        <tr>
                            @php
                                $shipping_user_id = $shippings->order->user_id;
                                $userData = App\Models\User::where('id', $shipping_user_id)->first();
                            @endphp
                            <td class="border px-4 py-2">{{ $index++ }}</td>
                            <td class="border px-4 py-2">{{ $shippings->order_id }}</td>
                            <td class="border px-4 py-2">{{ $userData->name }}</td>
                            <td class="border px-4 py-2">{{ $shippings->courier_name }}</td>
                            <td class="border px-4 py-2">{{ $shippings->tracking_number }}</td>
                            <td class="border px-4 py-2">
                                {{ \Carbon\Carbon::parse($shippings->shipped_at)->format('d M Y H:i') }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ \Carbon\Carbon::parse($shippings->delivered_at)->format('d M Y H:i') }}</td>
                            <td class="border px-4 py-2">{{ $shippings->status }}</td>
                            <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('shipping.edit', $shippings->id) }}"
                                    class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>

                                <form action="{{ route('delete_shipping', $shippings->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                            <td colspan="9" class="text-center p-4">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $shipping_list->links() }}
        </div>
    </div>
@endsection
