<nav class="sidebar" id="mySidebar">
    <div class="menu_content">
        <ul class="menu_items mb-0">
            <div class="menu_title menu_dahsboard"></div>
            <li class="item">
                <a href="{{ route('dashboard') }}" class="nav_link submenu_item">
                    <span class="navlink_icon">
                        <i class='bx bx-table'></i>
                    </span>
                    <span class="navlink">Rekapitulasi</span>
                </a>
            </li>
        </ul>

        <ul class="menu_items">
            <div class="menu_title menu_editor"></div>
            <li class="item">
                <a href="{{ route('absensi') }}" class="nav_link">
                    <span class="navlink_icon">
                        <i class='bx bx-user-pin'></i>
                    </span>
                    <span class="navlink">Absensi</span>
                </a>
            </li>

            <li class="item">
                <a href="{{ route('data-ochi') }}" class="nav_link">
                    <span class="navlink_icon">
                        <i class='bx bx-notepad'></i>
                    </span>
                    <span class="navlink">OCHI</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('data-qcc') }}" class="nav_link">
                    <span class="navlink_icon">
                        <i class='bx bx-folder-open'></i>
                    </span>
                    <span class="navlink">QCC</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('karyawan') }}" class="nav_link">
                    <span class="navlink_icon">
                        <i class='bx bxs-user-detail'></i>
                    </span>
                    <span class="navlink">Data Karwayan</span>
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