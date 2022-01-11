<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/blog.css">
     <link href="/css/chat.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    @stack('style')
    @livewireStyles
    <title>Tellme for your mental health</title>
</head>

<body class="bg-light">
    <div class="container">
        <x-navbar-app-layout>
        </x-navbar-app-layout>
    </div>
    {{-- main content --}}
    <div class="container my-3">
        <div class="row p-2">
            <div class="col p-2 d-md-none d-lg-block d-sm-none d-md-block d-none d-sm-block">
                <x-side-menu></x-side-menu>
            </div>
            <div class="col-md-7 border-end border-start ">
                @yield('main')
            </div>
            <div class="col p-2 d-sm-none d-md-block d-none d-sm-block ">
                @yield('side-content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    @livewireScripts
    @stack('script')
    <script>
        var clipboard = new ClipboardJS('.btn');
    </script>
</body>

</html>
