<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profil_model', 'profil');

        // Batasi akses admin (kecuali halaman publik)
        $public_methods = ['show', 'visi_misi', 'sejarah', 'identitas'];
        if (!in_array($this->router->fetch_method(), $public_methods)) {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    // admin

    public function index()
    {
        $data['title']   = 'Admin: Profil Sekolah';
        $data['content'] = $this->profil->first();
        $data['page']    = 'pages/profil/index';

        $this->viewAdmin($data);
    }
    // admin
    public function edit()
    {
        $data['content'] = $this->profil->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data profil belum tersedia.');
            redirect(base_url('profil'));
        }

        $data['input']        = $data['content'];
        $data['form_action']  = base_url('profil/update');
        $data['title']        = 'Edit Profil Sekolah';
        $data['page']         = 'pages/profil/form';

        $this->viewAdmin($data);
    }

    public function update()
    {
        $input = (object) $this->input->post(null, true);

        if (!$this->profil->validate()) {
            $data['title']        = 'Edit Profil Sekolah';
            $data['form_action']  = base_url('profil/update');
            $data['input']        = $input;
            $data['page']         = 'pages/profil/form';

            $this->viewAdmin($data);
            return;
        }

        $profil = $this->profil->first();

        if ($this->profil->updateProfil($profil->id_sekolah, $input)) {
            $this->session->set_flashdata('success', 'Profil sekolah berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat update.');
        }

        redirect(base_url('profil'));
    }
    // publik
    public function show()
    {
        $data['title']  = 'Profil Sekolah';
        $data['profil'] = $this->profil->first();
        $data['page']   = 'pages/profil/show';

        $this->view($data);
    }

    public function visi_misi()
    {
        $data['title']  = 'Visi,Misi dan Tujuan Sekolah';
        $data['profil'] = $this->profil->first();
        $data['page']   = 'pages/profil/visi_misi';

        $this->view($data);
    }

    public function sejarah()
    {
        $data['title']  = 'Sejarah Sekolah';
        $data['profil'] = $this->profil->first();
        $data['page']   = 'pages/profil/sejarah';

        $this->view($data);
    }

    public function identitas()
    {
        $data['title']  = 'Identitas Sekolah';
        $data['profil'] = $this->profil->first();
        $data['page']   = 'pages/profil/identitas';

        $this->view($data);
    }
}
