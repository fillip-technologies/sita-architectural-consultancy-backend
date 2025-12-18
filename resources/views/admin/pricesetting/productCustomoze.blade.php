@extends('admin.include.layout')

@section('heading', 'Product Customizations')
@section('title', 'Product Customizations')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-10">

    <h2 class="text-2xl font-semibold text-primary mb-8 flex items-center gap-2">
        <i class="fa-solid fa-palette text-primary"></i>
        Product Customizations
    </h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-gray-200 text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-800">
                <tr>
                    <th class="py-3 px-4 border-b text-left">#</th>
                    <th class="py-3 px-4 border-b text-left">User</th>
                    <th class="py-3 px-4 border-b text-left">Product</th>
                    <th class="py-3 px-4 border-b text-left">Message</th>
                    <th class="py-3 px-4 border-b text-left">Theme Color</th>
                    <th class="py-3 px-4 border-b text-left">Color Code</th>
                    <th class="py-3 px-4 border-b text-left">Notes</th>
                    <th class="py-3 px-4 border-b text-left">Gift Wrap</th>
                    <th class="py-3 px-4 border-b text-left">Images</th>
                    <th class="py-3 px-4 border-b text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customizations as $key => $custom)
                    @php
                        // Decode images in case stored as JSON string
                        $images = is_string($custom->images) ? json_decode($custom->images, true) : $custom->images;
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $key + 1 }}</td>

                        <td class="py-3 px-4 border-b">
                            {{ $custom->user ? $custom->user->name : 'Guest' }}
                        </td>

                        <td class="py-3 px-4 border-b">
                            {{ $custom->product ? $custom->product->name : 'Deleted Product' }}
                        </td>

                        <td class="py-3 px-4 border-b">
                            {{ $custom->message ?? '—' }}
                        </td>

                        <td class="py-3 px-4 border-b">
                            {{ $custom->theme_color ?? '—' }}
                        </td>

                        <td class="py-3 px-4 border-b">
                            @if ($custom->color_code)
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 rounded border"
                                        style="background-color: {{ $custom->color_code }}"></span>
                                    <span>{{ $custom->color_code }}</span>
                                </div>
                            @else
                                —
                            @endif
                        </td>

                        <td class="py-3 px-4 border-b">{{ $custom->notes ?? '—' }}</td>

                        <td class="py-3 px-4 border-b">
                            {{ $custom->gift_wrap ? 'Yes' : 'No' }}
                        </td>

                        <td class="py-3 px-4 border-b">
                            @if (!empty($images) && is_array($images))
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($images as $img)
                                        <img src="{{ asset($img) }}" alt="Customization Image"
                                            class="w-12 h-12 object-cover rounded border">
                                    @endforeach
                                </div>
                            @else
                                —
                            @endif
                        </td>

                        <td class="py-3 px-4 border-b text-gray-500">
                            {{ $custom->created_at->format('d M Y, h:i A') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-6 text-gray-500">
                            No customization requests found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
