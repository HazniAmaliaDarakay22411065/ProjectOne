<!-- form.php untuk admin - Kegiatan Masyarakat -->
<main role="main" class="container" style="padding-top: 150px;">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header"><?= $title ?></div>
                <div class="card-body">
                    <?= form_open_multipart($form_action) ?>

                    <div class="form-group">
                        <label>Judul Kegiatan</label>
                        <?= form_input('judul', $input->judul, ['class' => 'form-control', 'required' => true]) ?>
                        <?= form_error('judul') ?>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <?= form_textarea('deskripsi', $input->deskripsi, [
                            'class' => 'form-control',
                            'rows'  => 5,
                            'required' => true
                        ]) ?>
                        <?= form_error('deskripsi') ?>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label><br>
                        <?= form_upload('image') ?>
                        <?php if (isset($input->image)) : ?>
                            <div class="mt-2">
                                <img src="<?= base_url("images/kegiatan_masyarakat/$input->image") ?>" height="100">
                            </div>
                        <?php endif ?>
                        <?php if ($this->session->flashdata('image_error')) : ?>
                            <small class="form-text text-danger"><?= $this->session->flashdata('image_error') ?></small>
                        <?php endif ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>