<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
{{-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. -
Immanuel Kant --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="blog-header-logo text-dark" href="/">Tellme</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul
                class="navbar-nav me-auto mb-2 mb-lg-0 d-xxl-none d-xl-none d-xxl-block d-lg-none d-xl-block text-center">
                <li class="nav-item">
                    <a class="nav-link active btn btn-xl" @if (Request::is('/'))
                        style="color: #0aa2c0;"
                    @elseif(Request::is('story*'))
                        style="color: #0aa2c0;"
                        @endif aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active btn btn-xl" @if (Request::is('blog*'))style="color: #0aa2c0;" @endif aria-current="page"
                        href="/blog">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active btn btn-xl" @if (Request::is('save'))style="color: #0aa2c0;" @endif aria-current="page"
                        href="/save">Save</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active btn btn-xl" @if (Request::is('consultation'))style="color: #0aa2c0;" @endif aria-current="page"
                        href="/consultation">consultation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active btn btn-xl" @if (Request::is('profile'))style="color: #0aa2c0;" @endif aria-current="page"
                        href="/profile">Profile</a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link active btn btn-xl" @if (Request::is('settingprofile'))style="color: #0aa2c0;" @endif aria-current="page"
                        href="/settingprofile">
                        Setting Profile</a>
                </li>
                <div class="d-flex justify-content-center">
                    @auth
                        @php
                            if (Auth::user()->hasPermissionTo('show-story-dashboard')) {
                                $url = '/dashboard/story';
                            } elseif (Auth::user()->hasPermissionTo('show-blog-dashboard')) {
                                $url = '/dashboard/blog';
                            } elseif (Auth::user()->hasPermissionTo('show-komunikasi-dashboard')) {
                                $url = '/dashboard/blog';
                            } else {
                                $url = null;
                            }
                        @endphp
                        @if ($url != null)
                            <a class="btn btn-xl btn-outline-secondary" href="{{ $url }}">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-xl btn-outline-danger mx-3">
                                <span>Sign Out</span>
                            </button>
                        </form>
                    @endauth
                    {{-- @can('gotodashboard')
                        <a class="btn btn-xl btn-outline-secondary" href="/dashboard">Dashboard</a>
                    @endcan --}}
                    @guest
                        <a class="btn btn-xl btn-outline-secondary" href="/register">register</a>
                        <a class="btn btn-xl btn-outline-primary mx-2" href="/login">login</a>
                    @endguest

                </div>
            </ul>
        </div>
        <div class="d-md-none d-lg-block d-sm-none d-md-block d-none d-sm-block">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="d-block btn btn-xl btn-outline-danger mx-3">
                        <i class="ri-logout-box-line"></i>
                        Sign Out
                    </button>
                </form>
            @endauth

            @guest
                <a class="btn btn-xl btn-outline-secondary " href="/register"><i class="ri-registered-line"></i>Register</a>
                <a class="btn btn-xl btn-outline-primary mx-2" href="/login"><i class="ri-login-box-line"></i>Login</a>
            @endguest
        </div>

    </div>
</nav>
