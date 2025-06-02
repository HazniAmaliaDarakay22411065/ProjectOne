< role="main" class="container">
    <?php $this->load->view('layouts/_alert') ?>
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
            <h1 style="text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);">SMP NEGERI 11 JAYAPURA</h1>
            <p class="address" style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Alamat: Jl. Mambruk Perumnas III Yabansai Distrik Heram</p>
        </div>
    </div>

    <!--------------------sambutan-------->
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="image-container bg-light" style="padding: 20px; display: flex; justify-content: center; align-items: center; border-radius: 9px; min-height: 200px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <?php if (!empty($sambutan->foto_kepsek)): ?>
                        <img src="<?= base_url('images/kepsek/' . $sambutan->foto_kepsek) ?>" alt="Principal" class="img-fluid" style="max-width: 85%; height: auto; border-radius: 6px;">
                    <?php else: ?>
                        <img src="<?= base_url('images/default.jpg') ?>" alt="Principal" class="img-fluid" style="max-width: 85%; height: auto; border-radius: 6px;">
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="media text-light" style="display: flex; align-items: flex-start;">
                    <div class="media-body" style="flex: 1; text-align: left;">
                        <h5 class="mt-0" style="font-family: Lexend Giga;">Sambutan Kepala Sekolah</h5>
                        <p>Bismillahirrohmanirrohim</p>
                        <p>Assalamu’alaikum Wr. Wb.</p>
                        <?php if (!empty($sambutan->isi_sambutan)): ?>
                            <p><?= character_limiter(strip_tags($sambutan->isi_sambutan), 300, '...') ?></p>
                        <?php else: ?>
                            <p>Sambutan belum tersedia.</p>
                        <?php endif; ?>
                        <a href="<?= base_url('sambutan/show') ?>" class="btn btn-primary" style="font-family: Lexend Giga; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!------jumlah------>
    <section id="info-sekolah" class="stats section mt-5" style="font-family: Lexend Giga;">
        <div class="container mt-2" data-aos="fade-up">
            <div class="row">
                <!-- Kolom Siswa -->
                <div class="col-12 col-md-4 mt-3">
                    <div class="info-box shadow-sm h-100 text-dark bg-light">
                        <div class="info-box-body d-flex flex-column justify-content-center align-items-center">
                            <h4 class="info-box-title">Siswa</h4>
                            <p class="info-box-text mt-3" style="font-size: 4rem;">
                                <strong id="siswa-count" data-target="618">0</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Kolom Guru -->
                <div class="col-12 col-md-4 mt-3">
                    <div class="info-box shadow-sm h-100 text-dark bg-light">
                        <div class="info-box-body d-flex flex-column justify-content-center align-items-center">
                            <h4 class="info-box-title">Guru</h4>
                            <p class="info-box-text mt-3" style="font-size: 4rem;">
                                <strong id="guru-count" data-target="43">0</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Kolom Fasilitas -->
                <div class="col-12 col-md-4 mt-3">
                    <div class="info-box shadow-sm h-100 text-dark bg-light">
                        <div class="info-box-body d-flex flex-column justify-content-center align-items-center">
                            <h4 class="info-box-title">Fasilitas</h4>
                            <p class="info-box-text mt-3" style="font-size: 4rem;">
                                <strong id="fasilitas-count" data-target="5">0</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!---------extrakulikuler------->
    <?php if (!empty($ekskul_preview)): ?>
        <section id="ekstrakurikuler" class="mt-5">
            <div class="container-fluid" style="background: linear-gradient(to right, #003366, #808080); padding: 40px; border-radius: 8px; position: relative; width: 100vw; font-family: 'Lexend Giga', sans-serif; box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);">

                <!-- Overlay gelap -->
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); border-radius: 8px;"></div>

                <!-- Header -->
                <div class="link-container mb-4" style="display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 1;">
                    <h2 class="text-light">Ekstrakurikuler</h2>
                </div>

                <!-- Card Ekstrakurikuler -->
                <div class="row justify-content-center" style="position: relative; z-index: 1;">
                    <?php foreach (array_slice($ekskul_preview, 0, 4) as $eks): ?>
                        <div class="col-12 col-sm-6 col-md-3 mb-4">
                            <div class="card h-100 shadow-sm border-0" style="border-radius: 12px;">
                                <img src="<?= base_url('images/ekskul/' . $eks->image) ?>" class="card-img-top" alt="<?= $eks->judul ?>" style="height: 180px; object-fit: cover; border-radius: 12px 12px 0 0;">
                                <div class="card-body text-center p-3" style="background-color: #f8f9fa; border-radius: 0 0 12px 12px;">
                                    <h6 class="card-title text-dark mb-0" style="font-size: 15px; font-weight: 600;"><?= $eks->judul ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Deskripsi -->
                <div class="row">
                    <div class="col-12 col-md-7 text-light" style="z-index: 1;">
                        <p>Ekstrakurikuler adalah kegiatan di luar pelajaran yang membantu siswa berkembang secara sosial dan akademik.</p>
                        <a href="<?= base_url('ekskul/show') ?>" class="btn btn-primary mt-4">Tampilkan Selengkapnya</a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>




    <!--------------kemas------------->
    <?php if (!empty($kegiatan_preview)): ?>
        <section id="kegiatan-masyarakat" class="mt-5">
            <div class="container">
                <div class="link-container mt-5" style="display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 1; font-family: Lexend Giga;">
                    <h2 class="text-light">Kegiatan Masyarakat</h2>
                    <a href="kemas.html" class="btn btn-link text-light" style="text-decoration: underline;">Tampilkan Selengkapnya</a>
                </div>
                <div class="container-fluid" style="padding: 20px;">
                    <div class="row">
                        <?php foreach (array_slice($kegiatan_preview, 0, 4) as  $item): ?>
                            <!-- Post 1 -->
                            <div class="col-12 col-md-6 col-lg-3 mb-4">
                                <div class="card h-100" style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); text-align: center;">
                                    <img src="<?= base_url('images/kegiatan_masyarakat/' . $item->image) ?>" alt="<?= $item->judul ?>" style="width: 100%; height: 200px; object-fit: cover;">
                                    <div class="card-body" style="padding: 15px;">
                                        <h5 class="post-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">
                                            <?= $item->judul ?>
                                        </h5>
                                        <p class="post-content" style="font-size: 14px; color: #555;">
                                            <?= strip_tags($item->deskripsi) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>




    <!--------------------galeri sekolah----------->
    <?php if (!empty($galeri_preview)): ?>
        <section>
            <div class="container-fluid mt-5" style="background: linear-gradient(to right, #003366, #808080); background-size: cover; background-position: center; padding: 40px; border-radius: 8px; position: relative; width: 100vw; font-family: Lexend Giga; box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);">
                <h2 class="text-center text-light mb-4" style="font-family: Lexend Giga;">Galeri Sekolah</h2>
                <div class="row">
                    <?php foreach (array_slice($galeri_preview, 0, 4) as  $g): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 350px;">
                                <img src="<?= base_url('images/galeri/' . $g->image) ?>" class="card-img-top" alt="<?= $g->judul ?>" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-family: Lexend Giga;">
                                        <?= $g->judul ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="container mt-2 d-flex justify-content-center">
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="button-container d-flex justify-content-center">
                            <a href="<?= base_url('galeri/show') ?>" class="btn btn-dark text-light mt-4" style="font-family: Lexend Giga; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); width: 100%; max-width: 300px;">Tampilkan selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>




    <main id="kontak" class="py-5  text-light">
        <div class="container mt-5">
            <h2 class="text-center mb-5" style="font-family: 'Lexend Giga'; font-weight: bold;">Kontak Sekolah</h2>
            <div class="row g-4">
                <!-- Informasi Kontak -->
                <div class="col-md-6">
                    <div class="p-4 rounded bg-secondary h-100 shadow-sm">
                        <h4 class="mb-4">Informasi Kontak</h4>
                        <ul class="list-unstyled fs-6">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bi bi-geo-alt-fill text-primary me-2 fs-5"></i>
                                <div>
                                    <strong>Alamat:</strong>
                                    Jl. Mambruk Perumnas III Yabansai,<br> Yabansai, Kec. Heram, Kota Jayapura, Papua
                                </div>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bi bi-telephone-fill text-success me-2 fs-5"></i>
                                <div><strong>Telepon:</strong> (0987) 654-321</div>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bi bi-envelope-fill text-warning me-2 fs-5"></i>
                                <div><strong>Email:</strong> smpn11jayapura@gmail.com</div>
                            </li>
                            <li class="mb-4 d-flex align-items-start">
                                <i class="bi bi-clock-fill text-danger me-2 fs-5"></i>
                                <div><strong>Jam Operasional:</strong> Senin - Jumat, 07.00 - 15.00 WIT</div>
                            </li>
                        </ul>

                        <h4 class="mb-3">Ikuti Kami</h4>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-outline-light btn-sm shadow-sm"><i class="bi bi-facebook me-1"></i>Facebook</a>
                            <a href="#" class="btn btn-outline-light btn-sm shadow-sm"><i class="bi bi-instagram me-1"></i>Instagram</a>
                            <a href="#" class="btn btn-outline-light btn-sm shadow-sm"><i class="bi bi-youtube me-1"></i>YouTube</a>
                        </div>
                    </div>
                </div>

                <!-- Peta Lokasi -->
                <div class="col-md-6">
                    <div class="p-2 rounded shadow-sm">
                        <h4 class="mb-3">Lokasi Sekolah</h4>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.760842940443!2d140.64319677405308!3d-2.5841988973938994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x686cf5d7adae6081%3A0x6695562d4497ed95!2sSMP%20Negeri%2011%20Jayapura!5e0!3m2!1sid!2sid!4v1737919491496!5m2!1sid!2sid" width="100%" height="350" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
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
    </main>