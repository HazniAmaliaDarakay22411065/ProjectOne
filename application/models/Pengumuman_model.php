<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman_model extends MY_Model
{
    public function getDefaultValues()
    {
        return [
            'judul'      => '',
            'image'      => '',
            'deskripsi'  => '',
            'detail'     => ''
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'judul',
                'label' => 'Judul Pengumuman',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'deskripsi',
                'label' => 'Deskripsi',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'detail',
                'label' => 'Detail',
                'rules' => 'trim|required'
            ]
        ];
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'      => './images/pengumuman',
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

    public function get_by_id($id)
    {
        return $this->db->get_where('pengumuman', ['id' => $id])->row_array();
    }

    public function deleteImage($fileName)
    {
        if (file_exists("./images/pengumuman/$fileName")) {
            unlink("./images/pengumuman/$fileName");
        }
    }
}
