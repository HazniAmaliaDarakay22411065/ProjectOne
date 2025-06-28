<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengumuman_model', 'pengumuman');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title']        = 'Admin: Pengumuman';
        $data['content']      = $this->pengumuman->paginate($page)->get();
        $data['total_rows']   = $this->pengumuman->count();
        $data['pagination']   = $this->pengumuman->makePagination(
            base_url('pengumuman'),
            2,
            $data['total_rows']
        );
        $data['page']         = 'pages/pengumuman/index';

        $this->viewAdmin($data);
    }

    public function search($page = null)
    {
        $keyword = $this->input->post('keyword', true);
        $this->session->set_userdata('keyword_pengumuman', $keyword);

        $this->pengumuman->like('judul', $keyword)
            ->orLike('deskripsi', $keyword)
            ->orLike('detail', $keyword);

        $data['title']        = 'Admin: Pencarian Pengumuman';
        $data['content']      = $this->pengumuman->paginate($page)->get();
        $data['total_rows']   = $this->pengumuman->count();
        $data['pagination']   = $this->pengumuman->makePagination(
            base_url('pengumuman/search'),
            3,
            $data['total_rows']
        );
        $data['page']         = 'pages/pengumuman/index';

        $this->viewAdmin($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword_pengumuman');
        redirect(base_url('pengumuman'));
    }


    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->pengumuman->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($input->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->pengumuman->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('pengumuman/create'));
            }
        }

        if (!$this->pengumuman->validate()) {
            $data['title']        = 'Tambah Pengumuman';
            $data['input']        = $input;
            $data['form_action']  = base_url('pengumuman/create');
            $data['page']         = 'pages/pengumuman/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->pengumuman->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('pengumuman'));
    }

    // public function edit($id)
    // {
    //     $data['content'] = $this->pengumuman->where('id', $id)->first();

    //     if (!$data['content']) {
    //         $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
    //         redirect(base_url('pengumuman'));
    //     }

    //     if (!$_POST) {
    //         $data['input'] = $data['content'];
    //     } else {
    //         $data['input'] = (object) $this->input->post(null, true);
    //     }

    //     if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
    //         $imageName = url_title($data['input']->judul, '-', true) . '-' . date('YmdHis');
    //         $upload = $this->pengumuman->uploadImage('image', $imageName);

    //         if ($upload) {
    //             if (!empty($data['content']->image) && file_exists("./images/pengumuman/{$data['content']->image}")) {
    //                 unlink("./images/pengumuman/{$data['content']->image}");
    //             }
    //             $data['input']->image = $upload['file_name'];
    //         } else {
    //             redirect(base_url("pengumuman/edit/$id"));
    //         }
    //     }

    //     if (!$this->pengumuman->validate()) {
    //         $data['title']        = 'Edit Pengumuman';
    //         $data['form_action']  = base_url("pengumuman/edit/$id");
    //         $data['page']         = 'pages/pengumuman/form';

    //         $this->view($data);
    //         return;
    //     }

    //     if ($this->pengumuman->where('id', $id)->update($data['input'])) {
    //         $this->session->set_flashdata('success', 'Data berhasil diubah!');
    //     } else {
    //         $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
    //     }

    //     redirect(base_url('pengumuman'));
    // }
    public function edit($id)
    {
        $data['content'] = $this->pengumuman->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('pengumuman'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($data['input']->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->pengumuman->uploadImage('image', $imageName);

            if ($upload) {
                // Hapus gambar lama jika ada
                if (!empty($data['content']->image)) {
                    $this->pengumuman->deleteImage($data['content']->image);
                }

                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("pengumuman/edit/$id"));
            }
        } else {
            $data['input']->image = $data['content']->image; // Tetap gunakan gambar lama jika tidak upload baru
        }

        if (!$this->pengumuman->validate()) {
            $data['title'] = 'Edit Pengumuman';
            $data['form_action'] = base_url("pengumuman/edit/$id");
            $data['page'] = 'pages/pengumuman/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->pengumuman->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('pengumuman'));
    }

    // public function delete($id)
    // {
    //     if (!$_POST) {
    //         redirect(base_url('pengumuman'));
    //     }

    //     $pengumuman = $this->pengumuman->where('id', $id)->first();

    //     if (!$pengumuman) {
    //         $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
    //         redirect(base_url('pengumuman'));
    //     }

    //     if ($this->pengumuman->where('id', $id)->delete()) {
    //         if (!empty($pengumuman->image) && file_exists("./images/pengumuman/{$pengumuman->image}")) {
    //             unlink("./images/pengumuman/{$pengumuman->image}");
    //         }

    //         $this->session->set_flashdata('success', 'Data berhasil dihapus!');
    //     } else {
    //         $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
    //     }

    //     redirect(base_url('pengumuman'));


    // }


    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('pengumuman'));
        }

        $pengumuman = $this->pengumuman->where('id', $id)->first();

        if (!$pengumuman) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('pengumuman'));
        }

        if ($this->pengumuman->where('id', $id)->delete()) {
            if (!empty($pengumuman->image)) {
                $this->pengumuman->deleteImage($pengumuman->image);
            }
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('pengumuman'));
    }



    public function show()
    {
        $data['title']        = 'Pengumuman';
        $data['pengumuman']   = $this->pengumuman->orderBy('id', 'DESC')->get();
        $data['page']         = 'pages/pengumuman/show';

        $this->view($data);
    }

    public function detail($id)
    {
        $data['pengumuman'] = $this->pengumuman->where('id', $id)->first();

        if (!$data['pengumuman']) {
            $this->session->set_flashdata('warning', 'Pengumuman tidak ditemukan!');
            redirect(base_url('pengumuman/show'));
        }

        $data['title'] = $data['pengumuman']->judul;
        $data['page']  = 'pages/pengumuman/detail';

        $this->view($data);
    }

    public function image_required()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_required', 'Gambar pengumuman wajib diunggah.');
            return false;
        }
        return true;
    }
}
