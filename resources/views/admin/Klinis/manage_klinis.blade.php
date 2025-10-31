<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Manage Klinis</title>
</head>

<body class="d-flex" style="min-height: 100vh; overflow: hidden;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <x-sidebar></x-sidebar>

    <main class="flex-grow-1 d-flex flex-column" style="height: 100vh; overflow: auto;">
        <x-header>Manage Klinis</x-header>

        <div class="flex-grow-1">
            <div class="container-fluid p-3">
                <h2 class="mt-0 mb-2">Manage Klinis</h2>
                <p class="mb-3">Daftar klinis / catatan medis.</p>
            </div>

            <div class="container-fluid p-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Data Klinis</strong>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:70px">No</th>
                                    <th>ID</th>
                                    <th>Pet</th>
                                    <th>Tanggal</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($kliniss ?? collect()) as $i => $k)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $k->idklinis ?? ($k->id ?? '-') }}</td>
                                        <td>{{ $k->pet->nama ?? '-' }}</td>
                                        <td>{{ $k->tanggal ?? '-' }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($k->catatan ?? '-', 80) }}
                                        </td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-block">
                                                <a href="#"
                                                    class="btn btn-sm btn-info p-1 px-2"
                                                    title="Lihat"><i
                                                        class="bi bi-eye fs-6"></i></a>
                                                <a href="#"
                                                    class="btn btn-sm btn-warning p-1 px-2"
                                                    title="Edit"><i
                                                        class="bi bi-pencil fs-6"></i></a>
                                                <form method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger p-1 px-2"
                                                        title="Hapus"><i
                                                            class="bi bi-trash fs-6"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">Tidak ada
                                            catatan klinis</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

