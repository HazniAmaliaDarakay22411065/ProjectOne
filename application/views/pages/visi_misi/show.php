<div class="container bg-light text-dark" style="max-width: 800px; margin: 0 auto; margin-top: 10rem; padding: 2rem; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);">
    <div class="container-galeri text-center">
        <h3 style="font-family: 'Rowdies', serif; font-weight: bold; color: #343a40;">VISI, MISI DAN TUJUAN SEKOLAH</h3>
        <hr style="border-top: 2px solid #343a40; width: 80%; margin: 0 auto;">
    </div>
</div>

<main class="container py-5" style="margin-top: 120px;">
    <div class="container-misi" style="background-color: #CDD5DB;">
        <!-- Visi Section -->
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3>Visi</h3>
                <?php foreach ($visi as $row): ?>
                    <h5><?= htmlspecialchars($row->isi) ?></h5>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Misi Section -->
        <div class="row">
            <div class="col-12 col-md-6">
                <h4 class="mt-5">Misi</h4>
                <ol>
                    <?php foreach ($misi as $row): ?>
                        <p><?= nl2br(htmlspecialchars($row->isi)) ?></p>
                    <?php endforeach; ?>
                </ol>
            </div>

            <!-- Tujuan Section -->
            <div class="col-12 col-md-6">
                <h4 class="mt-5">Tujuan Sekolah</h4>
                <ol>
                    <?php foreach ($tujuan as $row): ?>
                        <p><?= nl2br(htmlspecialchars($row->isi)) ?></p>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
</main>