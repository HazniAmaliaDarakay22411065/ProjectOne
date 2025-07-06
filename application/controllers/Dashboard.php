<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Proteksi agar hanya admin login yang bisa akses
        if (
            !$this->session->userdata('is_login') ||
            $this->session->userdata('role') !== 'admin'
        ) {
            $this->session->set_flashdata('error', 'Silakan login sebagai admin terlebih dahulu.');
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['page'] = 'admin/dashboard'; // View konten admin
        $this->viewAdmin($data);
    }
}
