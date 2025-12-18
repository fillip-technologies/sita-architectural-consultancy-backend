@extends('admin.include.layout')
@section('heading', 'Venues')
@section('title', 'Venues List')
@section('content')
<div class="container">
    <!-- <h1>Venues</h1> -->
   <a href="{{ route('admin.venue.add') }}" 
   class="inline-block mb-3 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
   Add New Venue
</a>

    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Rating</th>
                <th>Spaces</th>
                <th>Images</th>
                <th>Cuisines</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venues as $venue)
            <tr>
                <td>{{ $venue->name }}</td>
                <td>{{ $venue->city }}</td>
                <td>{{ $venue->rating }}</td>
                <td>{{ $venue->spaces_count }}</td>
                <td>{{ $venue->images_count }}</td>
                <td>{{ $venue->cuisines_count }}</td>
                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('admin.venue.edit', $venue->id) }}" 
                       class="px-3 py-1 text-white bg-yellow-500 hover:bg-yellow-600 rounded-md text-sm">
                        Edit
                    </a>
                    <form action="{{ route('admin.venue.destroy', $venue->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Are you sure?')" 
                                class="px-3 py-1 text-white bg-red-500 hover:bg-red-600 rounded-md text-sm">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $venues->links() }}
</div>
@endsection
