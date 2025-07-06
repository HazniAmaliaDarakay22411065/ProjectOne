<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_model extends MY_Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    public function getDefaultValues()
    {
        return [
            'id_berita' => '',
            'judul'     => '',
            'jenis'     => '',
            'deskripsi' => '',
            'image'     => '',
            'tanggal'   => '',
            'is_published'  => 0
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'judul',
                'label' => 'Judul',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'jenis',
                'label' => 'Jenis',
                'rules' => 'trim|required|in_list[pengumuman,agenda]'
            ],

            [
                'field' => 'deskripsi',
                'label' => 'Deskripsi',
                'rules' => 'trim|required'
            ],

            [
                'field' => 'is_published',
                'label' => 'Status Publish',
                'rules' => 'in_list[0,1]'
            ]
            // Tidak wajib untuk tanggal, karena akan diset otomatis
        ];
    }


    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'      => './images/berita',
            'file_name'        => $fileName,
            'allowed_types'    => 'jpg|png|jpeg|gif',
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
        if (file_exists("./images/berita/$fileName")) {
            unlink("./images/berita/$fileName");
        }
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('berita', ['id_berita' => $id])->row_array();
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }
    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function generateIdBerita()
    {
        $last = $this->db->select('id_berita')
            ->order_by('id_berita', 'DESC')
            ->limit(1)
            ->get('berita')
            ->row();

        if ($last) {
            $number = (int) substr($last->id_berita, 2) + 1;
        } else {
            $number = 1;
        }

        return 'BR' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
