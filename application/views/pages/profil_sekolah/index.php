<h1><?= $title ?></h1>

<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

<a href="<?= base_url('profil_sekolah/create') ?>" class="btn btn-primary mb-3">Tambah Profil Sekolah</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Sekolah</th>
            <th>NPSN</th>
            <th>Jenjang</th>
            <th>Status</th>
            <th>Akreditasi</th>
            <th>Tahun Berdiri</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($contents)) : ?>
            <tr>
                <td colspan="8" class="text-center">Data tidak ditemukan.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($contents as $key => $row) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= html_escape($row->nama_sekolah) ?></td>
                    <td><?= html_escape($row->npsn) ?></td>
                    <td><?= html_escape($row->jenjang) ?></td>
                    <td><?= html_escape($row->status) ?></td>
                    <td><?= html_escape($row->akreditasi) ?></td>
                    <td><?= html_escape($row->tahun_berdiri) ?></td>
                    <td>
                        <a href="<?= base_url("profil_sekolah/edit/{$row->id}") ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?= base_url("profil_sekolah/delete/{$row->id}") ?>" method="post" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </tbody>
</table>

<?= $pagination ?>