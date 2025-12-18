@extends('admin.include.layout')

@section('heading', 'Shipping')
@section('title', 'Add/Edit Shipping')

@section('content')
<div class=" mx-auto bg-white shadow rounded p-6 mt-6">
    <h2 class="text-2xl font-bold mb-6">Edit Shipping</h2>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('shipping.update', $shippings->id) }}" method="POST" class="space-y-4">
        @csrf


        <div>
            <label for="order_id" class="block font-medium">Order ID</label>
            <select name="order_id" id="order_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                @foreach ($editShip as $orderShip)
                    <option value="{{ $orderShip->order->id }}"
                        {{ old('order_id', $shippings->order_id ?? '') == $orderShip->order->id ? 'selected' : '' }}>
                        {{ $orderShip->order->id }}
                    </option>
                @endforeach
            </select>
            @error('order_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Courier Name --}}
        <div>
            <label for="courier_name" class="block font-medium">Courier Name</label>
            <input type="text" name="courier_name" id="courier_name"
                   value="{{ old('courier_name', $shippings->courier_name ?? '') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            @error('courier_name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tracking Number --}}
        <div>
            <label for="tracking_number" class="block font-medium">Tracking Number</label>
            <input type="text" name="tracking_number" id="tracking_number"
                   value="{{ old('tracking_number', $shippings->tracking_number ?? '') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            @error('tracking_number')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Shipped At --}}
        <div>
            <label for="shipped_at" class="block font-medium">Shipped At</label>
            <input type="datetime-local" name="shipped_at" id="shipped_at"
                   value="{{ old('shipped_at', $shippings->shipped_at ? \Carbon\Carbon::parse($shippings->shipped_at)->format('Y-m-d\TH:i') : '') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            @error('shipped_at')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Delivered At --}}
        <div>
            <label for="delivered_at" class="block font-medium">Delivered At</label>
            <input type="datetime-local" name="delivered_at" id="delivered_at"
                   value="{{ old('delivered_at', $shippings->delivered_at ? \Carbon\Carbon::parse($shippings->delivered_at)->format('Y-m-d\TH:i') : '') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            @error('delivered_at')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block font-medium">Delivered Status</label>
            <select name="status" id="status" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                <option value="">-- Select Status --</option>
                <option value="pending" {{ old('status', $shippings->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="shipped" {{ old('status', $shippings->status ?? '') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="delivered" {{ old('status', $shippings->status ?? '') == 'delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
              Update
            </button>
        </div>
    </form>
</div>
@endsection
