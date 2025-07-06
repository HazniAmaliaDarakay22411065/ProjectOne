<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'login');

        if ($this->session->userdata('is_login')) {
            redirect('dashboard');
            return;
        }
    }

    public function index()
    {
        if (!$_POST) {
            $input = (object) $this->login->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->form_validation->set_rules($this->login->getValidationRules())->run()) {
            $data['title'] = 'Login';
            $data['input'] = $input;
            $data['page'] = 'pages/auth/login';
            $this->view($data);
            return;
        }

        if ($this->login->run($input)) {
            $this->session->set_flashdata('success', 'Berhasil login!');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Email atau password salah atau tidak aktif!');
            redirect('login');
        }
    }
}
