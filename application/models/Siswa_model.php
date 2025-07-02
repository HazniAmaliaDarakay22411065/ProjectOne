<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends MY_Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';

    public function getDefaultValues()
    {
        return [
            'id_siswa'      => '',
            'nis'           => '',
            'nama_siswa'    => '',
            'jenis_kelamin' => '',
            'id_kelas'      => ''
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'nis',
                'label' => 'NIS',
                'rules' => 'required|numeric|max_length[20]|is_unique[siswa.nis]'
            ],
            [
                'field' => 'nama_siswa',
                'label' => 'Nama Siswa',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'jenis_kelamin',
                'label' => 'Jenis Kelamin',
                'rules' => 'required|in_list[P,L]'
            ],
            [
                'field' => 'id_kelas',
                'label' => 'Kelas',
                'rules' => 'required'
            ]
        ];
    }

    // Relasi dengan kelas
    public function withKelas()
    {
        $this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
        $this->db->select('siswa.*, kelas.nama_kelas');
        return $this;
    }

    public function generateIdSiswa()
    {
        $last = $this->db->select('id_siswa')->order_by('id_siswa', 'DESC')->limit(1)->get($this->table)->row();

        if ($last) {
            $number = (int) substr($last->id_siswa, 2) + 1;
        } else {
            $number = 1;
        }

        return 'SW' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    public function generateIdSiswaBerikutnya()
    {
        $this->db->select('id_siswa');
        $this->db->from('siswa');
        $this->db->order_by('id_siswa', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get()->row();

        if ($last) {
            $lastNumber = (int) substr($last->id_siswa, 2); // contoh: SW012 => 12
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return 'SW' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    public function isUnique($field, $value, $id_siswa = null)
    {
        $this->db->where($field, $value);
        if ($id_siswa) {
            $this->db->where($this->primaryKey . ' !=', $id_siswa);
        }
        return $this->db->get($this->table)->num_rows() === 0;
    }
}
