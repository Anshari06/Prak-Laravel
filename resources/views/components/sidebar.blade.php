<style>
    .nav-link:hover,
    .nav-link:focus {
        background-color: #0dcaf0 !important;
        color: #fff !important;
        text-decoration: none;
    }
</style>

<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <div class="container-fluid">
        {{-- Brand: image + wrapped text. Use flex so the text can wrap within sidebar width. --}}
        <a class="navbar-brand d-flex align-items-start gap-2 text-white fs-5 fw-bold" href="#">
            <img src="{{ asset('img/logo-uner.png') }}" alt="Unair" width="50"
                class="flex-shrink-0 me-2">
            <span class="text-wrap flex-shrink-1"
                style="white-space: normal; word-break: break-word;">
                Rumah Sakit Pendidikan Hewan Unair
            </span>
        </a>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <x-nav-link href="/dashboard" :active="request()->is('/dashboard')"
                icn="bi bi-house-door me-2">Dashboard</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage-user" :active="request()->is('manage-user')" icn="bi bi-people me-2">
                Manage User</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage_barang" :active="request()->is('manage_barang')" icn="bi bi-box-seam me-2">
                Manage Barang</x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link href="/orders" :active="request()->is('orders')" icn="bi bi-table me-2">Orders</x-nav-link>
        </li>
        <li>
            <a href="#" class="nav-link text-white">
                <i class="bi bi-people me-2"></i>
                Customers
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#"
            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                class="rounded-circle me-2">
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
            aria-labelledby="dropdownUser1" style="">
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div>
