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

<main role="main" class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card mb-3">
                <div class="card border border-light shadow-lg rounded-4" style="transition: all 0.3s;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span>Data Siswa</span>
                            <a href="<?= base_url('siswa/create') ?>" class="btn btn-sm btn-primary ms-3">
                                <i class="fas fa-plus"></i> Tambah Siswa
                            </a>
                        </div>

                        <!-- Kolom Import Excel -->
                        <form action="<?= base_url('siswa/import_excel') ?>" method="post" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                            <input type="file" name="file_excel" accept=".xlsx,.xls" class="form-control form-control-sm" style="max-width: 180px;" required>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-file-import"></i> Import Excel
                            </button>
                        </form>


                        <!-- Kolom Pencarian -->
                        <form action="<?= base_url("siswa/search") ?>" method="POST" class="d-flex align-items-center gap-2">
                            <div class="input-group input-group-sm">
                                <input type="text" name="keyword" class="form-control" placeholder="Cari NIS" value="<?= $this->session->userdata('keyword') ?>">
                                <button class="btn btn-info" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url("guru/reset") ?>" class="btn btn-info">
                                    <i class="fas fa-eraser"></i>
                                </a>
                            </div>
                        </form>

                    </div>

                    <div class="card-body">
                        <?php $this->load->view('layouts/_alert') ?>

                        <!-- Tabel -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>ID Siswa</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($content as $row) : $no++; ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row->id_siswa ?></td>
                                            <td><?= $row->nis ?></td>
                                            <td><?= $row->nama_siswa ?></td>
                                            <td><?= $row->jenis_kelamin == 'L' ? 'L' : 'P' ?></td>
                                            <td><?= $row->nama_kelas ?? '-' ?></td>
                                            <td>
                                                <a href="<?= base_url("siswa/edit/$row->id_siswa") ?>" class="btn btn-sm">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>
                                                <?= form_open(base_url("siswa/delete/$row->id_siswa"), ['method' => 'POST', 'class' => 'd-inline']) ?>
                                                <button class="btn btn-sm" type="submit" onclick="return confirm('Yakin ingin menghapus siswa ini?')">
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
    </div>
</main>