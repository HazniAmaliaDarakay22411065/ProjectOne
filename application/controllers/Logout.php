<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends MY_Controller
{
    //agar pada saat kita login, logout menghapus session login 
    //supaya bisa login lagi atau register apabila ingin karena nantinya pada saat login hanya bisa di halaman homepag jika sudah login 
    public function index()
    {
        $sess_data = [
            'id_user',
            'email',
            'name',
            'role',
            'is_login'
        ];

        $this->session->unset_userdata($sess_data);
        $this->session->sess_destroy(); // menghapus semua sesion
        redirect(base_url()); //kemablai ke halaman utama
    }
}

/* End of file Logout.php */