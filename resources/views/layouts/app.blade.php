<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Book Rental System')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include jQuery and Bootstrap Bundle JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body, html {
            height: 100%; /* Needed to make the body take full height */
            margin: 0;
        }
        #app {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .flex-grow-1 {
            flex: 1;
        }
        .footer {
            background: #000;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="app">
        <header>
            <!-- Navigation bar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">Book Rental System</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('books.index') }}">Books</a>
                            </li>
                            @can('manage-books')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('books.create') }}">Add Book</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('genres.index') }}">Manage Genres</a>
                            </li>

                            @endcan
                            @can('manage-rentals')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rentals.manage') }}">Manage Rentals</a>
                            </li>
                            @endcan
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rentals.my') }}">My Rentals</a>
                            </li>
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ Auth::user()->name }} ({{ __('Logout') }})
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="flex-grow-1">
            @yield('content')
        </main>

        <footer class="footer p-3 mt-auto">
            © {{ date('Y') }} Book Rental System. All Rights Reserved.
        </footer>
    </div>
    <!-- Include Bootstrap JS -->
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();
        });
    </script>
</body>
</html>
