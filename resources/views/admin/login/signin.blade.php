<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HardwareMart - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e73c7e', // Yellow from screenshot
                        secondary: '#10b981', // Green from featured tags
                        dark: '#1f2937', // Dark gray for text
                        light: '#f3f4f6' // Light background
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-link.active {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            color: #b45309;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .login-card {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        video {
            position: fixed !important;
        }
    </style>

</head>

<body class="bg-gray-100 font-sans">
    <!-- Login Screen -->
    <!-- Login Screen -->
    <!-- Login Screen with Video Background -->
    <div id="login-screen" class="relative min-h-screen flex items-center justify-center overflow-hidden">

        <!-- VIDEO BACKGROUND -->
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('videos/video_preview_h264.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- DARK OVERLAY -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

        <!-- LOGIN CARD / CONTENT -->
        <div
            class="relative z-10 w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 rounded-2xl overflow-hidden shadow-2xl">
            <!-- Left Logo -->
            <div
                class="flex flex-col items-center justify-center p-10 bg-white/10 backdrop-blur-xl border-r border-white/20">
                <img src="{{ asset('images/hardwaremart-removebg-preview.png') }}"
                    class="w-60 h-60 object-contain drop-shadow-xl mb-6">
                <h1 class="text-4xl font-bold text-white drop-shadow-xl">HardwareMart</h1>
                <p class="text-white/80 mt-3 text-center text-lg">Admin Panel Login</p>
            </div>

            <!-- Right Login Form -->
            <div class="p-10 bg-white/20 backdrop-blur-2xl">
                <form id="login-form" method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <h2 class="text-white text-3xl font-semibold mb-8 text-center drop-shadow">Welcome Back</h2>

                    <input type="email" name="email" placeholder="hardwaremart@gmail.com"
                        class="w-full mb-5 px-4 py-3 rounded-lg bg-white/30 text-white placeholder-white/60 border border-white/40 focus:ring-2 focus:ring-primary"
                        required>
                    <input type="password" name="password" placeholder="••••••••"
                        class="w-full mb-6 px-4 py-3 rounded-lg bg-white/30 text-white placeholder-white/60 border border-white/40 focus:ring-2 focus:ring-primary"
                        required>

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" class="h-4 w-4 text-primary rounded">
                            <label class="ml-2 text-sm text-white/80">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-primary font-medium hover:underline">Forgot password?</a>
                    </div>

                    <button type="submit"
                        class="w-full bg-primary/80 hover:bg-primary text-white font-medium py-3 px-4 rounded-lg transition backdrop-blur">
                        Sign In
                    </button>

                    <div class="mt-6 text-center text-white/70 text-sm">
                        © 2025 Hardwaremart. All rights reserved.
                    </div>
                </form>
            </div>
        </div>
    </div>




    <script>
        // Toggle between login and admin panel
        document.getElementById('login-form').addEventListener('submit', function(e) {
            // e.preventDefault();
            document.getElementById('login-screen').classList.add('hidden');
            document.getElementById('admin-panel').classList.remove('hidden');
        });

        // Mobile sidebar toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.w-64');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('absolute');
            sidebar.classList.toggle('z-50');
        });

        // Set active state for sidebar links
        const sidebarLinks = document.querySelectorAll('.sidebar-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                sidebarLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>
