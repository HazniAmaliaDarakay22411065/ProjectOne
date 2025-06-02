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

            <div class="container" style="padding-top: 11vh; padding-bottom: 5vh;">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <?php if (!empty($content) && is_array($content)): ?>
                        <?php foreach ($content as $item): ?>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="<?= base_url('images/prestasi/' . $item->image) ?>" class="card-img-top" alt="<?= $item->judul ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $item->judul ?></h5>
                                        <p class="card-text"><?= character_limiter(strip_tags($item->deskripsi), 30) ?></p>
                                        <p class="card-text"><small class="text-muted"><?= date('d M Y', strtotime($item->created_at)) ?></small></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada data prestasi.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</main>