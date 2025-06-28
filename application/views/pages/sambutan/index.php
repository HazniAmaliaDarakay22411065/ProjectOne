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

<main role="main" class="container">
    <div class="row">
        <div class="col-md-10 mx-auto mt-2">
            <div class="card border border-light shadow-lg rounded-4" style="transition: all 0.3s;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span>Data Sambutan Guru</span>
                        <a href="<?= base_url('sambutan/create') ?>" class="btn btn-sm btn-primary ms-3">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                    <form action="<?= base_url("sambutan/search") ?>" method="POST" class="d-flex">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control form-control-sm me-2" placeholder="Cari NIP Guru" value="<?= $this->session->userdata('keyword_sambutan') ?>">
                            <button class="btn btn-info btn-sm" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="<?= base_url("sambutan/reset") ?>" class="btn btn-info btn-sm ms-1">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </div>
                    </form>

                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 15%;">Id Sambutan</th>
                                <th style="width: 15%;">Foto</th>
                                <th style="width: 25%;">Nama & NIP Guru</th>
                                <th style="width: 30%;">Isi Sambutan</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($content as $row) : $no++; ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->id_sambutan ?></td>
                                    <td>
                                        <?php if (!empty($row->guru_foto) && file_exists(FCPATH . "images/guru/{$row->guru_foto}")) : ?>
                                            <img src="<?= base_url("images/guru/{$row->guru_foto}") ?>" height="50" alt="Foto Kepala Sekolah">
                                        <?php else : ?>
                                            <span class="text-muted">Tidak ada foto</span>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <strong><?= $row->guru_nama ?></strong><br>
                                        <small><?= $row->guru_nip ?></small>

                                    </td>
                                    <td style="white-space: pre-wrap;">
                                        <strong>Pembuka:</strong> <?= strip_tags($row->pembuka) ?><br>
                                        <strong>Isi:</strong> <?= strip_tags(word_limiter($row->isi_sambutan, 20)) ?><br>
                                        <strong>Penutup:</strong> <?= strip_tags($row->penutup) ?>
                                    </td>
                                    <td>
                                        <form action="<?= base_url("sambutan/toggle/$row->id_sambutan") ?>" method="post">
                                            <button class="btn btn-sm <?= $row->is_published ? 'btn-success' : 'btn-secondary' ?>" type="submit">
                                                <?= $row->is_published ? '<i class="fas fa-check-circle"></i> Dipublish' : '<i class="fas fa-times-circle"></i> Tidak' ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <?= form_open(base_url("sambutan/delete/$row->id_sambutan"), ['method' => 'POST']) ?>
                                        <?= form_hidden('id_sambutan', $row->id_sambutan) ?>
                                        <a href="<?= base_url("sambutan/edit/$row->id_sambutan") ?>" class="btn btn-sm">
                                            <i class="fas fa-edit text-info"></i>
                                        </a>
                                        <button class="btn btn-sm" type="submit" onclick="return confirm('Yakin ingin menghapus sambutan ini?')">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                        <?= form_close() ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation">
                        <?= $pagination ?>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</main>