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

<!-- FASILITAS -->
<section>
    <div class="container mt-5">
        <div class="container bg-light text-dark" style="max-width: 800px; margin: 0 auto; margin-top: 10rem; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);">
            <div class="container-galeri text-center">
                <h3 style="font-family: 'Rowdies', serif; font-weight: bold; color: #343a40;">FASILITAS</h3>
                <hr style="border-top: 2px solid #343a40; width: 50%; margin: 0 auto;">
            </div>
        </div>

        <div class="row mt-5">
            <?php foreach ($fasilitas as $f) : ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card" style="transition: transform 0.3s, box-shadow 0.3s;">
                        <img src="<?= base_url('images/fasilitas/' . $f->image) ?>" class="card-img-top" alt="<?= $f->judul ?>" style="border-top-left-radius: 15px; border-top-right-radius: 15px; height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $f->judul ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>