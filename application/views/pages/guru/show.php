<div class="container bg-light text-dark" style="max-width: 800px; margin: 0 auto; margin-top: 10rem; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);">
    <div class="container-galeri text-center">
        <h3 style="font-family: 'Rowdies', serif; font-weight: bold; color: #343a40;">GURU, STAF DAN PPPK</h3>
        <hr style="border-top: 2px solid #343a40; width: 50%; margin: 0 auto;">
    </div>
</div>

<div class="container center-container" style="display: flex;flex-direction: column;justify-content: center; align-items: center;">
    <div class="container mt-5 d-flex flex-column align-items-center">
        <!-- Card Kepala Sekolah -->
        <?php if (!empty($kepala_sekolah)) : ?>
            <?php foreach ($kepala_sekolah as $row) : ?>
                <div class="card mb-4" style="width: 20rem; height: auto;">
                    <img src="<?= $row->image ? base_url("images/guru/$row->image") : base_url("images/user/avatar.png") ?>" alt="<?= $row->nama ?>" class="card-img-top" />
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $row->nama ?></h5>
                        <p class="card-text"><?= $row->jabatan ?> SMP NEGERI 11 JAYAPURA</p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-muted">Data Kepala Sekolah tidak tersedia.</p>
        <?php endif; ?>
    </div>

    <!-- Guru Tetap -->
    <div class="container mt-5">
        <h4 class="text-center text-light" style="font-family: Lexend Giga;">GURU TETAP</h4>
        <hr style="border-top: 2px solid #ffff; width: 50%; margin: 0 auto;">
        <div class="row mt-5">
            <?php if (!empty($guru_tetap)) : ?>
                <?php foreach ($guru_tetap as $row) : ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100">
                            <img src="<?= $row->image ? base_url("images/guru/$row->image") : base_url("images/user/avatar.png") ?>" alt="<?= $row->nama ?>" class="card-img-top" />
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $row->nama ?></h5>
                                <p class="card-text"><?= $row->mapel ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-muted text-center">Data Guru Tetap tidak tersedia.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Guru PPPK -->
    <div class="container mt-5">
        <h4 class="text-center text-light" style="font-family: Lexend Giga;">GURU PPPK</h4>
        <hr style="border-top: 2px solid #ffff; width: 50%; margin: 0 auto;">
        <div class="row mt-5">
            <?php if (!empty($guru_honorer)) : ?>
                <?php foreach ($guru_honorer as $row) : ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100">
                            <img src="<?= $row->image ? base_url("images/guru/$row->image") : base_url("images/user/avatar.png") ?>" alt="<?= $row->nama ?>" class="card-img-top" />
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $row->nama ?></h5>
                                <p class="card-text"><?= $row->mapel ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-muted text-center">Data Guru PPPK tidak tersedia.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

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