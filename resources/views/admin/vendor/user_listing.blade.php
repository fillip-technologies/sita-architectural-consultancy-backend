@extends('admin.include.layout')
@section('heading', 'User Listing')
@section('title', 'Users List')

@section('content')
    <div class=" mx-auto bg-white shadow rounded p-6 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Users</h1>

        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">#</th>
                        <th class="border px-4 py-2 text-left">Name</th>
                        <th class="border px-4 py-2 text-left">Email</th>
                        <th class="border px-4 py-2 text-left">Phone</th>
                        <th class="border px-4 py-2 text-left">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @php $index = 1; @endphp
                    @forelse($userListing as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $index++ }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->phone }}</td>
                            <td class="border px-4 py-2">{{ $user->address }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Modal Overlay -->
        <!-- Modal Overlay (centered) -->
        <div id="couponModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
                <h2 class="text-xl font-bold mb-4">Add Coupon</h2>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="modalUserId">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Coupon Code</label>
                        <input type="text" name="coupon_code"
                            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-600">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Discount (%)</label>
                        <input type="number" name="discount"
                            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-600">
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Add</button>
                    </div>
                </form>
                <!-- Close icon -->
                <button onclick="closeCouponModal()"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
            </div>
        </div>



        {{-- Pagination
    <div class="mt-4">
        {{ $userListing->links() }}
    </div> --}}
    </div>
    <script>
        function openCouponModal(userId) {
            document.getElementById('couponModal').classList.remove('hidden');
            document.getElementById('modalUserId').value = userId;
        }

        function closeCouponModal() {
            document.getElementById('couponModal').classList.add('hidden');
        }
    </script>


@endsection
