<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sambutan_model extends MY_Model
{
    public $table = 'sambutan'; // Nama tabel di database
    protected $primaryKey = 'id_sambutan'; // yang benar


    public function getDefaultValues()
    {
        return [
            'id_guru'      => '',
            'pembuka'      => '',
            'isi_sambutan' => '',
            'penutup'      => '',
            'is_published'  => 0
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'id_guru',
                'label' => 'Guru (Kepala Sekolah)',
                'rules' => 'required'
            ],

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
                'field' => 'is_published',
                'label' => 'Status Publish',
                'rules' => 'in_list[0,1]'
            ]
        ];
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'      => './images/guru/',
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
        $filePath = "./images/guru/$fileName";
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // public function withGuru()
    // {
    //     $this->db->select('sambutan.*, data_guru.nama, data_guru.nip, data_guru.jabatan, data_guru.foto');
    //     $this->db->from('sambutan');
    //     $this->db->join('data_guru', 'data_guru.id_guru = sambutan.id_guru', 'left');
    //     return $this->db->get()->result();
    // }

    // public function getPublishedWithGuru()
    // {
    //     $this->db->select('sambutan.*, data_guru.nama, data_guru.nip, data_guru.jabatan, data_guru.foto');
    //     $this->db->from('sambutan');
    //     $this->db->join('data_guru', 'data_guru.id_guru = sambutan.id_guru', 'left');
    //     $this->db->where('sambutan.is_published', 1);
    //     return $this->db->get()->row();
    // }
    public function with($table = 'data_guru')
    {
        $this->db->join($table, "$table.id_guru = sambutan.id_guru");
        $this->db->select("sambutan.*, $table.nama as guru_nama, $table.nip as guru_nip, $table.foto as guru_foto");
        return $this;
    }
    // public function with($table = 'data_guru')
    // {
    //     $this->db->join($table, "$table.id_guru = sambutan.id_guru");
    //     $this->db->select("sambutan.*, $table.nama as guru_nama, $table.nip as guru_nip, $table.foto as guru_foto");
    //     return $this;
    // }


    public function get_by_id($id)
    {
        return $this->db->get_where('sambutan', ['id_sambutan' => $id])->row_array();
    }

    public function get_published()
    {
        return $this->db->where('is_published', 1)->get($this->table)->row();
    }

    public function reset_publish()
    {
        return $this->db->update($this->table, ['is_published' => 0]);
    }

    public function getIdSambutan()
    {
        $this->db->select('RIGHT(id_sambutan, 3) as kode', false);
        $this->db->order_by('id_sambutan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('sambutan');

        if ($query->num_rows() > 0) {
            $data = $query->row();
            $kode = (int) $data->kode + 1;
        } else {
            $kode = 1;
        }

        $kodemax = str_pad($kode, 3, '0', STR_PAD_LEFT);
        return 'SB' . $kodemax;
    }
}
