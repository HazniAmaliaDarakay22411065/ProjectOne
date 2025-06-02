<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
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
        $data['title']        = 'Admin: Data Guru';
        $data['content']      = $this->guru->paginate($page)->get();
        $data['total_rows']   = $this->guru->count();
        $data['pagination']   = $this->guru->makePagination(
            base_url('guru'),
            2,
            $data['total_rows']
        );
        $data['page']         = 'pages/guru/index';

        $this->viewAdmin($data);
    }

    public function search($page = null)
    {
        $keyword = $this->input->post('keyword', true);
        $this->session->set_userdata('keyword_guru', $keyword);

        $this->guru->like('nama', $keyword)
            ->orLike('jabatan', $keyword)
            ->orLike('mapel', $keyword);

        $data['title']        = 'Admin: Data Guru (Pencarian)';
        $data['content']      = $this->guru->paginate($page)->get();
        $data['total_rows']   = $this->guru->count();
        $data['pagination']   = $this->guru->makePagination(
            base_url('guru/search'),
            3,
            $data['total_rows']
        );
        $data['page']         = 'pages/guru/index';

        $this->viewAdmin($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword_guru');
        redirect(base_url('guru'));
    }


    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->guru->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($input->nama, '-', true) . '-' . date('YmdHis');
            $upload = $this->guru->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('guru/create'));
            }
        }

        if (!$this->guru->validate()) {
            $data['title']        = 'Tambah Guru';
            $data['input']        = $input;
            $data['form_action']  = base_url('guru/create');
            $data['page']         = 'pages/guru/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->guru->create($input)) {
            $this->session->set_flashdata('success', 'Data guru berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('guru'));
    }

    public function edit($id)
    {
        $data['content'] = $this->guru->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data guru tidak ditemukan!');
            redirect(base_url('guru'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($data['input']->nama, '-', true) . '-' . date('YmdHis');
            $upload = $this->guru->uploadImage('image', $imageName);

            if ($upload) {
                if (!empty($data['content']->image) && file_exists("./images/guru/{$data['content']->image}")) {
                    unlink("./images/guru/{$data['content']->image}");
                }
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("guru/edit/$id"));
            }
        }

        if (!$this->guru->validate()) {
            $data['title']        = 'Edit Data Guru';
            $data['form_action']  = base_url("guru/edit/$id");
            $data['page']         = 'pages/guru/form';
            $this->viewAdmin($data);
            return;
        }

        if ($this->guru->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data guru berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('guru'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('guru'));
        }

        $guru = $this->guru->where('id', $id)->first();

        if (!$guru) {
            $this->session->set_flashdata('warning', 'Data guru tidak ditemukan!');
            redirect(base_url('guru'));
        }

        if ($this->guru->where('id', $id)->delete()) {
            if (!empty($guru->image) && file_exists("./images/guru/{$guru->image}")) {
                unlink("./images/guru/{$guru->image}");
            }

            $this->session->set_flashdata('success', 'Data guru berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('guru'));
    }

    // this

    public function show()
    {
        $data['title'] = 'Data Guru';
        $data['kepala_sekolah'] = $this->guru->where('jabatan', 'kepala sekolah')->get();
        $data['guru_tetap']     = $this->guru->where('jabatan', 'guru tetap')->get();
        $data['guru_honorer']   = $this->guru->where('jabatan', 'guru honorer')->get();
        $data['page']  = 'pages/guru/show';

        $this->view($data);
    }

    public function image_required()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_required', 'Foto guru wajib diunggah.');
            return false;
        }
        return true;
    }
}
