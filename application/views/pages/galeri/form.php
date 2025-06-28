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




<main role="main" class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border border-light shadow-lg rounded-4" style="transition: all 0.3s;">
                <div class="card-header bg-light text-dark text-center rounded-top-4">
                    <strong><?= $title ?></strong>
                </div>
                <div class="card-body p-4">
                    <?= form_open_multipart($form_action) ?>

                    <!-- ID Galeri -->
                    <div class="form-group mb-3">
                        <label for="id_galeri" class="form-label">ID Galeri</label>
                        <?= form_input('id_galeri', $input->id_galeri ?? '', [
                            'class' => 'form-control',
                            'readonly' => true,
                            'id' => 'id_galeri'
                        ]) ?>
                    </div>

                    <!-- Judul -->
                    <div class="form-group mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <?= form_input('judul', $input->judul, [
                            'class' => 'form-control ' . (form_error('judul') ? 'is-invalid' : ''),
                            'required' => true,
                            'id' => 'judul'
                        ]) ?>
                        <?= form_error('judul', '<div class="invalid-feedback">', '</div>') ?>
                    </div>

                    <!-- Gambar -->
                    <div class="form-group mb-4">
                        <label for="image" class="form-label">Gambar</label>
                        <?= form_upload('image', '', ['class' => 'form-control', 'id' => 'image']) ?>

                        <?php if (isset($input->image)) : ?>
                            <div class="mt-2">
                                <small class="d-block">Gambar saat ini:</small>
                                <img src="<?= base_url("images/galeri/$input->image") ?>" height="80" class="rounded shadow-sm mt-1">
                            </div>
                        <?php endif ?>

                        <?php if ($this->session->flashdata('image_error')) : ?>
                            <small class="text-danger d-block mt-1"><?= $this->session->flashdata('image_error') ?></small>
                        <?php endif ?>
                    </div>

                    <!-- Tombol -->
                    <button type="submit" class="btn btn-primary px-4">
                        Simpan
                    </button>

                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>