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
    <?php $this->load->view('layouts/_alert') ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-light shadow-lg rounded-4">
                <div class="card-header bg-white text-dark text-center rounded-top-4 border-bottom fw-bold">
                    <?= $title ?>
                </div>
                <div class="card-body p-4">
                    <?= form_open_multipart($form_action) ?>


                    <!-- ID Guru -->
                    <div class="mb-3">
                        <label for="id_guru" class="form-label fw-semibold">ID Guru</label>
                        <?= form_input('id_guru', $input->id_guru, [
                            'class' => 'form-control',
                            'readonly' => true
                        ]) ?>
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Guru</label>
                        <?= form_input('nama', $input->nama, [
                            'class' => 'form-control',
                            'required' => true,
                            'placeholder' => 'Contoh: Ibu Ratna Dewi'
                        ]) ?>
                        <div class="text-danger small mt-1"><?= form_error('nama') ?></div>
                    </div>

                    <!-- NIP -->
                    <div class="mb-3">
                        <label for="nip" class="form-label fw-semibold">NIP</label>
                        <?= form_input([
                            'type' => 'number',
                            'name' => 'nip',
                            'value' => $input->nip,
                            'class' => 'form-control',
                            'required' => true,
                            'maxlength' => 18,
                            'placeholder' => 'Contoh: 197812312005011002'
                        ]) ?>
                        <div class="text-danger small mt-1"><?= form_error('nip') ?></div>
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label fw-semibold">Tempat Lahir</label>
                        <?= form_input([
                            'type' => 'text',
                            'name' => 'tempat_lahir',
                            'value' => $input->tempat_lahir,
                            'class' => 'form-control',
                            'required' => true,
                            'pattern' => '[A-Za-z\s]+',
                            'title' => 'Tempat lahir hanya boleh huruf',
                            'placeholder' => 'Contoh: Jayapura'
                        ]) ?>

                        <div class="text-danger small mt-1"><?= form_error('tempat_lahir') ?></div>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                        <?= form_input([
                            'name' => 'tgl_lahir',
                            'id' => 'tgl_lahir',
                            'type' => 'date',
                            'value' => set_value('tgl_lahir', $input->tgl_lahir),
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                        <div class="text-danger small mt-1"><?= form_error('tgl_lahir') ?></div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Kelamin</label><br>
                        <div class="form-check form-check-inline">
                            <?= form_radio('jk', 'L', $input->jk === 'L', ['class' => 'form-check-input', 'id' => 'jkL']) ?>
                            <label class="form-check-label" for="jkL">Laki-Laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <?= form_radio('jk', 'P', $input->jk === 'P', ['class' => 'form-check-input', 'id' => 'jkP']) ?>
                            <label class="form-check-label" for="jkP">Perempuan</label>
                        </div>
                        <div class="text-danger small mt-1"><?= form_error('jk') ?></div>
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label for="jabatan" class="form-label fw-semibold">Jabatan</label>
                        <?= form_dropdown('jabatan', [
                            '' => 'Pilih Jabatan',
                            'Kepala Sekolah'       => 'Kepala Sekolah',
                            'Wakil Kepala Sekolah' => 'Wakil Kepala Sekolah',
                            'Wali Kelas'           => 'Wali Kelas',
                            'Guru Mapel'           => 'Guru Mapel',
                            'Komite Sekolah'       => 'Komite Sekolah',
                            'Bendahara'            => 'Bendahara',
                            'Kepala Tata Usaha'    => 'Kepala Tata Usaha',
                            'Wakasek Kurikulum'    => 'Wakasek Kurikulum',
                            'Wakasek Kesiswaan'    => 'Wakasek Kesiswaan',
                            'Wakasek Sarpras'      => 'Wakasek Sarpras',
                            'Wakasek Humas'        => 'Wakasek Humas'
                        ], $input->jabatan, ['class' => 'form-select', 'required' => true]) ?>
                        <div class="text-danger small mt-1"><?= form_error('jabatan') ?></div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <?= form_textarea('deskripsi', $input->deskripsi, [
                            'class' => 'form-control',
                            'required' => true,
                            'rows' => 4,
                            'placeholder' => 'Deskripsi singkat tentang guru ini...'
                        ]) ?>
                        <div class="text-danger small mt-1"><?= form_error('deskripsi') ?></div>
                    </div>

                    <!-- Foto -->
                    <div class="mb-3">
                        <label for="foto" class="form-label fw-semibold">Foto Guru</label>
                        <?= form_upload('foto', '', ['class' => 'form-control']) ?>
                        <?php if (isset($input->foto) && $input->foto) : ?>
                            <div class="mt-2">
                                <img src="<?= base_url("images/guru/$input->foto") ?>" class="img-thumbnail rounded" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('image_error')) : ?>
                            <div class="text-danger small mt-1"><?= $this->session->flashdata('image_error') ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- publis -->
                    <div class="form-group mb-3">
                        <label for="is_published">Status Tampilkan</label>
                        <select name="is_published" class="form-select">
                            <option value="0" <?= $input->is_published == 0 ? 'selected' : '' ?>>Tidak Ditampilkan</option>
                            <option value="1" <?= $input->is_published == 1 ? 'selected' : '' ?>>Tampilkan</option>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>

                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    
</main>