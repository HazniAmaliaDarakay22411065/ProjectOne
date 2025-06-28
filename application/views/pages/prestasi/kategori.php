<main id="prestasi_akademik" class="stats section light-background mt-5" style="font-family: 'Lexend Giga';">
    <div class="album">
        <div class="container" data-aos="fade-up">
            <div class="container bg-light text-dark" style="max-width: 800px; margin: 0 auto; margin-top: 10rem; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);">
                <div class="container-galeri text-center">
                    <h3 style="font-family: 'Rowdies', serif; font-weight: bold; color: #343a40;">
                        <?= $title ?>
                    </h3>
                    <hr style="border-top: 2px solid #343a40; width: 80%; margin: 0 auto;">
                </div>
            </div>

            <div class="container py-5">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <?php if (!empty($content) && is_array($content)): ?>
                        <?php foreach ($content as $item): ?>
                            <div class="col">
                                <div class="card border-0 shadow-sm h-100 rounded-4 hover-shadow transition">
                                    <div class="position-relative" style="height: 180px; overflow: hidden; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                                        <img src="<?= base_url('images/prestasi/' . $item->image) ?>"
                                            alt="<?= $item->judul ?>"
                                            class="w-100 h-100 object-fit-cover">
                                    </div>
                                    <div class="card-body px-3 py-2">
                                        <h6 class="fw-semibold text-dark mb-2" style="font-size: 0.95rem;">
                                            <?= $item->judul ?>
                                        </h6>
                                        <p class="text-muted mb-2" style="font-size: 0.85rem;">
                                            <?= character_limiter(strip_tags($item->deskripsi), 35) ?>
                                        </p>
                                        <p class="mb-1 text-secondary" style="font-size: 0.8rem;">
                                            <strong>Siswa:</strong> <?= $item->nama_siswa ?? '-' ?>
                                        </p>
                                        <p class="mb-1 text-secondary" style="font-size: 0.8rem;">
                                            <strong>Kelas:</strong> <?= $item->nama_kelas ?? '-' ?>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-transparent border-0 px-3 pb-3">
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            <?= date('d M Y', strtotime($item->created_at)) ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">Tidak ada data prestasi.</p>
                    <?php endif; ?>
                </div>
            </div>



        </div>
    </div>
</main>

<main id="kontak" class="py-5  text-light">
    <div class="container mt-5">
        <h2 class="text-center mb-5" style="font-family: 'Lexend Giga'; font-weight: bold;">Kontak Sekolah</h2>
        <div class="row g-4">
            <!-- Informasi Kontak -->
            <div class="col-md-6">
                <div class="p-4 rounded bg-dark h-100 shadow-sm">
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