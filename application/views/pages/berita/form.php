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
                    <?= $title ?>
                </div>
                <div class="card-body">
                    <?= form_open_multipart($form_action) ?>

                    <!-- ID Berita (readonly) -->
                    <div class="form-group mb-3">
                        <label for="id_berita">ID Berita</label>
                        <input type="text" name="id_berita" value="<?= $input->id_berita ?>" class="form-control" readonly>
                    </div>

                    <!-- Judul Berita -->
                    <div class="form-group mb-3">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" value="<?= set_value('judul', $input->judul) ?>" class="form-control <?= form_error('judul') ? 'is-invalid' : '' ?>" required placeholder="Contoh: Pengumuman Libur Sekolah">
                        <?= form_error('judul') ?>
                    </div>

                    <!-- Jenis Berita -->
                    <div class="form-group mb-3">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" class="form-control <?= form_error('jenis') ? 'is-invalid' : '' ?>" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="pengumuman" <?= set_select('jenis', 'pengumuman', $input->jenis == 'pengumuman') ?>>Pengumuman</option>
                            <option value="agenda" <?= set_select('jenis', 'agenda', $input->jenis == 'agenda') ?>>Agenda</option>
                        </select>
                        <?= form_error('jenis') ?>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control <?= form_error('deskripsi') ? 'is-invalid' : '' ?>" rows="4" placeholder="Tulis isi berita di sini..."><?= set_value('deskripsi', $input->deskripsi) ?></textarea>
                        <?= form_error('deskripsi') ?>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="form-group mb-3">
                        <label for="image">Gambar</label>
                        <input type="file" name="image" class="form-control-file <?= form_error('image') ? 'is-invalid' : '' ?>">
                        <?php if (isset($input->image) && file_exists(FCPATH . "images/berita/{$input->image}")) : ?>
                            <small class="d-block mt-3">Gambar saat ini:
                                <img src="<?= base_url("images/berita/$input->image") ?>" alt="" height="50">
                            </small>
                        <?php endif ?>
                        <?= form_error('image') ?>
                        <small class="text-danger"><?= $this->session->flashdata('image_error') ?></small>
                    </div>

                    <!-- Tombol Simpan -->
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>

                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>