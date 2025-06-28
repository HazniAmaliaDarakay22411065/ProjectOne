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


<section id="agenda">
    <div class="container bg-light text-dark" style="max-width: 800px; margin: 0 auto; margin-top: 10rem; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);">
        <div class="container-galeri text-center">
            <h3 style="font-family: 'Rowdies', serif; font-weight: bold; color: #343a40;">AGENDA</h3>
            <hr style="border-top: 2px solid #343a40; width: 50%; margin: 0 auto;">
        </div>
    </div>

    <div class="container py-5">
        <?php foreach ($agenda as $a) : ?>
            <div class="row mb-4 align-items-stretch">
                <!-- Gambar -->
                <div class="col-lg-3 col-md-4 col-sm-12 mb-3 mb-md-0 d-flex">
                    <div style="padding: 5px; background-color: #fff; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.08); width: 100%;">
                        <img src="<?= base_url('images/agenda/' . $a->image) ?>" alt="<?= $a->judul ?>" style="width: 100%; height: 100%; max-height: 220px; object-fit: cover; border-radius: 8px;">
                    </div>
                </div>

                <!-- Teks -->
                <div class="col-lg-9 col-md-8 col-sm-12 d-flex">
                    <div style="padding: 20px; background-color: #fff; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.08); width: 100%; display: flex; flex-direction: column; justify-content: center;">
                        <h5 style="font-family: 'Segoe UI', sans-serif; font-weight: 600; color: #2c3e50; margin-bottom: 10px;"><?= $a->judul ?></h5>
                        <p style="font-size: 0.95rem; color: #555; margin: 0;"><?= $a->deskripsi ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

</section>

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