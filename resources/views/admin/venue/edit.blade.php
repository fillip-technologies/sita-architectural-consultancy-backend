@extends('admin.include.layout')
@section('heading', 'Venues')
@section('title', 'Edit Venue')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Edit Venue</h2>

    <form action="{{ route('admin.product.update', $venue->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Venue Basic Details --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Venue Name</label>
                <input type="text" name="name" value="{{ old('name', $venue->name) }}" class="w-full border p-2" required>
            </div>
            <div>
                <label class="block mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location', $venue->location) }}" class="w-full border p-2" required>
            </div>
            <div>
                <label class="block mb-1">City</label>
                <input type="text" name="city" value="{{ old('city', $venue->city) }}" class="w-full border p-2">
            </div>
            <div>
                <label class="block mb-1">State</label>
                <input type="text" name="state" value="{{ old('state', $venue->state) }}" class="w-full border p-2">
            </div>
            <div>
                <label class="block mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $venue->phone) }}" class="w-full border p-2">
            </div>
            <div>
                <label class="block mb-1">Rating</label>
                <input type="number" step="0.1" name="rating" value="{{ old('rating', $venue->rating) }}" class="w-full border p-2">
            </div>
            <div>
                <label class="block mb-1">Total Reviews</label>
                <input type="number" name="total_reviews" value="{{ old('total_reviews', $venue->total_reviews) }}" class="w-full border p-2">
            </div>
            <div>
                <label class="block mb-1">Guest Capacity Min</label>
                <input type="number" name="guest_capacity_min" value="{{ old('guest_capacity_min', $venue->guest_capacity_min) }}" class="w-full border p-2">
            </div>
            <div>
                <label class="block mb-1">Guest Capacity Max</label>
                <input type="number" name="guest_capacity_max" value="{{ old('guest_capacity_max', $venue->guest_capacity_max) }}" class="w-full border p-2">
            </div>
            <div>
                <label class="block mb-1">Type</label>
                <select name="type" class="w-full border p-2">
                    <option value="Banquet" {{ $venue->type == 'Banquet' ? 'selected' : '' }}>Banquet</option>
                    <option value="Lawn" {{ $venue->type == 'Lawn' ? 'selected' : '' }}>Lawn</option>
                    <option value="Resort" {{ $venue->type == 'Resort' ? 'selected' : '' }}>Resort</option>
                </select>
            </div>

            <div>
                <label class="block mb-1">Amenities</label>
                <input type="text" name="amenities" value="{{ old('amenities', $venue->amenities) }}" class="w-full border p-2">
            </div>
            <div>
                <label class="block mb-1">Starting Price</label>
                <input type="number" name="starting_price" value="{{ old('starting_price', $venue->starting_price) }}" class="w-full border p-2">
            </div>
            <div>
                <label class="block mb-1">Event Spaces Count</label>
                <input type="number" name="event_spaces_count" value="{{ old('event_spaces_count', $venue->event_spaces_count) }}" class="w-full border p-2">
            </div>
            <div>
                <label class="block mb-1">Available This Weekend</label>
                <select name="available_this_weekend" class="w-full border p-2">
                    <option value="0" {{ $venue->available_this_weekend == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $venue->available_this_weekend == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <div>
                <label class="block mb-1">Main Image</label>
                <input type="file" name="main_image" class="w-full border p-2">
                @if($venue->main_image)
                    <img src="{{ asset($venue->main_image) }}" class="mt-2 h-16 rounded shadow">
                @endif
            </div>
            <div>
                <label class="block mb-1">Main Video</label>
                <input type="text" name="video" value="{{ old('video', $venue->video) }}" class="w-full border p-2">
            </div>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Venue Description</label>
            <textarea name="descr" id="venue_description" rows="6" class="border rounded-md p-2 w-full">{{ old('descr', $venue->descr ?? '') }}</textarea>
            @error('descr')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <hr class="my-6">

        {{-- Venue Images --}}
        <h3 class="font-semibold mb-2">Venue Images</h3>
        <div id="venue-images-wrapper">
            @foreach($venue->images as $i => $image)
                <div class="flex gap-2 mb-2 items-center">
                    <!-- Image Upload Input -->
                    <input type="file" name="images[{{ $i }}][image_path]" class="border p-2 w-1/3">

                    <!-- Description Input -->
                    <input type="text" name="images[{{ $i }}][description]" value="{{ $image->description }}" class="border p-2 w-1/3" placeholder="Description">

                    <!-- Preview Image & Delete Checkbox -->
                    <div class="w-1/3 flex items-center gap-3">
                        <img src="{{ asset($image->image_path) }}" class="h-16 rounded border">

                        <label class="flex items-center gap-1 text-red-600 font-medium">
                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}">
                            Delete
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Button to add new image dynamically -->
        <button type="button" class="bg-blue-500 text-white px-3 py-1 mb-4 rounded" onclick="addVenueImage()">+ Add Image</button>

        <hr class="my-6">

        {{-- Spaces --}}
       <h3 class="font-semibold mb-2">Event Spaces</h3>
        <div id="venue-spaces-wrapper">
            @foreach($venue->spaces as $i => $space)
                <div class="space-item grid grid-cols-4 gap-3 mb-3 border border-gray-300 p-3 rounded-md bg-gray-50">
                    <!-- Space Name -->
                    <input type="text" name="spaces[{{ $i }}][name]" value="{{ $space->name }}" class="border p-2 rounded w-full" placeholder="Space Name">

                    <!-- Min Capacity -->
                    <input type="number" name="spaces[{{ $i }}][capacity_min]" value="{{ $space->capacity_min }}" class="border p-2 rounded w-full" placeholder="Min Capacity">

                    <!-- Max Capacity -->
                    <input type="number" name="spaces[{{ $i }}][capacity_max]" value="{{ $space->capacity_max }}" class="border p-2 rounded w-full" placeholder="Max Capacity">

                    <!-- Size in Sq Ft -->
                    <input type="number" name="spaces[{{ $i }}][size_sqft]" value="{{ $space->size_sqft }}" class="border p-2 rounded w-full" placeholder="Square Feet">

                    <!-- Description -->
                    <textarea name="spaces[{{ $i }}][description]" class="border p-2 rounded col-span-4 w-full" placeholder="Description" rows="2">{{ $space->description }}</textarea>

                    <!-- AC Available -->
                    <select name="spaces[{{ $i }}][ac_available]" class="border p-2 rounded w-full">
                        <option value="1" {{ $space->ac_available ? 'selected' : '' }}>AC Available</option>
                        <option value="0" {{ !$space->ac_available ? 'selected' : '' }}>No AC</option>
                    </select>

                    <!-- Open Air / Indoor -->
                    <select name="spaces[{{ $i }}][open_air]" class="border p-2 rounded w-full">
                        <option value="1" {{ $space->open_air ? 'selected' : '' }}>Open Air</option>
                        <option value="0" {{ !$space->open_air ? 'selected' : '' }}>Indoor</option>
                    </select>

                    <!-- Features -->
                    <input type="text" name="spaces[{{ $i }}][features]" value="{{ $space->features }}" class="border p-2 rounded w-full" placeholder="Features (comma separated)">

                    <!-- Price Per Day -->
                    <input type="number" step="0.01" name="spaces[{{ $i }}][price_per_day]" value="{{ $space->price_per_day }}" class="border p-2 rounded w-full" placeholder="Price Per Day">

                    <!-- Remove Button -->
                    <div class="col-span-4 text-right">
                        <button type="button" class="text-red-500 hover:underline" onclick="removeSpace(this)">Remove</button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Space Button -->
        <button type="button" class="bg-blue-500 text-white px-3 py-1 mb-4 rounded" onclick="addVenueSpace()">+ Add Space</button>


        <hr class="my-6">

        {{-- Cuisines --}}
        <h3 class="font-semibold mb-2">Cuisines</h3>
        <div id="venue-cuisines-wrapper">
            @foreach($venue->cuisines as $i => $cuisine)
                <input type="text" name="cuisines[{{ $i }}][cuisine_name]" value="{{ $cuisine->cuisine_name }}" class="border p-2 mb-2" placeholder="Cuisine Name">
            @endforeach
        </div>
        <button type="button" class="bg-blue-500 text-white px-3 py-1 mb-4" onclick="addVenueCuisine()">+ Add Cuisine</button>

        <hr class="my-6">

        {{-- Catering --}}
        <h3 class="font-semibold mb-2">Catering Packages</h3>
        <div id="catering-packages-wrapper">
            @foreach($venue->cateringPackages as $i => $package)
                <div class="grid grid-cols-3 gap-2 mb-2">
                    <input type="text" name="catering[{{ $i }}][package_name]" value="{{ $package->package_name }}" class="border p-2">
                    <input type="number" name="catering[{{ $i }}][price_per_plate]" value="{{ $package->price_per_plate }}" class="border p-2">
                    <input type="text" name="catering[{{ $i }}][menu_details]" value="{{ $package->menu_details }}" class="border p-2">
                </div>
            @endforeach
        </div>
        <button type="button" class="bg-blue-500 text-white px-3 py-1 mb-4" onclick="addCateringPackage()">+ Add Package</button>

        <hr class="my-6">

        {{-- Themes --}}
        <h3 class="font-semibold mb-2">Decoration Themes</h3>
        <div id="decoration-themes-wrapper">
            @foreach($venue->decorationThemes as $i => $theme)
                <input type="text" name="themes[{{ $i }}][theme_name]" value="{{ $theme->theme_name }}" class="border p-2 mb-2" placeholder="Theme Name">
            @endforeach
        </div>
        <button type="button" class="bg-blue-500 text-white px-3 py-1 mb-4" onclick="addDecorationTheme()">+ Add Theme</button>

        <hr class="my-6">

        {{-- Services --}}
        <h3 class="font-semibold mb-2">Additional Services</h3>
        <div id="additional-services-wrapper">
            @foreach($venue->additionalServices as $i => $service)
                <div class="flex gap-2 mb-2">
                    <input type="text" name="services[{{ $i }}][service_name]" value="{{ $service->service_name }}" class="border p-2">
                    <select name="services[{{ $i }}][available]" class="border p-2">
                        <option value="1" {{ $service->available ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ !$service->available ? 'selected' : '' }}>Not Available</option>
                    </select>
                </div>
            @endforeach
        </div>
        <button type="button" class="bg-blue-500 text-white px-3 py-1 mb-4" onclick="addAdditionalService()">+ Add Service</button>

        <hr class="my-6">

        {{-- Reviews --}}
        <h3 class="font-semibold mb-2">Reviews</h3>
        <div id="venue-reviews-wrapper">
            @foreach($venue->reviews as $i => $review)
                <div class="grid grid-cols-3 gap-2 mb-2">
                    <input type="text" name="reviews[{{ $i }}][reviewer_name]" value="{{ $review->reviewer_name }}" class="border p-2">
                    <input type="number" step="0.1" name="reviews[{{ $i }}][rating]" value="{{ $review->rating }}" class="border p-2">
                    <input type="text" name="reviews[{{ $i }}][review_text]" value="{{ $review->review_text }}" class="border p-2">
                </div>
            @endforeach
        </div>
        <button type="button" class="bg-blue-500 text-white px-3 py-1 mb-4" onclick="addVenueReview()">+ Add Review</button>

        <hr class="my-6">

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Venue</button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor
            .create(document.querySelector('#venue_description'))
            .catch(error => {
                console.error(error);
            });
    });
