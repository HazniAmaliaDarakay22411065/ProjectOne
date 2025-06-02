<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP NEGERI 11 JAYAPURA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lexend+Giga:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lexend+Giga:wght@100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/home.css'); ?>">;
    <style>
        body {
            --s: 50px;
            --c: #223148;
            /* Warna biru tua */
            --_s: calc(2*var(--s)) calc(2*var(--s));
            --_g: 35.36% 35.36% at;
            --_c: #0000 66%, #2c3e50 68% 70%, #0000 72%;
            /* Mengubah warna ke biru tua */

            background:
                radial-gradient(var(--_g) 100% 25%, var(--_c)) var(--s) var(--s)/var(--_s),
                radial-gradient(var(--_g) 0 75%, var(--_c)) var(--s) var(--s)/var(--_s),
                radial-gradient(var(--_g) 100% 25%, var(--_c)) 0 0/var(--_s),
                radial-gradient(var(--_g) 0 75%, var(--_c)) 0 0/var(--_s),
                repeating-conic-gradient(var(--c) 0 25%, #0000 0 50%) 0 0/var(--_s),
                radial-gradient(var(--_c)) 0 calc(var(--s)/2)/var(--s) var(--s) var(--c);

            background-attachment: fixed;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top bg-light text-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand text-dark" href="#">
                <img src="img/logo.png" alt="Logo" class="navbar-brand-img d-inline-block align-text-middle" style="height: auto; width: 55px;">
                <span class="navbar-brand-text gradient-text" style="font-family: 'Rowdies', serif; font-size: 2rem; top: 6rem;">SMP NEGERI 11 JAYAPURA</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="font-family:'Kanit', serif;">
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="Home.html">BERANDA</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            PROFIL
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownProfil">
                            <li><a class="dropdown-item text-dark" href="visimisi.html">Visi, Misi dan Tujuan Sekolah</a></li>
                            <li><a class="dropdown-item text-dark" href="sejarah.html">Sejarah</a></li>
                            <li><a class="dropdown-item text-dark" href="guru.html">Guru dan Staf</a></li>
                            <li><a class="dropdown-item text-dark" href="fasilitas.html">Fasilitas</a></li>
                            <li><a class="dropdown-item text-dark" href="kemas.html">Keg. Masyarakat</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            KESISWAAN
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownKesiswaan">
                            <li><a class="dropdown-item text-dark" href="ekskul.html">Ekstrakurikuler</a></li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle text-dark" href="#">Prestasi</a> <!-- Hapus ikon dari sini -->
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item text-dark" href="prestasi_akademik.html">Prestasi Akademik</a></li>
                                    <li><a class="dropdown-item text-dark" href="prestasi_non.html">Prestasi Non-Akademik</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            INFORMASI
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownInformasi">
                            <li><a class="dropdown-item text-dark" href="pengumuman.html">Pengumuman</a></li>
                            <li><a class="dropdown-item text-dark" href="agenda.html">Agenda</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link text-dark" href="galeri.html">GALERI</a></li>
                    <li class="nav-item"><button class="btn btn-dark" onclick="location.href='<?= base_url('/login'); ?>'">LOGIN</button></li>

                    <li class="nav-item"><a class="nav-link text-dark" href="galeri.html">ADMIN</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Carousel Section -->
    <section id=" home" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/sekolah1.png" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/sekolah2.png" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/sekolah3.png" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#home" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#home" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>

    <!----- Welcome Section ----->
    <div class="container-fluid py-5" style="background-color: #4B6382;">
        <div class="welcome-container text-light" style="background-color: #A4B5C4; font-family: 'Rowdies', serif; padding: 20px; border-radius: 10px;">
            <h3 style="font-family: Lexend Giga; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">SELAMAT DATANG DI WEBSITE</h3>
            <h1 style="text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);">SEKOLAH SMP NEGERI 11 JAYAPURA</h1>
            <p class="address" style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Alamat: Jl. Mambruk Perumnas III Yabansai Distrik Heram</p>
        </div>
    </div>

    <!--------------------sambutan-------->
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="image-container bg-light" style="padding: 20px; display: flex; justify-content: center; align-items: center; border-radius: 9px; min-height: 200px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <img src="img/foto_kepsek.jpeg" alt="Principal" class="img-fluid" style="max-width: 85%; height: auto; border-radius: 6px;">
                </div>
            </div>

            <!-- Container Sambutan Kepala Sekolah -->
            <div class="col-12 col-md-8">
                <div class="media text-light" style="display: flex; align-items: flex-start;">
                    <div class="media-body" style="flex: 1; text-align: left;">
                        <h5 class="mt-0" style="font-family: Lexend Giga;">Sambutan Kepala Sekolah</h5>
                        <p>Bismillahirrohmanirrohim</p>
                        <p>Assalamu’alaikum Wr. Wb.</p>
                        <p>Segala puji hanya untuk Allah SWT dan shalawat serta salam semoga tercurah atas nabi yang terakhir, yaitu nabi kita Muhammad SAW, begitu pula atas keluarga, para sahabat dan para pengikutnya.</p>
                        <p>Alhamdulillahi robbil alamin kami panjatkan kehadirat Tuhan Allah SWT, bahwasannya dengan rahmat dan karunia-Nya lah akhirnya Website sekolah ini dengan domain <a href="http://www.smpnegeri11jayapura.sch.id" class="btn-link" style="color: #007bff; text-decoration: underline;">www.smpnegeri11jayapura.sch.id</a> dapat kami perbaharui dan kembangkan. Kami mengucapkan selamat datang di Website kami SMP NEGERI 11 JAYAPURA. Dalam perkembangan era globalisasi...</p>
                        <a href="sambutan.html" class="btn btn-primary" style="font-family: Lexend Giga; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jumlah -->
    <section id="info-sekolah" class="stats section mt-5" style="font-family: 'Lexend Giga';">
        <div class="container mt-2" data-aos="fade-up">
            <div class="row justify-content-center">
                <!-- Kolom Siswa -->
                <div class="col-12 col-md-4 mt-3 d-flex justify-content-center">
                    <div class="info-box text-dark bg-light shadow-sm" style="width: 140px; padding: 6px; border-radius: 8px;">
                        <div class="info-box-body d-flex flex-column justify-content-center align-items-center">
                            <h6 class="info-box-title" style="font-size: 0.8rem; margin-bottom: 4px;">Siswa</h6>
                            <p class="info-box-text" style="font-size: 1.4rem; margin: 0;">
                                <strong id="siswa-count" data-target="618">0</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Kolom Guru -->
                <div class="col-12 col-md-4 mt-3 d-flex justify-content-center">
                    <div class="info-box text-dark bg-light shadow-sm" style="width: 140px; padding: 6px; border-radius: 8px;">
                        <div class="info-box-body d-flex flex-column justify-content-center align-items-center">
                            <h6 class="info-box-title" style="font-size: 0.8rem; margin-bottom: 4px;">Guru</h6>
                            <p class="info-box-text" style="font-size: 1.4rem; margin: 0;">
                                <strong id="guru-count" data-target="43">0</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Kolom Fasilitas -->
                <div class="col-12 col-md-4 mt-3 d-flex justify-content-center">
                    <div class="info-box text-dark bg-light shadow-sm" style="width: 140px; padding: 6px; border-radius: 8px;">
                        <div class="info-box-body d-flex flex-column justify-content-center align-items-center">
                            <h6 class="info-box-title" style="font-size: 0.8rem; margin-bottom: 4px;">Fasilitas</h6>
                            <p class="info-box-text" style="font-size: 1.4rem; margin: 0;">
                                <strong id="fasilitas-count" data-target="5">0</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <!---------extrakulikuler------->
    <section id="ekstrakurikuler" class="mt-5">
        <div class="container-fluid" style="background: linear-gradient(to right, #003366, #808080); background-size: cover; background-position: center; padding: 40px; border-radius: 8px; position: relative; width: 100vw; font-family: Lexend Giga; box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); border-radius: 8px;"></div>
            <div class="link-container" style="display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 1;">
                <h2 class="text-light">Ekstrakurikuler</h2>
            </div>
            <div class="row">
                <!-- Gambar di kolom 4 -->
                <div class="col-12 col-md-5 image-container" style="z-index: 1;">
                    <img src="img/basket.jpg" class="mt-2" alt="Image 1" style="position: relative; height: auto; width: 35%; z-index: 1; top: 18%; right: 2%;">
                    <img src="img/img3.jpg" class="mt-2" alt="Image 2" style="position: relative; height: 28%; width: 40%; z-index: 1; top: 28%;">
                    <img src="img/basket.jpg" class="mt-2" alt="Image 3" style="position: relative; height: 20%; width: 30%; z-index: 1; top: -32%; left: 36%;">
                    <img src="img/keg_PMR.jpg" class="mt-2" alt="Image 4" style="position: relative; height: 35%; width: 32%; z-index: 1; top: 18%; right: 30%;">
                    <img src="img/basket.jpg" class="mt-2" alt="Image 5" style="position: relative; height: 20%; width: 25%; z-index: 1; top: 23%; right: 28%;">
                    <img src="img/img4.jpg" class="mt-2" alt="Image 6" style="position: relative; height: 35%; width: 28%; z-index: 1; top: -8%; left: 64%;">
                </div>
                <!-- Keterangan Ekstrakurikuler di kolom 6 -->
                <div class="col-12 col-md-7 text-light" style="z-index: 1;">
                    <p>Ekstrakurikuler adalah kegiatan yang dilakukan oleh siswa di luar jam pelajaran sekolah yang biasanya bersifat mendukung pembelajaran akademik, sosial, dan pengembangan diri. Beberapa kegiatan ekstrakurikuler yang ada di sekolah kami antara lain:</p>
                    <ul>
                        <li>Olahraga: Sepak bola, basket, voli, bulu tangkis, renang, dan atletik.</li>
                        <li>Kesenian: Paduan suara, band, tari, teater, dan seni rupa.</li>
                        <li>Akademik: Klub sains, klub matematika, debat, dan jurnalistik.</li>
                        <li>Kepemimpinan: Organisasi siswa, OSIS, dan klub pecinta alam.</li>
                        <li>Keterampilan Khusus: Pramuka, KIR, dan robotika.</li>
                    </ul>
                    <a href="ekskul.html" class="btn btn-primary mt-4" style="font-family: Lexend Giga; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">Read More</a>
                </div>
            </div>
        </div>
    </section>


    <!--------------kemas------------->
    <section id="kegiatan-masyarakat" class="mt-5">
        <div class="container">
            <div class="link-container mt-5" style="display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 1; font-family: Lexend Giga;">
                <h2 class="text-light">Kegiatan Masyarakat</h2>
                <a href="kemas.html" class="btn btn-link text-light" style="text-decoration: underline;">Tampilkan Selengkapnya</a>
            </div>
            <div class="container-fluid" style="padding: 20px;">
                <div class="row">
                    <!-- Post 1 -->
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card h-100" style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); text-align: center;">
                            <img src="img/gmbr1.jpg" alt="Post 1 Image" style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="card-body" style="padding: 15px;">
                                <h5 class="post-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Kegiatan Gotong Royong</h5>
                                <p class="post-content" style="font-size: 14px; color: #555;">Membersihkan area di dalam dan di luar sekolah agar siswa/siswi belajar untuk bermanfaat di lingkungan masyarakat.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Post 2 -->
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card h-100" style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); text-align: center;">
                            <img src="img/gmbr2.jpg" alt="Post 2 Image" style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="card-body" style="padding: 15px;">
                                <h5 class="post-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Kegiatan Menanam Pohon</h5>
                                <p class="post-content" style="font-size: 14px; color: #555;">Kegiatan ini berguna agar siswa/siswi dan masyarakat memahami pentingnya menjaga lingkungan.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Post 3 -->
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card h-100" style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); text-align: center;">
                            <img src="img/gmbr3.jpg" alt="Post 3 Image" style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="card-body" style="padding: 15px;">
                                <h5 class="post-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Kegiatan Membersihkan Tempat Ibadah</h5>
                                <p class="post-content" style="font-size: 14px; color: #555;">Kegiatan ini membantu agar siswa/siswi serta masyarakat menjaga kebersihan tempat ibadah.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Post 4 -->
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card h-100" style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); text-align: center;">
                            <img src="img/gmbr4.jpg" alt="Post 4 Image" style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="card-body" style="padding: 15px;">
                                <h5 class="post-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Kegiatan Bersih-Bersih Pantai</h5>
                                <p class="post-content" style="font-size: 14px; color: #555;">Kegiatan ini mengajarkan siswa/siswi dan masyarakat tentang pentingnya menjaga kebersihan lingkungan pantai.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!--------------------galeri sekolah----------->
    <section>
        <div class="container-fluid mt-5" style="background: linear-gradient(to right, #003366, #808080); background-size: cover; background-position: center; padding: 40px; border-radius: 8px; position: relative; width: 100vw; font-family: Lexend Giga; box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);">
            <h2 class="text-center text-light mb-4" style="font-family: Lexend Giga;">Galeri Sekolah</h2>
            <div class="row">
                <!-- Galeri Item 1 -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 350px;">
                        <img src="img/1.jpeg" class="card-img-top" alt="Gambar 1" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title" style="font-family: Lexend Giga;">Kegiatan Pramuka</h5>
                        </div>
                    </div>
                </div>
                <!-- Galeri Item 2 -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 350px;">
                        <img src="img/2.jpeg" class="card-img-top" alt="Gambar 2" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title" style="font-family: Lexend Giga;">Kegiatan Olahraga</h5>
                        </div>
                    </div>
                </div>
                <!-- Galeri Item 3 -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 350px;">
                        <img src="img/3.jpeg" class="card-img-top" alt="Gambar 3" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title" style="font-family: Lexend Giga;">Kegiatan Seni</h5>
                        </div>
                    </div>
                </div>
                <!-- Galeri Item 4 -->
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 350px;">
                        <img src="img/4.jpeg" class="card-img-top" alt="Gambar 4" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title" style="font-family: Lexend Giga;">Kegiatan Ekskul</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-2 d-flex justify-content-center">
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="button-container d-flex justify-content-center">
                        <a href="galeri.html" class="btn btn-dark text-light mt-4" style="font-family: Lexend Giga; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); width: 100%; max-width: 300px;">Tampilkan selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- testimoni Sekolah -->
    <section id="testimoni" class="py-5">
        <div class="container mt-5">
            <h2 class="text-center mb-5 text-light" style="font-family: Lexend Giga;">Testimoni Alumni</h2>
            <div class="row">
                <!-- Komentar Carousel -->
                <div class="col-md-8 mb-4 text-dark bg-light" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="text-center">
                                    <img src="img/6.jpeg" class="rounded-circle img-fluid shadow-1-strong mt-5" alt="sample image" width="100" height="100">
                                    <p class="mb-0 text-dark"><strong>- Anna Morian</strong></p>
                                    <p class="lead font-italic mx-4 mx-md-5 mt-3">
                                        "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, voluptas nostrum quisquam!"
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="text-center">
                                    <img src="img/guru.jpg" class="rounded-circle img-fluid shadow-1-strong mt-5" alt="sample image" width="100" height="100">
                                    <p class="mb-0 text-dark"><strong>- Teresa May</strong></p>
                                    <p class="lead font-italic mx-4 mx-md-5 mt-3">
                                        "Neque cupiditate assumenda in maiores repudiandae mollitia adipisci maiores repudiandae mollitia consectetur adipisicing architecto elit sed adipiscing elit."
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="text-center">
                                    <img src="img/kelulusan.jpg" class="rounded-circle img-fluid shadow-1-strong mt-5" alt="sample image" width="100" height="100">
                                    <p class="mb-0 text-dark"><strong>- Kate Allise</strong></p>
                                    <p class="lead font-italic mx-4 mx-md-5 mt-3">
                                        "Neque cupiditate assumenda in maiores repudiandae mollitia adipisci maiores repudiandae mollitia consectetur adipisicing architecto elit sed adipiscing elit."
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Form Komentar -->
                <div class="col-md-4 mb-4">
                    <div class="text-dark bg-light" style="border-radius: 8px; box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); padding: 20px;">
                        <h5 class="text-center mt-5">Kirim Komentar</h5>
                        <form class="p-3">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama Anda">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" rows="3" placeholder="Masukkan deskripsi saran Anda"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-------kontak------>
    <main id="kontak" class="py-5">
        <div class="container mt-5 text-light">
            <h2 class="text-center mb-5" style="font-family: Lexend Giga;">Kontak Sekolah</h2>
            <div class="row">
                <!-- Informasi Kontak -->
                <div class="col-md-4 mb-4">
                    <h4 class="mb-3">Informasi Kontak</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="bi bi-geo-alt-fill text-primary contact-icon"></i>
                            <strong> Alamat:</strong> Jl. Mambruk Perumnas III Yabansai, <br> Yabansai, Kec. Heram, Kota Jayapura Prov. Papua
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-telephone-fill text-success contact-icon"></i>
                            <strong> Telepon:</strong> (0987) 654-321
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-envelope-fill text-warning contact-icon"></i>
                            <strong> Email:</strong> smpn11jayapura@gmail.com
                        </li>
                        <li class="mb-5">
                            <i class="bi bi-clock-fill text-danger contact-icon"></i>
                            <strong> Jam Operasional:</strong> Senin - Jumat, 07.00 - 15.00 WIT
                        </li>
                    </ul>
                    <h4 class="mb-3">Ikuti Kami</h4>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-primary btn-sm">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="#" class="btn btn-info btn-sm">
                            <i class="bi bi-instagram"></i> Instagram
                        </a>
                        <a href="#" class="btn btn-danger btn-sm">
                            <i class="bi bi-youtube"></i> YouTube
                        </a>
                    </div>
                </div>

                <!-- Form Kontak -->
                <div class="col-md-4 mb-4">
                    <h4 class="mb-3">Kirim Pesan</h4>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Tulis pesan Anda di sini"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>

                <!-- Peta Lokasi -->
                <div class="col-md-4 mb-4">
                    <h4 class="mb-3">Lokasi Sekolah</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.760842940443!2d140.64319677405308!3d-2.5841988973938994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x686cf5d7adae6081%3A0x6695562d4497ed95!2sSMP%20Negeri%2011%20Jayapura!5e0!3m2!1sid!2sid!4v1737919491496!5m2!1sid!2sid" width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-dark bg-light py-3">
        <div class="container text-center">
            <p>&copy; 2025 SMP Negeri 11 Jayapura. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./home.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const counters = document.querySelectorAll("strong[id$='-count']");

            function animateCounter(counter) {
                const target = +counter.getAttribute("data-target");
                let current = 0;
                const increment = Math.ceil(target / 100); // Kecepatan peningkatan angka
                const duration = 2000; // Durasi animasi dalam ms (2 detik)
                const intervalTime = duration / (target / increment);

                function updateCounter() {
                    current += increment;
                    if (current >= target) {
                        counter.innerText = target; // Pastikan nilai akhir sesuai target
                    } else {
                        counter.innerText = current;
                        setTimeout(updateCounter, intervalTime);
                    }
                }

                updateCounter();
            }

            function handleScrollAnimation() {
                counters.forEach(counter => {
                    const rect = counter.getBoundingClientRect();
                    if (rect.top < window.innerHeight && counter.innerText === "0") {
                        animateCounter(counter);
                    }
                });
            }

            window.addEventListener("scroll", handleScrollAnimation);
            handleScrollAnimation(); // Menjalankan animasi jika elemen sudah terlihat saat halaman dimuat
        });
    </script>
</body>

</html>