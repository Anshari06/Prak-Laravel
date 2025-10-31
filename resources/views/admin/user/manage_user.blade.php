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
        <x-header>Manage Users</x-header>

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
                            <strong>Data Users</strong>
                        </div>
                        <div class=" table-responsive">
                            <table class="table table-striped-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="70px">Number</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $i => $user)
                                        <tr>
                                            <td>{{ $i + 1 }}</td> {{-- Menampilkan nomor urut --}}
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->nama_role }}</td>
                                            <td>
                                                <div class=" d-grid gap-2 d-md-block">
                                                    <a {{-- href="{{ route('.show', $barang->idbarang) }}" --}}
                                                        class="btn btn-sm btn-info p-1 px-2"
                                                        title="Lihat">
                                                        <i class="bi bi-eye fs-6"></i>
                                                    </a>
                                                    <a {{-- href="{{ route('.edit', $barang->idbarang) }}" --}}
                                                        class="btn btn-sm btn-warning p-1 px-2"
                                                        title="Edit">
                                                        <i class="bi bi-pencil fs-6"></i>
                                                    </a>
                                                    <form {{-- action="{{ route('.destroy', $barang->idbarang) }}" --}} method="POST"
                                                        class="d-inline"
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
                </div>
            </div>
    </main>
</body>

</html>
