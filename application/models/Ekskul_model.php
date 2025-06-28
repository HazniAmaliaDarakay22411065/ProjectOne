<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ekskul_model extends MY_Model
{

    protected $table = 'ekskul';
    protected $primaryKey = 'id_ekskul';



    public function getDefaultValues()
    {
        return [
            'id_ekskul'         => '',
            'judul'             => '',
            'image'             => '',
            'id_guru'           => ''
        ];
    }

    public function getValidationRules()
    {

        return  [

            [
                'field' => 'id_guru',
                'label' => 'Guru Penanggungjawab',
                'rules' => 'required'
            ],

            [
                'field'    => 'judul',
                'label'    => 'judul',
                'rules'    => 'trim|required'
            ],


        ];
    }

    public function generateIdEkskul()
    {
        $last = $this->db->select('id_ekskul')
            ->order_by('id_ekskul', 'DESC')
            ->limit(1)
            ->get('ekskul')
            ->row();

        if ($last) {
            $number = (int) substr($last->id_ekskul, 3) + 1;
        } else {
            $number = 1;
        }

        return 'EKS' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    public function get_preview($limit = 4)
    {
        $this->db->select('ekskul.*, data_guru.nama as nama_guru');
        $this->db->from('ekskul');
        $this->db->join('data_guru', 'data_guru.id_guru = ekskul.id_guru', 'left');
        $this->db->order_by('ekskul.id_ekskul', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }


    // Relasi dengan guru
    public function withGuru()
    {
        $this->db->join('data_guru', 'data_guru.id_guru = ekskul.id_guru');
        $this->db->select('ekskul.*, data_guru.nama as guru_nama, data_guru.nip as guru_nip');
        return $this;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config    = [
            'upload_path'        => './images/ekskul', //tmpt penyimpanan up foto pada bag confirm pembayaran
            'file_name'          => $fileName,
            'allowed_types'      => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'           => 1024,
            'max_width'          => 0,
            'max_height'         => 0,
            'overwrite'          => true,
            'file_ext_tolower'   => true
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }
}
