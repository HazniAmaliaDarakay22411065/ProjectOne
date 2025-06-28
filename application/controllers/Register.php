<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller
{

    public function __construct() //mengecek apakah user sudah login
    {
        parent::__construct();
        $is_login    = $this->session->userdata('is_login'); //memanggi session dgn is_login 

        if ($is_login) { //jika sudah login maka tidak boleh kembali ke halaman register
            redirect(base_url());
            return;
        }
    }


    public function index()
    {
        if (!$_POST) {
            $input    = (object) $this->register->getDefaultValues();
        } else {
            $input     = (object) $this->input->post(null, true);
        }

        if (!$this->register->validate()) {
            $data['title']    = 'Register';
            $data['input']    = $input;
            $data['page']    = 'pages/auth/register';
            $this->view($data);
            return; //pada saat sudah mengakses viiew maka akan berhenti
        }

        if ($this->register->run($input)) {
            $this->session->set_flashdata('success', 'Berhasil melakukan registrasi!');
            redirect(base_url('login')); //setelah register langsung ke login
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan!');
            redirect(base_url('register'));
        }
    }


    /**
     * Callback untuk validasi kekuatan password
     */
    public function validate_password_strength($password)
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $special   = preg_match('@[^\w]@', $password); // simbol

        if (!$uppercase || !$lowercase || !$number || !$special) {
            $this->form_validation->set_message(
                'validate_password_strength',
                'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.'
            );
            return false;
        }

        return true;
    }
}


/* End of file Register.php */