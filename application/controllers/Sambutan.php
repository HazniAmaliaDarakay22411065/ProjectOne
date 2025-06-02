<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sambutan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sambutan_model', 'sambutan');

        // Batasi akses ke semua method kecuali 'show' untuk publik
        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title']      = 'Admin: Sambutan Kepala Sekolah';
        $data['content']    = $this->sambutan->paginate($page)->get();
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
        $input = (!$_POST) ? (object) $this->sambutan->getDefaultValues() : (object) $this->input->post(null, true);

        if (!empty($_FILES['foto_kepsek']['name'])) {
            $imageName = url_title($input->nama_kepsek, '-', true) . '-' . date('YmdHis');
            $upload = $this->sambutan->uploadImage('foto_kepsek', $imageName);
            if ($upload) {
                $input->foto_kepsek = $upload['file_name'];
            } else {
                redirect(base_url('sambutan/create'));
            }
        }

        if (!$this->sambutan->validate()) {
            $data['title']       = 'Tambah Sambutan';
            $data['input']       = $input;
            $data['form_action'] = base_url('sambutan/create');
            $data['page']        = 'pages/sambutan/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->sambutan->create($input)) {
            $this->session->set_flashdata('success', 'Sambutan berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data.');
        }

        redirect(base_url('sambutan'));
    }

    public function edit($id)
    {
        $data['content'] = $this->sambutan->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('sambutan'));
        }

        $data['input'] = (!$_POST) ? $data['content'] : (object) $this->input->post(null, true);

        if (!empty($_FILES['foto_kepsek']['name'])) {
            $imageName = url_title($data['input']->nama_kepsek, '-', true) . '-' . date('YmdHis');
            $upload = $this->sambutan->uploadImage('foto_kepsek', $imageName);

            if ($upload) {
                if (!empty($data['content']->foto_kepsek) && file_exists("./images/kepsek/{$data['content']->foto_kepsek}")) {
                    unlink("./images/kepsek/{$data['content']->foto_kepsek}");
                }
                $data['input']->foto_kepsek = $upload['file_name'];
            } else {
                redirect(base_url("sambutan/edit/$id"));
            }
        }

        if (!$this->sambutan->validate()) {
            $data['title']       = 'Edit Sambutan';
            $data['form_action'] = base_url("sambutan/edit/$id");
            $data['page']        = 'pages/sambutan/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->sambutan->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Sambutan berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat update data.');
        }

        redirect(base_url('sambutan'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('sambutan'));
        }

        $sambutan = $this->sambutan->where('id', $id)->first();

        if (!$sambutan) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('sambutan'));
        }

        if ($this->sambutan->where('id', $id)->delete()) {
            if (!empty($sambutan->foto_kepsek) && file_exists("./images/kepsek/{$sambutan->foto_kepsek}")) {
                unlink("./images/kepsek/{$sambutan->foto_kepsek}");
            }
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus data.');
        }

        redirect(base_url('sambutan'));
    }

    public function show()
    {
        $data['title']    = 'Sambutan Kepala Sekolah';
        $data['sambutan'] = $this->sambutan->orderBy('id', 'DESC')->first();
        $data['page']     = 'pages/sambutan/show';

        $this->view($data);
    }

    public function image_required()
    {
        if (empty($_FILES['foto_kepsek']['name'])) {
            $this->form_validation->set_message('image_required', 'Foto kepala sekolah wajib diunggah.');
            return false;
        }
        return true;
    }
}
