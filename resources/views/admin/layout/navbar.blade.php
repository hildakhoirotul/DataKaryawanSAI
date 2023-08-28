<nav class="navbar">
    <div class="logo_item ms-3">

        <i class="bx bx-menu" id="sidebarOpen"></i>
    </div>

    <div class="navbar_content">

        <i class='bx bx-sun' id="darkLight"></i>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <span>{{ Auth::user()->nik }}</span>
                <img src="assets/img/account.png" class="img" alt="">
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                <li>
                    <a class="dropdown-item" href="/change-password">
                        <i class="fa-solid fa-key"></i>
                        <span>Ganti Sandi</span>

                    </a>
                </li>

                <div class="dropdown-divider"></div>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>{{ __('Keluar') }}</span>

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </div>
</nav>