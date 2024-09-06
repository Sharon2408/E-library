<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $text }}</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    {{-- Bootstrap --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}

    <!-- BOX ICONS CSS-->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />

    {{-- Bootswatch --}}
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css" rel="stylesheet" />

    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/logo.png') }}">
    {{-- Toaster --}}
   
    {{-- Jquery --}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/app.css'])
</head>
<style>
    body {
        background-color: #F0F5F9;
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm fixed-top" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}"
                    style="font-family:Pacifico;font-size: 18px;">
                    {{ $text }}
                </a>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/library/bookshelf">My Book Shelf</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                                style="max-height: 200px; overflow-y: auto;">
                                @foreach ($categories as $categoryvalue)
                                    <li><a class="dropdown-item"
                                            href="{{ route('library.book', ['category_id' => $categoryvalue->category_id]) }}">
                                            {{ $categoryvalue->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @can('view', App\Models\Book::class)
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('admin.book') }}">View Books</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/admin/viewplans">View Plans</a>
                            </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu bg-dark dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item  text-white" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    </div>

    <main class="py-5">
        {{-- <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div> --}}
        @yield('content')
    </main>
    </div>
    <script>
        @if (session()->has('book-added'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.success("{{ session()->get('book-added') }}");
        @elseif (session()->has('book-updated'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.info("{{ session()->get('book-updated') }}");
        @elseif (session()->has('book-deleted'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.error("{{ session()->get('book-deleted') }}");
        @elseif (session()->has('book-shelf'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.success("{{ session()->get('book-shelf') }}");
        @elseif (session()->has('book-shelf-removed'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.error("{{ session()->get('book-shelf-removed') }}");
        @elseif (session()->has('plan-created'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.success("{{ session()->get('plan-created') }}");
        @elseif (session()->has('plan-updated'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.success("{{ session()->get('plan-updated') }}");
        @elseif (session()->has('plan-deleted'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.warning("{{ session()->get('plan-deleted') }}");
        @elseif (session()->has('register'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.success("{{ session()->get('register') }}");
        @elseif (session()->has('book-shelf-exist'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.warning("{{ session()->get('book-shelf-exist') }}");
        @elseif (session()->has('book-restored'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300"
            }
            toastr.info("{{ session()->get('book-restored') }}");
        @endif
    </script>

</body>

</html>
