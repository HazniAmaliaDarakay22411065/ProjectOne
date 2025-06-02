<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['page'] = 'admin/dashboard'; // View konten admin
        $this->viewAdmin($data);
    }
}
