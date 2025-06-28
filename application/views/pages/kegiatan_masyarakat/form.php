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
<main role="main" class="container mt-3">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php $this->load->view('layouts/_alert') ?>
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white text-center rounded-top-4">
                    <strong><?= $title ?></strong>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="id_kegmas">ID Kegmas</label>
                        <input type="text" name="id_kegmas" value="<?= $input->id_kegmas ?>" class="form-control" readonly>
                    </div>
                    <?= form_open_multipart($form_action) ?>
                    <div class="form-group mb-3">
                        <label for="judul">Judul</label>
                        <?= form_input('judul', $input->judul, ['class' => 'form-control', 'required' => true]) ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="id_guru">Penanggung Jawab (Guru)</label>
                        <select name="id_guru" class="form-control" required>
                            <option value="">-- Pilih Guru --</option>
                            <?php foreach ($guru as $g) : ?>
                                <option value="<?= $g->id_guru ?>" <?= $input->id_guru == $g->id_guru ? 'selected' : '' ?>>
                                    <?= $g->id_guru ?> - <?= $g->nama ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>



                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" rows="5" class="form-control"><?= $input->deskripsi ?></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <input type="file" name="image" class="form-control">
                        <label for="image">Foto</label><br>
                        <?php if (isset($input->image)) : ?>
                            <img src="<?= base_url("images/kegiatan_masyarakat/$input->image") ?>" alt="" height="80" class="mb-2"><br>
                        <?php endif ?>

                        <small class="text-danger"><?= $this->session->flashdata('image_error') ?></small>
                    </div>
                    <!-- Tombol -->
                    <button type="submit" class="btn btn-primary px-4">
                        Simpan
                    </button> <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</main>