<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sambutan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sambutan_model', 'sambutan');
        $this->load->model('Guru_model', 'guru');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title']      = 'Admin: Sambutan Guru';
        $data['content']    = $this->sambutan->with('data_guru')->paginate($page)->get();
        $data['total_rows'] = $this->sambutan->count();
        $data['pagination'] = $this->sambutan->makePagination(
            base_url('sambutan'),
            2,
            $data['total_rows']
        );
        $data['page'] = 'pages/sambutan/index';
        $this->viewAdmin($data);
    }


    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->sambutan->getDefaultValues();
            $input->id_sambutan = $this->sambutan->getIdSambutan(); // Tambahkan ID otomatis
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->sambutan->validate()) {
            $data['title']       = 'Tambah Sambutan';
            $data['input']       = $input;
            $data['form_action'] = base_url('sambutan/create');
            $data['guru']        = $this->guru->get();
            $data['page']        = 'pages/sambutan/form';
            return $this->viewAdmin($data);
        }

        if ($this->sambutan->create($input)) {
            $this->session->set_flashdata('success', 'Sambutan berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data.');
        }

        redirect(base_url('sambutan'));
    }

    public function toggle($id_sambutan)
    {
        $sambutan = $this->sambutan->where('id_sambutan', $id_sambutan)->first();
        if (!$sambutan) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('sambutan'));
        }

        $newStatus = $sambutan->is_published ? 0 : 1;
        if ($newStatus == 1) {
            $this->sambutan->reset_publish();
        }

        if ($this->sambutan->update($id_sambutan, ['is_published' => $newStatus])) {
            $message = $newStatus ? 'Sambutan berhasil dipublish!' : 'Sambutan berhasil di-unpublish!';
            $this->session->set_flashdata('success', $message);
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengubah status.');
        }

        redirect(base_url('sambutan'));
    }

    public function edit($id_sambutan)
    {
        $data['content'] = $this->sambutan->where('id_sambutan', $id_sambutan)->first();
        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('sambutan'));
        }

        $data['input'] = (!$_POST) ? $data['content'] : (object) $this->input->post(null, true);

        if (!$this->sambutan->validate()) {
            $data['title']       = 'Edit Sambutan';
            $data['form_action'] = base_url("sambutan/edit/$id_sambutan");
            $data['guru']        = $this->guru->get();
            $data['page']        = 'pages/sambutan/form';
            return $this->viewAdmin($data);
        }

        $data['input']->is_published = isset($data['input']->is_published) && $data['input']->is_published == '1' ? 1 : 0;
        if ($data['input']->is_published == 1) {
            $this->sambutan->reset_publish();
        }

        if ($this->sambutan->where('id_sambutan', $id_sambutan)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Sambutan berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat update data.');
        }

        redirect(base_url('sambutan'));
    }

    public function delete($id_sambutan)
    {
        if (!$_POST) redirect(base_url('sambutan'));

        $sambutan = $this->sambutan->where('id_sambutan', $id_sambutan)->first();
        if (!$sambutan) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('sambutan'));
        }

        if ($this->sambutan->where('id_sambutan', $id_sambutan)->delete()) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus data.');
        }

        redirect(base_url('sambutan'));
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword_sambutan', $this->input->post('keyword'));
        } else {
            redirect(base_url('sambutan'));
        }

        $keyword = $this->session->userdata('keyword_sambutan');

        // Perbaiki JOIN
        $this->sambutan->join('data_guru', 'data_guru.id_guru = sambutan.id_guru');

        $data['title'] = 'Admin: Sambutan Guru (Hasil Pencarian)';
        $data['content'] = $this->sambutan
            ->like('data_guru.nip', $keyword)
            ->orLike('data_guru.nama', $keyword)
            ->paginate($page)
            ->get();

        $data['total_rows'] = $this->sambutan
            ->like('data_guru.nip', $keyword)
            ->orLike('data_guru.nama', $keyword)
            ->count();

        $data['pagination'] = $this->sambutan->makePagination(
            base_url('sambutan/search'),
            3,
            $data['total_rows']
        );

        $data['page'] = 'pages/sambutan/index';
        $this->viewAdmin($data);
    }


    public function reset()
    {
        $this->session->unset_userdata('keyword_sambutan');
        redirect(base_url('sambutan'));
    }

    public function show()
    {
        $data['title'] = 'Sambutan Guru';
        $data['sambutan'] = $this->sambutan
            ->with('data_guru')
            ->where('sambutan.is_published', 1)
            ->orderBy('sambutan.id_sambutan', 'DESC')
            ->first();

        $data['page'] = 'pages/sambutan/show';
        $this->view($data);
    }
}
