@extends('admin.include.layout')

@section('heading', 'Coupons')
@section('title', 'Add Coupans')

@section('content')
<div class=" mx-auto bg-white shadow rounded p-6 mt-6">
    <h2 class="text-2xl font-bold mb-6">Add New Coupon</h2>

    {{-- Success Message --}}
    @if(session('coupons'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('coupons') }}
        </div>
    @endif

    <form action="{{ route('admin.coupons.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="code" class="block font-medium">Coupons</label>
            <input type="text" name="code"  value="{{ old('	code') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" >
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="slug" class="block font-medium">Value</label>
            <input type="number" name="value" id="slug" value="{{ old('value') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            @error('value') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="slug" class="block font-medium">Type</label>
            <input type="text" name="type" id="slug" value="{{ old('value') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            @error('type') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

          <div>
            <label for="slug" class="block font-medium">Expire date</label>
            <input type="datetime-local" name="expires_at" id="slug" value="{{ old('expires_at') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            @error('expires_at') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                + Add Coupon
            </button>
        </div>
    </form>
</div>
@endsection
