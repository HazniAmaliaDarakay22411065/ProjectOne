<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_masyarakat extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kegiatan_masyarakat_model', 'kegiatan');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title']        = 'Admin: Kegiatan Masyarakat';
        $data['content']      = $this->kegiatan->paginate($page)->get();
        $data['total_rows']   = $this->kegiatan->count();
        $data['pagination']   = $this->kegiatan->makePagination(
            base_url('kegiatan_masyarakat'),
            2,
            $data['total_rows']
        );
        $data['page']         = 'pages/kegiatan_masyarakat/index';

        $this->viewAdmin($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->kegiatan->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($input->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->kegiatan->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('kegiatan_masyarakat/create'));
            }
        }

        if (!$this->kegiatan->validate()) {
            $data['title']        = 'Tambah Kegiatan Masyarakat';
            $data['input']        = $input;
            $data['form_action']  = base_url('kegiatan_masyarakat/create');
            $data['page']         = 'pages/kegiatan_masyarakat/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->kegiatan->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('kegiatan_masyarakat'));
    }

    public function edit($id)
    {
        $data['content'] = $this->kegiatan->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('kegiatan_masyarakat'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($data['input']->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->kegiatan->uploadImage('image', $imageName);

            if ($upload) {
                if (!empty($data['content']->image) && file_exists("./images/kegiatan_masyarakat/{$data['content']->image}")) {
                    unlink("./images/kegiatan_masyarakat/{$data['content']->image}");
                }
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("kegiatan_masyarakat/edit/$id"));
            }
        }

        if (!$this->kegiatan->validate()) {
            $data['title']        = 'Edit Kegiatan Masyarakat';
            $data['form_action']  = base_url("kegiatan_masyarakat/edit/$id");
            $data['page']         = 'pages/kegiatan_masyarakat/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->kegiatan->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('kegiatan_masyarakat'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('kegiatan_masyarakat'));
        }

        $kegiatan = $this->kegiatan->where('id', $id)->first();

        if (!$kegiatan) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('kegiatan_masyarakat'));
        }

        if ($this->kegiatan->where('id', $id)->delete()) {
            if (!empty($kegiatan->image) && file_exists("./images/kegiatan_masyarakat/{$kegiatan->image}")) {
                unlink("./images/kegiatan_masyarakat/{$kegiatan->image}");
            }

            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('kegiatan_masyarakat'));
    }

    public function show()
    {
        $data['title']               = 'Kegiatan Masyarakat';
        $data['kegiatan_masyarakat'] = $this->kegiatan->orderBy('id', 'DESC')->get();
        $data['page']               = 'pages/kegiatan_masyarakat/show';

        $this->view($data);
    }

    public function image_required()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_required', 'Foto kegiatan masyarakat wajib diunggah.');
            return false;
        }
        return true;
    }
}
