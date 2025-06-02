<main role="main" class="container" style="padding-top: 80px;">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <?php $this->load->view('layouts/_alert') ?>
            <div class="card mb-3 mt-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span>Visi, Misi & Tujuan</span>
                        <a href="<?= base_url('visi_misi/create') ?>" class="btn btn-sm btn-primary ms-3">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>
                    <form action="<?= base_url('visi_misi/search') ?>" method="POST" class="d-flex">
                        <div class="input-group input-group-sm">
                            <input type="text" name="keyword" class="form-control" placeholder="Cari kategori atau isi"
                                value="<?= $this->session->userdata('keyword_visi_misi') ?>">
                            <button class="btn btn-info" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="<?= base_url('visi_misi/reset') ?>" class="btn btn-info btn-sm ms-1">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Isi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($content as $row) : $no++; ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><strong><?= ucfirst($row->kategori) ?></strong></td>
                                    <td><?= nl2br(htmlspecialchars($row->isi)) ?></td>
                                    <td>
                                        <?= form_open(base_url("visi_misi/delete/$row->id"), ['method' => 'POST']) ?>
                                        <?= form_hidden('id', $row->id) ?>
                                        <a href="<?= base_url("visi_misi/edit/$row->id") ?>" class="btn btn-sm">
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