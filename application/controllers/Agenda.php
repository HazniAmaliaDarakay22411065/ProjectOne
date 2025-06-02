<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Agenda_model', 'agenda');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title']      = 'Admin: Agenda';
        $data['content']    = $this->agenda->paginate($page)->get();
        $data['total_rows'] = $this->agenda->count();
        $data['pagination'] = $this->agenda->makePagination(
            base_url('agenda'),
            2,
            $data['total_rows']
        );
        $data['page']       = 'pages/agenda/index';

        $this->view($data);
    }

    public function search($page = null)
    {
        $keyword = $this->input->post('keyword', true);
        $this->session->set_userdata('keyword_agenda', $keyword);

        $this->agenda->like('judul', $keyword)
            ->orLike('deskripsi', $keyword);

        $data['title']      = 'Admin: Pencarian Agenda';
        $data['content']    = $this->agenda->paginate($page)->get();
        $data['total_rows'] = $this->agenda->count();
        $data['pagination'] = $this->agenda->makePagination(
            base_url('agenda/search'),
            3,
            $data['total_rows']
        );
        $data['page']       = 'pages/agenda/index';

        $this->view($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword_agenda');
        redirect(base_url('agenda'));
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->agenda->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($input->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->agenda->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('agenda/create'));
            }
        }

        if (!$this->agenda->validate()) {
            $data['title']       = 'Tambah Agenda';
            $data['input']       = $input;
            $data['form_action'] = base_url('agenda/create');
            $data['page']        = 'pages/agenda/form';

            $this->view($data);
            return;
        }

        if ($this->agenda->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('agenda'));
    }

    public function edit($id)
    {
        $data['content'] = $this->agenda->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('agenda'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
            $imageName = url_title($data['input']->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->agenda->uploadImage('image', $imageName);

            if ($upload) {
                if (!empty($data['content']->image)) {
                    $this->agenda->deleteImage($data['content']->image);
                }
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("agenda/edit/$id"));
            }
        } else {
            $data['input']->image = $data['content']->image;
        }

        if (!$this->agenda->validate()) {
            $data['title']       = 'Edit Agenda';
            $data['form_action'] = base_url("agenda/edit/$id");
            $data['page']        = 'pages/agenda/form';

            $this->view($data);
            return;
        }

        if ($this->agenda->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('agenda'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('agenda'));
        }

        $agenda = $this->agenda->where('id', $id)->first();

        if (!$agenda) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('agenda'));
        }

        if ($this->agenda->where('id', $id)->delete()) {
            if (!empty($agenda->image)) {
                $this->agenda->deleteImage($agenda->image);
            }
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('agenda'));
    }

    public function show()
    {
        $data['title']  = 'Agenda';
        $data['agenda'] = $this->agenda->orderBy('id', 'DESC')->get();
        $data['page']   = 'pages/agenda/show';

        $this->view($data);
    }

    public function detail($id)
    {
        $data['agenda'] = $this->agenda->where('id', $id)->first();

        if (!$data['agenda']) {
            $this->session->set_flashdata('warning', 'Agenda tidak ditemukan!');
            redirect(base_url('agenda/show'));
        }

        $data['title'] = $data['agenda']->judul;
        $data['page']  = 'pages/agenda/detail';

        $this->view($data);
    }

    public function image_required()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_required', 'Gambar agenda wajib diunggah.');
            return false;
        }
        return true;
    }
}
