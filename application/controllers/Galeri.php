<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Galeri extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Galeri_model', 'galeri');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title']        = 'Admin: Galeri';
        $data['content']      = $this->galeri->paginate($page)->get();
        $data['total_rows']   = $this->galeri->count();
        $data['pagination']   = $this->galeri->makePagination(
            base_url('galeri'),
            2,
            $data['total_rows']
        );
        $data['page']         = 'pages/galeri/index';

        $this->viewAdmin($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('galeri'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']        = 'Admin: Galeri';
        $data['content']      = $this->galeri->like('judul', $keyword)->paginate($page)->get();
        $data['total_rows']   = $this->galeri->like('judul', $keyword)->count();
        $data['pagination']   = $this->galeri->makePagination(
            base_url('galeri/search'),
            3,
            $data['total_rows']
        );
        $data['page']         = 'pages/galeri/index';

        $this->viewAdmin($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('galeri'));
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->galeri->getDefaultValues();
            $input->id_galeri = $this->galeri->getKodeGaleri(); // ID otomatis
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($input->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->galeri->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('galeri/create'));
            }
        }

        if (!$this->galeri->validate()) {
            $data['title']        = 'Tambah Galeri';
            $data['input']        = $input;
            $data['form_action']  = base_url('galeri/create');
            $data['page']         = 'pages/galeri/form';

            $this->viewAdmin($data);
            return;
        }

        if (!isset($input->id_galeri) || empty($input->id_galeri)) {
            $input->id_galeri = $this->galeri->getKodeGaleri();
        }

        if ($this->galeri->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('galeri'));
    }

    public function edit($id)
    {
        $data['content'] = $this->galeri->where('id_galeri', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('galeri'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($data['input']->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->galeri->uploadImage('image', $imageName);

            if ($upload) {
                if (!empty($data['content']->image) && file_exists("./images/galeri/{$data['content']->image}")) {
                    unlink("./images/galeri/{$data['content']->image}");
                }
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("galeri/edit/$id"));
            }
        }

        if (!$this->galeri->validate()) {
            $data['title']        = 'Edit Galeri';
            $data['form_action']  = base_url("galeri/edit/$id");
            $data['page']         = 'pages/galeri/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->galeri->where('id_galeri', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('galeri'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('galeri'));
        }

        $galeri = $this->galeri->where('id_galeri', $id)->first();

        if (!$galeri) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('galeri'));
        }

        if ($this->galeri->where('id_galeri', $id)->delete()) {
            if (!empty($galeri->image) && file_exists("./images/galeri/{$galeri->image}")) {
                unlink("./images/galeri/{$galeri->image}");
            }

            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('galeri'));
    }

    public function show()
    {
        $data['title']   = 'Galeri Sekolah';
        $data['galeri']  = $this->galeri
            ->where('is_published', 1)
            ->orderBy('id_galeri', 'DESC')
            ->get();
        $data['page']    = 'pages/galeri/show';

        $this->view($data);
    }


    public function image_required()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_required', 'Foto Galeri wajib diunggah.');
            return false;
        }
        return true;
    }

    // publis
    public function toggle($id)
    {
        $galeri = $this->galeri->where('id_galeri', $id)->first();

        if (!$galeri) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            return redirect(base_url('galeri'));
        }

        $status = $galeri->is_published ? 0 : 1;
        $this->galeri->update($id, ['is_published' => $status]);

        $pesan = $status ? 'dipublish' : 'di-unpublish';
        $this->session->set_flashdata('success', "Galeri berhasil $pesan.");
        redirect(base_url('galeri'));
    }
}
