<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Guru extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Guru_model', 'guru');
        $this->load->library('form_validation');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function validate_nip_numeric($nip)
    {
        if (!preg_match('/^[0-9]+$/', $nip)) {
            $this->form_validation->set_message('validate_nip_numeric', 'NIP hanya boleh berisi angka.');
            return false;
        }
        return true;
    }

    public function validate_tempat_lahir_alpha($tempat_lahir)
    {
        if (!preg_match('/^[a-zA-Z\s]+$/', $tempat_lahir)) {
            $this->form_validation->set_message('validate_tempat_lahir_alpha', 'Tempat lahir hanya boleh berisi huruf dan spasi.');
            return false;
        }
        return true;
    }

    public function valid_tanggal($date)
    {
        if (DateTime::createFromFormat('Y-m-d', $date) !== false) {
            return true;
        } else {
            $this->form_validation->set_message('valid_tanggal', 'Format Tanggal Lahir tidak valid. Gunakan format YYYY-MM-DD.');
            return false;
        }
    }

    public function index($page = null)
    {
        $data['title']        = 'Admin: Data Guru';
        $data['content']      = $this->guru->paginate($page)->get();
        $data['total_rows']   = $this->guru->count();
        $data['pagination']   = $this->guru->makePagination(base_url('guru'), 2, $data['total_rows']);
        $data['page']         = 'pages/guru/index';

        $this->viewAdmin($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->guru->getDefaultValues();
            $input->id_guru = $this->guru->generateIdGuru();
        } else {
            $input = (object) $this->input->post(null, true);
            $input->id_guru = $this->guru->generateIdGuru();
        }

        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|callback_valid_tanggal');

        if (!$this->guru->validate() || $this->form_validation->run() === false) { //validasi gagal
            $data['title']        = 'Tambah Guru';
            $data['input']        = $input;
            $data['form_action']  = base_url('guru/create');
            $data['page']         = 'pages/guru/form';
            $this->viewAdmin($data);
            return;
        }

        // Cek apakah NIP atau Nama sudah ada
        if (!$this->guru->isUnique('nip', $input->nip)) {
            $this->session->set_flashdata('error', 'NIP sudah terdaftar!');
            redirect(base_url('guru/create'));
            return;
        }

        if (!$this->guru->isUnique('nama', $input->nama)) {
            $this->session->set_flashdata('error', 'Nama sudah terdaftar!');
            redirect(base_url('guru/create'));
            return;
        }

        // Upload Foto
        if (!empty($_FILES['foto']['name'])) {
            $fileName = url_title($input->nama, '-', true) . '-' . date('YmdHis');
            $upload = $this->guru->uploadImage('foto', $fileName);
            if ($upload) {
                $input->foto = $upload['file_name'];
            } else {
                redirect(base_url('guru/create'));
            }
        }

        if ($this->guru->create($input)) {
            $this->session->set_flashdata('success', 'Data guru berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('guru'));
    }

    public function edit($id)
    {
        $data['content'] = $this->guru->where('id_guru', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('guru'));
        }

        if (!$_POST) {
            $data['input'] = $data['content'];
        } else {
            $post = (object) $this->input->post(null, true);
            $data['input'] = (object) array_merge((array) $data['content'], (array) $post);
        }

        if (!empty($_FILES['foto']['name'])) {
            $fileName = url_title($data['input']->nama, '-', true) . '-' . date('YmdHis');
            $upload = $this->guru->uploadImage('foto', $fileName);
            if ($upload) {
                if (
                    $data['content']->foto !== 'default.jpg' &&
                    file_exists(FCPATH . "images/guru/{$data['content']->foto}")
                ) {
                    unlink(FCPATH . "images/guru/{$data['content']->foto}");
                }
                $data['input']->foto = $upload['file_name'];
            } else {
                redirect(base_url("guru/edit/$id"));
            }
        }

        $this->form_validation->set_rules('nip', 'NIP', 'required|max_length[18]|callback_validate_nip_numeric');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'callback_validate_tempat_lahir_alpha');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|callback_valid_tanggal');

        if (!$this->guru->validate() || $this->form_validation->run() === false) {
            $data['title']        = 'Edit Data Guru';
            $data['form_action']  = base_url("guru/edit/$id");
            $data['page']         = 'pages/guru/form';
            $this->viewAdmin($data);
            return;
        }

        // Cek duplikat NIP (kecuali miliknya sendiri)
        if (!$this->guru->isUnique('nip', $data['input']->nip, $id)) {
            $this->session->set_flashdata('error', 'NIP sudah digunakan oleh guru lain!');
            redirect(base_url("guru/edit/$id"));
            return;
        }

        if ($this->guru->where('id_guru', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('guru'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('guru'));
        }

        $guru = $this->guru->where('id_guru', $id)->first();

        if (!$guru) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('guru'));
        }

        if ($this->guru->where('id_guru', $id)->delete()) {

            // Jangan hapus jika fotonya adalah default
            if (!empty($guru->foto) && $guru->foto !== 'default.jpg') {
                $foto_path = FCPATH . "images/guru/{$guru->foto}";
                if (file_exists($foto_path)) {
                    unlink($foto_path);
                }
            }

            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('guru'));
    }


    public function search($page = null)
    {
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword', $this->input->post('keyword'));
        } else {
            redirect(base_url('guru'));
        }

        $keyword = $this->session->userdata('keyword');

        $data['title']      = 'Admin: Data Guru';
        $data['content']    = $this->guru->like('nip', $keyword)->orLike('nama', $keyword)->paginate($page)->get();
        $data['total_rows'] = $this->guru->like('nip', $keyword)->orLike('nama', $keyword)->count();
        $data['pagination'] = $this->guru->makePagination(base_url('guru/search'), 3, $data['total_rows']);
        $data['page']       = 'pages/guru/index';

        $this->viewAdmin($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword');
        redirect(base_url('guru'));
    }

    public function import_excel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'xlsx';
            $config['max_size']      = 2048;
            $config['file_name']     = 'import_guru_' . time();

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file_excel')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect(base_url('guru'));
            }

            $file = $this->upload->data('full_path');
            $reader = new Xlsx();
            $spreadsheet = $reader->load($file);
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            $data_guru = [];
            $id_guru_awal = $this->guru->generateIdGuruBerikutnya();
            $nomor_awal = intval(substr($id_guru_awal, 2));

            for ($i = 1; $i < count($sheet); $i++) {
                $baris = $sheet[$i];

                // Cek apakah nama atau nip sudah ada
                if (!$this->guru->isUnique('nip', $baris[1]) || !$this->guru->isUnique('nama', $baris[0])) {
                    continue;
                }

                $id_guru = 'GR' . str_pad($nomor_awal++, 3, '0', STR_PAD_LEFT);

                $data_guru[] = [
                    'id_guru'      => $id_guru,
                    'nama'         => $baris[0],
                    'nip'          => $baris[1],
                    'tempat_lahir' => $baris[2],
                    'tgl_lahir'    => $baris[3],
                    'jk'           => $baris[4],
                    'jabatan'      => $baris[5],
                    'deskripsi'    => $baris[6],
                    'foto'         => 'default.jpg'
                ];
            }

            if (!empty($data_guru)) {
                $this->db->insert_batch('data_guru', $data_guru);
                $this->session->set_flashdata('success', 'Data guru berhasil diimport.');
            } else {
                $this->session->set_flashdata('error', 'Tidak ada data yang bisa diimport.');
            }

            unlink($file);
            redirect(base_url('guru'));
        }
    }
    // publish 
    public function toggle($id)
    {
        $guru = $this->guru->where('id_guru', $id)->first();

        if (!$guru) {
            $this->session->set_flashdata('warning', 'Data guru tidak ditemukan!');
            return redirect(base_url('guru'));
        }

        $status = $guru->is_published ? 0 : 1;
        $this->guru->update($id, ['is_published' => $status]);

        $pesan = $status ? 'ditampilkan' : 'un-published';
        $this->session->set_flashdata('success', "Data guru berhasil $pesan.");
        redirect(base_url('guru'));
    }

    public function show()
    {
        $data['title'] = 'Daftar Guru';
        $data['guru']  = $this->guru
            ->where('is_published', 1)
            ->orderBy('id_guru', 'ASC')
            ->get();
        $data['page']  = 'pages/guru/show';

        $this->view($data);
    }
}
