<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends MY_Model
{
    public $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    public function getDefaultValues()
    {
        return [
            'id_kelas'   => '',
            'nama_kelas' => ''
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'nama_kelas',
                'label' => 'Nama Kelas',
                'rules' => 'required|trim'
            ]
        ];
    }




    public function generateIdKelas()
    {
        $this->db->select('RIGHT(id_kelas, 3) as kode', false);
        $this->db->order_by('id_kelas', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $kode = (int) $query->row()->kode + 1;
        } else {
            $kode = 1;
        }

        return 'KLS' . str_pad($kode, 3, '0', STR_PAD_LEFT);
    }
}
