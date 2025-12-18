@extends('admin.include.layout')

@section('heading', 'Shipping')
@section('title', 'Add Shipping')

@section('content')
    <div class=" mx-auto bg-white shadow rounded p-6 mt-6">
        <h2 class="text-2xl font-bold mb-6">Add New Shipping</h2>

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

        <form action="{{ route('admin.shipping.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Order ID --}}
            <div>
                <label for="order_id" class="block font-medium">Oredr ID</label>

                <select name="order_id" id="status" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                    <option value="">-- Select Oredr ID --</option>
                    @foreach ($order as $orderid)
                        <option value="{{ $orderid->id }}">{{ $orderid->id }}</option>
                    @endforeach

                </select>


            </div>

            {{-- Courier Name --}}
            <div>
                <label for="courier_name" class="block font-medium">Courier Name</label>
                <input type="text" name="courier_name" id="courier_name" value="{{ old('courier_name') }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                @error('courier_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tracking Number --}}
            <div>
                <label for="tracking_number" class="block font-medium">Tracking Number</label>
                <input type="text" name="tracking_number" id="tracking_number" value="{{ old('tracking_number') }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                @error('tracking_number')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Shipped At --}}
            <div>
                <label for="shipped_at" class="block font-medium">Shipped At</label>
                <input type="datetime-local" name="shipped_at" id="shipped_at" value="{{ old('shipped_at') }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                @error('shipped_at')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Delivered At --}}
            <div>
                <label for="delivered_at" class="block font-medium">Delivered At</label>
                <input type="datetime-local" name="delivered_at" id="delivered_at" value="{{ old('delivered_at') }}"
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
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="shipped" {{ old('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="flex justify-start">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                    + Add Shipping
                </button>
            </div>
        </form>
    </div>
@endsection
