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
        <a class="navbar-brand d-flex align-items-start gap-2 text-white fs-5 fw-bold"
            href="/resepsionis">
            <img src="{{ asset('img/logo-uner.png') }}" alt="Logo" width="50"
                class="flex-shrink-0 me-2">
            <span class="text-wrap flex-shrink-1"
                style="white-space: normal; word-break: break-word;">
                Rumah Sakit Pendidikan Hewan Unair
            </span>
        </a>
    </div>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto resepsionis-nav">
        <li class="nav-item">
            <x-nav-link href="/resepsionis-dashboard" :active="request()->is('resepsionis-dashboard')" icn="bi bi-house-door me-2">
                Dashboard
            </x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link href="/regis-pet" :active="request()->is('regis-pet')"
                icn="bi bi-clipboard2-plus me-2">
                Registrasi Pet
            </x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link href="/regis-pemilik" :active="request()->is('regis-pemilik')"
                icn="bi bi-person-plus me-2">
                Registrasi Pemilik
            </x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link href="/temu-dokter" :active="request()->is('temu-dokter')"
                icn="bi bi-clipboard-data me-2">
                Temu Dokter
            </x-nav-link>
        </li>
    </ul>

    <hr>

    <div class="dropdown">
        <a href="#"
            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                class="rounded-circle me-2">
            <strong>{{ session('user_name') ?? (Auth::user()->nama ?? (Auth::user()->name ?? 'Resepsionis')) }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
            aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-r').submit();">Logout</a>
                <form id="logout-form-r" action="{{ route('logout') }}" method="POST"
                    class="d-none">@csrf</form>
            </li>
        </ul>
    </div>
</div>
