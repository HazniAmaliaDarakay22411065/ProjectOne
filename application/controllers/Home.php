<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ekskul_model', 'ekskul');
        $this->load->model('Kegiatan_masyarakat_model', 'kegiatan');
        $this->load->model('Galeri_model', 'galeri');
        $this->load->model('Sambutan_model', 'sambutan');
        $this->load->model('Guru_model', 'guru');
    }

    public function index()
    {

        // Ambil maksimal 6 data ekskul untuk preview di home
        $data['ekskul_preview'] = $this->ekskul->get_preview(4);

        $data['kegiatan_preview'] = $this->kegiatan
            ->withGuru()
            ->where('kegiatan_masyarakat.is_published', 1)
            ->orderBy('kegiatan_masyarakat.id_kegmas', 'DESC')
            ->limit(4)
            ->get();


        $data['galeri_preview'] = $this->galeri
            ->where('is_published', 1)
            ->orderBy('id_galeri', 'DESC')
            ->limit(4)
            ->get();

        // Ambil sambutan terbaru
        // Ambil sambutan terbaru yang sudah dipublish
        $sambutan = $this->sambutan
            ->with('data_guru')
            ->where('sambutan.is_published', 1)
            ->orderBy('sambutan.id_sambutan', 'DESC')
            ->first();


        // Potong isi sambutan jika ada
        if (!empty($sambutan->isi_sambutan)) {
            $sambutan->isi_sambutan_ringkas = character_limiter(strip_tags($sambutan->isi_sambutan), 300, '...');
        }

        $data['sambutan'] = $sambutan;
        $data['title']    = 'Home';
        $data['page']     = 'pages/home/index';

        $this->view($data);
    }
}
