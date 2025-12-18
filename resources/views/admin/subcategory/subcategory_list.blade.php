@extends('admin.include.layout')
@section('heading', 'SubCategories')
@section('title', 'SubCategories List')

@section('content')
<div class="mx-auto bg-white shadow rounded p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">SubCategories</h1>
        <a href="{{ url('admin/subcat') }}" class="bg-green-600 text-white px-4 py-2 rounded">
            + Add SubCategory
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto text-center">
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Category Name</th>
                    <th class="border px-4 py-2">Sub Category</th>
                    <th class="border px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @php $index = 1; @endphp

                @forelse($data_sub as $categoryId => $subcats)
                    {{-- Category Group Heading --}}
                    <tr class="bg-gray-200">
                        <td colspan="4" class="text-left px-4 py-2 font-bold text-lg">
                            {{ $subcats->first()->category->name }}
                        </td>
                    </tr>

                    {{-- Subcategories under each category --}}
                    @foreach($subcats as $subcategory)
                        <tr>
                            <td class="border px-4 py-2">{{ $index++ }}</td>
                            <td class="border px-4 py-2">{{ $subcategory->category->name }}</td>
                            <td class="border px-4 py-2">{{ $subcategory->name }}</td>

                            <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('edit.subcate', $subcategory->id) }}"
                                   class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>

                                <form action="{{ route('delete.subcate', $subcategory->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this subcategory?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">No categories found.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>

{{-- Swal Alerts --}}
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
        timer: 2500,
        timerProgressBar: true,
        showConfirmButton: false
    });
</script>
@endif

@endsection
