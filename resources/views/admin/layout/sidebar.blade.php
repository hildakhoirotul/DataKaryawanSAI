<nav class="sidebar" id="mySidebar">
    <div class="menu_content">
        <ul class="menu_items mb-0">
            <div class="menu_title menu_dahsboard"></div>
            <li class="item">
                <a href="{{ route('dashboard') }}" class="nav_link submenu_item">
                    <span class="navlink_icon">
                        <i class="bi bi-table"></i>
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
                        <i class="bi bi-person-check"></i>
                    </span>
                    <span class="navlink">Absensi</span>
                </a>
            </li>

            <li class="item">
                <a href="{{ route('data-ochi') }}" class="nav_link">
                    <span class="navlink_icon">
                        <i class="bi bi-journal-text"></i>
                    </span>
                    <span class="navlink">OCHI</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('data-qcc') }}" class="nav_link">
                    <span class="navlink_icon">
                        <i class="bi bi-journals"></i>
                    </span>
                    <span class="navlink">QCC</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('karyawan') }}" class="nav_link">
                    <span class="navlink_icon">
                        <i class="bi bi-person-vcard"></i>
                    </span>
                    <span class="navlink">Data Karyawan</span>
                </a>
            </li>
        </ul>

        <ul class="menu_items">
            <div class="menu_title menu_setting"></div>
            <li class="item">
                <a href="{{ route('setting') }}" class="nav_link">
                    <span class="navlink_icon">
                        <i class="bi bi-gear"></i>
                    </span>
                    <span class="navlink">Pengaturan</span>
                </a>
            </li>
            <li class="item">
                <a href="{{ route('intruksi') }}" class="nav_link">
                    <span class="navlink_icon">
                        <i class="bi bi-chat-dots"></i>
                    </span>
                    <span class="navlink">Petunjuk</span>
                </a>
            </li>
        </ul>
        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
            <div class="bottom expand_sidebar">
                <span> Expand</span>
                <i class="bi bi-box-arrow-in-right"></i>
            </div>
            <div class="bottom collapse_sidebar">
                <span> Collapse</span>
                <i class="bi bi-box-arrow-in-left"></i>
            </div>
        </div>
    </div>
</nav>