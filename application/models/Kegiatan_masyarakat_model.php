<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_masyarakat_model extends MY_Model
{

    protected $table = 'kegiatan_masyarakat';

    public function getDefaultValues()
    {
        return [
            'judul'             => '',
            'image'             => '',
            'deskripsi'         => ''
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

            // [
            //     'field'    => 'image',
            //     'label'    => 'Foto kegiatan masyarakat',
            //     'rules'    => 'callback_image_required'
            // ],

            [
                'field'    => 'deskripsi',
                'label'    => 'deskripsi kegiatan masyarakat',
                'rules'    => 'trim|required'
            ],
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config    = [
            'upload_path'        => './images/kegiatan_masyarakat', //tmpt penyimpanan up foto pada bag confirm pembayaran
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
