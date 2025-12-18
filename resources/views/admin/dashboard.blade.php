@extends('admin.include.layout')
@section('title', 'Dashboard')
@section('content')


    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card bg-white rounded-xl shadow p-6 border-l-4 border-primary transition duration-300">
            <div class="flex justify-between">
                <div>
                    <p class="text-dark">Total Users</p>
                    <h3 class="text-2xl font-bold text-dark mt-2">0</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                    <i class="fas  fa-users  text-blue-800 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600 font-medium">
                    <i class="fas fa-arrow-up"></i> 12.5%
                </span>
                <span class="text-dark text-sm ml-2">Since last month</span>
            </div>
        </div>

        <div class="stat-card bg-white rounded-xl shadow p-6 border-l-4 border-secondary transition duration-300">
            <div class="flex justify-between">
                <div>
                    <p class="text-dark">Active Bookings</p>
                    <h3 class="text-2xl font-bold text-dark mt-2">0</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center">
                    <i class="fas fa-calendar-check text-secondary text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600 font-medium">
                    <i class="fas fa-arrow-up"></i> 8.3%
                </span>
                <span class="text-dark text-sm ml-2">Since last month</span>
            </div>
        </div>

        <div class="stat-card bg-white rounded-xl shadow p-6 border-l-4 border-purple-500 transition duration-300">
            <div class="flex justify-between">
                <div>
                    <p class="text-dark">Total Products</p>
                    <h3 class="text-2xl font-bold text-dark mt-2">0</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-500/10 flex items-center justify-center">
                    <i class="fas fa-building text-purple-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600 font-medium">
                    <i class="fas fa-arrow-up"></i> 5.2%
                </span>
                <span class="text-dark text-sm ml-2">Since last month</span>
            </div>
        </div>

        <div class="stat-card bg-white rounded-xl shadow p-6 border-l-4 border-yellow-400 transition duration-300">
            <div class="flex justify-between">
                <div>
                    <p class="text-dark">Total OrderRequest</p>
                    <h3 class="text-2xl font-bold text-dark mt-2">0</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-400/10 flex items-center justify-center">
                    <i class="fas fa-star text-yellow-400 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600 font-medium">
                    <i class="fas fa-arrow-up"></i> 0.3%
                </span>
                <span class="text-dark text-sm ml-2">Since last month</span>
            </div>
        </div>
    </div>

    <!-- Charts and Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-dark">Revenue Overview</h2>
                <div>
                    <button class="text-sm bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-lg">Monthly</button>
                    <button class="text-sm hover:bg-gray-100 px-3 py-1 rounded-lg">Yearly</button>
                </div>
            </div>
            <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                <p class="text-gray-500">Revenue chart visualization</p>
            </div>
        </div>

        <!-- Recent Bookings -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-dark mb-6">Users List</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-500 text-sm border-b">
                            <th class="pb-3">Name</th>
                            <th class="pb-3">Email</th>
                            <th class="pb-3">Address</th>
                            <th class="pb-3">Phone</th>
                        </tr>
                    </thead>
                    <tbody>



                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Reviews -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold text-dark mb-6">Recent Reviews</h2>
        <div class="space-y-4">
            <div class="border-b pb-4">
                <div class="flex justify-between">
                    <h3 class="font-medium">The Grand Ballroom</h3>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mt-2">"Excellent venue with spacious halls and professional staff. Highly
                    recommended!"</p>
                <p class="text-gray-500 text-xs mt-2">- Amit Sharma, 2 days ago</p>
            </div>

            <div class="border-b pb-4">
                <div class="flex justify-between">
                    <h3 class="font-medium">Sunset Resort</h3>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mt-2">"Beautiful location but the catering could be improved. Overall a good
                    experience."</p>
                <p class="text-gray-500 text-xs mt-2">- Priya Singh, 4 days ago</p>
            </div>

            <div>
                <div class="flex justify-between">
                    <h3 class="font-medium">Crystal Gardens</h3>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <p class="text-gray-600 text-sm mt-2">"The garden setup was perfect for our outdoor wedding. The staff was
                    very accommodating."</p>
                <p class="text-gray-500 text-xs mt-2">- Neha Patel, 1 week ago</p>
            </div>
        </div>
    </div>
@endsection
