<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil_sekolah extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profil_sekolah_model', 'profil');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title']      = 'Admin: Profil Sekolah';
        $data['contents']   = $this->profil->paginate($page)->get();
        $data['total_rows'] = $this->profil->count();
        $data['pagination'] = $this->profil->makePagination(
            base_url('profil_sekolah'),
            2,
            $data['total_rows']
        );
        $data['page'] = 'pages/profil_sekolah/index';

        $this->viewAdmin($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->profil->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->profil->validate()) {
            $data['title']       = 'Tambah Profil Sekolah';
            $data['input']       = $input;
            $data['form_action'] = base_url('profil_sekolah/create');
            $data['page']        = 'pages/profil_sekolah/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->profil->create($input)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
            redirect(base_url('profil_sekolah'));
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
            redirect(base_url('profil_sekolah/create'));
        }
    }

    public function edit($id = null)
    {
        if (!$id) {
            redirect(base_url('profil_sekolah'));
        }

        $data['content'] = $this->profil->where('id', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('profil_sekolah'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->profil->validate()) {
            $data['title']       = 'Edit Profil Sekolah';
            $data['form_action'] = base_url("profil_sekolah/edit/$id");
            $data['page']        = 'pages/profil_sekolah/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->profil->where('id', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
            redirect(base_url('profil_sekolah'));
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
            redirect(base_url("profil_sekolah/edit/$id"));
        }
    }

    public function delete($id = null)
    {
        if (!$id || !$_POST) {
            redirect(base_url('profil_sekolah'));
        }

        $profil = $this->profil->where('id', $id)->first();

        if (!$profil) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('profil_sekolah'));
        }

        if ($this->profil->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('profil_sekolah'));
    }

    public function show()
    {
        $data['title'] = 'Profil Sekolah';
        $data['profil'] = $this->profil->first(); // ambil 1 data profil sekolah

        $data['page'] = 'pages/profil_sekolah/show';
        $this->view($data);
    }
}
