<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fasilitas extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fasilitas_model', 'fasilitas');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title']        = 'Admin: Fasilitas';
        $data['content']      = $this->fasilitas->paginate($page)->get();
        $data['total_rows']   = $this->fasilitas->count();
        $data['pagination']   = $this->fasilitas->makePagination(
            base_url('fasilitas'),
            2,
            $data['total_rows']
        );
        $data['page']         = 'pages/fasilitas/index';

        $this->viewAdmin($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('fasilitas'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']        = 'Admin: Fasilitas';
        $data['content']      = $this->fasilitas
            ->like('judul', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows']   = $this->fasilitas->like('judul', $keyword)->count();
        $data['pagination']   = $this->fasilitas->makePagination(
            base_url('fasilitas/search'),
            3,
            $data['total_rows']
        );
        $data['page']         = 'pages/fasilitas/index';

        $this->viewAdmin($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('fasilitas'));
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->fasilitas->getDefaultValues();
            $input->id_fasilitas = $this->fasilitas->generateId(); // 💡 tambahkan ini
        } else {
            $input = (object) $this->input->post(null, true);
        }

        // upload image
        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($input->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->fasilitas->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('fasilitas/create'));
            }
        }

        if (!$this->fasilitas->validate()) {
            $data['title']        = 'Tambah Fasilitas';
            $data['input']        = $input;
            $data['form_action']  = base_url('fasilitas/create');
            $data['page']         = 'pages/fasilitas/form';

            $this->viewAdmin($data);
            return;
        }

        // pastikan ID tidak kosong saat simpan
        if (!isset($input->id_fasilitas) || empty($input->id_fasilitas)) {
            $input->id_fasilitas = $this->fasilitas->generateId();
        }

        if ($this->fasilitas->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('fasilitas'));
    }


    public function edit($id)
    {
        $data['content'] = $this->fasilitas->where('id_fasilitas', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('fasilitas'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($data['input']->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->fasilitas->uploadImage('image', $imageName);

            if ($upload) {
                if (!empty($data['content']->image) && file_exists("./images/fasilitas/{$data['content']->image}")) {
                    unlink("./images/fasilitas/{$data['content']->image}");
                }
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("fasilitas/edit/$id"));
            }
        }

        if (!$this->fasilitas->validate()) {
            $data['title']        = 'Edit Fasilitas';
            $data['form_action']  = base_url("fasilitas/edit/$id");
            $data['page']         = 'pages/fasilitas/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->fasilitas->where('id_fasilitas', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('fasilitas'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('fasilitas'));
        }

        $fasilitas = $this->fasilitas->where('id_fasilitas', $id)->first();

        if (!$fasilitas) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('fasilitas'));
        }

        if ($this->fasilitas->where('id_fasilitas', $id)->delete()) {
            if (!empty($fasilitas->image) && file_exists("./images/fasilitas/$fasilitas->image")) {
                unlink("./images/fasilitas/$fasilitas->image");
            }

            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('fasilitas'));
    }

    public function show()
    {
        $data['title']     = 'Fasilitas Sekolah';
        $data['fasilitas'] = $this->fasilitas->orderBy('id_fasilitas', 'DESC')->get();
        $data['page']      = 'pages/fasilitas/show';

        $this->view($data);
    }

    public function image_required()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_required', 'Foto Fasilitas wajib diunggah.');
            return false;
        }
        return true;
    }
}
