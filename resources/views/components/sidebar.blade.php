<style>
    .nav-link:hover,
    .nav-link:focus {
        background-color: #0dcaf0 !important;
        color: #fff !important;
        text-decoration: none;
    }
</style>
{{-- icon --}}

<head>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <div class="container-fluid">
        {{-- Brand: image + wrapped text. Use flex so the text can wrap within sidebar width. --}}
        <a class="navbar-brand d-flex align-items-start gap-2 text-white fs-5 fw-bold"
            href="/dashboard">
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
            <x-nav-link href="/admin-dashboard" :active="request()->is('admin-dashboard')"
                icn="bi bi-house-door me-2">Dashboard</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage-user" :active="request()->is('manage-user*')" icn="bi bi-people me-2">
                Manage User</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage-role" :active="request()->is('manage-role')" icn="bi bi-person-circle me-2">
                Manage Role</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage-pemilik" :active="request()->is('manage-pemilik')" icn="bi bi-person me-2">
                Manage Pemilik</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage-dokter" :active="request()->is('manage-dokter*')" icn="bi bi-person-badge me-2">
                Manage Dokter</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage-perawat" :active="request()->is('manage-perawat*')" icn="bi bi-person me-2">
                Manage Perawat</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage-jenis" :active="request()->is('manage-jenis')" icn="bx bxs-paw-print me-2">
                Manage Jenis Hewan</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage-pet" :active="request()->is('manage-pet')" icn="bx bx-paw-print reguler me-2">
                Manage Pets</x-nav-link>
        </li>
        <hr>
        <li>
            <span class="text-wrap flex-shrink-1 fw-bold"
                style="white-space: normal; word-break: break-word;">
                Manajemen Kategori </span>
        </li>
        <li>
            <x-nav-link href="/manage-kategori" :active="request()->is('manage-kategori')" icn="bi bi-list-ul me-2">
                Daftar Kategori</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage-kategori-klinis" :active="request()->is('manage-kategori-klinis')"
                icn="bi bi-heart-pulse-fill me-2">
                Daftar Kategori Klinis</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/manage-tindakan" :active="request()->is('manage-tindakan')" icn="bi bi-heart-pulse me-2">
                Daftar Kategori Tindakan Terapi</x-nav-link>
        </li>

    </ul>
    <hr>
    <div class="dropdown">
        <a href="#"
            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                class="rounded-circle me-2">
            <strong>{{ session('user_name') ?? (Auth::user()->nama ?? (Auth::user()->name ?? 'User')) }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
            aria-labelledby="dropdownUser1" style="">
            <li><a class="dropdown-item" href="{{ route('logout') }}">Sign out</a></li>
        </ul>
    </div>
</div>
