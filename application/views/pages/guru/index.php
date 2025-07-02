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

<main role="main" class="container-fluid">
    <?php $this->load->view('layouts/_alert') ?>
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-4">
            <div class="card border border-light shadow-lg rounded-4">
                <!-- Card Header -->
                <div class="card-header bg-white border-bottom">
                    <div class="w-100 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <!-- Kolom Tambah Guru -->
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold">Data Guru</span>
                            <a href="<?= base_url('guru/create') ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                        </div>

                        <!-- Kolom Import Excel -->
                        <form action="<?= base_url('guru/import_excel') ?>" method="post" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                            <input type="file" name="file_excel" accept=".xlsx,.xls" class="form-control form-control-sm" style="max-width: 180px;" required>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-file-import"></i> Import Excel
                            </button>
                        </form>

                        <!-- Kolom Pencarian -->
                        <form action="<?= base_url("guru/search") ?>" method="POST" class="d-flex align-items-center gap-2">
                            <div class="input-group input-group-sm">
                                <input type="text" name="keyword" class="form-control" placeholder="Cari NIP / Nama" value="<?= $this->session->userdata('keyword') ?>">
                                <button class="btn btn-info" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url("guru/reset") ?>" class="btn btn-info">
                                    <i class="fas fa-eraser"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th style="width: 40px;">No</th>
                                    <th>ID Guru</th>
                                    <th>Foto</th>
                                    <th style="min-width: 120px;">Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th style="min-width: 120px;">Tanggal Lahir</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>JK</th>
                                    <th>Deskripsi</th>
                                    <th style="width: 80px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($content as $row) : ?>
                                    <tr class="text-center">
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->id_guru ?></td>
                                        <td>
                                            <?php
                                            $foto = (!empty($row->foto) && file_exists(FCPATH . "images/guru/{$row->foto}"))
                                                ? base_url("images/guru/{$row->foto}")
                                                : base_url("images/guru/default.png");
                                            ?>
                                            <img src="<?= $foto ?>" class="img-thumbnail rounded" height="40" width="40">
                                        </td>
                                        <td class="text-start"><?= $row->nama ?></td>
                                        <td><?= $row->tempat_lahir ?></td>
                                        <td><?= date('d-m-Y', strtotime($row->tgl_lahir)) ?></td>
                                        <td><?= $row->nip ?></td>
                                        <td><?= $row->jabatan ?></td>
                                        <td><?= $row->jk == 'L' ? 'L' : 'P' ?></td>
                                        <td class="text-start"><?= $row->deskripsi ?></td>
                                        <td>
                                            <?= form_open(base_url("guru/delete/$row->id_guru"), ['method' => 'POST']) ?>
                                            <?= form_hidden('id_guru', $row->id_guru) ?>
                                            <a href="<?= base_url("guru/edit/$row->id_guru") ?>" class="btn btn-sm">
                                                <i class="fas fa-edit text-info"></i>
                                            </a>
                                            <button class="btn btn-sm" type="submit" onclick="return confirm('Apakah yakin ingin menghapus guru ini?')">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                            <?= form_close() ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Navigasi Pagination -->
                    <nav aria-label="Page navigation example">
                        <?= $pagination ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</main>