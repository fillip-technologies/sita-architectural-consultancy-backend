@extends('admin.include.layout')
@section('heading', 'Vendor Registration')
@section('title', 'Vendor Registration List')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Vendors List</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Business Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Category</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vendors as $vendor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $vendor->business_name }}</td>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ $vendor->mobile_number }}</td>
                    <td>{{ $vendor->category }}</td>
                    <td>{{ $vendor->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No vendors found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
