<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Fasilitas_model extends MY_Model
{
    protected $table = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';

    public function getDefaultValues()
    {
        return [

            'id_fasilitas'      => '',
            'judul'             => '',
            'image'             => ''
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
                'label'    => 'Foto Fasilitas',
                'rules'    => 'callback_image_required'
            ],
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config    = [
            'upload_path'        => './images/fasilitas', //tmpt penyimpanan up foto pada bag confirm pembayaran
            'file_name'            => $fileName,
            'allowed_types'        => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'            => 1024,
            'max_width'            => 0,
            'max_height'        => 0,
            'overwrite'            => true,
            'file_ext_tolower'    => true
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }

    public function generateId()
    {
        $this->db->select('RIGHT(id_fasilitas, 3) as kode', false);
        $this->db->order_by('id_fasilitas', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('fasilitas');

        if ($query->num_rows() > 0) {
            $data = $query->row();
            $kode = (int) $data->kode + 1;
        } else {
            $kode = 1;
        }

        return 'FS' . str_pad($kode, 3, '0', STR_PAD_LEFT); // FS001, FS002, dst.
    }
}
