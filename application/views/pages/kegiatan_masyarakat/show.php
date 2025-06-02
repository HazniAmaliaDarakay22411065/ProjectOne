<main>
    <div class="container">
        <!-- Header -->
        <div class="container bg-light text-dark" style="max-width: 800px; margin: 0 auto; margin-top: 10rem; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);">
            <div class="container-galeri text-center">
                <h3 style="font-family: 'Rowdies', serif; font-weight: bold; color: #343a40;">KEGIATAN MASYARAKAT</h3>
                <hr style="border-top: 2px solid #343a40; width: 50%; margin: 0 auto;">
            </div>
        </div>

        <!-- Cards -->
        <div class="container-fluid mt-5" style="padding: 10px;">
            <div class="row d-flex justify-content-center flex-wrap">
                <?php foreach ($kegiatan_masyarakat as $item): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                        <div class="card h-100 text-center">
                            <img src="<?= base_url('images/kegiatan_masyarakat/' . $item->image) ?>" alt="<?= $item->judul ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="post-title mb-2" style="font-size: 18px; font-weight: bold;">
                                    <?= $item->judul ?>
                                </h5>
                                <p class="post-content" style="font-size: 14px; color: #555;">
                                    <?= strip_tags($item->deskripsi) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</main>