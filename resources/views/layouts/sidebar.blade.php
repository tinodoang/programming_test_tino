<style>
    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px
    }
</style>

<div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-1" href="dashboard"><img src="{{ asset('img/logosd.png') }}" class="mr-2"
                    alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="dashboard"><img src="{{ asset('img/logosd.png') }}"
                    alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
                <hr class="sidebar-divider d-none d-md-block">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                        <img src="{{ asset('img/faces/face28.jpg') }}" alt="profile" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <div class="d-flex prof">
                    <img src="{{ asset('img/faces/face28.jpg') }}" alt="profile" class="profile-img" />
                    <span class="ml-2 text-gray-600 mt-3 text-muted">{{ auth()->user()->name }}</span>
                </div>

                <p class="text-muted">Dashboard</p>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('home') }}">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <p class="nav-item text-muted">Data Master</p>
                @if (auth()->user()->peran === 'Admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('user') }}">
                            <i class="fa-solid fa-users menu-icon"></i>
                            <span class="menu-title">User</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('kategori') }}">
                        <i class="fa-solid fa-list menu-icon"></i>
                        <span class="menu-title">Kategori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('produk') }}">
                        <i class="fa-solid fa-computer menu-icon"></i>
                        <span class="menu-title">Produk</span>
                    </a>
                </li>
                <p class="nav-item text-muted">Transaksi</p>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('riwayat') }}">
                        <i class="fa-solid fa-history menu-icon"></i>
                        <span class="menu-title">Riwayat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('transaksi') }}">
                        <i class="fa-solid fa-money-bill-1-wave menu-icon"></i>
                        <span class="menu-title">Transaksi</span>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- main-panel ends -->
        <div class="main-panel">
            <!-- page-body-wrapper ends -->
            <div class="content-wrapper">
