<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Library</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .img-fluid {
            border: none !important;
            background: none !important;
        }

    </style>

</head>

<body>
    <input type="hidden" name="" id="app">
    <div class="flex-center position-ref full-height bg-light">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    @if (Auth::user()->is_admin == 1)
                        <a href="{{ url('/home') }}">Dashboard</a>
                    @else
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="content">
            <section class="container">
                <div class="title m-b-md">
                    <img src="{{ asset('img/Library-System.png') }}" alt="Library System"
                        class="img-fluid img-thumbnail">
                </div>
            </section>
            <section class="container">
                @auth
                    @if (Auth::user()->is_admin == 1)
                        <div class="btn-group">
                            <a href="{{ route('library.book.addBook') }}" class="btn btn-primary mr-2">ADD BOOK</a>
                            <a href="{{ route('library.book.bookList') }}" class="btn btn-primary mr-2">BOOK LIST</a>
                            <a href="{{ route('library.user.studentList') }}" class="btn btn-primary mr-2">STUDENT LIST</a>
                        </div>
                    @else
                        <div class="btn-group">
                            <a href="{{ route('library.book.borrowBook') }}" class="btn btn-primary mr-2">BORROW BOOK</a>
                            <a href="{{ route('library.user.returnBook') }}" class="btn btn-primary mr-2">RETURN BOOK</a>
                            <a href="{{ route('library.user.viewRecords') }}" class="btn btn-primary">VIEW RECORD(s)</a>
                        </div>
                    @endif
                @endauth
            </section>
            <br>
            @if (session()->has('mssg'))
                <div class="alert alert-success row justify-content-center">{{ session('mssg') }}
                </div>
            @endif
            {{-- {{ date('Y-m-d H:i:s') }} --}}
        </div>
    </div>
</body>

</html>
