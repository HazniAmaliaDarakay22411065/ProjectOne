<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ekskul extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ekskul_model', 'ekskul');
        $this->load->model('Guru_model', 'guru'); // 🟢 DITAMBAHKAN: Load model guru

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
            }
        }
    }

    public function index($page = null)
    {
        $data['title']      = 'Admin: Ekskul';
        $data['content']    = $this->ekskul->withGuru()->paginate($page)->get(); // 🟢 DITAMBAHKAN: relasi guru
        $data['total_rows'] = $this->ekskul->count();
        $data['pagination'] = $this->ekskul->makePagination(
            base_url('ekskul'),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/ekskul/index';

        $this->viewAdmin($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('ekskul'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']      = 'Admin: Ekskul';
        $data['content']    = $this->ekskul
            ->withGuru() // 🟢 DITAMBAHKAN: relasi guru saat pencarian
            ->like('nama', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->ekskul->like('nama', $keyword)->count();
        $data['pagination'] = $this->ekskul->makePagination(
            base_url('ekskul/search'),
            3,
            $data['total_rows']
        );
        $data['page']       = 'pages/ekskul/index';

        $this->viewAdmin($data);
    }

    public function create()
    {
        $input = !$_POST
            ? (object) $this->ekskul->getDefaultValues()
            : (object) $this->input->post(null, true);

        $input->id_ekskul = $this->ekskul->generateIdEkskul();

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($input->nama, '-', true) . '-' . date('YmdHis');
            $upload = $this->ekskul->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('ekskul/create'));
            }
        }

        if (!$this->ekskul->validate()) {
            $data['title']       = 'Tambah Ekskul';
            $data['input']       = $input;
            $data['guru']        = $this->guru->get(); // 🟢 DITAMBAHKAN: dropdown guru untuk form
            $data['form_action'] = base_url('ekskul/create');
            $data['page']        = 'pages/ekskul/form';
            return $this->viewAdmin($data);
        }

        if ($this->ekskul->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('ekskul'));
    }

    public function edit($id)
    {
        $data['content'] = $this->ekskul->where('id_ekskul', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('ekskul'));
        }

        $data['input'] = !$_POST
            ? $data['content']
            : (object) $this->input->post(null, true);

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($data['input']->nama, '-', true) . '-' . date('YmdHis');
            $upload = $this->ekskul->uploadImage('image', $imageName);

            if ($upload) {
                if (!empty($data['content']->image) && file_exists("./images/ekskul/{$data['content']->image}")) {
                    unlink("./images/ekskul/{$data['content']->image}");
                }
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("ekskul/edit/$id"));
            }
        }

        if (!$this->ekskul->validate()) {
            $data['title']       = 'Edit Ekskul';
            $data['input']       = $data['input'];
            $data['guru']        = $this->guru->get(); // 🟢 DITAMBAHKAN: dropdown guru saat edit
            $data['form_action'] = base_url("ekskul/edit/$id");
            $data['page']        = 'pages/ekskul/form';
            return $this->viewAdmin($data);
        }

        if ($this->ekskul->where('id_ekskul', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('ekskul'));
    }

    public function delete($id)
    {
        if (!$_POST) redirect(base_url('ekskul'));

        $ekskul = $this->ekskul->where('id_ekskul', $id)->first();
        if (!$ekskul) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('ekskul'));
        }

        if ($this->ekskul->where('id_ekskul', $id)->delete()) {
            if (!empty($ekskul->image) && file_exists("./images/ekskul/$ekskul->image")) {
                unlink("./images/ekskul/$ekskul->image");
            }
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('ekskul'));
    }

    public function show()
    {
        $data['title']   = 'Ekstrakurikuler Sekolah';
        $data['ekskul']  = $this->ekskul->withGuru()->orderBy('id_ekskul', 'DESC')->get(); // 🟢 DITAMBAHKAN: relasi guru di halaman publik
        $data['page']    = 'pages/ekskul/show';

        $this->view($data);
    }

    public function image_required()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_required', 'Foto Ekskul wajib diunggah.');
            return false;
        }
        return true;
    }
}
