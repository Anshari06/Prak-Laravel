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
            href="/dokter-dashboard">
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
            <x-nav-link href="/dokter-dashboard" :active="request()->is('dokter-dashboard')"
                icn="bi bi-house-door me-2">Dashboard</x-nav-link>
        </li>
        <li>
            <x-nav-link href="/dokter/rekam" :active="request()->is('dokter/rekam')" icn="bi bi-folder2-open me-2">
                Rekam Medis</x-nav-link>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#"
            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            id="dropdownUserDoc" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                class="rounded-circle me-2">
            <strong>{{ session('user_name') ?? (Auth::user()->nama ?? Auth::user()->name ?? 'Dokter') }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
            aria-labelledby="dropdownUserDoc" style="">
            <li><a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-d').submit();">Sign out</a></li>
            <form id="logout-form-d" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </ul>
    </div>
</div>