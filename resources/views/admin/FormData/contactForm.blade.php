@extends('admin.include.layout')
@section('heading', 'Contact Form')
@section('title', 'Contact Form List')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Contact Form Submissions</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Wedding Date</th>
                <th>Guests</th>
                <th>Location</th>
                <th>Budget</th>
                <th>Services</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone_number }}</td>
                    <td>{{ $contact->wedding_date }}</td>
                    <td>{{ $contact->expected_guests }}</td>
                    <td>{{ $contact->wedding_location }}</td>
                    <td>{{ $contact->budget_range }}</td>
                    <td>{{ $contact->services_needed }}</td>
                    <td>{{ $contact->additional_details }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No contact form submissions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
