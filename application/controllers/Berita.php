<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Berita_model', 'berita');

        $public_methods = ['show', 'detail'];

        if (!in_array($this->router->fetch_method(), $public_methods)) {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title'] = 'Berita';
        $data['berita'] = $this->berita->paginate($page)->orderBy('tanggal', 'DESC')->get();
        $data['total_rows'] = $this->berita->count();
        $data['pagination'] = $this->berita->makePagination(
            base_url('berita'),
            2,
            $data['total_rows']
        );
        $data['page'] = 'pages/berita/index';

        $this->viewAdmin($data);
    }

    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('berita'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title'] = 'Admin: Berita';
        $data['berita'] = $this->berita->like('judul', $keyword)->paginate($page)->get();
        $data['total_rows'] = $this->berita->like('judul', $keyword)->count();
        $data['pagination'] = $this->berita->makePagination(
            base_url('berita/search'),
            3,
            $data['total_rows']
        );
        $data['page'] = 'pages/berita/index';

        $this->viewAdmin($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('berita'));
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->berita->getDefaultValues();
            $input->id_berita = $this->berita->generateIdBerita();
        } else {
            $input = (object) $this->input->post(null, true);
            $input->is_published = $this->input->post('is_published', true); // Tambah ini
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($input->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->berita->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('berita/create'));
            }
        }

        if (!$this->berita->validate()) {
            $data['title'] = 'Tambah Berita';
            $data['input'] = $input;
            $data['form_action'] = base_url('berita/create');
            $data['page'] = 'pages/berita/form';

            $this->viewAdmin($data);
            return;
        }

        $input->tanggal = date('Y-m-d');

        if ($this->berita->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('berita'));
    }

    public function edit($id)
    {
        $data['content'] = $this->berita->where('id_berita', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('berita'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
            $data['input']->is_published = $this->input->post('is_published', true); // Tambah ini
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($data['input']->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->berita->uploadImage('image', $imageName);

            if ($upload) {
                if (!empty($data['content']->image)) {
                    $this->berita->deleteImage($data['content']->image);
                }
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("berita/edit/$id"));
            }
        } else {
            $data['input']->image = $data['content']->image;
        }

        if (!$this->berita->validate()) {
            $data['title'] = 'Edit Berita';
            $data['form_action'] = base_url("berita/edit/$id");
            $data['page'] = 'pages/berita/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->berita->where('id_berita', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('berita'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('berita'));
        }

        $berita = $this->berita->where('id_berita', $id)->first();

        if (!$berita) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('berita'));
        }

        if ($this->berita->where('id_berita', $id)->delete()) {
            if (!empty($berita->image)) {
                $this->berita->deleteImage($berita->image);
            }
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('berita'));
    }

    public function toggle($id)
    {
        $berita = $this->berita->where('id_berita', $id)->first();

        if (!$berita) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            return redirect(base_url('berita'));
        }

        $status = $berita->is_published ? 0 : 1;
        $this->berita->update($id, ['is_published' => $status]);

        $pesan = $status ? 'dipublish' : 'di-unpublish';
        $this->session->set_flashdata('success', "Berita berhasil $pesan.");
        redirect(base_url('berita'));
    }

    public function show()
    {
        $data['title'] = 'Berita';
        $data['berita'] = $this->berita->where('is_published', 1)->orderBy('tanggal', 'DESC')->get(); // hanya yang publish
        $data['page'] = 'pages/berita/show';
        $this->view($data);
    }

    public function detail($id)
    {
        $berita = $this->berita->where('id_berita', $id)->first();

        if (!$berita) {
            show_404();
        }

        $data['title']  = $berita->judul;
        $data['berita'] = $berita;
        $data['page']   = 'pages/berita/detail';

        $this->view($data);
    }

    public function image_required()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_required', 'Gambar berita wajib diunggah.');
            return false;
        }
        return true;
    }
}
