<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sejarah extends MY_Controller
{
    public function index()
    {
        $data['title']        = 'Sejarah Sekolah';
        $data['page']        = 'pages/sejarah/index';
        $this->view($data);
    }
}
