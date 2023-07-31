<nav class="navbar">
    <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        <!-- <img src="images/logo.png" alt=""></i>CodingNepal -->
    </div>

    <div class="navbar_content">
        <!-- <i class="bi bi-grid"></i> -->
        <i class='bx bx-sun' id="darkLight"></i>
        <!-- <i class='bx bx-bell'></i> -->
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <span>{{ Auth::user()->nik }}</span>
                <img src="assets/img/account.png" class="img" alt="">
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                    <a class="dropdown-item" href="/change-password">
                        <!-- <span> -->
                            <i class="fa-solid fa-key"></i>
                            <span>Change Password</span>
                        <!-- </span> -->

                    </a>
                </li>

                <div class="dropdown-divider"></div>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <!-- <span > -->
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>{{ __('Logout') }}</span>
                        <!-- </span> -->

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
            <!-- <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul> -->
        </li>
    </div>
</nav>