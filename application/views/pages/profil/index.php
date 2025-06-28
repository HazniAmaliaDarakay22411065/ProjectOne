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
<div class="container mt-4">
    <div class="card bg-white shadow-lg border-0 rounded-4">
        <div class="card-header bg-light text-dark fw-bold d-flex justify-content-between align-items-center rounded-top-4">
            <h4 class="mb-0 fw-bold">Profil Sekolah</h4>
            <a href="<?= base_url('profil/edit') ?>" class="btn btn-sm btn-primary fw-bold">Edit Profil</a>
        </div>
        <div class="card-body rounded-bottom-4">
            <div class="table-responsive">
                <table class="table table-bordered align-middle shadow-sm rounded-3 overflow-hidden">
                    <tbody>
                        <tr class="bg-white">
                            <th class="fw-bold text-dark">Nama Sekolah</th>
                            <td class="text-dark"><?= $content->nama_sekolah ?></td>
                        </tr>
                        <tr class="bg-light">
                            <th class="fw-bold text-dark">NPSN</th>
                            <td class="text-dark"><?= $content->npsn ?></td>
                        </tr>
                        <tr class="bg-white">
                            <th class="fw-bold text-dark">Jenjang</th>
                            <td class="text-dark"><?= $content->jenjang ?></td>
                        </tr>
                        <tr class="bg-light">
                            <th class="fw-bold text-dark">Status</th>
                            <td class="text-dark"><?= $content->status ?></td>
                        </tr>
                        <tr class="bg-white">
                            <th class="fw-bold text-dark">Akreditasi</th>
                            <td class="text-dark"><?= $content->akreditasi ?></td>
                        </tr>
                        <tr class="bg-light">
                            <th class="fw-bold text-dark">Tahun Berdiri</th>
                            <td class="text-dark"><?= $content->tahun_berdiri ?></td>
                        </tr>
                        <tr class="bg-white">
                            <th class="fw-bold text-dark">Visi</th>
                            <td class="text-dark"><?= nl2br($content->visi) ?></td>
                        </tr>
                        <tr class="bg-light">
                            <th class="fw-bold text-dark">Misi</th>
                            <td class="text-dark"><?= nl2br($content->misi) ?></td>
                        </tr>
                        <tr class="bg-white">
                            <th class="fw-bold text-dark">Tujuan</th>
                            <td class="text-dark"><?= nl2br($content->tujuan) ?></td>
                        </tr>
                        <tr class="bg-light">
                            <th class="fw-bold text-dark">Sejarah</th>
                            <td class="text-dark"><?= nl2br($content->sejarah) ?></td>
                        </tr>
                        <tr class="bg-white">
                            <th class="fw-bold text-dark">Alamat</th>
                            <td class="text-dark"><?= $content->alamat ?></td>
                        </tr>
                        <tr class="bg-light">
                            <th class="fw-bold text-dark">Telepon</th>
                            <td class="text-dark"><?= $content->telephone ?></td>
                        </tr>
                        <tr class="bg-white">
                            <th class="fw-bold text-dark">Email</th>
                            <td class="text-dark"><?= $content->email ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>