<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_masyarakat_model extends MY_Model
{
    protected $table = 'kegiatan_masyarakat';
    protected $primaryKey = 'id_kegmas';

    public function getDefaultValues()
    {
        return [
            'id_kegmas'   => '',
            'id_guru'     => '',
            'judul'       => '',
            'image'       => '',
            'deskripsi'   => ''
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'id_guru',
                'label' => 'Guru Penanggung Jawab',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'judul',
                'label' => 'Judul',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'deskripsi',
                'label' => 'Deskripsi',
                'rules' => 'required|trim'
            ]
        ];
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'      => './images/kegiatan_masyarakat',
            'file_name'        => $fileName,
            'allowed_types'    => 'jpg|gif|png|jpeg|JPG|PNG',
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
        $path = "./images/kegiatan_masyarakat/$fileName";
        if (file_exists($path)) {
            unlink($path);
        }
    }

    // JOIN guru untuk menampilkan nama guru di controller/view
    public function withGuru()
    {
        $this->db->join('data_guru', 'data_guru.id_guru = kegiatan_masyarakat.id_guru');
        $this->db->select('kegiatan_masyarakat.*, data_guru.nama AS nama_guru');
        return $this;
    }

    //  Generate ID otomatis 
    public function generateIdKegmas()
    {
        $this->db->select('id_kegmas');
        $this->db->from($this->table);
        $this->db->order_by('id_kegmas', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get()->row();

        if ($last) {
            $number = (int) substr($last->id_kegmas, 2) + 1;
        } else {
            $number = 1;
        }

        return 'KM' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
