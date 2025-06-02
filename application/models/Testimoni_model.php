<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimoni_model extends MY_Model
{
    protected $table = 'testimoni';

    public function getDefaultValues()
    {
        return [
            'nama'       => '',
            'image'      => '',
            'deskripsi'  => '',
            'caption'    => '',
            'id_user'    => null,
            'is_approved' => 0,
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'deskripsi',
                'label' => 'Testimoni',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'caption',
                'label' => 'Caption',
                'rules' => 'trim' // boleh kosong
            ]
        ];
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'      => './images/testimoni',
            'file_name'        => $fileName,
            'allowed_types'    => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'         => 1024,
            'overwrite'        => true,
            'file_ext_tolower' => true
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }

    public function deleteImage($fileName)
    {
        if (file_exists("./images/testimoni/$fileName")) {
            unlink("./images/testimoni/$fileName");
        }
    }
}
