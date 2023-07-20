<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fontawesome/css/all.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="css/style.css" /> -->
    <link href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}" rel="stylesheet">


    <!-- <link rel="stylesheet" href="css/app.css" /> -->
</head>

<body>
    <!-- navbar -->
    @include('admin.layout.navbar')

    <!-- sidebar -->
    <!-- <div class="container-fluid"> -->
    <nav class="sidebar">
        <div class="menu_content">
            <ul class="menu_items">
                <div class="menu_title menu_dahsboard"></div>
                <!-- duplicate or remove this li tag if you want to add or remove navlink with submenu -->
                <!-- start -->
                <li class="item">
                    <div href="#" class="nav_link submenu_item">
                        <span class="navlink_icon">
                            <i class="bx bx-home-alt"></i>
                        </span>
                        <span class="navlink">Home</span>
                        <i class="bx bx-chevron-right arrow-left"></i>
                    </div>

                    <ul class="menu_items submenu">
                        <a href="#" class="nav_link sublink">Nav Sub Link</a>
                        <a href="#" class="nav_link sublink">Nav Sub Link</a>
                        <a href="#" class="nav_link sublink">Nav Sub Link</a>
                        <a href="#" class="nav_link sublink">Nav Sub Link</a>
                    </ul>
                </li>
                <!-- end -->

                <!-- duplicate this li tag if you want to add or remove  navlink with submenu -->
                <!-- start -->
                <li class="item">
                    <div href="#" class="nav_link submenu_item">
                        <span class="navlink_icon">
                            <i class="bx bx-grid-alt"></i>
                        </span>
                        <span class="navlink">Overview</span>
                        <i class="bx bx-chevron-right arrow-left"></i>
                    </div>

                    <ul class="menu_items submenu">
                        <a href="#" class="nav_link sublink">Nav Sub Link</a>
                        <a href="#" class="nav_link sublink">Nav Sub Link</a>
                        <a href="#" class="nav_link sublink">Nav Sub Link</a>
                        <a href="#" class="nav_link sublink">Nav Sub Link</a>
                    </ul>
                </li>
                <!-- end -->
            </ul>

            <ul class="menu_items">
                <div class="menu_title menu_editor"></div>
                <!-- duplicate these li tag if you want to add or remove navlink only -->
                <!-- Start -->
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bxs-magic-wand"></i>
                        </span>
                        <span class="navlink">Magic build</span>
                    </a>
                </li>
                <!-- End -->

                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-loader-circle"></i>
                        </span>
                        <span class="navlink">Filters</span>
                    </a>
                </li>
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-filter"></i>
                        </span>
                        <span class="navlink">Filter</span>
                    </a>
                </li>
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-cloud-upload"></i>
                        </span>
                        <span class="navlink">Upload new</span>
                    </a>
                </li>
            </ul>
            <ul class="menu_items">
                <div class="menu_title menu_setting"></div>
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-flag"></i>
                        </span>
                        <span class="navlink">Notice board</span>
                    </a>
                </li>
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-medal"></i>
                        </span>
                        <span class="navlink">Award</span>
                    </a>
                </li>
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-cog"></i>
                        </span>
                        <span class="navlink">Setting</span>
                    </a>
                </li>
                <li class="item">
                    <a href="#" class="nav_link">
                        <span class="navlink_icon">
                            <i class="bx bx-layer"></i>
                        </span>
                        <span class="navlink">Features</span>
                    </a>
                </li>
            </ul>

            <!-- Sidebar Open / Close -->
            <div class="bottom_content">
                <div class="bottom expand_sidebar">
                    <span> Expand</span>
                    <i class='bx bx-log-in'></i>
                </div>
                <div class="bottom collapse_sidebar">
                    <span> Collapse</span>
                    <i class='bx bx-log-out'></i>
                </div>
            </div>
        </div>
    </nav>

    <main class="content pt-5">
        @yield('content')
    </main>
    <!-- </div> -->

    <!-- JavaScript -->
    <!-- <script src="js/script.js"></script> -->
    <script src="{{ asset('js/script.js') }}?v={{ filemtime(public_path('js/script.js')) }}"></script>
    <!-- <script src="js/app.js"></script> -->
</body>

</html>