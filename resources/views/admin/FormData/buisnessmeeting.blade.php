@extends('admin.include.layout')
@section('heading', 'Buisness Meeting')
@section('title', 'Buisness Meeting List')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Meetings</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Event Date</th>
                <th>Guests</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @forelse($meetings as $meeting)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($meeting->event_date)->format('d-m-Y') }}</td>
                    <td>{{ $meeting->guest_count }}</td>
                    <td>{{ $meeting->contact_number }}</td>
                    <td>{{ $meeting->email }}</td>
                    <td>{{ $meeting->remarks }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No meetings found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
