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