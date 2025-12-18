@extends('admin.include.layout')

@section('heading', 'Products')
@section('title', 'Add Product')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Add New Product</h2>

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Product Details --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Product Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">View Product Section</label>
                    <select name="show_product" class="w-full border p-2 rounded">
                        <option value="">-- Select Section --</option>
                        <option value="top" {{ old('show_product') == 'top' ? 'selected' : '' }}>Top Product</option>

                        {{-- FIXED: Correct old('show_product') match --}}
                        <option value="new_arrival" {{ old('show_product') == 'new_arrival' ? 'selected' : '' }}>
                            New Arrival
                        </option>

                        <option value="offers" {{ old('offers') == 'offers' ? 'selected' : '' }}>
                            Limited offer
                        </option>
                    </select>
                    @error('show_product')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Category</label>
                    <select name="category_id" id="categorySelect" class="w-full border p-2 rounded">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="subcategoryDiv" hidden>
                    <label class="block mb-1 font-semibold">Subcategory</label>
                    <select name="subcategory_id" id="subcategorySelect" class="w-full border p-2 rounded">
                        <option value="">-- Select Subcategory --</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Price</label>
                    <input type="number" name="price" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('price') }}">
                    @error('price')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Discount (%)</label>
                    <input type="number" name="discount" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('discount') }}">
                    @error('discount')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Stock</label>
                    <input type="number" name="stock" class="w-full border p-2 rounded" value="{{ old('stock') }}">
                    @error('stock')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Main Image</label>
                    <input type="file" name="image" class="w-full border p-2 rounded">
                    @error('image')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Gallery Images</label>
                    <input type="file" name="gallery_images[]" multiple class="w-full border p-2 rounded">
                    @error('gallery_images.*')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Product Features</label>

                    <div id="featuresWrapper">
                        <div class="feature-item flex gap-2 mb-2">
                            <input type="text" name="features[]" class="w-full border p-2 rounded"
                                placeholder="Enter feature">
                            <button type="button"
                                class="removeFeature bg-red-500 text-white px-3 rounded hidden">X</button>
                        </div>
                    </div>

                    <button type="button" id="addfeatures" class="bg-green-600 text-white px-3 py-1 mt-2 rounded">
                        + Add More
                    </button>

                    @error('features')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Product Specifications</label>

                    <div id="product_specifications">

                        <!-- ONE PAIR -->
                        <div class="spec-row flex gap-2 mb-2">
                            <input type="text" name="specifications_label[]" class="w-1/2 border p-2 rounded"
                                placeholder="Label (e.g., Color)">
                            <input type="text" name="specifications_value[]" class="w-1/2 border p-2 rounded"
                                placeholder="Value (e.g., Black)">
                            <button type="button" class="removeSpec bg-red-500 text-white px-3 rounded hidden">X</button>
                        </div>

                    </div>

                    <button type="button" id="addSpec" class="bg-green-600 text-white px-3 py-1 mt-2 rounded">
                        + Add More
                    </button>

                    @error('product_specifications')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-4">
                <label class="block mb-1 font-semibold">Product Details</label>
                <textarea name="product_details" id="product_details" rows="6" class="border rounded-md p-2 w-full">{{ old('product_details') }}</textarea>
                @error('product_details')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Product Description --}}
            <div class="mt-4">
                <label class="block mb-1 font-semibold">Description</label>
                <textarea name="description" id="product_description" rows="6" class="border rounded-md p-2 w-full">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Variants --}}
            <div class="mt-6">
                <h3 class="text-xl font-bold mb-2">Product Variants</h3>

                <div id="variants-wrapper">
                    <div class="variant border p-4 mb-3 rounded bg-gray-50">
                        <label class="block mb-1 font-semibold">SKU</label>
                        <input type="text" name="variants[0][sku]" class="w-full border p-2 rounded">

                        <label class="block mt-2 mb-1 font-semibold">Price</label>
                        <input type="number" step="0.01" name="variants[0][price]"
                            class="w-full border p-2 rounded">

                        <label class="block mt-2 mb-1 font-semibold">Stock</label>
                        <input type="number" name="variants[0][stock]" class="w-full border p-2 rounded">

                        <label class="block mt-2 mb-1 font-semibold">Size</label>
                        <input type="text" name="variants[0][size]" class="w-full border p-2 rounded">

                        <label class="block mt-2 mb-1 font-semibold">Color</label>
                        <input type="text" name="variants[0][color]" class="w-full border p-2 rounded">

                        <label class="block mt-2 mb-1 font-semibold">Image</label>
                        <input type="file" name="variants[0][image]" class="w-full border p-2 rounded">

                        <div class="mt-3 options-wrapper">
                            <h4 class="font-semibold">Options</h4>
                            <div class="option flex gap-2 mb-2">
                                <input type="text" name="variants[0][options][0][name]"
                                    class="border p-2 rounded w-1/2" placeholder="Option Name">
                                <input type="text" name="variants[0][options][0][value]"
                                    class="border p-2 rounded w-1/2" placeholder="Option Value">
                            </div>
                        </div>

                        <button type="button" class="add-option bg-blue-500 text-white px-2 py-1 mt-2 rounded">+ Add
                            Option</button>
                        <button type="button" class="remove-variant bg-red-500 text-white px-2 py-1 mt-2 rounded ml-2">
                            Remove Variant
                        </button>
                    </div>
                </div>

                <button type="button" id="add-variant" class="bg-green-500 text-white px-3 py-2 rounded">+ Add
                    Variant</button>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Product</button>
            </div>

        </form>
    </div>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#product_description'))
            .catch(error => console.error(error));

            ClassicEditor.create(document.querySelector('#product_details'))
            .catch(error => console.error(error));
    </script>

    {{-- Variant Script --}}
    <script>
        let variantIndex = 1;

        document.getElementById('add-variant').addEventListener('click', function() {
            const wrapper = document.getElementById('variants-wrapper');
            const firstVariant = wrapper.querySelector('.variant');
            const clone = firstVariant.cloneNode(true);

            clone.querySelectorAll('input').forEach(input => input.value = '');

            clone.querySelectorAll('[name]').forEach(input => {
                input.name = input.name.replace(/variants\[\d+\]/, `variants[${variantIndex}]`);
            });

            wrapper.appendChild(clone);
            variantIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-option')) {
                const variant = e.target.closest('.variant');
                const variantIdx = variant.querySelector('input[name*="variants["]')
                    .name.match(/variants\[(\d+)\]/)[1];

                const optionsWrapper = variant.querySelector('.options-wrapper');
                const optionIndex = optionsWrapper.querySelectorAll('.option').length;

                const newOption = document.createElement('div');
                newOption.classList.add('option', 'flex', 'gap-2', 'mb-2');
                newOption.innerHTML = `
                <input type="text" name="variants[${variantIdx}][options][${optionIndex}][name]" class="border p-2 rounded w-1/2" placeholder="Option Name">
                <input type="text" name="variants[${variantIdx}][options][${optionIndex}][value]" class="border p-2 rounded w-1/2" placeholder="Option Value">
            `;
                optionsWrapper.appendChild(newOption);
            }

            if (e.target.classList.contains('remove-variant')) {
                if (document.querySelectorAll('.variant').length > 1) {
                    e.target.closest('.variant').remove();
                }
            }
        });
    </script>

    <script>
        document.getElementById("addfeatures").addEventListener("click", function() {
            const wrapper = document.getElementById("featuresWrapper");

            const newFeature = document.createElement("div");
            newFeature.classList.add("feature-item", "flex", "gap-2", "mb-2");

            newFeature.innerHTML = `
            <input type="text" name="features[]" class="w-full border p-2 rounded" placeholder="Enter feature">
            <button type="button" class="removeFeature bg-red-500 text-white px-3 rounded">X</button>
        `;

            wrapper.appendChild(newFeature);
        });

        // Remove Feature
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("removeFeature")) {
                e.target.parentElement.remove();
            }
        });
    </script>
    <script>
        document.getElementById('addSpec').addEventListener('click', function() {

            // create a new row
            let row = document.createElement('div');
            row.classList.add('spec-row', 'flex', 'gap-2', 'mb-2');

            row.innerHTML = `
        <input type="text" name="specifications_label[]" class="w-1/2 border p-2 rounded" placeholder="Label">
        <input type="text" name="specifications_value[]" class="w-1/2 border p-2 rounded" placeholder="Value">
        <button type="button" class="removeSpec bg-red-500 text-white px-3 rounded">X</button>
    `;

            document.getElementById('product_specifications').appendChild(row);

            updateRemoveButtons();
        });

        function updateRemoveButtons() {
            const buttons = document.querySelectorAll('.removeSpec');

            buttons.forEach(btn => btn.classList.remove('hidden'));

            // Allow delete
            buttons.forEach(btn => {
                btn.onclick = function() {
                    this.parentElement.remove();
                    if (document.querySelectorAll('.spec-row').length === 1) {
                        document.querySelector('.removeSpec').classList.add('hidden');
                    }
                }
            });
        }

        // initialize
        updateRemoveButtons();
    </script>


    {{-- JQuery for subcategories --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categorySelect').on('change', function() {
                var categoryId = $(this).val();
                var subDiv = $('#subcategoryDiv');
                var subSelect = $('#subcategorySelect');

                subSelect.html('<option value="">-- Select Subcategory --</option>');
                subDiv.attr('hidden', true);

                if (!categoryId) return;

                $.ajax({
                    url: '/get-subcategories/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(key, subcat) {
                                subSelect.append('<option value="' + subcat.id + '">' +
                                    subcat.name +
                                    '</option>');
                            });
                        } else {
                            subSelect.append(
                                '<option value="">No subcategories found</option>');
                        }
                        subDiv.removeAttr('hidden');
                    }
                });
            });
        });
    </script>

    @if ($errors->any())
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
    @endif

@endsection
