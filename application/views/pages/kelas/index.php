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


<main role="main" class="container-fluid">
    <?php $this->load->view('layouts/_alert') ?>
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-4">
            <div class="card border border-light shadow-lg rounded-4">
                <!-- Header -->
                <div class="card-header bg-white border-bottom">
                    <div class="w-100 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <!-- Tambah Kelas -->
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold">Data Kelas</span>
                            <a href="<?= base_url('kelas/create') ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                        </div>

                        <!-- Pencarian (opsional, jika kamu buat method search kelas) -->
                        <form action="<?= base_url("kelas/search") ?>" method="POST" class="d-flex align-items-center gap-2">
                            <div class="input-group input-group-sm">
                                <input type="text" name="keyword" class="form-control" placeholder="Cari Nama Kelas" value="<?= $this->session->userdata('keyword') ?>">
                                <button class="btn btn-info" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url("kelas/reset") ?>" class="btn btn-info">
                                    <i class="fas fa-eraser"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width: 40px;">No</th>
                                <th>ID Kelas</th>
                                <th>Nama Kelas</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($content as $row) : ?>
                                <tr class="text-center">
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->id_kelas ?></td>
                                    <td class="text-center"><?= $row->nama_kelas ?></td>
                                    <td>
                                        <a href="<?= base_url("kelas/edit/$row->id_kelas") ?>" class="btn btn-sm">
                                            <i class="fas fa-edit text-info"></i>
                                        </a>
                                        <form action="<?= base_url("kelas/delete/$row->id_kelas") ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                            <button class="btn btn-sm" type="submit">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                            <?php if (empty($content)) : ?>
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data kelas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <!-- Navigasi Pagination -->
                    <nav aria-label="Page navigation">
                        <?= $pagination ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>