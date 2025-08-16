@php
$role = Auth::user()->role;
@endphp

<!-- Page Sidebar Start -->
<div class="sidebar-wrapper" data-layout="stroke-svg">

    <!-- Logo Section -->
    <div class="logo-wrapper">
        <a href="index-2.html">
            <img class="img-fluid" src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo">
        </a>
        <div class="back-btn">
            <i class="fa fa-angle-left"></i>
        </div>
    </div>

    <!-- Logo Icon (Mini Mode) -->
    <div class="logo-icon-wrapper">
        <a href="index-2.html">
            <img class="img-fluid" src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo Icon">
        </a>
    </div>

    <!-- Sidebar Menu -->
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow">
            <i data-feather="arrow-left"></i>
        </div>
        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
                <!-- Back Button (Mobile) -->
                <li class="back-btn">
                    <a href="index-2.html">
                        <img class="img-fluid" src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo Icon">
                    </a>
                    <div class="mobile-back text-end text-white">
                        <span>Back</span>
                        <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                    </div>
                </li>


                <!-- General Section -->
                <li class="sidebar-main-title">
                    <div>
                        <h6 class=" lan-1text-white">MENU</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav text-white active" href="{{route('dashboard')}}">
                        <i class="fa fa-dashboard me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if ($role == 'superadmin')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav text-white" href="{{route('company-profile.edit')}}">
                        <i class="fa fa-building me-2"></i>
                        <span>Company Profile</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav text-white" href="{{ route('types') }}">
                        <i class="fa fa-leaf me-2"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                @endif

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav text-white" href="{{route('products')}}">
                        <i class="fa fa-cube me-2"></i>
                        <span>Produk</span>
                    </a>
                </li>

                @if ($role == 'superadmin')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav text-white" href="{{route('customers')}}">
                        <i class="fa fa-users me-2"></i>
                        <span>Customer</span>
                    </a>
                </li>
                @endif

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav text-white" href="{{route('orders')}}">
                        <i class="fa fa-list-alt me-2"></i>
                        <span>Pesanan</span>
                    </a>
                </li>

            </ul>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </div>
    </nav>

</div>
<!-- Page Sidebar Ends -->
