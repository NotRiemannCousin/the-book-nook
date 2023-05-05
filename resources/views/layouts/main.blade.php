<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'The Book Nook')</title>


    <link rel="icon" type="image/x-icon" href="/favicon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</head>

<body class="d-flex min-vh-100 flex-column">
    <div id="message-holder" class="fade-out position-fixed d-flex justify-content-center m-2 m-md-5 w-fill z-3"
        style="bottom: 2em">
        <div id="message"
            class="d-none p-3 px-5 bg-white border border-black border-opacity-25 rounded-1 text-color text-center">
        </div>
    </div>
    <div id="bag-holder" class="position-fixed d-flex p-2 py-5 p-md-5 justify-content-center z-2 d-none hide-bag"
        style="background-color: #0006; height: 100vh; width: 100vw;">
        <div id="bag-container" class="d-flex flex-column bag-container p-2 p-md-5 h-100 w-100 rounded-3 bg-white"
            style="max-height: 100%">
            <div class="d-flex justify-content-between">
                <h2 class="px-4">Book Bag</h2>
                <button class="btn btn-error-variant p-2 px-3 border-0 rounded-4 clear-bag">Clear</button>
            </div>
            <hr>
            <div id="bag-wrapper" class="d-grid book-wrapper overflow-y-auto p-2 py-0 p-md-3 py-md-0">


            </div>
        </div>
    </div>
    <nav
        class="d-flex flex-column navbar navbar-expand-lg b-bottom-1 py-2 justify-content-center soft-shadow-bottom fw-medium sticky-top z-1">
        {{-- <!-- <header class="nav modal-header px-4 py-1 bg-primary"> --> --}}
        <div
            class="d-md-flex pb-2 p-md-0 w-fill w-md-fit nav-container align-items-center justify-content-between justify-content-md-center">
            <a href="/" class="mx-4 mxl-0 navbar-brand" title="home">
                @include('layouts.logo')
            </a>
        @include('layouts.util.search', ['style' => 'hide-md'])
            <button class="navbar-toggler border mx-4 float-end" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="px-1 mr-4 w-100 navbar-collapse collapse flex-grow-0" id="navbar">
                <ul class="navbar-nav align-items-center justify-items-center text-center">
                    <li class="px-4 nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="px-4 nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="px-4 nav-item show-bag">
                        <a class="nav-link">Bag
                            <span id="bag-count" class="d-inline-block d-none bg-danger text-white rounded-circle"
                                style="height: 1.5em;width: 1.5em"></span></a>
                    </li>
                    <li class="px-4 nav-item">
                        @auth
                            <a class="nav-link" href="/account">Account</a>
                        </li>
                        <li class="px-4 nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a class="nav-link"
                                    onclick="event.preventDefault();this.closest('form').submit()">Logout</a>
                            </form>
                        @else
                            <a href="{{ route('register') }}" class="nav-link">Sign In</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
        @include('layouts.util.search', ['style' => 'w-fill'])
    </nav>
    @yield('header')
    <main class="d-flex justify-content-center flex-fill py-5 px-3 py-sm-5">
        <div class="main-container" style="width: {{ $main_width ?? 'max-content' }}">
            @yield('content', 'No content.')
        </div>
    </main>
    <footer class="footer d-flex justify-content-center">
        <div class="footer-container w-100 d-md-grid t-columns-3">
            <div>
                <h4>Site</h4>
                <div>
                    <a class="d-block text-body text-decoration-none" href="{{ route('about') }}">About</a>
                    <a class="d-block text-body text-decoration-none" href="{{ route('contact') }}">Contact</a>
                </div>
            </div>
            <div>
                <h4>Account</h4>
                <span class="d-block text-body text-decoration-none show-bag">My Bag</span>
                <a class="d-block text-body text-decoration-none" href="{{ route('login') }}">SignIn</a>
                <a class="d-block text-body text-decoration-none" href="{{ route('register') }}">SignUp</a>
            </div>
            <div>
                <h4>Contact</h4>
                <div class="fw-light">
                    <a class="d-block text-body" href="tel:5538998434938">+55 (38) 9 9843-4938</a>
                    <a class="d-block text-body"
                        href="mailto:marcelohenrique8822@gmail.com">marcelohenrique8822@gmail.com</a>
                    <div class="fs-2">
                        <a href="https://api.whatsapp.com/send?phone=5538998434938&text=Olá!"><i
                                class="text-body fa-brands fa-square-whatsapp"></i></a>
                        <a href="https://github.com/MarceloH1122/"><i
                                class="text-body fa-brands fa-square-github"></i></a>
                        <a href="https://www.linkedin.com/in/marcelo-henrique-kg/"><i
                                class="text-body fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a class="my-2 my-ref text-body text-center" href="https://github.com/MarceloH1122" target="_black">&copy;
        Marcelo
        Henrique - {{ date('Y') }}
    </a>
</body>

</html>
