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

<section id="pengumuan">
    <div class="container bg-light text-dark" style="max-width: 800px; margin: 0 auto; margin-top: 10rem; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);">
        <div class="container-galeri text-center">
            <h3 style="font-family: 'Rowdies', serif; font-weight: bold; color: #343a40;">PENGUMUMAN</h3>
            <hr style="border-top: 2px solid #343a40; width: 50%; margin: 0 auto;">
        </div>
    </div>

    <div class="container my-5">
        <div class="row ps-md-4"> <!-- padding start (left) saat medium screen ke atas -->
            <?php foreach ($pengumuman as $item) : ?>
                <div class="col-md-6 col-lg-4 mb-4" style="margin-top: 20px;">
                    <div class="card h-100 shadow rounded-3">
                        <img src="<?= base_url("images/pengumuman/{$item->image}") ?>" class="card-img-top" alt="<?= htmlspecialchars($item->judul) ?>" style="object-fit: cover; height: 200px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($item->judul) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($item->deskripsi)) ?></p>
                            <a href="<?= base_url("pengumuman/detail/{$item->id}") ?>" class="btn btn-primary mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>