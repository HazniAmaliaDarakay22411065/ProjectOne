<!-- Breadcrumb Full Width & Menarik -->
<div class="w-100 position-relative" style="top: 0; left: 0; background: #ffffff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 1000; font-family: 'Kanit', sans-serif;">
    <div class="d-flex align-items-center px-3 py-2 flex-wrap">
        <nav aria-label="breadcrumb" class="flex-grow-1">
            <ol class="breadcrumb mb-0">
                <!-- Link ke Dashboard -->
                <li class="breadcrumb-item">
                    <a href="<?= base_url('dashboard') ?>" class="text-dark d-flex align-items-center">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </a>
                </li>

                <!-- Jika ada segment ke-2, tampilkan -->
                <?php if ($this->uri->segment(2)) : ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-angle-right me-1"></i> <?= ucwords(str_replace('_', ' ', $this->uri->segment(2))) ?>
                    </li>
                <?php else : ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-angle-right me-1"></i> <?= isset($title) ? $title : 'Dashboard' ?>
                    </li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</div>

<main role="main" class="container my-4">
    <?php $this->load->view('layouts/_alert') ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-light shadow-lg rounded-4">
                <div class="card-header bg-white text-dark text-center rounded-top-4 border-bottom fw-bold">
                    <?= $title ?>
                </div>
                <div class="card-body">
                    <form action="<?= $form_action ?>" method="POST">

                        <!-- Nama -->
                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" value="<?= set_value('name', $input->name) ?>" class="form-control" required>
                            <?= form_error('name') ?>
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="<?= set_value('email', $input->email) ?>" class="form-control" required>
                            <?= form_error('email') ?>
                        </div>
                        <!-- pass -->
                        <div class="mb-3">
                            <label for="password">Kata Sandi</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()" tabindex="-1">
                                    <i class="fas fa-eye" id="icon-eye"></i>
                                </button>
                            </div>
                            <?= form_error('password') ?>
                        </div>



                        <!-- Role (readonly admin) -->
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" readonly>
                                <option value="admin" <?= $input->role == 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                            <?= form_error('role') ?>
                        </div>

                        <!-- Status Aktif -->
                        <div class="form-group mb-4">
                            <label for="is_active">Status</label>
                            <select name="is_active" class="form-control" required>
                                <option value="1" <?= $input->is_active == 1 ? 'selected' : '' ?>>Aktif</option>
                                <option value="0" <?= $input->is_active == 0 ? 'selected' : '' ?>>Tidak Aktif</option>
                            </select>
                            <?= form_error('is_active') ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const iconEye = document.getElementById("icon-eye");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                iconEye.classList.remove("fa-eye");
                iconEye.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                iconEye.classList.remove("fa-eye-slash");
                iconEye.classList.add("fa-eye");
            }
        }
    </script>
</main>