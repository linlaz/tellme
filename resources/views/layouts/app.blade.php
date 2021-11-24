<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard | Tellme</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/dist/trix.css">
    <style>
        trix-toolbar .trix-button-group--file-tools {
            display: none;
        }

        trix-toolbar .trix-button-group--block-tools {
            display: none;
        }

    </style>
    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/css/record.css" rel="stylesheet">
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="https://markjivko.com/dist/recorder.js"></script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/" class="logo d-flex align-items-center">
                <img src="/assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Tellme</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="/assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="/assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="/assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ Auth::user()->getRoleNames() }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.show') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">


            {{-- user --}}
            <li class="nav-item">
                <a class="nav-link @if (!Request::is('dashboard*')) collapsed @endif" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if (!Request::is('saved')) collapsed @endif" href="{{ route('save') }}">
                    <i class="bx bx-save"></i>
                    <span>save</span>
                </a>
            </li>

            @if (Auth::user()->hasRole(['user', 'konsultan', 'writer', 'admin']))
                <li class="nav-item">
                    <a class="nav-link @if (!Request::is('konsultasi')) collapsed @endif" href="{{ route('konsultasi') }}">
                        <i class="bi bi-chat-left"></i>
                        <span>konsultasi</span>
                    </a>
                </li>
            @endif
            {{-- user --}}


            {{-- konsultan --}}
            @if (Auth::user()->hasRole(['admin', 'konsultan']))
                <li class="nav-heading">konsultan</li>
            @endif

            @if (Auth::user()->hasRole(['konsultan', 'admin']))
                <li class="nav-item">
                    <a class="nav-link @if (!Request::is('komunikasi')) collapsed @endif " href="{{ route('komunikasi') }}">
                        <i class="bi bi-chat-left-quote"></i>
                        <span>komunikasi</span>
                    </a>
                </li>
            @endif
            {{-- endkonsultasi --}}


            {{-- writer blog --}}
            @if (Auth::user()->hasRole(['admin', 'writer']) || Auth::user()->hasPermissionTo('add-blog'))
                <li class="nav-heading">blog</li>
            @endif

            @if (Auth::user()->hasRole(['writer', 'admin']) || Auth::user()->hasPermissionTo('add-blog'))
                <li class="nav-item">
                    <a class="nav-link @if(!Request::is('blog*'))collapsed @endif" href="{{ route('blog') }}">
                        <i class="bi bi-files"></i>
                        <span >blog</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->hasRole(['writer', 'admin']) || Auth::user()->hasPermissionTo('delete-category'))
                <li class="nav-item">
                    <a class="nav-link @if(!Request::is('category'))collapsed @endif " href="{{ route('category') }}">
                        <i class="bx bxs-category"></i>
                        <span>Category</span>
                    </a>
                </li>
            @endif

            {{-- end writer blog --}}


            @if (Auth::user()->hasRole('admin'))
                <li class="nav-heading">admin</li>

                <li class="nav-item">
                    <a class="nav-link @if (!Request::is('dashboardadmin')) collapsed @endif" href="{{ route('dashboardadmin') }}">
                        <i class="bi bi-person-lines-fill"></i>
                        <span>Dashboard admin</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(!Request::is('user*'))collapsed @endif" href="{{ route('user') }}">
                        <i class="ri-user-3-line"></i>
                        <span>User</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(!Request::is('role*'))collapsed @endif" href="{{ route('aboutrole') }}">
                        <i class="bi bi-unlock"></i>
                        <span>role and permission</span>
                    </a>
                </li>

            @endif



        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main min-vh-100">
        {{ $slot }}
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/vendor/quill/quill.min.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/assets/vendor/chart.js/chart.min.js"></script>
    <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/vendor/echarts/echarts.min.js"></script>
    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>
    <script src="/js/record.js"></script>
    <script type="text/javascript" src="/dist/trix.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                tags: true
            });
        });

        document.addEventlistener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script>

</body>

</html>
