<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>Sharing & Caring Hub</title>
    
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            .min-h-screen {
                min-height: 100vh;
            }
            .bg-gray-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(17 24 39/var(--tw-bg-opacity));
            }
            .bg-dark {
                background-color: #1F2937 !important;
            }
            .bg-dark .navbar-brand {
                color: #fff;
            }
            .bg-dark .nav-link {
                color: #fff;
            }
            .max-w-7xl {
                max-width: 80rem;
            }
            .bg-dark .card-text {
                color: #fff;
            }
            .text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175/var(--tw-text-opacity));
            }
            .w-4 {
                width: 1rem;
            }
            .h-4 {
                height: 1rem;
            }
            a {
                text-decoration: inherit;
            }
            .pagination{
                justify-content: center;
            }
            .border-gray-600 {
                --tw-border-opacity: 1;
                border-color: rgb(75 85 99/var(--tw-border-opacity));
            }
            .border-t-2 {
                border-top-width: 2px !important;
            }
            ul {
                list-style: none;
            }
            .bg-gray-700 {
                --tw-bg-opacity: 1;
                background-color: rgb(55 65 81/var(--tw-bg-opacity));
                color: #fff;
            }
            .opacity-75 {
                opacity: .75;
            }
            .border-l-2 {
                border-left-width: 2px;
            }
        </style>
    </head>
<body>
    <div class="min-h-screen bg-gray-900">
        <!-- Topbar Start -->
        <div class="container-fluid bg-dark px-5">
            <div class="row gx-0">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <!-- Social media icons/buttons here -->
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center justify-content-center" style="height: 45px;">
                        <a class="btn btn-sm btn-outline-light me-2" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt fw-normal"></i> Login
                        </a>
                        <a class="btn btn-sm btn-outline-light" href="{{ route('register') }}">
                            <i class="fas fa-user-plus fw-normal"></i> Register
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Your Navbar Code Here -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <!-- Your Navbar Content Here -->
            </div>
        </nav>

        <main class="py-4">
            <div class="container max-w-7xl">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
