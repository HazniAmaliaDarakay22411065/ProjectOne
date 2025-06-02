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

<!-- Bagian Ekstrakurikuler -->
<main id="ekskul">
    <div class="album">
        <div class="container" data-aos="fade-up">
            <!-- Header -->
            <div class="container bg-light text-dark" style="max-width: 800px; margin: 0 auto; margin-top: 10rem; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);">
                <div class="container-galeri text-center">
                    <h3 style="font-family: 'Rowdies', serif; font-weight: bold; color: #343a40;">EKSTRAKURIKULER</h3>
                    <hr style="border-top: 2px solid #343a40; width: 80%; margin: 0 auto;">
                </div>
            </div>

            <!-- Card Ekstrakurikuler -->
            <div class="row mt-5 justify-content-center">
                <?php foreach ($ekskul as $e) : ?>
                    <div class="col-12 col-sm-6 col-md-3 mb-4">
                        <div class="card h-100 shadow-sm border-0" style="border-radius: 12px;">
                            <img src="<?= base_url('images/ekskul/' . $e->image) ?>" class="card-img-top" alt="<?= $e->judul ?>" style="height: 180px; object-fit: cover; border-radius: 12px 12px 0 0;">
                            <div class="card-body text-center p-3" style="background-color: #f8f9fa; border-radius: 0 0 12px 12px;">
                                <h6 class="card-title text-dark mb-0" style="font-size: 15px; font-weight: 600;"><?= strtoupper($e->judul) ?></h6>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</main>