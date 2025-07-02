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
                <div class="card-body">
                    <form action="<?= $form_action ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="id_ekskul">ID Ekskul</label>
                            <input type="text" name="id_ekskul" value="<?= $input->id_ekskul ?>" class="form-control" readonly>
                        </div>

                        <!-- Nama Ekskul -->
                        <div class="mb-3">
                            <label for="judul">Nama Ekskul</label>
                            <input type="text" name="judul" value="<?= set_value('judul', $input->judul) ?>" class="form-control" required>
                            <?= form_error('judul') ?>
                        </div>


                        <div class="form-group mb-3">
                            <label for="id_guru">Penanggung Jawab (Guru)</label>
                            <select name="id_guru" id="id_guru" class="form-control" required>
                                <option value="">-- Pilih Guru --</option>
                                <?php foreach ($guru as $g) : ?>
                                    <option value="<?= $g->id_guru ?>"
                                        <?= $input->id_guru == $g->id_guru ? 'selected' : '' ?>
                                        data-nama="<?= $g->nama ?>"
                                        data-deskripsi="<?= $g->deskripsi ?>">
                                        <?= $g->id_guru ?> - <?= $g->nama ?> -- <?= $g->deskripsi ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>


                        <div class="form-group mb-3">
                            <label for="image">Foto</label>
                            <input type="file" name="image" class="form-control-file <?= form_error('image') ? 'is-invalid' : '' ?>">
                            <?php if (isset($input->image)) : ?>
                                <small class="d-block mt-2">Foto saat ini: <img src="<?= base_url("images/ekskul/$input->image") ?>" alt="" height="40"></small>
                            <?php endif ?>
                            <?= form_error('image') ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>