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
    <?php $this->load->view('layouts/_alert') ?>
    <div class="row">
        <div class="col-md-10 mx-auto ">
            <div class="card mb-3">
                <div class="card border border-light shadow-lg rounded-4" style="transition: all 0.3s;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span>Data Galeri</span>
                            <a href="<?= base_url('galeri/create') ?>" class="btn btn-sm btn-primary ms-3">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                        </div>
                        <!-- Form pencarian -->
                        <form action="<?= base_url("galeri/search") ?>" method="POST" class="d-flex">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control form-control-sm me-2" placeholder="Cari Galeri" value="<?= $this->session->userdata('keyword') ?>">
                                <button class="btn btn-info btn-sm" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url("galeri/reset") ?>" class="btn btn-info btn-sm ms-1">
                                    <i class="fas fa-eraser"></i>
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Galeri</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($content as $row) : $no++; ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $row->id_galeri ?></td>
                                        <td>
                                            <?php if (!empty($row->image) && file_exists(FCPATH . "images/galeri/{$row->image}")) : ?>
                                                <img src="<?= base_url("images/galeri/{$row->image}") ?>" height="50" alt="Gambar Galeri">
                                            <?php else : ?>
                                                <span class="text-muted">Tidak ada gambar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $row->judul ?></td>
                                        <td>
                                            <form action="<?= base_url("galeri/toggle/$row->id_galeri") ?>" method="post">
                                                <button class="btn btn-sm <?= $row->is_published ? 'btn-success' : 'btn-secondary' ?>" type="submit">
                                                    <?= $row->is_published ? '<i class="fas fa-check-circle"></i> Publish' : '<i class="fas fa-times-circle"></i> Tidak' ?>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <?= form_open(base_url("galeri/delete/$row->id_galeri"), ['method' => 'POST']) ?>
                                            <?= form_hidden('id_galeri', $row->id_galeri) ?>
                                            <a href="<?= base_url("galeri/edit/$row->id_galeri") ?>" class="btn btn-sm">
                                                <i class="fas fa-edit text-info"></i>
                                            </a>
                                            <button class="btn btn-sm" type="submit" onclick="return confirm('Apakah yakin ingin menghapus?')">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                            <?= form_close() ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <!-- Navigasi Pagination -->
                        <nav aria-label="Page navigation example">
                            <?= $pagination ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>