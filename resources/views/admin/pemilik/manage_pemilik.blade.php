<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Dashboard Admin</title>
</head>

<body class="d-flex" style="min-height: 100vh; overflow: hidden;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    {{-- Sidebar --}}
    <x-sidebar></x-sidebar>

    {{-- Main Content --}}
    <main class="flex-grow-1 d-flex flex-column" style="height: 100vh; overflow: auto;">
        {{-- Header Fixed --}}
        <x-header>Manage Pemilik</x-header>

        <div class="flex-grow-1">
            <div class="container-fluid p-3">
                <h2 class="mt-0 mb-2">Welcome</h2>
                <p class="mb-3">Your data is right here</p>

                {{-- for alert --}}
                {{-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif --}}

                <div class="container-fluid p3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Data Pemilik</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:70px">#</th>
                                        <th>ID Pemilik</th>
                                        <th>Nama Pemilik</th>
                                        <th>No. WA</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemiliks as $i => $pemilik)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $pemilik->idpemilik ?? ($pemilik->iduser ?? '-') }}
                                            </td>
                                            <td>{{ $pemilik->user->nama ?? '-' }}
                                            </td>
                                            <td>{{ $pemilik->no_wa ?? '-' }}</td>
                                            <td>{{ $pemilik->alamat ?? '-' }}</td>
                                            <td>
                                                <div class="d-grid gap-2 d-md-block">
                                                    <a href="#"
                                                        class="btn btn-sm btn-info p-1 px-2"
                                                        title="Lihat">
                                                        <i class="bi bi-eye fs-6"></i>
                                                    </a>
                                                    <a href="#"
                                                        class="btn btn-sm btn-warning p-1 px-2"
                                                        title="Edit">
                                                        <i class="bi bi-pencil fs-6"></i>
                                                    </a>
                                                    <form method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus pemilik ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger p-1 px-2"
                                                            title="Hapus">
                                                            <i class="bi bi-trash fs-6"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</body>

</html>
