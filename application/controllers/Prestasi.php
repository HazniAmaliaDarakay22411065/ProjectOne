<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prestasi_model', 'prestasi');

        if (
            $this->router->fetch_method() !== 'akademik' &&
            $this->router->fetch_method() !== 'non_akademik'
        ) {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title']        = 'Admin: Data Prestasi';
        $data['content']      = $this->prestasi->paginate($page)->get();
        $data['total_rows']   = $this->prestasi->count();
        $data['pagination']   = $this->prestasi->makePagination(
            base_url('prestasi'),
            2,
            $data['total_rows']
        );
        $data['page']         = 'pages/prestasi/index';

        $this->view($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->prestasi->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($input->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->prestasi->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('prestasi/create'));
            }
        }

        if (!$this->prestasi->validate()) {
            $data['title']        = 'Tambah Prestasi';
            $data['input']        = $input;
            $data['form_action']  = base_url('prestasi/create');
            $data['page']         = 'pages/prestasi/form';

            $this->view($data);
            return;
        }

        if ($this->prestasi->create($input)) {
            $this->session->set_flashdata('success', 'Data prestasi berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('prestasi'));
    }

    public function edit($id)
    {
        $data['content'] = $this->prestasi->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data prestasi tidak ditemukan!');
            redirect(base_url('prestasi'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($data['input']->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->prestasi->uploadImage('image', $imageName);

            if ($upload) {
                if (!empty($data['content']->image)) {
                    $this->prestasi->deleteImage($data['content']->image);
                }
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("prestasi/edit/$id"));
            }
        }

        if (!$this->prestasi->validate()) {
            $data['title']        = 'Edit Prestasi';
            $data['input']        = $data['input'];
            $data['form_action']  = base_url("prestasi/edit/$id");
            $data['page']         = 'pages/prestasi/form';

            $this->view($data);
            return;
        }

        if ($this->prestasi->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data prestasi berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('prestasi'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('prestasi'));
        }

        $prestasi = $this->prestasi->where('id', $id)->first();

        if (!$prestasi) {
            $this->session->set_flashdata('warning', 'Data prestasi tidak ditemukan!');
            redirect(base_url('prestasi'));
        }

        if ($this->prestasi->where('id', $id)->delete()) {
            if (!empty($prestasi->image)) {
                $this->prestasi->deleteImage($prestasi->image);
            }

            $this->session->set_flashdata('success', 'Data prestasi berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('prestasi'));
    }


    public function akademik()
    {
        $this->load->helper('text');

        $data['title'] = 'Prestasi Akademik';
        $data['content'] = $this->prestasi
            ->where('kategori', 'akademik')
            ->orderBy('created_at', 'DESC')
            ->get();
        $data['page'] = 'pages/prestasi/kategori';

        $this->view($data);
    }

    public function non_akademik()
    {
        $this->load->helper('text');

        $data['title'] = 'Prestasi Non-Akademik';
        $data['content'] = $this->prestasi
            ->where('kategori', 'non_akademik')
            ->orderBy('created_at', 'DESC')
            ->get();
        $data['page'] = 'pages/prestasi/kategori';

        $this->view($data);
    }

    public function image_required()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_required', 'Foto prestasi wajib diunggah.');
            return false;
        }
        return true;
    }
}
