<!-- Breadcrumb Full Width & Menarik -->
<div class="w-100 position-relative" style="top: 0; left: 0; background: #ffffff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 1000; font-family: 'Kanit', sans-serif;">
    <div class="d-flex align-items-center px-3 py-2 flex-wrap">
        <nav aria-label="breadcrumb" class="flex-grow-1">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('dashboard') ?>" class="text-dark d-flex align-items-center">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </a>
                </li>
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
    <?php $this->load->view('layouts/_alert') ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-light shadow-lg rounded-4">
                <div class="card-header bg-white text-dark text-center rounded-top-4 border-bottom fw-bold">
                    <?= isset($title) ? $title : 'Form Siswa' ?>
                </div>
                <div class="card-body">
                    <form action="<?= $form_action ?>" method="POST">

                        <!-- ID  (readonly) -->
                        <div class="mb-3">
                            <label for="id_siswa">ID Siswa</label>
                            <input type="text" name="id_siswa" id="id_siswa" class="form-control"
                                value="<?= set_value('id_siswa', $input->id_siswa) ?>" readonly>
                        </div>
                        <!-- NIS -->
                        <div class="form-group mb-3">
                            <label for="nis">NIS</label>
                            <input type="text" name="nis" id="nis"
                                class="form-control <?= form_error('nis') ? 'is-invalid' : '' ?>"
                                value="<?= set_value('nis', $input->nis) ?>">
                            <?= form_error('nis', '<div class="invalid-feedback">', '</div>') ?>
                        </div>

                        <!-- Nama Siswa -->
                        <div class="form-group mb-3">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" name="nama_siswa" id="nama_siswa"
                                class="form-control <?= form_error('nama_siswa') ? 'is-invalid' : '' ?>"
                                value="<?= set_value('nama_siswa', $input->nama_siswa) ?>">
                            <?= form_error('nama_siswa', '<div class="invalid-feedback">', '</div>') ?>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="form-group mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-control <?= form_error('jenis_kelamin') ? 'is-invalid' : '' ?>">
                                <option value="">-- Pilih --</option>
                                <option value="L" <?= set_select('jenis_kelamin', 'L', $input->jenis_kelamin == 'L') ?>>Laki-laki</option>
                                <option value="P" <?= set_select('jenis_kelamin', 'P', $input->jenis_kelamin == 'P') ?>>Perempuan</option>
                            </select>
                            <?= form_error('jenis_kelamin', '<div class="invalid-feedback">', '</div>') ?>
                        </div>

                        <!-- Kelas -->
                        <div class="form-group mb-3">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" id="id_kelas"
                                class="form-control <?= form_error('id_kelas') ? 'is-invalid' : '' ?>">
                                <option value="">-- Pilih Kelas --</option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k->id_kelas ?>"
                                        <?= set_select('id_kelas', $k->id_kelas, $k->id_kelas == $input->id_kelas) ?>>
                                        <?= $k->nama_kelas ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('id_kelas', '<div class="invalid-feedback">', '</div>') ?>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>