<main>
    <div class="container mt-5" style="padding-top: 100px;">
        <!-- Gambar Sambutan -->
        <?php if (!empty($sambutan->foto_kepsek)): ?>
            <img src="<?= base_url('/images/kepsek/' . $sambutan->foto_kepsek) ?>" alt="Foto Kepala Sekolah" class="img-fluid zoom-image center-image" style="max-width: 180px; height: auto; display: block; margin: 0 auto;">
        <?php endif; ?>
        <!-- Sambutan -->
        <div class="sambutan mt-5 text-light" style="font-family: 'Lexend Giga', sans-serif;">
            <h2 class="text-center">Sambutan Kepala Sekolah</h2>

            <?php if (!empty($sambutan->pembuka)): ?>
                <p id="pembuka" class="text-center"><?= $sambutan->pembuka ?></p>
            <?php endif; ?>

            <p class="text-center">Assalamu‘alaikum Wr. Wb.</p>

            <?php if (!empty($sambutan->isi_sambutan)): ?>
                <p id="isi-sambutan"><?= nl2br($sambutan->isi_sambutan) ?></p>
            <?php endif; ?>

            <?php if (!empty($sambutan->isi_sambutan_2)): ?>
                <p><?= nl2br($sambutan->isi_sambutan_2) ?></p>
            <?php endif; ?>

            <?php if (!empty($sambutan->isi_sambutan_3)): ?>
                <p><?= nl2br($sambutan->isi_sambutan_3) ?></p>
            <?php endif; ?>

            <?php if (!empty($sambutan->isi_sambutan_4)): ?>
                <p><?= nl2br($sambutan->isi_sambutan_4) ?></p>
            <?php endif; ?>

            <?php if (!empty($sambutan->penutup)): ?>
                <p><?= nl2br($sambutan->penutup) ?></p>
            <?php endif; ?>

            <!-- Identitas Kepala Sekolah -->
            <div class="mt-4">
                <p style="margin: 0;"><strong>Kepala SMP NEGERI 11 JAYAPURA</strong></p><br>
                <p id="nama-kepala" style="margin: 0;"><?= $sambutan->nama_kepsek ?></p>
                <p id="nip-kepala" style="margin: 0;">NIP. <?= $sambutan->nip_kepsek ?></p>
            </div>
        </div>
    </div>
</main>