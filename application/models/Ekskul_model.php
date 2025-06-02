<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ekskul_model extends MY_Model
{

    protected $table = 'ekskul';

    public function getDefaultValues()
    {
        return [
            'judul'             => '',
            'image'             => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field'    => 'judul',
                'label'    => 'judul',
                'rules'    => 'trim|required'
            ],


        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config    = [
            'upload_path'        => './images/ekskul', //tmpt penyimpanan up foto pada bag confirm pembayaran
            'file_name'            => $fileName,
            'allowed_types'        => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'            => 1024,
            'max_width'            => 0,
            'max_height'        => 0,
            'overwrite'            => true,
            'file_ext_tolower'    => true
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }
}
