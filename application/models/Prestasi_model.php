<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi_model extends MY_Model
{
    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';

    public function getDefaultValues()
    {
        return [
            'id_prestasi' => '',
            'id_siswa'    => '',
            'judul'       => '',
            'image'       => '',
            'kategori'    => '',
            'deskripsi'   => ''
        ];
    }

    public function getValidationRules()
    {
        return [
            [
                'field' => 'id_siswa',
                'label' => 'Siswa',
                'rules' => 'required'
            ],
            [
                'field' => 'judul',
                'label' => 'Judul',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'kategori',
                'label' => 'Kategori',
                'rules' => 'required|in_list[akademik,non_akademik]'
            ],
            [
                'field' => 'deskripsi',
                'label' => 'Deskripsi',
                'rules' => 'trim|required'
            ],
        ];
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'      => './images/prestasi',
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
        $path = "./images/prestasi/$fileName";
        if (file_exists($path)) {
            unlink($path);
        }
    }



    // ✅ JOIN siswa dan kelas untuk ditampilkan di controller
    public function withSiswaDanKelas()
    {
        $this->db->join('siswa', 'siswa.id_siswa = prestasi.id_siswa');
        $this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $this->db->select('prestasi.*, siswa.nama_siswa, kelas.nama_kelas');
        return $this;
    }
    public function generateIdPrestasi()
    {
        $this->db->select('id_prestasi');
        $this->db->from($this->table);
        $this->db->order_by('id_prestasi', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get()->row();

        if ($last) {
            $number = (int) substr($last->id_prestasi, 2) + 1;
        } else {
            $number = 1;
        }

        return 'PR' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
