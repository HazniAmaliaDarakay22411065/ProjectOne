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
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php $this->load->view('layouts/_alert') ?>

            <div class="card mb-3">
                <div class="card border border-light shadow-lg rounded-4" style="transition: all 0.3s;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span>Data Prestasi</span>
                            <a href="<?= base_url('prestasi/create') ?>" class="btn btn-sm btn-primary ms-3">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                        </div>
                        <!-- Form pencarian -->
                        <form action="<?= base_url('prestasi/search') ?>" method="POST" class="d-flex">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control form-control-sm me-2" placeholder="Cari judul / kategori"
                                    value="<?= $this->session->userdata('keyword_prestasi') ?>">
                                <button class="btn btn-info btn-sm" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="<?= base_url('prestasi/reset') ?>" class="btn btn-info btn-sm ms-1">
                                    <i class="fas fa-eraser"></i>
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-sm align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>ID Prestasi</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Foto</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($content as $row) : $no++; ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td><?= $row->id_prestasi ?></td>
                                        <td><?= $row->judul ?></td>
                                        <td><?= $row->deskripsi ?></td>
                                        <td><?= ucwords($row->kategori) ?></td>
                                        <td><?= $row->nama_siswa ?? '-' ?></td>
                                        <td><?= $row->nama_kelas ?? '-' ?></td>
                                        <td class="text-center">
                                            <img src="<?= $row->image ? base_url("images/prestasi/$row->image") : base_url("images/default.png") ?>" alt="<?= $row->judul ?>" height="50">
                                        </td>
                                        <td class="text-center">
                                            <?= $row->created_at ? date('d M Y H:i', strtotime($row->created_at)) : '-' ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <a href="<?= base_url("prestasi/edit/{$row->id_prestasi}") ?>" class="btn btn-sm">
                                                    <i class="fas fa-edit text-info"></i>
                                                </a>
                                                <form action="<?= base_url("prestasi/delete") ?>" method="POST" onsubmit="return confirm('Apakah yakin ingin menghapus?')">
                                                    <input type="hidden" name="id_prestasi" value="<?= $row->id_prestasi ?>">
                                                    <button type="submit" class="btn btn-sm">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </div>
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