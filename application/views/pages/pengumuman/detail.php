<div class="row justify-content-center" style="padding-top: 140px;">
    <div class="col-md-8">
        <div class="card mb-3">
            <?php if (!empty($pengumuman->image)) : ?>
                <img src="<?= base_url("images/pengumuman/{$pengumuman->image}") ?>" class="card-img-top" alt="<?= htmlspecialchars($pengumuman->judul) ?>">
            <?php endif; ?>
            <div class="card-body">
                <h3 class="card-title"><?= htmlspecialchars($pengumuman->judul) ?></h3>
                <p class="card-text">
                    <?= nl2br(htmlspecialchars($pengumuman->deskripsi)) ?>
                </p>
                <hr>
                <p class="card-text">
                    <?= nl2br(htmlspecialchars($pengumuman->detail)) ?>
                </p>
                <a href="<?= base_url('pengumuman/show') ?>" class="btn btn-secondary mt-3">Kembali ke Daftar Pengumuman</a>
            </div>
        </div>
    </div>
</div>