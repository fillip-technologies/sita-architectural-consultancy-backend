@extends('admin.include.layout')
@section('heading', 'OrderListing')
@section('title', 'Users List')

@section('content')
    <div class=" resonsive-table mx-auto bg-white shadow rounded p-6 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Order Details</h1>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">#</th>
                        <th class="border px-4 py-2 text-left">Name</th>
                        <th class="border px-4 py-2 text-left">OrderNumber</th>
                        <th class="border px-4 py-2 text-left">TotalAmount</th>
                        <th class="border px-4 py-2 text-left">Address</th>
                        <th class="border px-4 py-2 text-center">PaymentStatus</th>
                        <th class="border px-4 py-2 text-center">Discount</th>
                        <th class="border px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $index = 1; @endphp
                    @forelse($orderListing as $orders)

                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $index++ }}</td>
                            <td class="border px-4 py-2">{{ $orders->user->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $orders->order_number }}</td>
                            <td class="border px-4 py-2">{{ $orders->total_amount }}</td>
                            <td class="border px-4 py-2">{{ $orders->user->address ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $orders->status }}</td>
                            <td class="border px-4 py-2">{{ $orders->discount }}</td>
                            <td class="border px-4 py-2">
                                {{-- FIX: Changed from duplicate ID to data attribute --}}
                                <button data-id="{{ $orders->id }}" data-status="{{ $orders->payment_status }}"
                                    class="paymentstatus inline-block bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-lg
                                      hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 transition">
                                    Payment Status
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-4 text-gray-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Coupon Modal --}}
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
                <button onclick="closeCouponModal()"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
            </div>
        </div>

        {{-- Payment Modal --}}
        <div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96 relative">
                <h2 class="text-lg font-semibold mb-4 text-gray-800">Payment Details</h2>

                <form action="" method="POST" id="paymentForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="order_id" id="order_id">

                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 text-sm font-medium mb-1">
                            Payment Status
                        </label>
                        <input type="text" id="status" name="status"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                    </div>

                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Update
                    </button>
                </form>

                <div class="text-right mt-4">
                    <button id="closeModal" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                        Close
                    </button>
                </div>
            </div>
        </div>

        {{-- JS --}}
        <script>
            // ✅ open coupon modal
            function openCouponModal(userId) {
                document.getElementById('couponModal').classList.remove('hidden');
                document.getElementById('modalUserId').value = userId;
            }

            function closeCouponModal() {
                document.getElementById('couponModal').classList.add('hidden');
            }

            // ✅ open payment modal for each row button
            document.querySelectorAll('.paymentstatus').forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-id');
                    const status = this.getAttribute('data-status');

                    document.getElementById('paymentModal').classList.remove('hidden');
                    document.getElementById('order_id').value = orderId;
                    document.getElementById('status').value = status;

                    // dynamically set form action (adjust your update route)
                    document.getElementById('paymentForm').action = `/admin/orders/${orderId}`;
                });
            });

            // ✅ close modal
            document.getElementById('closeModal').addEventListener('click', () => {
                document.getElementById('paymentModal').classList.add('hidden');
            });
        </script>
    </div>
@endsection
