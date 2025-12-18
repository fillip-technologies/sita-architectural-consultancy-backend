@extends('admin.include.layout')
@section('heading', 'Banners')
@section('title', 'banners List')

@section('content')
    <div class=" mx-auto bg-white shadow rounded p-6 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Banners</h1>
            <a href="{{ route('banner') }}" class="bg-green-600 text-white px-4 py-2 rounded">
                + Add Banners
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
                        <th class="border px-4 py-2">Section Name</th>
                        <th class="border px-4 py-2">Section Type</th>
                        <th class="border px-4 py-2">Images</th>
                        <th class="border px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $index = 1; @endphp
                    @forelse($banner as $b)


                        <tr>
                            <td class="border px-4 py-2">{{ $index++ }}</td>
                            <td class="border px-4 py-2">{{ $b->section_name }}</td>
                            <td class="border px-4 py-2">{{ $b->section_type }}</td>
                            <td class="border px-4 py-2 flex">
                               @foreach ($b->images as $images)
                               <img src="{{ asset($images) }}" alt="{{ $b->section_name }}" width="80px" class="m-2 ">
                               @endforeach
                            </td>
                            <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('banner.edit',$b->id) }}"
                                    class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>

                                <form action="{{ route('banner.delete',$b->id) }}"
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
                            <td colspan="5" class="text-center p-4">No Banners found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $banner->links() }}
        </div>
    </div>
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
    @elseif ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `
                <ul style="text-align:center; color:red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
                confirmButtonText: 'Ok'
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Errors',
                text: "{{ session('error') }}"
                timer: 2500,
                timerProgressBar: true,
                showConfirmButton: false
            });
        </script>
    @endif
@endsection
