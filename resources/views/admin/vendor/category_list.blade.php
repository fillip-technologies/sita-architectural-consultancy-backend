@extends('admin.include.layout')
@section('heading', 'Categories')
@section('title', 'Categories List')

@section('content')
    <div class="max-w-6xl mx-auto bg-white shadow rounded p-6 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Categories</h1>
            <a href="{{ route('category') }}" class="bg-green-600 text-white px-4 py-2 rounded">
                + Add Category
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
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Slug</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $index = 1; @endphp
                    @forelse($cate_list as $category)
                        <tr>
                            <td class="border px-4 py-2">{{ $index++ }}</td>
                            <td class="border px-4 py-2">{{ $category->name }}</td>
                            <td class="border px-4 py-2">{{ $category->slug }}</td>
                            <td class="border px-4 py-2">{{ $category->description }}</td>
                            <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('category.edit',$category->id) }}"
                                    class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>

                                <form action="{{ route('category.delete',$category->id) }}"
                                      method="POST"
                                      class="inline"
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
                            <td colspan="5" class="text-center p-4">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $cate_list->links() }}
        </div>
    </div>
@endsection
