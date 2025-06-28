<div class="container d-flex justify-content-center align-items-center vh-100 pt-5" style="margin-top: 30px;">
    <div class="d-flex bg-white p-4 rounded-4 shadow" style="max-width: 700px; width: 100%;">

        <!-- Gambar -->
        <div class="d-none d-md-flex align-items-center justify-content-center pe-3">
            <img src="<?= base_url('/img/logo.png'); ?>" alt="Registration Image" style="width: 200px;">
        </div>

        <!-- Form -->
        <div class="flex-fill">
            <?php $this->load->view('layouts/_alert') ?>

            <h4 class="mb-3">Registrasi Akun</h4>

            <?= form_open('register', ['method' => 'POST', 'novalidate' => 'novalidate']) ?>

            <div class="mb-2">
                <label for="fullname" class="form-label">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <?= form_input('name', set_value('name', $input->name), [
                        'class' => 'form-control ' . (form_error('name') ? 'is-invalid' : ''),
                        'id' => 'fullname',
                        'placeholder' => 'Masukkan nama',
                        // 'required' => true
                    ]) ?>
                    <?php if (form_error('name')) : ?>
                        <div class="invalid-feedback"><?= form_error('name') ?></div>
                    <?php endif ?>
                </div>
            </div>

            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <?= form_input('email', set_value('email', $input->email), [
                        'type' => 'email',
                        'class' => 'form-control ' . (form_error('email') ? 'is-invalid' : ''),
                        'placeholder' => 'Masukkan email',
                        'required' => true
                    ]) ?>
                    <?php if (form_error('email')) : ?>
                        <div class="invalid-feedback"><?= form_error('email') ?></div>
                    <?php endif ?>
                </div>
            </div>

            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <?= form_password('password', '', [
                        'class' => 'form-control ' . (form_error('password') ? 'is-invalid' : ''),
                        'id' => 'password',
                        'placeholder' => 'Masukkan password',
                        'required' => true
                    ]) ?>
                    <?php if (form_error('password')) : ?>
                        <div class="invalid-feedback"><?= form_error('password') ?></div>
                    <?php endif ?>
                </div>
            </div>

            <div class="mb-2">
                <label for="repeat-password" class="form-label">Ulangi Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <?= form_password('password_confirmation', '', [
                        'class' => 'form-control ' . (form_error('password_confirmation') ? 'is-invalid' : ''),
                        'id' => 'repeat-password',
                        'placeholder' => 'Ulangi password',
                        'required' => true
                    ]) ?>
                    <?php if (form_error('password_confirmation')) : ?>
                        <div class="invalid-feedback"><?= form_error('password_confirmation') ?></div>
                    <?php endif ?>

                    <?php if ($this->session->flashdata('password_errors')) : ?>
                        <?php foreach ($this->session->flashdata('password_errors') as $err) : ?>
                            <div class="invalid-feedback d-block"><?= $err ?></div>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>



            <button type="submit" class="btn btn-primary rounded-pill w-100 mt-2">Registrasi</button>
            <div class="text-center mt-2">
                <a href="<?= base_url('login'); ?>">Sudah punya akun? Login di sini</a>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>