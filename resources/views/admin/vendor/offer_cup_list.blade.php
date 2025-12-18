@extends('admin.include.layout')
@section('heading', 'Coupons List')
@section('title', 'Coupons List')

@section('content')
    <div class=" mx-auto bg-white shadow rounded p-6 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Coupons</h1>
            <a href="{{ url('offer') }}" class="bg-green-600 text-white px-4 py-2 rounded">
                + Add Coupons
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
                        <th class="border px-4 py-2">Code</th>
                        <th class="border px-4 py-2">Value</th>
                        <th class="border px-4 py-2">Type</th>
                        <th class="border px-4 py-2">Expire date</th>
                        {{-- <th class="border px-4 py-2 text-center">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @php $index = 1; @endphp
                    @forelse($cupon as $cp)
                        <tr>
                            <td class="border px-4 py-2">{{ $index++ }}</td>
                            <td class="border px-4 py-2">{{ $cp->code }}</td>
                            <td class="border px-4 py-2">{{ $cp->value }}</td>
                            <td class="border px-4 py-2">{{ $cp->type }}</td>
                            <td class="border px-4 py-2">{{ $cp->expires_at }}</td>
                            {{-- <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('category.edit',$cp->id) }}"
                                    class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>

                                <form action="{{ route('category.delete',$cp->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $cupon->links() }}
        </div>
    </div>
@endsection
