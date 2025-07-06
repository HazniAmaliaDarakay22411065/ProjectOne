<div class="container-fluid">
    <h3>Hai, Selamat Datang <?= $this->session->userdata('name') ?>!</h3>


    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Profil Sekolah</h5>
                    <p class="card-text">Lihat atau ubah data profil sekolah.</p>
                    <a href="<?= site_url('admin/profil') ?>" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Data Guru</h5>
                    <p class="card-text">Kelola data guru dan jabatan mereka.</p>
                    <a href="<?= site_url('admin/guru') ?>" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Galeri</h5>
                    <p class="card-text">Tambah dan atur galeri sekolah.</p>
                    <a href="<?= site_url('admin/galeri') ?>" class="btn btn-primary">Kelola</a>
                </div>
            </div>
        </div>
    </div>
</div>