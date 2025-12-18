@extends('admin.include.layout')
@section('heading', 'Contact Supports')
@section('title', 'Users List')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow rounded p-6 mt-6" id="ordersSection">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Users</h1>
    </div>

    <div class="overflow-x-auto">
        @php
          
            $uniqueUsers = $allsmg
                ->sortByDesc('created_at')
                ->unique('user_id')
                ->values();
            $index = 1;
        @endphp

        <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">#</th>
                    <th class="border px-4 py-2 text-left">User ID</th>
                    <th class="border px-4 py-2 text-left">Order ID</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                    <th class="border px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($uniqueUsers as $user)
                    @php
                        $status = $user->status == 1 ? 'Client Message' : 'Admin Reply';
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $index++ }}</td>
                        <td class="border px-4 py-2">{{ $user->user_id }}</td>
                        <td class="border px-4 py-2">{{ $user->order_id }}</td>
                        <td class="border px-4 py-2">{{ $status }}</td>
                        <td class="border px-4 py-2">
                            <a href="#"
                               class="text-pink-600 hover:underline text-sm contact-support"
                               data-order-id="{{ $user->order_id }}"
                               data-user-id="{{ $user->user_id }}">
                                Support
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-4 text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Chat Box -->
<div id="chatBox" class="hidden px-4">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-2xl border border-gray-200 flex flex-col overflow-hidden h-[600px]">
            <!-- Header -->
            <div class="bg-blue-800 text-primary p-4 flex items-center justify-between flex-shrink-0">
                <div>
                    <h3 class="font-semibold text-sm leading-tight text-white">Our Support Team</h3>
                    <p class="text-xs text-white/80">We’re here to help you 24/7</p>
                </div>
                <button id="closeBtn"
                    class="w-8 h-8 rounded-full hover:bg-primary text-primary hover:text-white flex items-center justify-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Chat Messages -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 mainparent"></div>

            <!-- Input Box -->
            <div class="p-4 bg-white border-t border-gray-200 flex-shrink-0">
                <form id="mainform" method="POST" class="flex w-full items-center gap-2">
                    @csrf
                    <input type="hidden" id="order_id" name="order_id">
                    <input type="hidden" id="user_id" name="user_id">
                    <input type="text" name="message" id="message" placeholder="Type a message..."
                        class="flex-1 px-3 py-2 border border-primary rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm"
                        required />
                    <button type="button" id="sendSms"
                        class="w-8 h-8 rounded-full flex items-center justify-center bg-primary text-white hover:bg-primary/90 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M22 2L11 13M22 2L15 22l-4-9-9-4 20-7z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const chatBox = document.getElementById("chatBox");
    const ordersSection = document.getElementById("ordersSection");
    const contactLinks = document.querySelectorAll(".contact-support");
    const closeBtn = document.getElementById("closeBtn");
    const orderInput = document.getElementById("order_id");
    const userInput = document.getElementById("user_id");

    let refreshInterval = null; // 🕐 interval store karne ke liye

    contactLinks.forEach(link => {
        link.addEventListener("click", e => {
            e.preventDefault();
            const orderId = link.getAttribute("data-order-id");
            const userId = link.getAttribute("data-user-id");

            orderInput.value = orderId;
            userInput.value = userId;

            ordersSection.classList.add("hidden");
            chatBox.classList.remove("hidden");

            loadMessages(orderId);

          
            if (refreshInterval) clearInterval(refreshInterval);
            refreshInterval = setInterval(() => {
                loadMessages(orderId);
            }, 1000);
        });
    });

    closeBtn.addEventListener("click", () => {
        chatBox.classList.add("hidden");
        ordersSection.classList.remove("hidden");


        if (refreshInterval) clearInterval(refreshInterval);
    });
});

function loadMessages(order_id) {
    $.ajax({
        type: 'GET',
        url: "{{ url('/get-messages') }}/" + order_id,
        success: function(response) {
            if (response.status === 'success') {
                $(".mainparent").empty();
                $.each(response.messages, function(index, data) {
                    let time = new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                    if (data.status == 2) {
                        $(".mainparent").append(`
                            <div class="flex justify-end">
                                <div class="bg-blue-900 text-white rounded-2xl rounded-br-md px-3 py-2 max-w-[80%] text-sm">
                                    <p>${data.message}</p>
                                    <p class="text-xs mt-1 text-green-100">${time}</p>
                                </div>
                            </div>
                        `);
                    } else if (data.status == 1) {
                        $(".mainparent").append(`
                            <div class="flex justify-start">
                                <div class="bg-white text-gray-800 rounded-2xl rounded-bl-md shadow-sm px-3 py-2 max-w-[80%] text-sm">
                                    <p>${data.message}</p>
                                    <p class="text-xs mt-1 text-gray-500">${time}</p>
                                </div>
                            </div>
                        `);
                    }
                });

                $(".mainparent").scrollTop($(".mainparent")[0].scrollHeight);
            }
        },
        error: function(xhr) {
            console.error("Failed to load messages:", xhr.responseText);
        }
    });
}

// ✅ Send message
$(document).ready(function() {
    $("#sendSms").on('click', function(e) {
        e.preventDefault();

        let message = $("#message").val().trim();
        let order_id = $("#order_id").val();
        let user_id = $("#user_id").val();

        if (message === "") return;

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.store.message') }}",
            data: {
                _token: "{{ csrf_token() }}",
                order_id: order_id,
                user_id: user_id,
                message: message
            },
            success: function(response) {
                if (response.status === 'success') {
                    $("#message").val('');
                    loadMessages(order_id);
                } else {
                    console.error("Server returned error:", response.error);
                }
            },
            error: function(xhr) {
                console.error("Error sending message:", xhr.responseText);
            }
        });
    });
});
</script>

@endsection
