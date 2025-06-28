<div class="container bg-light text-dark" style="max-width: 800px; margin: 0 auto; margin-top: 10rem; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);">
    <div class="container-galeri text-center">
        <h3 style="font-family: 'Rowdies', serif; font-weight: bold; color: #343a40;">VISI, MISI DAN TUJUAN SEKOLAH </h3>
        <hr style="border-top: 2px solid #343a40; width: 80%; margin: 0 auto;">
    </div>
</div>








<main class="container py-5">
    <div class="container-misi" style="background-color: #CDD5DB; padding: 30px; border-radius: 8px;">

        <!-- Visi Section -->
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3>Visi</h3>
                <h5><?= nl2br(htmlspecialchars($profil->visi)) ?></h5>
            </div>
        </div>

        <!-- Misi dan Tujuan side by side -->
        <div class="row">
            <div class="col-12 col-md-6">
                <h4 class="mt-5">Misi</h4>
                <?php
                $misi_items = explode("\n", trim($profil->misi));
                foreach ($misi_items as $misi_item):
                    if (trim($misi_item) !== ''):
                ?>
                        <p><?= htmlspecialchars(trim($misi_item)) ?></p>
                <?php
                    endif;
                endforeach;
                ?>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mt-5">Tujuan Sekolah</h4>
                <?php
                $tujuan_items = explode("\n", trim($profil->tujuan));
                foreach ($tujuan_items as $tujuan_item):
                    if (trim($tujuan_item) !== ''):
                ?>
                        <p><?= htmlspecialchars(trim($tujuan_item)) ?></p>
                <?php
                    endif;
                endforeach;
                ?>
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
                        <a href="https://www.instagram.com/smpn11jpr?igsh=Nm00dWZrMTV2Z3Fz" class="btn btn-outline-light btn-sm shadow-sm"><i class="bi bi-instagram me-1"></i>Instagram</a>
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