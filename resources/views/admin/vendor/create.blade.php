@extends('admin.include.layout')
@section('heading', 'Vendors')
@section('title', 'Add Vendors')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow rounded p-6 mt-6">
    <h1 class="text-2xl font-bold mb-4">Add Vendor</h1>

    

    @include('admin.include.error')
    <form action="{{ route('admin.vendors.store') }}" method="POST">
        @csrf

        {{-- Vendor main details --}}
        <h2 class="text-lg font-semibold mt-4 mb-4">Vendor Details</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <input type="text" name="name" placeholder="Vendor Name" class="border p-2 w-full" value="{{ old('name') }}">
            <input type="text" name="slug" placeholder="Slug" class="border p-2 w-full" value="{{ old('slug') }}">
            <input type="text" name="tagline" placeholder="Tagline" class="border p-2 w-full" value="{{ old('tagline') }}">

            <textarea name="description" placeholder="Description" class="border p-2 w-full md:col-span-3">{{ old('description') }}</textarea>

            <input type="number" name="years_experience" placeholder="Years Experience" class="border p-2 w-full" value="{{ old('years_experience') }}">
            <input type="number" name="starting_price" placeholder="Starting Price" class="border p-2 w-full" value="{{ old('starting_price') }}">
            <input type="number" step="0.1" name="rating_avg" placeholder="Average Rating" class="border p-2 w-full" value="{{ old('rating_avg') }}">

            <input type="number" name="total_clients" placeholder="Total Clients" class="border p-2 w-full" value="{{ old('total_clients') }}">
            <input type="text" name="base_city" placeholder="Base City" class="border p-2 w-full" value="{{ old('base_city') }}">
            <input type="text" name="base_state" placeholder="Base State" class="border p-2 w-full" value="{{ old('base_state') }}">

            <input type="text" name="service_area" placeholder="Service Area" class="border p-2 w-full" value="{{ old('service_area') }}">
            
            <label class="flex items-center space-x-2 col-span-1 md:col-span-3">
                <input type="checkbox" name="is_available_all_week" value="1" class="h-4 w-4" {{ old('is_available_all_week') ? 'checked' : '' }}>
                <span>Available all week</span>
            </label>

            <input type="text" name="type" placeholder="Vendor Type (e.g. band-baja, caterer)" class="border p-2 w-full" value="{{ old('type') }}">
            <input type="file" name="cover_image" class="border p-2 w-full">
            
            <textarea name="address" placeholder="Full Address" class="border p-2 w-full md:col-span-3">{{ old('address') }}</textarea>

            <label class="flex items-center space-x-2 col-span-1 md:col-span-3">
                <input type="checkbox" name="verified" value="1" class="h-4 w-4" {{ old('verified') ? 'checked' : '' }}>
                <span>Verified Vendor</span>
            </label>

            <select name="status" class="border p-2 w-full">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        {{-- Services --}}
        <h2 class="text-lg font-semibold mt-4 mb-2">Services</h2>
        <div id="services-container">
            @php $services = old('services', [['name' => '']]); @endphp
            @foreach($services as $i => $service)
                <div class="flex gap-2 mb-2">
                    <input type="text" name="services[{{ $i }}][name]" placeholder="Service Name" class="flex-1 border p-2" value="{{ $service['name'] }}">
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addService()" class="bg-blue-500 text-white px-3 py-1 rounded">+ Add Service</button>

        {{-- Portfolio --}}
        <h2 class="text-lg font-semibold mt-4 mb-2">Portfolio</h2>
        <div id="portfolio-container">
            {{-- Initial empty portfolio row --}}
            <div class="flex gap-2 mb-2">
                <input type="text" name="portfolio[0][title]" placeholder="Portfolio Title" class="flex-1 border p-2">
                <input type="file" name="portfolio[0][image]" class="flex-1 border p-2">
            </div>
        </div>
        <button type="button" onclick="addPortfolio()" class="bg-blue-500 text-white px-3 py-1 rounded">
            + Add Portfolio 
        </button>

        {{-- Reviews --}}
        <h2 class="text-lg font-semibold mt-4 mb-2">Reviews</h2>
        <div id="reviews-container">
            @php $reviews = old('reviews', [['client_name' => '', 'rating' => '', 'review_text' => '']]); @endphp
            @foreach($reviews as $i => $review)
                <div class="flex gap-2 mb-2">
                    <input type="text" name="reviews[{{ $i }}][client_name]" placeholder="Client Name" class="flex-1 border p-2" value="{{ $review['client_name'] }}">
                    <input type="number" step="0.1" name="reviews[{{ $i }}][rating]" placeholder="Rating" class="w-24 border p-2" value="{{ $review['rating'] }}">
                    <input type="text" name="reviews[{{ $i }}][review_text]" placeholder="Review" class="flex-1 border p-2" value="{{ $review['review_text'] }}">
                </div>
            @endforeach
        </div>
        <button type="button" onclick="addReview()" class="bg-blue-500 text-white px-3 py-1 rounded">+ Add Review</button>

        <div class="mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Vendor</button>
        </div>
    </form>
</div>


<script>
    // Track the counts based on old() values
    let serviceIndex = {{ count(old('services', [['name'=>'']])) }};
    let portfolioIndex = {{ count(old('portfolio', [['title'=>'','image'=>'']])) }};
    let reviewIndex = {{ count(old('reviews', [['client_name'=>'','rating'=>'','review_text'=>'']])) }};

    function addService() {
        let container = document.getElementById('services-container');
        let div = document.createElement('div');
        div.classList.add('flex', 'gap-2', 'mb-2');
        div.innerHTML = `
            <input type="text" name="services[${serviceIndex}][name]" placeholder="Service Name" class="flex-1 border p-2">
        `;
        container.appendChild(div);
        serviceIndex++;
    }

     function addPortfolio() {
        let container = document.getElementById('portfolio-container');
        let div = document.createElement('div');
        div.classList.add('flex','gap-2','mb-2');
        div.innerHTML = `
            <input type="text" name="portfolio[${portfolioIndex}][title]" placeholder="Portfolio Title" class="flex-1 border p-2">
            <input type="file" name="portfolio[${portfolioIndex}][image]" class="flex-1 border p-2">
        `;
        container.appendChild(div);
        portfolioIndex++;
    }

    function addReview() {
        let container = document.getElementById('reviews-container');
        let div = document.createElement('div');
        div.classList.add('flex', 'gap-2', 'mb-2');
        div.innerHTML = `
            <input type="text" name="reviews[${reviewIndex}][client_name]" placeholder="Client Name" class="flex-1 border p-2">
            <input type="number" step="0.1" name="reviews[${reviewIndex}][rating]" placeholder="Rating" class="w-24 border p-2">
            <input type="text" name="reviews[${reviewIndex}][review_text]" placeholder="Review" class="flex-1 border p-2">
        `;
        container.appendChild(div);
        reviewIndex++;
    }
</script>
@endsection
