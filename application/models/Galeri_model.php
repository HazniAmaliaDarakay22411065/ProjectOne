<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Galeri_model extends MY_Model
{

    protected $table = 'galeri';
    protected $primaryKey = 'id_galeri';

    public function getDefaultValues()
    {
        return [
            'id_galeri'   => '',
            'judul'       => '',
            'image'       => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field'    => 'judul',
                'label'    => 'judul',
                'rules'    => 'trim|required'
            ],

            [
                'field'    => 'image',
                'label'    => 'Foto Galeri',
                'rules'    => 'callback_image_required'
            ],
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config    = [
            'upload_path'          => './images/galeri', //tmpt penyimpanan up foto pada bag confirm pembayaran
            'file_name'            => $fileName,
            'allowed_types'        => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'             => 1024,
            'max_width'            => 0,
            'max_height'           => 0,
            'overwrite'            => true,
            'file_ext_tolower'     => true
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }

    public function getKodeGaleri()
    {
        $this->db->select('RIGHT(id_galeri, 3) as kode', false);
        $this->db->order_by('id_galeri', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            $data = $query->row();
            $kode = (int) $data->kode + 1;
        } else {
            $kode = 1;
        }

        return 'GA' . str_pad($kode, 3, '0', STR_PAD_LEFT);
    }

    // allert 
    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }
}

/* End of file Myorder_model.php */