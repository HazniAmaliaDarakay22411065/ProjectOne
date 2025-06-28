<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model', 'siswa');
        $this->load->model('Kelas_model', 'kelas');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
            }
        }
    }

    public function index($page = null)
    {
        $data['title']      = 'Data Siswa';
        $data['content']    = $this->siswa->withKelas()->paginate($page)->get();
        $data['total_rows'] = $this->siswa->count();
        $data['pagination'] = $this->siswa->makePagination(base_url('siswa'), 2, $data['total_rows']);
        $data['page']       = 'pages/siswa/index';

        $this->viewAdmin($data);
    }

    public function create()
    {
        $input = !$_POST ? (object) $this->siswa->getDefaultValues() : (object) $this->input->post(null, true);
        $input->id_siswa = $this->siswa->generateIdSiswa();

        if (!$this->siswa->validate()) {
            $data['title']       = 'Tambah Siswa';
            $data['input']       = $input;
            $data['kelas']       = $this->kelas->get(); // dropdown kelas
            $data['form_action'] = base_url('siswa/create');
            $data['page']        = 'pages/siswa/form';
            return $this->viewAdmin($data);
        }

        if ($this->siswa->create($input)) {
            $this->session->set_flashdata('success', 'Data siswa berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan data.');
        }

        redirect(base_url('siswa'));
    }

    public function edit($id)
    {
        $data['content'] = $this->siswa->where('id_siswa', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data siswa tidak ditemukan.');
            redirect(base_url('siswa'));
        }

        $data['input'] = !$_POST ? $data['content'] : (object) $this->input->post(null, true);

        // Load library form_validation
        $this->load->library('form_validation');

        // Ambil nilai NIS dari form dan dari data lama
        $nis_input = $this->input->post('nis');
        $nis_lama  = $data['content']->nis;

        // Tambahkan aturan is_unique hanya jika NIS berubah
        $is_unique = ($nis_input != $nis_lama) ? '|is_unique[siswa.nis]' : '';

        // Set rules manual (karena kita tidak pakai MY_Model->validate())
        $this->form_validation->set_rules('nis', 'NIS', 'required|numeric|max_length[20]' . $is_unique);
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[P,L]');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title']       = 'Edit Siswa';
            $data['form_action'] = base_url("siswa/edit/$id");
            $data['kelas']       = $this->kelas->get();
            $data['page']        = 'pages/siswa/form';
            return $this->viewAdmin($data);
        }

        if ($this->siswa->where('id_siswa', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }

        redirect(base_url('siswa'));
    }


    public function delete($id)
    {
        if (!$_POST) redirect(base_url('siswa'));

        $siswa = $this->siswa->where('id_siswa', $id)->first();
        if (!$siswa) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan.');
            redirect(base_url('siswa'));
        }

        if ($this->siswa->where('id_siswa', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }

        redirect(base_url('siswa'));
    }

    public function import_excel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'xlsx';
            $config['max_size']      = 2048;
            $config['file_name']     = 'import_siswa_' . time();

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file_excel')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect(base_url('siswa'));
            }

            $file = $this->upload->data('full_path');
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($file);
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            $data_siswa = [];
            $this->load->model('Siswa_model', 'siswa');
            $this->load->model('Kelas_model', 'kelas');

            $id_siswa_awal = $this->siswa->generateIdSiswaBerikutnya();
            $nomor_awal = intval(substr($id_siswa_awal, 2));

            for ($i = 1; $i < count($sheet); $i++) {
                $baris = $sheet[$i];
                $id_siswa = 'SW' . str_pad($nomor_awal++, 3, '0', STR_PAD_LEFT);

                $nama_kelas = $baris[3];
                $kelas = $this->kelas->where('nama_kelas', $nama_kelas)->first();

                if (!$kelas) {
                    continue; // skip jika nama kelas tidak ditemukan
                }

                $data_siswa[] = [
                    'id_siswa'      => $id_siswa,
                    'nama_siswa'    => $baris[0],
                    'nis'           => $baris[1],
                    'jenis_kelamin' => $baris[2],
                    'id_kelas'      => $kelas->id_kelas,
                ];
            }

            if (!empty($data_siswa)) {
                $this->db->insert_batch('siswa', $data_siswa);
                $this->session->set_flashdata('success', 'Data siswa berhasil diimport.');
            } else {
                $this->session->set_flashdata('error', 'Tidak ada data siswa yang valid untuk diimport.');
            }

            unlink($file);
            redirect(base_url('siswa'));
        }
    }

    public function search($page = null)
    {
        // Cek apakah ada keyword dari form
        if (isset($_POST['keyword'])) {
            $this->session->set_userdata('keyword_siswa', $this->input->post('keyword'));
        } else {
            redirect(base_url('siswa'));
        }

        $keyword = $this->session->userdata('keyword_siswa');

        $data['title'] = 'Pencarian Data Siswa';
        $data['content'] = $this->siswa
            ->withKelas()
            ->like('nis', $keyword)
            ->paginate($page)
            ->get();

        $data['total_rows'] = $this->siswa
            ->like('nis', $keyword)
            ->count();

        $data['pagination'] = $this->siswa->makePagination(
            base_url('siswa/search'),
            3,
            $data['total_rows']
        );

        $data['page'] = 'pages/siswa/index';

        $this->viewAdmin($data);
    }

    public function reset()
    {
        $this->session->unset_userdata('keyword_siswa');
        redirect(base_url('siswa'));
    }
}