</script>

{{-- Reuse the same JS from create --}}
<script>
let imgIndex = {{ $venue->images->count() }},
    spaceIndex = {{ $venue->spaces->count() }},
    cuisineIndex = {{ $venue->cuisines->count() }},
    cateringIndex = {{ $venue->cateringPackages->count() }},
    themeIndex = {{ $venue->decorationThemes->count() }},
    serviceIndex = {{ $venue->additionalServices->count() }},
    reviewIndex = {{ $venue->reviews->count() }};

function addVenueImage() {
    document.getElementById('venue-images-wrapper').insertAdjacentHTML('beforeend',
        `<div class="flex gap-2 mb-2">
            <input type="file" name="images[${imgIndex}][image_path]" class="border p-2 w-1/2">
            <input type="text" name="images[${imgIndex}][description]" class="border p-2 w-1/2" placeholder="Description">
        </div>`);
    imgIndex++;
}

// function addVenueSpace() {
//     document.getElementById('venue-spaces-wrapper').insertAdjacentHTML('beforeend',
//         `<div class="grid grid-cols-3 gap-2 mb-2">
//             <input type="text" name="spaces[${spaceIndex}][name]" class="border p-2" placeholder="Space Name">
//             <input type="number" name="spaces[${spaceIndex}][capacity_min]" class="border p-2" placeholder="Min Capacity">
//             <input type="number" name="spaces[${spaceIndex}][capacity_max]" class="border p-2" placeholder="Max Capacity">
//         </div>`);
//     spaceIndex++;
// }

