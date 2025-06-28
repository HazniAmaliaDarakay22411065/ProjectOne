<!-- Breadcrumb Full Width & Menarik -->
<div class="w-100 position-relative" style="top: 0; left: 0; background: #ffffff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 1000; font-family: 'Kanit', sans-serif;">
    <div class="d-flex align-items-center px-3 py-2 flex-wrap">
        <nav aria-label="breadcrumb" class="flex-grow-1">
            <ol class="breadcrumb mb-0">
                <!-- Link ke Dashboard -->
                <li class="breadcrumb-item">
                    <a href="<?= base_url('dashboard') ?>" class="text-dark d-flex align-items-center">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </a>
                </li>

                <!-- Jika ada segment ke-2, tampilkan -->
                <?php if ($this->uri->segment(2)) : ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-angle-right me-1"></i> <?= ucwords(str_replace('_', ' ', $this->uri->segment(2))) ?>
                    </li>
                <?php else : ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-angle-right me-1"></i> <?= isset($title) ? $title : 'Dashboard' ?>
                    </li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</div>

<!-- form.php untuk Prestasi (admin) -->
<main role="main" class="container mt-3">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border border-light shadow-lg rounded-4">
                <div class="card-header text-center fw-bold"><?= $title ?></div>
                <div class="card-body">
                    <?= form_open_multipart($form_action) ?>
                    <!-- ID -->
                    <div class="mb-3">
                        <label for="id_prestasi" class="form-label fw-semibold">ID Prestasi</label>
                        <input type="text" name="id_prestasi" id="id_prestasi" class="form-control" value="<?= $input->id_prestasi ?>" readonly>
                    </div>

                    <!-- Judul -->
                    <div class="form-group mb-3">
                        <label for="judul">Judul Prestasi</label>
                        <?= form_input('judul', $input->judul, [
                            'class' => 'form-control',
                            'required' => true,
                            'placeholder' => 'Contoh: Juara 1 Lomba Matematika'
                        ]) ?>
                        <?= form_error('judul', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <!-- Kategori -->
                    <div class="form-group mb-3">
                        <label for="kategori">Kategori</label>
                        <?= form_dropdown('kategori', [
                            '' => '-- Pilih Kategori --',
                            'akademik' => 'Akademik',
                            'non_akademik' => 'Non Akademik'
                        ], $input->kategori, ['class' => 'form-control', 'required' => true]) ?>
                        <?= form_error('kategori', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <?= form_textarea('deskripsi', $input->deskripsi, [
                            'class' => 'form-control',
                            'rows' => 4,
                            'placeholder' => 'Jelaskan detail prestasi yang diraih...'
                        ]) ?>
                        <?= form_error('deskripsi', '<small class="text-danger">', '</small>') ?>
                    </div>


                    <!-- Nama Siswa -->
                    <div class="form-group mb-3">
                        <label for="id_siswa">Nama Siswa</label>
                        <?= form_dropdown('id_siswa', $dropdown_siswa, $input->id_siswa, [
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                        <?= form_error('id_siswa', '<small class="text-danger">', '</small>') ?>
                    </div>


                    <!-- Upload Gambar -->
                    <div class="form-group mb-3">
                        <label for="image">Gambar Prestasi</label>
                        <?= form_upload('image', null, ['class' => 'form-control']) ?>
                        <?php if (isset($input->image)) : ?>
                            <div class="mt-2">
                                <img src="<?= base_url("images/prestasi/$input->image") ?>" height="100">
                            </div>
                        <?php endif ?>
                        <?php if ($this->session->flashdata('image_error')) : ?>
                            <small class="text-danger"><?= $this->session->flashdata('image_error') ?></small>
                        <?php endif ?>
                    </div>

                    <!-- Created At (readonly) -->
                    <?php if (isset($input->created_at)) : ?>
                        <div class="form-group mb-3">
                            <label>Dibuat Pada</label>
                            <input type="text" class="form-control" value="<?= date('d M Y H:i', strtotime($input->created_at)) ?>" readonly>
                        </div>
                    <?php endif ?>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>