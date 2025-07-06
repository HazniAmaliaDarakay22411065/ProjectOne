<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil_model extends MY_Model
{
    protected $table    = 'profil_sekolah';
    protected $perPage  = 1;

    public function getDefaultValues()
    {
        return [
            'nama_sekolah'      => '',
            'npsn'              => '',
            'jenjang'           => '',
            'status'            => '',
            'akreditasi'        => '',
            'tahun_berdiri'     => '',
            'visi'              => '',
            'misi'              => '',
            'sejarah'           => ''

        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'nama_sekolah',
                'label' => 'Nama Sekolah',
                'rules' => 'required'
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
                'rules' => 'required'
            ],

            [
                'field' => 'tahun_berdiri',
                'label' => 'Tahun Berdiri',
                'rules' => 'trim|required|numeric|exact_length[4]'
            ],
            [
                'field' => 'visi',
                'label' => 'Visi',
                'rules' => 'required'
            ],
            [
                'field' => 'misi',
                'label' => 'Misi',
                'rules' => 'required'
            ],

            [
                'field' => 'tujuan',
                'label' => 'Tujuan',
                'rules' => 'required'
            ],

            [
                'field' => 'sejarah',
                'label' => 'Sejarah',
                'rules' => 'required'
            ]


        ];
    }

    public function first()
    {
        return $this->db->get($this->table)->row();
    }

    public function updateProfil($id, $data)
    {
        return $this->db->where('id_sekolah', $id)->update($this->table, $data);
    }

    public function generateIdSekolah()
    {
        $this->db->select('id_sekolah');
        $this->db->like('id_sekolah', 'PS');
        $this->db->order_by('id_sekolah', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $lastId = $query->row()->id_sekolah;
            $lastNumber = (int) substr($lastId, 2);
            $newNumber = $lastNumber + 1;
            return 'PS' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            return 'PS001';
        }
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }
}
