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

<div class="container my-4">
    <?php $this->load->view('layouts/_alert') ?>
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-10">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-white text-center border-bottom fw-bold py-3 rounded-top-4">
                    <h5 class="mb-0">Edit Profil Sekolah</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="id_sekolah" class="form-label">ID Profil Sekolah</label>
                        <input type="text" name="id_sekolah" id="id_sekolah"
                            class="form-control form-control-sm" value="<?= set_value('id_sekolah', $input->id_sekolah) ?>" readonly>
                    </div>

                    <?= form_open($form_action, ['method' => 'POST']) ?>

                    <?php
                    $fields = [
                        'nama_sekolah'  => 'Nama Sekolah',
                        'npsn'          => 'NPSN',
                        'jenjang'       => 'Jenjang',
                        'status'        => 'Status',
                        'akreditasi'    => 'Akreditasi',
                        'tahun_berdiri' => 'Tahun Berdiri',

                    ];
                    foreach ($fields as $name => $label) : ?>
                        <div class="mb-3">
                            <label for="<?= $name ?>" class="form-label"><?= $label ?></label>
                            <input type="<?= $name === 'email' ? 'email' : ($name === 'tahun_berdiri' ? 'number' : 'text') ?>"
                                name="<?= $name ?>" id="<?= $name ?>"
                                class="form-control form-control-sm"
                                value="<?= set_value($name, $input->$name) ?>" required>
                            <?= form_error($name, '<div class="text-danger small">', '</div>') ?>
                        </div>
                    <?php endforeach; ?>

                    <?php
                    $textareas = [
                        'visi'    => 'Visi',
                        'misi'    => 'Misi',
                        'tujuan'  => 'Tujuan',
                        'sejarah' => 'Sejarah',

                    ];
                    foreach ($textareas as $name => $label) : ?>
                        <div class="mb-3">
                            <label for="<?= $name ?>" class="form-label"><?= $label ?></label>
                            <textarea name="<?= $name ?>" id="<?= $name ?>"
                                rows="<?= in_array($name, ['sejarah', 'tujuan']) ? 6 : 4 ?>"
                                class="form-control form-control-sm" required><?= set_value($name, $input->$name) ?></textarea>
                            <?= form_error($name, '<div class="text-danger small">', '</div>') ?>
                        </div>
                    <?php endforeach; ?>

                    <div class="text-start mt-4">
                        <button type="submit" class="btn btn-sm btn-primary px-4">Simpan</button>
                    </div>

                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>