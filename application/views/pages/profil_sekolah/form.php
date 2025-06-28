<h1><?= $title ?></h1>

<?php
echo validation_errors('<div class="alert alert-danger">', '</div>');
?>

<form action="<?= $form_action ?>" method="post">
    <div class="form-group mb-3">
        <label for="nama_sekolah">Nama Sekolah</label>
        <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" value="<?= set_value('nama_sekolah', $input->nama_sekolah) ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="npsn">NPSN</label>
        <input type="number" name="npsn" id="npsn" class="form-control" value="<?= set_value('npsn', $input->npsn) ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="jenjang">Jenjang</label>
        <input type="text" name="jenjang" id="jenjang" class="form-control" value="<?= set_value('jenjang', $input->jenjang) ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="status">Status</label>
        <input type="text" name="status" id="status" class="form-control" value="<?= set_value('status', $input->status) ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="akreditasi">Akreditasi</label>
        <input type="text" name="akreditasi" id="akreditasi" class="form-control" value="<?= set_value('akreditasi', $input->akreditasi) ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="tahun_berdiri">Tahun Berdiri</label>
        <input type="number" name="tahun_berdiri" id="tahun_berdiri" class="form-control" value="<?= set_value('tahun_berdiri', $input->tahun_berdiri) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('profil_sekolah') ?>" class="btn btn-secondary">Batal</a>
</form>