<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends MY_Model
{
    public function getDefaultValues()
    {
        return [
            'image'   => '',
            'nama'    => '',
            'jabatan' => '',
            'mapel'   => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [

            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'jabatan',
                'label' => 'Jabatan',
                'rules' => 'required|in_list[kepala sekolah,guru tetap,guru honorer]'
            ],
            [
                'field' => 'mapel',
                'label' => 'Mapel',
                'rules' => 'trim|required'
            ]
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'      => './images/guru',
            'file_name'        => $fileName,
            'allowed_types'    => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'         => 1024,
            'max_width'        => 0,
            'max_height'       => 0,
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
        if (file_exists("./images/guru/$fileName")) {
            unlink("./images/guru/$fileName");
        }
    }
}

/* End of file Guru_model.php */
