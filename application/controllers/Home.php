<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Testimoni_model', 'testimoni');
        $this->load->model('Ekskul_model', 'ekskul');
        $this->load->model('Kegiatan_masyarakat_model', 'kegiatan');
        $this->load->model('Galeri_model', 'galeri');
        $this->load->model('Sambutan_model', 'sambutan');
    }

    public function index()
    {
        // Ambil testimoni yang sudah disetujui dan tampilkan carousel
        $data['testimoni'] = $this->testimoni
            ->where('is_approved', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        // Ambil maksimal 6 data ekskul untuk preview di home
        $data['ekskul_preview'] = $this->ekskul
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();

        $data['kegiatan_preview'] = $this->kegiatan
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();

        $data['galeri_preview'] = $this->galeri
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();

        // Ambil sambutan terbaru
        $sambutan = $this->sambutan->orderBy('id', 'DESC')->first();

        // Potong isi sambutan jika ada
        if (!empty($sambutan->isi_sambutan)) {
            $sambutan->isi_sambutan_ringkas = character_limiter(strip_tags($sambutan->isi_sambutan), 300, '...');
        }

        $data['sambutan'] = $sambutan;

        $data['title'] = 'Home';
        $data['page']  = 'pages/home/index';

        $this->view($data);
    }

    // public function submitTestimoni()
    // {
    //     if (!$this->session->userdata('id_user')) {
    //         $this->session->set_flashdata('error', 'Silakan login terlebih dahulu untuk mengirim testimoni.');
    //         redirect(base_url());
    //     }

    //     $input = (object) $this->input->post(null, true);
    //     $input->id_user = $this->session->userdata('id_user');

    //     if (!empty($_FILES['image']['name'])) {
    //         $imageName = url_title($input->nama, '-', true) . '-' . date('YmdHis');
    //         $upload = $this->testimoni->uploadImage('image', $imageName);
    //         if ($upload) {
    //             $input->image = $upload['file_name'];
    //         } else {
    //             redirect(base_url());
    //         }
    //     } else {
    //         $input->image = null;
    //     }

    //     if (!$this->testimoni->validate()) {
    //         $this->session->set_flashdata('error', validation_errors());
    //         redirect(base_url());
    //     }

    //     // Set default is_approved ke 0 (menunggu persetujuan admin)
    //     $input->is_approved = 0;

    //     if ($this->testimoni->create($input)) {
    //         $this->session->set_flashdata('success', 'Testimoni berhasil dikirim dan menunggu persetujuan.');
    //     } else {
    //         $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan saat mengirim testimoni.');
    //     }

    //     redirect(base_url());
    // }
}
