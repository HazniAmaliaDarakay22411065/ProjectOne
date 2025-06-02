<main class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <strong><?= $title ?></strong>
                </div>
                <div class="card-body">
                    <?= form_open_multipart($form_action) ?>
                    <div class="form-group mb-3">
                        <label for="nama">Nama Guru</label>
                        <input type="text" name="nama" value="<?= set_value('nama', $input->nama) ?>" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>">
                        <?= form_error('nama') ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" class="form-control <?= form_error('jabatan') ? 'is-invalid' : '' ?>">
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="kepala sekolah" <?= set_select('jabatan', 'kepala sekolah', $input->jabatan == 'kepala sekolah') ?>>Kepala Sekolah</option>
                            <option value="guru tetap" <?= set_select('jabatan', 'guru tetap', $input->jabatan == 'guru tetap') ?>>Guru Tetap</option>
                            <option value="guru honorer" <?= set_select('jabatan', 'guru honorer', $input->jabatan == 'guru honorer') ?>>Guru Honorer</option>
                        </select>
                        <?= form_error('jabatan') ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="mapel">Mata Pelajaran</label>
                        <input type="text" name="mapel" value="<?= set_value('mapel', $input->mapel) ?>" class="form-control <?= form_error('mapel') ? 'is-invalid' : '' ?>">
                        <?= form_error('mapel') ?>
                    </div>

                    <div class="form-group mb-4">
                        <label for="image">Foto</label><br>
                        <input type="file" name="image" class="form-control <?= form_error('image') ? 'is-invalid' : '' ?>">
                        <?= form_error('image') ?>
                        <?php if (isset($input->image) && $input->image != ''): ?>
                            <img src="<?= base_url("images/guru/$input->image") ?>" alt="Foto Guru" class="img-thumbnail mt-2" width="150">
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('guru') ?>" class="btn btn-secondary">Kembali</a>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>