<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profil_sekolah_model extends MY_Model
{
    public function getDefaultValues()
    {
        return [
            'nama_sekolah'   => '',
            'npsn'           => '',
            'jenjang'        => '',
            'status'         => '',
            'akreditasi'     => '',
            'tahun_berdiri'  => ''
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'nama_sekolah',
                'label' => 'Nama Sekolah',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'npsn',
                'label' => 'NPSN',
                'rules' => 'trim|required|numeric'
            ],
            [
                'field' => 'jenjang',
                'label' => 'Jenjang',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'akreditasi',
                'label' => 'Akreditasi',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'tahun_berdiri',
                'label' => 'Tahun Berdiri',
                'rules' => 'trim|required|numeric|exact_length[4]'
            ]
        ];
    }

    public function getProfilSekolah()
    {
        return $this->db->get('profil_sekolah')->row();
    }

    public function updateProfilSekolah($data, $id = 1)
    {
        return $this->db->where('id', $id)->update('profil_sekolah', $data);
    }
}