function addVenueSpace() {
        const i = spaceIndex++;
        const html = `
            <div class="space-item grid grid-cols-4 gap-3 mb-3 border border-gray-300 p-3 rounded-md bg-gray-50">
                <input type="text" name="spaces[${i}][name]" class="border p-2 rounded w-full" placeholder="Space Name">
                <input type="number" name="spaces[${i}][capacity_min]" class="border p-2 rounded w-full" placeholder="Min Capacity">
                <input type="number" name="spaces[${i}][capacity_max]" class="border p-2 rounded w-full" placeholder="Max Capacity">
                <input type="number" name="spaces[${i}][size_sqft]" class="border p-2 rounded w-full" placeholder="Square Feet">

                <textarea name="spaces[${i}][description]" class="border p-2 rounded col-span-4 w-full" placeholder="Description" rows="2"></textarea>

                <select name="spaces[${i}][ac_available]" class="border p-2 rounded w-full">
                    <option value="1">AC Available</option>
                    <option value="0" selected>No AC</option>
                </select>

                <select name="spaces[${i}][open_air]" class="border p-2 rounded w-full">
                    <option value="1">Open Air</option>
                    <option value="0" selected>Indoor</option>
                </select>

                <input type="text" name="spaces[${i}][features]" class="border p-2 rounded w-full" placeholder="Features (comma separated)">
                <input type="number" step="0.01" name="spaces[${i}][price_per_day]" class="border p-2 rounded w-full" placeholder="Price Per Day">

                <div class="col-span-4 text-right">
                    <button type="button" class="text-red-500 hover:underline" onclick="removeSpace(this)">Remove</button>
                </div>
            </div>
        `;
        document.getElementById('venue-spaces-wrapper').insertAdjacentHTML('beforeend', html);
    }

    function removeSpace(button) {
        button.closest('.space-item').remove();
    }

