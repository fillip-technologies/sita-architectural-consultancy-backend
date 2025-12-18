<nav class="mt-6 flex-1 overflow-y-auto bg-gradient-to-b from-black to-gray-900 text-white p-2">

    <!-- Section Title -->
    <div class="px-4 mb-6 mt-4">
        <p class="text-xs uppercase text-red-500 font-bold tracking-wider opacity-80">
            Navigation
        </p>
    </div>

    <!-- Single Link -->
    <a href="{{ url('/admin/dashboard') }}"
        class="flex items-center px-6 py-3 mb-3 rounded-xl shadow-md
               bg-gray-900/60 backdrop-blur-xl border border-gray-800
               hover:bg-red-600 hover:border-red-400 transition-all duration-300 group">
        <i class="fas fa-tachometer-alt mr-4 text-red-500 group-hover:text-white"></i>
        Dashboard
    </a>

    <a href="{{ url('admin/list/order') }}"
        class="flex items-center px-6 py-3 mb-3 rounded-xl shadow-md
               bg-gray-900/60 backdrop-blur-xl border border-gray-800
               hover:bg-red-600 hover:border-red-400 transition-all duration-300 group">
               <i class="fas fa-file-invoice-dollar mr-4 text-red-500 group-hover:text-white"></i>

        Estimate Lists
    </a>
        <a href=""
        class="flex items-center px-6 py-3 mb-3 rounded-xl shadow-md
               bg-gray-900/60 backdrop-blur-xl border border-gray-800
               hover:bg-red-600 hover:border-red-400 transition-all duration-300 group">

        <i class="fa-solid fa-users mr-4 text-red-500 group-hover:text-white"></i>
        Contact Lists
    </a>

    <!-- Dropdown -->
    <details class="group w-full mb-3">
        <summary
            class="flex items-center justify-between px-6 py-3 mb-2 cursor-pointer rounded-xl shadow-md
                   bg-gray-900/60 backdrop-blur-xl border border-gray-800
                   hover:bg-red-600 hover:border-red-400 transition-all duration-300">
            <div class="flex items-center">
                <i class="fas fa-indian-rupee-sign mr-4 text-red-400 group-hover:text-white"></i>

                <span class="font-semibold">Set Price</span>
            </div>
            <i class="fas fa-chevron-down text-red-400 transition-transform duration-300 group-open:rotate-180"></i>
        </summary>

        <div class="pl-12 flex flex-col space-y-2">
            <a href="{{ url('admin/list/users') }}"
                class="flex items-center bg-gray-800/60 backdrop-blur-xl text-white px-4 py-2
                       hover:bg-red-600 transition-all duration-200">
                <i class="fas fa-user mr-3 text-red-400"></i> Add Prices
            </a>

            <a href="#"
                class="flex items-center bg-gray-800/60 backdrop-blur-xl px-4 py-2
                       hover:bg-red-600 transition-all duration-200">
                <i class="fas fa-users mr-3 text-red-400"></i> Lists Prices
            </a>
        </div>
    </details>

    <!-- Coupons -->
    <details class="group w-full mb-3">
        <summary
            class="flex items-center justify-between px-6 py-3 cursor-pointer rounded-xl shadow-md
                   bg-gray-900/60 backdrop-blur-xl border border-gray-800
                   hover:bg-red-600 transition-all duration-300">
            <div class="flex items-center">
                <i class="fas fa-hard-hat mr-3 text-red-500"></i>
                <span>Project Types</span>
            </div>
            <i class="fas fa-chevron-down text-red-400 transition-transform duration-300 group-open:rotate-180"></i>
        </summary>

        <div class="pl-12 flex flex-col space-y-2 mt-2">
            <a href="{{ url('admin/offer') }}"
                class=" bg-gray-800/60 flex items-center hover:text-red-300 px-4 py-2">
                <i class="fas fa-plus mr-2 text-red-400"></i>Add Types
            </a>

            <a href=""
                class=" bg-gray-800/60  flex items-center hover:text-red-300 px-4 py-2">
                <i class="fas fa-list mr-2 text-red-400"></i>List Project Type
            </a>
        </div>
    </details>

    {{-- <!-- Category -->
    <details class="group w-full mb-3">
        <summary
            class="flex items-center justify-between px-6 py-3 cursor-pointer rounded-xl shadow-md
                   bg-gray-900/60 backdrop-blur-xl border border-gray-800
                   hover:bg-red-600 transition-all duration-300">
            <div class="flex items-center">
                <i class="fas fa-layer-group mr-3 text-red-500"></i>
                <span>Category</span>
            </div>
            <i class="fas fa-chevron-down text-red-400 transition-transform duration-300 group-open:rotate-180"></i>
        </summary>

        <div class="pl-12 flex flex-col space-y-2 mt-2">
            <a href="{{ url('admin/category') }}" class=" bg-gray-800/60  flex items-center hover:text-red-300 px-4 py-2">
                <i class="fas fa-plus mr-2 text-red-400"></i>Add Category
            </a>

            <a href="{{ route('category.listing') }}" class="bg-gray-800/60  flex items-center hover:text-red-300 px-4 py-2">
                <i class="fas fa-list mr-2 text-red-400"></i>All Category
            </a>
        </div>
    </details>

    <!-- SubCategory -->
    <details class="group w-full mb-3">
        <summary
            class="flex items-center justify-between px-6 py-3 cursor-pointer rounded-xl shadow-md
                   bg-gray-900/60 backdrop-blur-xl border border-gray-800
                   hover:bg-red-600 transition-all duration-300">
            <div class="flex items-center">
                <i class="fas fa-stream mr-3 text-red-500"></i>
                <span>SubCategory</span>
            </div>
            <i class="fas fa-chevron-down text-red-400 transition-transform duration-300 group-open:rotate-180"></i>
        </summary>

        <div class="pl-12 flex flex-col space-y-2 mt-2">
            <a href="{{ url('admin/subcat') }}" class=" bg-gray-800/60  flex items-center hover:text-red-300 px-4 py-2">
                <i class="fas fa-plus mr-2 text-red-400"></i>Add SubCategory
            </a>
            <a href="{{ url('admin/list/subcate') }}" class="bg-gray-800/60  flex items-center hover:text-red-300 px-4 py-2">
                <i class="fas fa-list mr-2 text-red-400"></i>All SubCategory
            </a>
        </div>
    </details>

    <!-- Products -->
    <details class="group w-full mb-3">
        <summary
            class="flex items-center justify-between px-6 py-3 cursor-pointer rounded-xl shadow-md
                   bg-gray-900/60 backdrop-blur-xl border border-gray-800
                   hover:bg-red-600 transition-all duration-300">
            <div class="flex items-center">
                <i class="fas fa-box-open mr-3 text-red-500"></i>
                <span>Products</span>
            </div>
            <i class="fas fa-chevron-down text-red-400 transition-transform duration-300 group-open:rotate-180"></i>
        </summary>

        <div class="pl-12 flex flex-col space-y-2 mt-2">
            <a href="{{ route('admin.venue.add') }}" class="bg-gray-800/60 flex items-center hover:text-red-300 px-4 py-2">
                <i class="fas fa-plus mr-2 text-red-400"></i>Add Products
            </a>
            <a href="{{ route('poducts.listing') }}" class="bg-gray-800/60 flex items-center hover:text-red-300 px-4 py-2">
                <i class="fas fa-list mr-2 text-red-400"></i>All Products
            </a>
        </div>
    </details>

    <!-- Shipping -->
    <details class="group w-full mb-3">
        <summary
            class="flex items-center justify-between px-6 py-3 cursor-pointer rounded-xl shadow-md
                   bg-gray-900/60 backdrop-blur-xl border border-gray-800
                   hover:bg-red-600 transition-all duration-300">
            <div class="flex items-center">
                <i class="fas fa-shipping-fast mr-3 text-red-500"></i>
                <span>Shipping</span>
            </div>
            <i class="fas fa-chevron-down text-red-400 transition-transform duration-300 group-open:rotate-180"></i>
        </summary>

        <div class="pl-12 flex flex-col space-y-2 mt-2">
            <a href="{{ url('admin/shipping') }}" class="bg-gray-800/60 flex items-center hover:text-red-300 px-4 py-2">
                <i class="fas fa-plus mr-2 text-red-400"></i>Add Shipping
            </a>

            <a href="{{ url('admin/shipping/list') }}" class="bg-gray-800/60 flex items-center hover:text-red-300 px-4 py-2">
                <i class="fas fa-list mr-2 text-red-400"></i>All Shipping
            </a>
        </div>
    </details> --}}

</nav>
