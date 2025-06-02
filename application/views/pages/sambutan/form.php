<!-- form.php untuk admin - Sambutan Kepala Sekolah -->
<main role="main" class="container" style="padding-top: 150px;">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header"><?= $title ?></div>
                <div class="card-body">
                    <?= form_open_multipart($form_action) ?>

                    <div class="form-group">
                        <label>Pembuka</label>
                        <?= form_textarea('pembuka', $input->pembuka, [
                            'class' => 'form-control',
                            'rows'  => 3,
                            'required' => true
                        ]) ?>
                        <?= form_error('pembuka') ?>
                    </div>

                    <div class="form-group">
                        <label>Isi Sambutan</label>
                        <?= form_textarea('isi_sambutan', $input->isi_sambutan, [
                            'class' => 'form-control',
                            'rows'  => 5,
                            'required' => true
                        ]) ?>
                        <?= form_error('isi_sambutan') ?>
                    </div>

                    <div class="form-group">
                        <label>Penutup</label>
                        <?= form_textarea('penutup', $input->penutup, [
                            'class' => 'form-control',
                            'rows'  => 3,
                            'required' => true
                        ]) ?>
                        <?= form_error('penutup') ?>
                    </div>

                    <div class="form-group">
                        <label>Nama Kepala Sekolah</label>
                        <?= form_input('nama_kepsek', $input->nama_kepsek, ['class' => 'form-control', 'required' => true]) ?>
                        <?= form_error('nama_kepsek') ?>
                    </div>

                    <div class="form-group">
                        <label>NIP Kepala Sekolah</label>
                        <?= form_input('nip_kepsek', $input->nip_kepsek, ['class' => 'form-control', 'required' => true]) ?>
                        <?= form_error('nip_kepsek') ?>
                    </div>

                    <div class="form-group">
                        <label>Foto Kepala Sekolah</label><br>
                        <?= form_upload('foto_kepsek') ?>
                        <?php if (isset($input->foto_kepsek)) : ?>
                            <div class="mt-2">
                                <img src="<?= base_url("images/kepsek/$input->foto_kepsek") ?>" height="100">
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