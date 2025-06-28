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

<main role="main" class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-light shadow-lg rounded-4">
                <div class="card-header bg-white text-dark text-center rounded-top-4 border-bottom fw-bold">
                    <?= isset($input->id_kelas) && $this->uri->segment(2) == 'edit' ? 'Edit Kelas' : 'Tambah Kelas' ?>
                </div>
                <div class="card-body p-4">
                    <form action="<?= $form_action ?>" method="POST">

                        <!-- ID Kelas -->
                        <div class="mb-3">
                            <label for="id_kelas" class="form-label fw-semibold">ID Kelas</label>
                            <input type="text" name="id_kelas" id="id_kelas" class="form-control" value="<?= $input->id_kelas ?>" readonly>
                        </div>

                        <!-- Nama Kelas -->
                        <div class="mb-3">
                            <label for="nama_kelas" class="form-label fw-semibold">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control <?= form_error('nama_kelas') ? 'is-invalid' : '' ?>" value="<?= set_value('nama_kelas', $input->nama_kelas) ?>" placeholder="Contoh: VII A" required>
                            <div class="text-danger small mt-1"><?= form_error('nama_kelas') ?></div>
                        </div>

                        <!-- Tombol -->
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>