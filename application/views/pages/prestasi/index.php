<main role="main" class="container" style="padding-top: 80px;">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php $this->load->view('layouts/_alert') ?>
            <div class="card mb-3 mt-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span>Prestasi</span>
                        <a href="<?= base_url('prestasi/create') ?>" class="btn btn-sm btn-primary ms-3">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                    <form action="<?= base_url('prestasi/search') ?>" method="POST" class="d-flex">
                        <div class="input-group input-group-sm">
                            <input type="text" name="keyword" class="form-control" placeholder="Cari judul / kategori"
                                value="<?= $this->session->userdata('keyword_prestasi') ?>">
                            <button class="btn btn-info" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="<?= base_url('prestasi/reset') ?>" class="btn btn-info btn-sm ms-1">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Dibuat</th> <!-- Kolom baru -->
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($content as $row) : $no++; ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->judul ?></td>
                                    <td><?= ucwords($row->kategori) ?></td>
                                    <td>
                                        <img src="<?= $row->image ? base_url("images/prestasi/$row->image") : base_url("images/default.png") ?>" alt="<?= $row->judul ?>" height="50">
                                    </td>
                                    <td>
                                        <?= $row->created_at ? date('d M Y H:i', strtotime($row->created_at)) : '-' ?>
                                    </td>
                                    <td>
                                        <?= form_open(base_url("prestasi/delete/$row->id"), ['method' => 'POST']) ?>
                                        <?= form_hidden('id', $row->id) ?>
                                        <a href="<?= base_url("prestasi/edit/$row->id") ?>" class="btn btn-sm">
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
                    <nav aria-label="Page navigation example">
                        <?= $pagination ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</main>