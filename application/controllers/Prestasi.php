<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prestasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prestasi_model', 'prestasi');
        $this->load->model('Siswa_model', 'siswa');

        if (!in_array($this->router->fetch_method(), ['akademik', 'non_akademik'])) {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
            }
        }
    }

    public function index($page = null)
    {
        $data['title'] = 'Admin: Data Prestasi';
        $data['content'] = $this->prestasi
            ->withSiswaDanKelas()
            ->paginate($page)
            ->get();

        $data['total_rows'] = $this->prestasi->count();
        $data['pagination'] = $this->prestasi->makePagination(
            base_url('prestasi'),
            2,
            $data['total_rows']
        );

        $siswa = $this->siswa->withKelas()->get();
        $dropdown_siswa = [];
        foreach ($siswa as $s) {
            $dropdown_siswa[$s->id_siswa] = $s->nama_siswa . ' (' . $s->nama_kelas . ')';
        }
        $data['dropdown_siswa'] = $dropdown_siswa;


        $data['page'] = 'pages/prestasi/index';
        $this->viewAdmin($data);
    }

    public function create()
    {

        if (!$_POST) {
            $input = (object) $this->prestasi->getDefaultValues();
            $input->id_prestasi = $this->prestasi->generateIdPrestasi(); // 💡 tambahkan ini
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!empty($_FILES['image']['name'])) {
            $imageName = url_title($input->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->prestasi->uploadImage('image', $imageName);
            if ($upload) {
                $input->image = $upload['file_name'];
            } else {
                redirect(base_url('prestasi/create'));
            }
        }

        if (!$this->prestasi->validate()) {
            $siswa = $this->siswa->withKelas()->get();
            $dropdown_siswa = [];
            foreach ($siswa as $s) {
                $dropdown_siswa[$s->id_siswa] = $s->nama_siswa . ' (' . $s->nama_kelas . ')';
            }

            $data['title'] = 'Tambah Prestasi';
            $data['input'] = $input;
            $data['form_action'] = base_url('prestasi/create');
            $data['dropdown_siswa'] = $dropdown_siswa;
            $data['page'] = 'pages/prestasi/form';

            $this->viewAdmin($data);
            return;
        }

        $input->id_prestasi = $this->prestasi->generateIdPrestasi();

        if ($this->prestasi->create($input)) {
            $this->session->set_flashdata('success', 'Data prestasi berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('prestasi'));
    }

    public function edit($id)
    {
        $data['content'] = $this->prestasi->where('id_prestasi', $id)->first();

        if (!$data['content']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('prestasi'));
        }

        $data['input'] = !$_POST ? $data['content'] : (object) $this->input->post(null, true);

        if (!empty($_FILES['image']['name'])) {
            $imageName = url_title($data['input']->judul, '-', true) . '-' . date('YmdHis');
            $upload = $this->prestasi->uploadImage('image', $imageName);
            if ($upload) {
                if (!empty($data['content']->image)) {
                    $this->prestasi->deleteImage($data['content']->image);
                }
                $data['input']->image = $upload['file_name'];
            } else {
                redirect(base_url("prestasi/edit/$id"));
            }
        }

        if (!$this->prestasi->validate()) {
            $siswa = $this->siswa->withKelas()->get();
            $dropdown_siswa = [];
            foreach ($siswa as $s) {
                $dropdown_siswa[$s->id_siswa] = $s->nama_siswa . ' (' . $s->nama_kelas . ')';
            }

            $data['title'] = 'Edit Prestasi';
            $data['form_action'] = base_url("prestasi/edit/$id");
            $data['dropdown_siswa'] = $dropdown_siswa;
            $data['page'] = 'pages/prestasi/form';

            $this->viewAdmin($data);
            return;
        }

        if ($this->prestasi->where('id_prestasi', $id)->update($data['input'])) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui.');
        }

        redirect(base_url('prestasi'));
    }

    public function delete()
    {
        $id = $this->input->post('id_prestasi');

        if (!$id || $_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->session->set_flashdata('error', 'ID tidak ditemukan atau metode salah.');
            return redirect(base_url('prestasi'));
        }

        $prestasi = $this->prestasi->where('id_prestasi', $id)->first();

        if (!$prestasi) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            return redirect(base_url('prestasi'));
        }

        if ($this->prestasi->where('id_prestasi', $id)->delete()) {
            if (!empty($prestasi->image)) {
                $this->prestasi->deleteImage($prestasi->image);
            }
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }

        return redirect(base_url('prestasi'));
    }

    public function akademik()
    {
        $data['title'] = 'Prestasi Akademik';
        $data['content'] = $this->prestasi
            ->withSiswaDanKelas()
            ->where('kategori', 'akademik')
            ->orderBy('created_at', 'DESC')
            ->get();
        $data['page'] = 'pages/prestasi/kategori';
        $this->view($data);
    }

    public function non_akademik()
    {
        $data['title'] = 'Prestasi Non-Akademik';
        $data['content'] = $this->prestasi
            ->withSiswaDanKelas()
            ->where('kategori', 'non_akademik')
            ->orderBy('created_at', 'DESC')
            ->get();
        $data['page'] = 'pages/prestasi/kategori';
        $this->view($data);
    }
}
