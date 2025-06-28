<main>
    <div class="container mt-5" style="padding-top: 100px;">
        <!-- Gambar Sambutan -->
        <?php if (!empty($sambutan->guru_foto)) : ?>
            <img src="<?= base_url('images/guru/' . $sambutan->guru_foto) ?>"
                alt="Foto Kepala Sekolah" class="img-fluid zoom-image center-image" style="max-width: 180px; height: auto; display: block; margin: 0 auto;">
        <?php endif; ?>

        <!-- Sambutan -->
        <div class="sambutan text-light" style="font-family: 'Lexend Giga', sans-serif;">
            <h2 class="text-center">Sambutan Guru</h2>

            <?php if (!empty($sambutan->pembuka)) : ?>
                <p class="text-center" id="pembuka"><?= nl2br(htmlspecialchars($sambutan->pembuka)) ?></p>
            <?php endif; ?>

            <?php if (!empty($sambutan->isi_sambutan)) : ?>
                <p id="isi-sambutan"><?= nl2br(htmlspecialchars($sambutan->isi_sambutan)) ?></p>
            <?php endif; ?>

            <?php if (!empty($sambutan->isi_sambutan_2)) : ?>
                <p><?= nl2br(htmlspecialchars($sambutan->isi_sambutan_2)) ?></p>
            <?php endif; ?>

            <?php if (!empty($sambutan->isi_sambutan_3)) : ?>
                <p><?= nl2br(htmlspecialchars($sambutan->isi_sambutan_3)) ?></p>
            <?php endif; ?>

            <?php if (!empty($sambutan->isi_sambutan_4)) : ?>
                <p><?= nl2br(htmlspecialchars($sambutan->isi_sambutan_4)) ?></p>
            <?php endif; ?>

            <?php if (!empty($sambutan->penutup)) : ?>
                <p><?= nl2br(htmlspecialchars($sambutan->penutup)) ?></p>
            <?php endif; ?>

            <!-- Identitas Kepala Sekolah -->
            <div class="mt-4 text-start">
                <p style="margin: 0;"><strong>Guru SMP NEGERI 11 JAYAPURA</strong></p><br>
                <p id="nama-kepala" style="margin: 0;"><?= $sambutan->guru_nama ?></p>
                <p id="nip-kepala" style="margin: 0;">NIP. <?= $sambutan->guru_nip ?></p>
                <p class="text-muted mt-2">ID Sambutan: <?= $sambutan->id_sambutan ?></p>
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