<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Tellme | for your mental health</title>

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
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    @livewireStyles
    @stack('style')
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/blog.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light blog-header py-3">
            <div class="container-fluid">
                <a class=" blog-header-logo text-dark" href="/">Tellme</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item mx-3">
                            <a class="nav-link btn" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link btn" href="{{ route('blogs') }}">blog</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        @auth
                            <a class="btn btn-sm btn-outline-secondary" href="{{ url('/dashboard') }}">Dashboard</a>
                        @endauth
                        @guest
                            <a class="btn btn-sm btn-outline-secondary" href="/register">register</a>
                            <a class="btn btn-sm btn-outline-primary mx-2" href="{{ route('login') }}">login</a>
                        @endguest

                    </div>
                </div>
            </div>
        </nav>
    </div>

    <main class="container mt-2" style="min-height: 600px;">
        {{ $slot }}
    </main>

    <footer class="container blog-footer">
        <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a
                href="https://twitter.com/mdo">@mdo</a>.</p>
        <p>
            <a href="#">Back to top</a>
        </p>
    </footer>



</body>
@livewireScripts
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script>
    var clipboard = new ClipboardJS('.btn');
</script>
@stack('script')

</html>
