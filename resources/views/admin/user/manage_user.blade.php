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
    {{-- Konten utama --}}
    <main class="flex-grow-1 p-4" style="overflow-y: auto;">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Data User</h2>

                {{-- <a href="{{ route('barang.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah  --}}
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="container">
                <h1>Manage Users</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $i => $user)
                            <tr>
                                <td>{{ $i + 1 }}</td> {{-- Menampilkan nomor urut --}}
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at ? $user->created_at->format('Y-m-d H:i') : '-' }}</td>
                                <td>
                                    <div class=" d-grid gap-2 d-md-block">
                                                <a 
                                                {{-- href="{{ route('.show', $barang->idbarang) }}" --}}
                                                    class="btn btn-sm btn-info p-1 px-2" title="Lihat">
                                                    <i class="bi bi-eye fs-6"></i>
                                                </a>
                                                <a 
                                                {{-- href="{{ route('.edit', $barang->idbarang) }}" --}}
                                                    class="btn btn-sm btn-warning p-1 px-2" title="Edit">
                                                    <i class="bi bi-pencil fs-6"></i>
                                                </a>
                                                <form
                                                    {{-- action="{{ route('.destroy', $barang->idbarang) }}" --}}
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
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
    </main>
</body>

</html>
