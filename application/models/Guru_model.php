<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends MY_Model
{
    public $table = 'data_guru';
    protected $primaryKey = 'id_guru';

    public function getDefaultValues()
    {
        return [
            'id_guru'    => '',
            'nama'       => '',
            'nip'        => '',
            'tempat_lahir' => '',
            'tgl_lahir'  => '',
            'jk'         => '',
            'jabatan'    => '',
            'deskripsi'  => '',
            'foto'       => 'default.jpg'
        ];
    }
    public function validate()
    {
        $this->load->library('form_validation');

        $rules = $this->getValidationRules();

        $this->form_validation->set_rules($rules);

        return $this->form_validation->run();
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'nama',
                'label' => 'Nama Guru',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'nip',
                'label' => 'NIP',
                'rules' => 'trim|required|numeric|max_length[18]',
                'errors' => [
                    'is_unique' => 'NIP ini sudah terdaftar.'
                ]
            ],
            [
                'field' => 'tempat_lahir',
                'label' => 'Tempat Lahir',
                'rules' => 'trim|callback_validate_tempat_lahir_alpha'
            ],
            [
                'field' => 'tgl_lahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'trim|required|callback_valid_tanggal'
            ],
            [
                'field' => 'jk',
                'label' => 'Jenis Kelamin',
                'rules' => 'required|in_list[L,P]'
            ],
            [
                'field' => 'jabatan',
                'label' => 'Jabatan',
                'rules' => 'required'
            ],
            [
                'field' => 'deskripsi',
                'label' => 'Deskripsi',
                'rules' => 'trim|required'
            ]
        ];
    }


    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'      => './images/guru',
            'file_name'        => $fileName,
            'allowed_types'    => 'jpg|jpeg|png',
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
        $path = "./images/guru/$fileName";
        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function generateIdGuru()
    {
        $this->db->select('RIGHT(id_guru, 3) as kode', false);
        $this->db->order_by('id_guru', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $kode = (int) $query->row()->kode + 1;
        } else {
            $kode = 1;
        }

        return 'GR' . str_pad($kode, 3, '0', STR_PAD_LEFT);
    }

    public function generateIdGuruBerikutnya()
    {
        $this->db->select('id_guru');
        $this->db->order_by('id_guru', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get('data_guru')->row();

        if (!$last) {
            return 'GR001';
        }

        $lastId = intval(substr($last->id_guru, 2));
        $nextId = $lastId + 1;
        return 'GR' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
    }

    public function isUnique($field, $value, $id_guru = null)
    {
        $this->db->where($field, $value);

        // Jika sedang proses edit, abaikan baris dengan ID yang sedang diedit
        if ($id_guru) {
            $this->db->where($this->primaryKey . ' !=', $id_guru);
        }

        return $this->db->get($this->table)->num_rows() === 0;
    }
}
