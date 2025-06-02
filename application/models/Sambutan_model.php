<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sambutan_model extends MY_Model
{

    protected $table = 'sambutan'; // Nama tabel di database

    public function getDefaultValues()
    {
        return [
            'pembuka'      => '',
            'isi_sambutan' => '',
            'penutup'      => '',
            'nama_kepsek'  => '',
            'nip_kepsek'   => '',
            'foto_kepsek'  => ''
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'pembuka',
                'label' => 'Pembuka Sambutan',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'isi_sambutan',
                'label' => 'Isi Sambutan',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'penutup',
                'label' => 'Penutup Sambutan',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'nama_kepsek',
                'label' => 'Nama Kepala Sekolah',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'nip_kepsek',
                'label' => 'NIP Kepala Sekolah',
                'rules' => 'trim|required'
            ]
        ];
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'      => './images/kepsek/',
            'file_name'        => $fileName,
            'allowed_types'    => 'jpg|jpeg|png|gif',
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
        $filePath = "./images/kepsek/$fileName";
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('sambutan', ['id' => $id])->row_array();
    }
}
