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
        <x-header>Manage Jenis</x-header>

        <div class="flex-grow-1">
            <div class="container-fluid p-3">
                <h2 class="mt-0 mb-2">Welcome</h2>
                <p class="mb-3">Your data is right here</p>
            </div>

            {{-- Table: Daftar Jenis Hewan --}}
            <div class="container-fluid p-3">
                <div class="card">
                    <div class="card-header">
                        <strong>Daftar Jenis Hewan</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:60px">#</th>
                                        <th>ID</th>
                                        <th>Nama Jenis Hewan</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jenisHewans ?? collect() as $i => $jenis)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $jenis->idjenis_hewan ?? '-' }}</td>
                                            <td>{{ $jenis->nama_jenis_hewan ?? '-' }}</td>
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-outline-primary">Edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">No jenis
                                                hewan found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</body>
