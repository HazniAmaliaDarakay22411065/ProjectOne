<!-- sidebar.php -->
<div class="sidebar bg-dark text-white position-fixed"
    style="top: 0; left: 0; height: 100vh; width: 250px; overflow-y: auto; z-index: 1030;">

    <!-- Logo & Nama Website -->
    <div class="p-3 border-bottom d-flex align-items-center">
        <img src="<?= base_url('img/logo.png') ?>" alt="Logo"
            style="width: 45px; height: 55px; object-fit: cover;" class="me-2">
        <span style="font-family: 'Rowdies', serif; font-weight: 700; font-size: 1.1rem;">
            SMP NEGERI 11 JAYAPURA
        </span>
    </div>

    <!-- Menu sidebar -->
    <div class="p-3">
        <a class="mb-3 text-white text-decoration-none d-block" href="<?= base_url('home') ?>">
            <i class="fas fa-home me-2"></i> Dashboard
        </a>
        <!-- Dropdown Beranda -->
        <div class="mb-3">
            <a class="text-white text-decoration-none d-block dropdown-toggle" href="#" id="dropdownBeranda" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-home me-2"></i> Beranda
            </a>
            <ul class="dropdown-menu bg-white shadow-sm border-0" aria-labelledby="dropdownBeranda">
                <li><a class="dropdown-item" href="<?= base_url('berita') ?>"><i class="fas fa-tachometer-alt me-2"></i> Halaman Utama</a></li>
                <li><a class="dropdown-item" href="<?= base_url('sambutan') ?>"><i class="fas fa-user-tie me-2"></i> Sambutan Guru</a></li>
            </ul>
        </div>


        <!-- Profil -->
        <div class="dropdown mb-3">
            <a class="text-white text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user me-2"></i> Profil
            </a>
            <ul class="dropdown-menu custom-bg border-0 shadow-sm mt-1">
                <li><a class="dropdown-item text-white" href="<?= base_url('profil') ?>"><i class="fas fa-id-card me-2"></i> Edit Profil</a></li>
                <li><a class="dropdown-item text-white" href="<?= base_url('guru') ?>"><i class="fas fa-chalkboard-teacher me-2"></i> Guru dan PPPK</a></li>
                <li><a class="dropdown-item text-white" href="<?= base_url('fasilitas') ?>"><i class="fas fa-school me-2"></i> Fasilitas</a></li>
                <li><a class="dropdown-item text-white" href="<?= base_url('kegiatan_masyarakat') ?>"><i class="fas fa-hands-helping me-2"></i> Keg. Masyarakat</a></li>
            </ul>
        </div>

        <!-- Kesiswaan -->
        <div class="dropdown mb-3">
            <a class="text-white text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-users me-2"></i> Kesiswaan
            </a>
            <ul class="dropdown-menu custom-bg border-0 shadow-sm mt-1">
                <li><a class="dropdown-item text-white" href="<?= base_url('siswa') ?>"><i class="fas fa-user-graduate me-2"></i> Siswa</a></li>
                <li><a class="dropdown-item text-white" href="<?= base_url('kelas') ?>"><i class="fas fa-chalkboard"></i> Kelas</a></li>
                <li><a class="dropdown-item text-white" href="<?= base_url('ekskul') ?>"><i class="fas fa-user-graduate me-2"></i> Ekstrakurikuler</a></li>
                <li><a class="dropdown-item text-white" href="<?= base_url('prestasi') ?>"><i class="fas fa-trophy me-2"></i> Prestasi</a></li>
            </ul>
        </div>

        <!-- Informasi -->
        <a class="mb-3 text-white text-decoration-none d-block" href="<?= base_url('berita') ?>">
            <i class="fas fa-info-circle me-2"></i> Berita
        </a>


        <!-- Lain-lain -->
        <a class="mb-3 text-white text-decoration-none d-block" href="<?= base_url('galeri') ?>"><i class="fas fa-image me-2"></i> Galeri</a>
        <a class="mb-3 text-white text-decoration-none d-block" href="<?= base_url('User'); ?>"><i class="fas fa-user-tie me-2"></i> Petugas</a>
    </div>
</div>