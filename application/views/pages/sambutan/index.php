<main role="main" class="container" style="padding-top: 80px;">
    <div class="row">
        <div class="col-md-10 mx-auto mt-5">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span>Data Sambutan Kepala Sekolah</span>
                        <a href="<?= base_url('sambutan/create') ?>" class="btn btn-sm btn-primary ms-3">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                    <form action="<?= base_url("sambutan/search") ?>" method="POST" class="d-flex">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control form-control-sm me-2" placeholder="Cari Nama Kepsek" value="<?= $this->session->userdata('keyword') ?>">
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
                                <th style="width: 15%;">Foto</th>
                                <th style="width: 25%;">Nama & NIP Kepsek</th>
                                <th style="width: 45%;">Isi Sambutan</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($content as $row) : $no++; ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>
                                        <?php if (!empty($row->foto_kepsek) && file_exists(FCPATH . "images/kepsek/{$row->foto_kepsek}")) : ?>
                                            <img src="<?= base_url("images/kepsek/{$row->foto_kepsek}") ?>" height="50" alt="Foto Kepala Sekolah">
                                        <?php else : ?>
                                            <span class="text-muted">Tidak ada foto</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?= $row->nama_kepsek ?></strong><br>
                                        <small><?= $row->nip_kepsek ?></small>
                                    </td>
                                    <td style="white-space: pre-wrap;">
                                        <strong>Pembuka:</strong> <?= strip_tags($row->pembuka) ?><br>
                                        <strong>Isi:</strong> <?= strip_tags(word_limiter($row->isi_sambutan, 20)) ?><br>
                                        <strong>Penutup:</strong> <?= strip_tags($row->penutup) ?>
                                    </td>
                                    <td>
                                        <?= form_open(base_url("sambutan/delete/$row->id"), ['method' => 'POST']) ?>
                                        <?= form_hidden('id', $row->id) ?>
                                        <a href="<?= base_url("sambutan/edit/$row->id") ?>" class="btn btn-sm">
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