<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/homersph.css') }}">
    <link rel="icon" type="Image/png" sizes="42x42" href="{{ asset('img/logo-uner.png') }}">

    {{-- Bootstrap CSS --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"> --}}
    <title>Home RSPH</title>
</head>

<body>
    {{-- JS script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <nav>
        <div class="nav">
            <img src="{{ asset('img/logo-uner.png') }}" alt="Logo Universitas Airlangga"
                class="logo ">
            <ul>
                <li><a href="#Home">Home</a></li>
                <li><a href="/struktur">Struktur</a></li>
                <li><a href="/layanan">layanan umum</a></li>
                <li><a href="#visi">visi dan misi</a></li>
                <li><a href="/login">login</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <section id="Home" class="intro">
            <div class="container">
                <div>
                    <h1>Selamat Datang Selamat Datang di RSPH UNAIR</h1>
                    <p>Rumah Sakit Pendidikan Hewan Universitas Airlangga adalah fasilitas kesehatan
                        hewan yang menggabungkan
                        layanan medis berkualitas, penelitian, dan pendidikan. Kami hadir untuk
                        memberikan pelayanan terbaik bagi kesehatan hewan kesayangan maupun hewan
                        ternak,
                        serta mendukung pengembangan ilmu kedokteran hewan di Indonesia.</p>
                </div>
                <img src="https://assets-a1.kompasiana.com/items/album/2024/12/08/slider1-rshp-1-67556ec4ed64154f3162f472.jpg?t=o&v=1200"
                    alt="Rumah Sakit Pendidikan Hewan Universitas Airlangga">
            </div>
        </section>

        <section class="struktur">
            <div class="container-visi">
                <div>
                    <h2 id="visi">Visi</h2>
                    <p>Visi kami adalah menjadi pusat layanan kesehatan hewan terkemuka yang
                        mendukung pendidikan dan penelitian di bidang kedokteran hewan. Misi kami
                        meliputi:</p>
                </div>
                <div>
                    <h2>Misi</h2>
                    <ol>
                        <li>Menyediakan layanan kesehatan hewan yang berkualitas tinggi.</li>
                        <li>Mendukung pendidikan mahasiswa melalui praktik langsung di rumah sakit.
                        </li>
                        <li>Melakukan penelitian untuk meningkatkan ilmu kedokteran hewan.</li>
                    </ol>
                </div>
            </div>
            <div id="struktur" class="container-struktur">
                <h2> Struktur Organisasi</h2>
                <p>Struktur organisasi Rumah Sakit Pendidikan Hewan Universitas Airlangga terdiri:
                </p>
                <div class= "direktur">
                    <img src=https://media.tenor.com/notUnAjgm8UAAAAM/beluga-cat-meme.gif
                        alt="Direktur">
                    <h3>Direktur</h3>
                    <p>Dr. drh. Dwi Wahyuni, M.Si</p>
                </div>
                <div class="wakdir">
                    <div class="direktur">
                        <img src=https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvG3QM7JOkzmnquefv_KBeVZpC-tamk5afdQ&s
                            alt="Direktur">
                        <h3>Wakil Direktur</h3>
                        <p>Dr. drh. Dwi Wahyuni, M.Si</p>
                    </div>
                    <div class="direktur">
                        <img src=https://i.pinimg.com/236x/6a/45/06/6a45066f341e3d70cda152b04669d1e7.jpg
                            alt="Direktur">
                        <h3>Sekretariat</h3>
                        <p>Dr. drh. Dwi Wahyuni, M.Si</p>
                    </div>
                </div>
            </div>
            <section id=layanan>
                <div class="container-layanan">
                    <div>
                        <h2>Layanan Umum</h2>
                        <p>Rumah Sakit Pendidikan Hewan Universitas Airlangga menyediakan berbagai
                            layanan umum, antara lain:</p>
                    </div>
                    <div class="card-layanan">
                        <img src="https://pbs.twimg.com/media/Ee5Z1sJUEAEzIbW.jpg"
                            alt="Layanan Umum">
                        <h3>Layanan Umum</h3>
                        <p>Memberikan layanan kesehatan hewan untuk hewan peliharaan dan ternak.</p>
                    </div>
                    <div class="card-layanan">
                        <img src="https://pbs.twimg.com/media/Ee5Z1sJUEAEzIbW.jpg"
                            alt="Layanan Umum">
                        <h3>Vaksinasi & Pencegahan Penyakit</h3>
                        <p> Vaksinasi sesuai protokol untuk kucing, anjing, dan hewan lain..</p>
                    </div>
                    <div class="card-layanan">
                        <img src="https://pbs.twimg.com/media/Ee5Z1sJUEAEzIbW.jpg"
                            alt="Layanan Umum">
                        <h3>Rawat Inap</h3>
                        <p>MRuang rawat dengan pengawasan dokter hewan 24 jam.</p>
                    </div>
            </section>
        </section>
    </main>
    
    <footer>
        <p> <i>© 2024 RSPH. by @anshari.</i></p>
    </footer>
</body>

</html>
