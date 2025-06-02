<nav class="navbar navbar-expand-lg fixed-top bg-light text-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand text-dark" href="#">
            <img src="<?= base_url('/img/logo.png'); ?>" alt="Logo" class="navbar-brand-img d-inline-block align-text-middle" style="height: auto; width: 55px;">
            <span class="navbar-brand-text gradient-text" style="font-family: 'Rowdies', serif; font-size: 2rem; top: 6rem;">SMP NEGERI 11 JAYAPURA</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="font-family:'Kanit', serif;">
                <li class="nav-item">
                    <a class="nav-link text-dark" aria-current="page" href="<?= base_url('home') ?>">BERANDA</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        PROFIL
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownProfil">
                        <li><a class="dropdown-item text-dark" href="<?= base_url('visi_misi/show') ?>">Visi, Misi dan Tujuan Sekolah</a></li>
                        <li><a class="dropdown-item text-dark" href="<?= base_url('sejarah') ?>">Sejarah</a></li>
                        <li><a class="dropdown-item text-dark" href="<?= base_url('guru/show') ?>">Guru dan Staf</a></li>
                        <li><a class="dropdown-item text-dark" href="<?= base_url('fasilitas/show') ?>">Fasilitas</a></li>
                        <li><a class="dropdown-item text-dark" href="<?= base_url('kegiatan_masyarakat/show') ?>">Keg. Masyarakat</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        KESISWAAN
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownKesiswaan">
                        <li><a class="dropdown-item text-dark" href="<?= base_url('ekskul/show') ?>">Ekstrakurikuler</a></li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle text-dark" href="#">Prestasi</a> <!-- Hapus ikon dari sini -->
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-dark" href="<?= base_url('prestasi/akademik') ?>">Prestasi Akademik</a></li>
                                <li><a class="dropdown-item text-dark" href="<?= base_url('prestasi/non_akademik') ?>">Prestasi Non-Akademik</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        INFORMASI
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownInformasi">
                        <li><a class="dropdown-item text-dark" href="<?= base_url('pengumuman/show') ?>">Pengumuman</a></li>
                        <li><a class="dropdown-item text-dark" href="<?= base_url('agenda/show') ?>">Agenda</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link text-dark" href="<?= base_url('galeri/show') ?>">GALERI</a></li>
                <?php if (! $this->session->userdata('is_login')) : ?>
                    <!-- Menampilkan tombol login dan register jika belum login -->
                    <li class="nav-item"><button class="btn btn-dark" onclick="location.href='<?= base_url('/login'); ?>'">LOGIN</button></li>

                <?php else: ?>
                    <!-- Jika SUDAH LOGIN -->
                    <?php if ($this->session->userdata('role') == 'admin') : ?>
                        <li class="nav-item"><a class="nav-link text-dark" href="<?= base_url('dashboard'); ?>">ADMIN</a></li>
                        <!-- Logout Tampil Jika Login, untuk semua role -->
                    <?php elseif ($this->session->userdata('role') == 'users') : ?>
                        <li class="nav-item">
                            <button class="btn btn-outline-dark" onclick="location.href='<?= base_url('logout'); ?>'">LOGOUT</button>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>