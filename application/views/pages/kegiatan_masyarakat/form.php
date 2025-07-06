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


<!-- form.php untuk admin - Kegiatan Masyarakat -->
<main role="main" class="container my-4">
    <?php $this->load->view('layouts/_alert') ?>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border border-light shadow-lg rounded-4">
                <div class="card-header bg-white text-dark text-center fw-bold">
                    <?= $title ?>
                </div>
                <div class="card-body">
                    <?= form_open_multipart($form_action) ?>

                    <!-- ID Kegiatan Masyarakat (readonly) -->
                    <div class="mb-3">
                        <label for="id_kegmas">ID Kegiatan</label>
                        <input type="text" name="id_kegmas" id="id_kegmas" class="form-control"
                            value="<?= set_value('id_kegmas', $input->id_kegmas) ?>" readonly>
                    </div>

                    <!-- Judul -->
                    <div class="mb-3">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control"
                            value="<?= set_value('judul', $input->judul) ?>" required>
                        <?= form_error('judul', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <!-- Penanggung Jawab -->
                    <div class="mb-3">
                        <label for="id_guru">Penanggung Jawab (Guru)</label>
                        <select name="id_guru" id="id_guru" class="form-select <?= form_error('id_guru') ? 'is-invalid' : '' ?>">
                            <option value="">-- Pilih Guru --</option>
                            <?php foreach ($guru as $g) : ?>
                                <option value="<?= $g->id_guru ?>" <?= set_select('id_guru', $g->id_guru, $input->id_guru == $g->id_guru) ?>>
                                    <?= $g->nama ?> - <?= $g->nip ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <?= form_error('id_guru', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"><?= set_value('deskripsi', $input->deskripsi) ?></textarea>
                        <?= form_error('deskripsi', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label for="image">Foto</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <?php if (!empty($input->image)) : ?>
                            <img src="<?= base_url("images/kegiatan_masyarakat/$input->image") ?>" height="80" class="mt-2">
                        <?php endif ?>
                        <small class="text-danger"><?= $this->session->flashdata('image_error') ?></small>
                    </div>

                    <!-- Status Publish -->
                    <div class="mb-3">
                        <label for="is_published">Status Publish</label>
                        <select name="is_published" class="form-select">
                            <option value="0" <?= $input->is_published == 0 ? 'selected' : '' ?>>Tidak dipublish</option>
                            <option value="1" <?= $input->is_published == 1 ? 'selected' : '' ?>>Publish</option>
                        </select>
                    </div>

                    <!-- Tombol Simpan -->
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>