function addVenueCuisine() {
    document.getElementById('venue-cuisines-wrapper').insertAdjacentHTML('beforeend',
        `<input type="text" name="cuisines[${cuisineIndex}][cuisine_name]" class="border p-2 mb-2" placeholder="Cuisine Name">`);
    cuisineIndex++;
}

function addCateringPackage() {
    document.getElementById('catering-packages-wrapper').insertAdjacentHTML('beforeend',
        `<div class="grid grid-cols-3 gap-2 mb-2">
            <input type="text" name="catering[${cateringIndex}][package_name]" class="border p-2" placeholder="Package Name">
            <input type="number" name="catering[${cateringIndex}][price_per_plate]" class="border p-2" placeholder="Price/Plate">
            <input type="text" name="catering[${cateringIndex}][menu_details]" class="border p-2" placeholder="Menu Details">
        </div>`);
    cateringIndex++;
}

function addDecorationTheme() {
    document.getElementById('decoration-themes-wrapper').insertAdjacentHTML('beforeend',
        `<input type="text" name="themes[${themeIndex}][theme_name]" class="border p-2 mb-2" placeholder="Theme Name">`);
    themeIndex++;
}

function addAdditionalService() {
    document.getElementById('additional-services-wrapper').insertAdjacentHTML('beforeend',
        `<div class="flex gap-2 mb-2">
            <input type="text" name="services[${serviceIndex}][service_name]" class="border p-2" placeholder="Service Name">
            <select name="services[${serviceIndex}][available]" class="border p-2">
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select>
        </div>`);
    serviceIndex++;
}

function addVenueReview() {
    document.getElementById('venue-reviews-wrapper').insertAdjacentHTML('beforeend',
        `<div class="grid grid-cols-3 gap-2 mb-2">
            <input type="text" name="reviews[${reviewIndex}][reviewer_name]" class="border p-2" placeholder="Reviewer Name">
            <input type="number" name="reviews[${reviewIndex}][rating]" step="0.1" class="border p-2" placeholder="Rating">
            <input type="text" name="reviews[${reviewIndex}][review_text]" class="border p-2" placeholder="Review">
        </div>`);
    reviewIndex++;
}
</script>
@endsection
