@extends('admin.include.layout')

@section('heading', 'Categories')
@section('title', 'Add Category')

@section('content')
<div class=" mx-auto bg-white shadow rounded p-6 mt-6">
    <h2 class="text-2xl font-bold mb-6">Update Category</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Category Name --}}
        <div>
            <label for="name" class="block font-medium">Category Name</label>
            <input type="text" name="name" id="name" value="{{ old('name',$category->name) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring" >
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Slug --}}
        <div>
            <label for="slug" class="block font-medium">Category Images</label>
            <input type="file" name="cat_images" id="slug" value="{{ old('cat_images',$category->cat_images) }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
            @error('cat_images') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            <img src="{{ asset($category->cat_images) }}" alt="" width="100px" class="mt-2">
        </div>



        {{-- Submit --}}
        <div class="flex justify-start">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                + Update Category
            </button>
        </div>
    </form>
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
