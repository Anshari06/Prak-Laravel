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

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 260px;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-start gap-2 text-white fs-5 fw-bold"
            href="/resepsionis">
            <img src="{{ asset('img/logo-uner.png') }}" alt="Logo" width="44"
                class="flex-shrink-0 me-2">
            <span class="text-wrap flex-shrink-1"
                style="white-space: normal; word-break: break-word;">
                Rumah Sakit Pendidikan Hewan Unair
            </span>
        </a>
    </div>

    <hr class="border-light">

    <ul class="nav nav-pills flex-column mb-auto resepsionis-nav">
        <li class="nav-item">
            <x-nav-link href="/resepsionis-dashboard" :active="request()->is('resepsionis')" icn="bi bi-house-door me-2">
                Dashboard
            </x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link href="/resepsionis/antrian" :active="request()->is('resepsionis/antrian')"
                icn="bi bi-clipboard-data me-2">
                Antrian
            </x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link href="/resepsionis/registrasi" :active="request()->is('resepsionis/registrasi')"
                icn="bi bi-person-plus me-2">
                Registrasi Pasien
            </x-nav-link>
        </li>
        <li class="nav-item">
            <x-nav-link href="/resepsionis/pasien" :active="request()->is('resepsionis/pasien')" icn="bi bi-people me-2">
                Data Pasien
            </x-nav-link>
        </li>
        <li class="nav-item mt-2">
            <x-nav-link href="/resepsionis/rekam" :active="request()->is('resepsionis/rekam')" icn="bi bi-folder2-open me-2">
                Rekam Medis
            </x-nav-link>
        </li>
    </ul>

    <hr class="border-light">

    <div class="mt-auto">
        <div class="dropdown">
            <a href="#"
                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                    class="rounded-circle me-2">
                <strong>{{ Auth::user()->nama ?? (Auth::user()->name ?? 'Resepsionis') }}</strong>
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
</div>
