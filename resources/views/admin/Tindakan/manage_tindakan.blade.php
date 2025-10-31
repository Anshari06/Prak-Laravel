
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
    <title>Manage Tindakan</title>
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
        <x-header>Manage Tindakan</x-header>

        <div class="flex-grow-1">
            <div class="container-fluid p-3">
                <h2 class="mt-0 mb-2">Manage Tindakan</h2>
                <p class="mb-3">Daftar tindakan klinis.</p>
            </div>

            <div class="container-fluid p-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Data Tindakan</strong>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:70px">Number</th>
                                    <th>ID</th>
                                    <th>Nama Tindakan</th>
                                    <th>Kategori</th>
                                    <th>Klinis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($tindakans ?? collect()) as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $item->idkode_tindakan_terapi ?? '-' }}</td>
                                        <td>{{ $item->deskripsi_tindakan_terapi ?? '-' }}</td>
                                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                        <td>{{ $item->kat_klinis->nama_kategori_klinis ?? '-' }}</td>
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
                                        <td colspan="5" class="text-center py-4">Tidak ada data
                                            tindakan</td>
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
