<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model', 'kelas');
        $this->load->library('form_validation');

        if ($this->session->userdata('role') !== 'admin') {
            redirect(base_url('/'));
        }
    }

    public function index($page = null)
    {
        $data['title']        = 'Admin: Data Kelas';
        $data['content']      = $this->kelas->orderBy('id_kelas', 'ASC')->paginate($page)->get();
        $data['total_rows']   = $this->kelas->count();
        $data['pagination']   = $this->kelas->makePagination(
            base_url('kelas'),
            2,
            $data['total_rows']
        );
        $data['page']         = 'pages/kelas/index';

        $this->viewAdmin($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->kelas->getDefaultValues();
            $input->id_kelas = $this->kelas->generateIdKelas(); // ID otomatis
        } else {
            $input = (object) $this->input->post(null, true);
            $input->id_kelas = $this->kelas->generateIdKelas(); // Pastikan ID tidak kosong
        }

        if (!$this->kelas->validate()) {
            $data['title']        = 'Tambah Kelas';
            $data['input']        = $input;
            $data['form_action']  = base_url('kelas/create');
            $data['page']         = 'pages/kelas/form';
            $this->viewAdmin($data);
            return;
        }

        if ($this->kelas->create($input)) {
            $this->session->set_flashdata('success', 'Data kelas berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan saat menyimpan.');
        }

        redirect(base_url('kelas'));
    }

    public function edit($id)
    {
        $kelas = $this->kelas->where('id_kelas', $id)->first();

        if (!$kelas) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan.');
            redirect(base_url('kelas'));
        }

        if (!$_POST) {
            $input = $kelas;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->kelas->validate()) {
            $data['title']        = 'Edit Kelas';
            $data['input']        = $input;
            $data['form_action']  = base_url("kelas/edit/$id");
            $data['page']         = 'pages/kelas/form';
            $this->viewAdmin($data);
            return;
        }

        if ($this->kelas->update($id, $input)) {
            $this->session->set_flashdata('success', 'Data kelas berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan saat memperbarui.');
        }

        redirect(base_url('kelas'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('kelas'));
        }

        $kelas = $this->kelas->where('id_kelas', $id)->first();

        if (!$kelas) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('kelas'));
        }

        if ($this->kelas->delete($id)) {
            $this->session->set_flashdata('success', 'Data kelas berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }

        redirect(base_url('kelas'));
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword_kelas', $this->input->post('keyword'));
        }

        $keyword = $this->session->userdata('keyword_kelas');

        $data['title']      = 'Admin: Data Kelas';
        $data['content']    = $this->kelas
            ->like('id_kelas', $keyword)
            ->orLike('nama_kelas', $keyword)
            ->orderBy('id_kelas', 'ASC')
            ->paginate($page)
            ->get();

        $data['total_rows'] = $this->kelas
            ->like('id_kelas', $keyword)
            ->orLike('nama_kelas', $keyword)
            ->count();

        $data['pagination'] = $this->kelas->makePagination(
            base_url('kelas/search'),
            3,
            $data['total_rows']
        );

        $data['page'] = 'pages/kelas/index';
        $this->viewAdmin($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword_kelas');
        redirect(base_url('kelas'));
    }
}
