<main class="container py-5" style="margin-top: 120px;">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <strong><?= $title ?></strong>
                </div>
                <div class="card-body">
                    <?= form_open_multipart($form_action) ?>

                    <!-- KATEGORI -->
                    <div class="form-group mb-3">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" class="form-control <?= form_error('kategori') ? 'is-invalid' : '' ?>" <?= (isset($input->id) ? 'readonly disabled' : '') ?>>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="visi" <?= set_select('kategori', 'visi', $input->kategori == 'visi') ?>>Visi</option>
                            <option value="misi" <?= set_select('kategori', 'misi', $input->kategori == 'misi') ?>>Misi</option>
                            <option value="tujuan" <?= set_select('kategori', 'tujuan', $input->kategori == 'tujuan') ?>>Tujuan</option>
                        </select>
                        <?= form_error('kategori') ?>
                    </div>

                    <!-- ISI -->
                    <div class="form-group mb-4">
                        <label for="isi">Isi <small class="text-muted">(Tekan ENTER untuk baris baru / poin baru)</small></label>
                        <textarea name="isi" rows="8" class="form-control <?= form_error('isi') ? 'is-invalid' : '' ?>" placeholder="Contoh:
                            Menyelenggarakan standar kualitas belajar
                            Melaksanakan pembelajaran aktif dan kreatif
                            Melaksanakan bimbingan peserta didik"><?= set_value('isi', $input->isi) ?></textarea>
                        <?= form_error('isi') ?>
                    </div>

                    <!-- TOMBOL -->
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('visi_misi') ?>" class="btn btn-secondary">Kembali</a>

                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>