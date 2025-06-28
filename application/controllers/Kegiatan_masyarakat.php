<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_masyarakat extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kegiatan_masyarakat_model', 'kegmas');
        $this->load->model('Guru_model', 'guru');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
            }
        }
    }

    public function index($page = null)
    {
        $data['title']      = 'Admin: Kegiatan Masyarakat';
        $data['content']    = $this->kegmas->withGuru()->paginate($page)->get();
        $data['total_rows'] = $this->kegmas->count();
        $data['pagination'] = $this->kegmas->makePagination(
            base_url('kegiatan_masyarakat'),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/kegiatan_masyarakat/index';

        $this->viewAdmin($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('kegiatan_masyarakat'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']      = 'Admin: Kegiatan Masyarakat';
        $data['content']    = $this->kegmas
            ->withGuru()
            ->like('judul', $keyword)
            ->paginate($page)
            ->get();
        $data['total_rows'] = $this->kegmas->like('judul', $keyword)->count();
        $data['pagination'] = $this->kegmas->makePagination(
            base_url('kegiatan_masyarakat/search'),
            3,
            $data['total_rows']
        );
        $data['page']       = 'pages/kegiatan_masyarakat/index';

        $this->viewAdmin($data);
    }

    public function create()
    {
        $input = !$_POST
            ? (object) $this->kegmas->getDefaultValues()
            : (object) $this->input->post(null, true);

        $input->id_kegmas = $this->kegmas->generateIdKegmas();

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($input->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->kegmas->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('kegiatan_masyarakat/create'));
            }
        }

        if (!$this->kegmas->validate()) {
            $data['title']       = 'Tambah Kegiatan Masyarakat';
            $data['input']       = $input;
            $data['guru']        = $this->guru->get(); // untuk dropdown guru
            $data['form_action'] = base_url('kegiatan_masyarakat/create');
            $data['page']        = 'pages/kegiatan_masyarakat/form';
            return $this->viewAdmin($data);
        }

        if ($this->kegmas->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('kegiatan_masyarakat'));
    }

    public function edit($id)
    {
        $data['content'] = $this->kegmas->where('id_kegmas', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('kegiatan_masyarakat'));
        }

        $data['input'] = !$_POST
            ? $data['content']
            : (object) $this->input->post(null, true);

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($data['input']->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->kegmas->uploadImage('image', $imageName);

            if ($upload) {
                if (!empty($data['content']->image) && file_exists("./images/kegiatan_masyarakat/{$data['content']->image}")) {
                    unlink("./images/kegiatan_masyarakat/{$data['content']->image}");
                }
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("kegiatan_masyarakat/edit/$id"));
            }
        }

        if (!$this->kegmas->validate()) {
            $data['title']       = 'Edit Kegiatan Masyarakat';
            $data['input']       = $data['input'];
            $data['guru']        = $this->guru->get();
            $data['form_action'] = base_url("kegiatan_masyarakat/edit/$id");
            $data['page']        = 'pages/kegiatan_masyarakat/form';
            return $this->viewAdmin($data);
        }

        if ($this->kegmas->where('id_kegmas', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('kegiatan_masyarakat'));
    }

    public function delete($id)
    {
        if (!$_POST) redirect(base_url('kegiatan_masyarakat'));

        $kegmas = $this->kegmas->where('id_kegmas', $id)->first();
        if (!$kegmas) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('kegiatan_masyarakat'));
        }

        if ($this->kegmas->where('id_kegmas', $id)->delete()) {
            if (!empty($kegmas->image) && file_exists("./images/kegiatan_masyarakat/$kegmas->image")) {
                unlink("./images/kegiatan_masyarakat/$kegmas->image");
            }
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('kegiatan_masyarakat'));
    }

    public function show()
    {
        $data['title']   = 'Kegiatan Masyarakat Sekolah';
        $data['kegiatan'] = $this->kegmas->withGuru()->orderBy('id_kegmas', 'DESC')->get();
        $data['page']    = 'pages/kegiatan_masyarakat/show';

        $this->view($data);
    }

    public function image_required()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_required', 'Foto kegiatan wajib diunggah.');
            return false;
        }
        return true;
    }
}
