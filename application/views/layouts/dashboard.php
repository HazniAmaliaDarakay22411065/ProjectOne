<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Dashboard' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="p-3 text-white" style="width: 250px; height: 100vh; background-color: #0d6efd;">
            <h4 class="text-center">Dashboard</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="<?= base_url('dashboard'); ?>" class="nav-link text-white"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('dashboard/galeri'); ?>" class="nav-link text-white"><i class="fas fa-images"></i> Galeri</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('dashboard/kegiatan'); ?>" class="nav-link text-white"><i class="fas fa-users"></i> Kegiatan</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('dashboard/fasilitas'); ?>" class="nav-link text-white"><i class="fas fa-building"></i> Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('logout'); ?>" class="nav-link text-white"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg bg-white shadow border-bottom">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url('/img/logo.png'); ?>" alt="Logo SMP" width="60" height="70" class="me-2">
                        <span class="navbar-brand mb-0 h5">SMP Negeri 11 Jayapura</span>
                    </div>
                    <div class="ms-auto">
                        <img src="foto_profile.jpg" alt="Profile" width="40" height="40" class="rounded-circle">
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="p-4">
                <?php $this->load->view($page); ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>