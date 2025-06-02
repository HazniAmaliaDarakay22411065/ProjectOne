<main role="main" class="container" style="padding-top: 80px;">
    <div class="row">
        <div class="col-md-10 mx-auto mt-5">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span>Data Kegiatan Masyarakat</span>
                        <a href="<?= base_url('kegiatan_masyarakat/create') ?>" class="btn btn-sm btn-primary ms-3">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                    <!-- Form pencarian -->
                    <form action="<?= base_url("kegiatan_masyarakat/search") ?>" method="POST" class="d-flex">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control form-control-sm me-2" placeholder="Cari Kegiatan" value="<?= $this->session->userdata('keyword') ?>">
                            <button class="btn btn-info btn-sm" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="<?= base_url("kegiatan_masyarakat/reset") ?>" class="btn btn-info btn-sm ms-1">
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
                                <th style="width: 15%;">Gambar</th>
                                <th style="width: 20%;">Judul</th>
                                <th style="width: 40%;">Deskripsi</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($content as $row) : $no++; ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?php if (!empty($row->image) && file_exists(FCPATH . "images/kegiatan_masyarakat/{$row->image}")) : ?>
                                            <img src="<?= base_url("images/kegiatan_masyarakat/{$row->image}") ?>" height="50" alt="Gambar">
                                        <?php else : ?>
                                            <span class="text-muted">Tidak ada gambar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row->judul ?></td>
                                    <td style="white-space: pre-wrap;"><?= strip_tags($row->deskripsi) ?></td>
                                    <td>
                                        <?= form_open(base_url("kegiatan_masyarakat/delete/$row->id"), ['method' => 'POST']) ?>
                                        <?= form_hidden('id', $row->id) ?>
                                        <a href="<?= base_url("kegiatan_masyarakat/edit/$row->id") ?>" class="btn btn-sm">
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
                    <nav aria-label="Page navigation">
                        <?= $pagination ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</main>