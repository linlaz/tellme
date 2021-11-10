<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Blog Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/blog/">


    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    @livewireStyles
    <link rel="stylesheet" type="text/css" href="/dist/trix.css">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/blog.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="link-secondary" href="#">Subscribe</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="#">Large</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    @if (Route::has('login'))
                        @auth
                            <a class="btn btn-sm btn-outline-secondary" href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a class="btn btn-sm btn-outline-secondary mx-2" href="{{ route('login') }}">login</a>
                            @if (Route::has('register'))
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        {{-- <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">
                <a class="p-2 link-secondary" href="#">World</a>
                <a class="p-2 link-secondary" href="#">U.S.</a>
                <a class="p-2 link-secondary" href="#">Technology</a>
                <a class="p-2 link-secondary" href="#">Design</a>
                <a class="p-2 link-secondary" href="#">Culture</a>
                <a class="p-2 link-secondary" href="#">Business</a>
                <a class="p-2 link-secondary" href="#">Politics</a>
                <a class="p-2 link-secondary" href="#">Opinion</a>
                <a class="p-2 link-secondary" href="#">Science</a>
                <a class="p-2 link-secondary" href="#">Health</a>
                <a class="p-2 link-secondary" href="#">Style</a>
                <a class="p-2 link-secondary" href="#">Travel</a>
            </nav>
        </div> --}}
    </div>

    <main class="container mt-2" style="min-height: 600px;">

        {{ $slot }}


    </main>

    <footer class="blog-footer">
        <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a
                href="https://twitter.com/mdo">@mdo</a>.</p>
        <p>
            <a href="#">Back to top</a>
        </p>
    </footer>



</body>
@livewireScripts
<script type="text/javascript" src="/dist/trix.js"></script>
    
</html>
