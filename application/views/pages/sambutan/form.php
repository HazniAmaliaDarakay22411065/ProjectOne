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

<!-- form.php untuk admin - Sambutan Kepala Sekolah -->
<!-- File: application/views/pages/sambutan/form.php -->


<main role="main" class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border border-light shadow-lg rounded-4">
                <div class="card-header bg-white text-dark text-center fw-bold">
                    <?= $title ?>
                </div>
                <div class="card-body">
                    <?= form_open($form_action, ['method' => 'POST']) ?>
                    <!-- ID Sambutan (readonly) -->
                    <div class="mb-3">
                        <label for="id_sambutan">ID Sambutan</label>
                        <input type="text" name="id_sambutan" id="id_sambutan" class="form-control"
                            value="<?= set_value('id_sambutan', $input->id_sambutan) ?>" readonly>
                    </div>

                    <!-- ID Guru -->
                    <div class="mb-3">
                        <label for="id_guru">Pilih Guru</label>
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

                    <!-- Pembuka -->
                    <div class="mb-3">
                        <label for="pembuka">Pembuka</label>
                        <textarea name="pembuka" id="pembuka" rows="2" class="form-control"><?= set_value('pembuka', $input->pembuka) ?></textarea>
                        <?= form_error('pembuka', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <!-- Isi Sambutan -->
                    <div class="mb-3">
                        <label for="isi_sambutan">Isi Sambutan</label>
                        <textarea name="isi_sambutan" id="isi_sambutan" rows="5" class="form-control"><?= set_value('isi_sambutan', $input->isi_sambutan) ?></textarea>
                        <?= form_error('isi_sambutan', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <!-- Penutup -->
                    <div class="mb-3">
                        <label for="penutup">Penutup</label>
                        <textarea name="penutup" id="penutup" rows="2" class="form-control"><?= set_value('penutup', $input->penutup) ?></textarea>
                        <?= form_error('penutup', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <!-- Status Publish -->
                    <div class="mb-3">
                        <label for="is_published"> Pilih Status Publish</label>
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