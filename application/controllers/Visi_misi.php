<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Visi_misi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Visi_misi_model', 'visi_misi');

        if ($this->router->fetch_method() !== 'show') {
            if ($this->session->userdata('role') != 'admin') {
                redirect(base_url('/'));
                return;
            }
        }
    }

    public function index($page = null)
    {
        $data['title']        = 'Admin: Data Visi Misi';
        $data['content']      = $this->visi_misi->paginate($page)->get();
        $data['total_rows']   = $this->visi_misi->count();
        $data['pagination']   = $this->visi_misi->makePagination(
            base_url('visi_misi'),
            2,
            $data['total_rows']
        );
        $data['page']         = 'pages/visi_misi/index';

        $this->viewAdmin($data);
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->visi_misi->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->visi_misi->validate()) {
            $data['title']       = 'Tambah Visi Misi';
            $data['input']       = $input;
            $data['form_action'] = base_url('visi_misi/create');
            $data['page']        = 'pages/visi_misi/form';

            $this->viewAdmin($data);
            return;
        }

        // Simpan data berdasarkan baris
        $baris = explode("\n", $input->isi);
        $sukses = false;

        foreach ($baris as $item) {
            $isi = trim($item);
            if (!empty($isi)) {
                $newData = [
                    'kategori' => $input->kategori,
                    'isi'      => $isi,
                ];
                if ($this->visi_misi->create((object) $newData)) {
                    $sukses = true;
                }
            }
        }

        if ($sukses) {
            $this->session->set_flashdata('success', 'Data visi/misi berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Tidak ada data yang disimpan.');
        }

        redirect(base_url('visi_misi'));
    }

    public function edit($id)
    {
        // Ambil data awal berdasarkan ID
        $dataLama = $this->visi_misi->where('id', $id)->first();

        if (!$dataLama) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('visi_misi'));
        }

        // Ambil semua data dengan kategori yang sama
        $kategori = $dataLama->kategori;
        $semuaData = $this->visi_misi->where('kategori', $kategori)->get();

        if (!$_POST) {
            // Gabungkan isi dari semua data kategori ini
            $isiGabungan = '';
            foreach ($semuaData as $item) {
                $isiGabungan .= $item->isi . "\n";
            }

            $data['input'] = (object) [
                'kategori' => $kategori,
                'isi'      => trim($isiGabungan)
            ];
        } else {
            $data['input'] = (object) $this->input->post(null, true);
        }

        if (!$this->visi_misi->validate()) {
            $data['title']       = 'Edit Visi Misi';
            $data['form_action'] = base_url("visi_misi/edit/$id");
            $data['page']        = 'pages/visi_misi/form';

            $this->viewAdmin($data);
            return;
        }

        // Hapus semua entri lama kategori ini
        $this->visi_misi->where('kategori', $kategori)->delete();

        // Simpan ulang entri berdasarkan baris
        $baris = explode("\n", $data['input']->isi);
        $sukses = false;

        foreach ($baris as $item) {
            $isi = trim($item);
            if (!empty($isi)) {
                $newData = [
                    'kategori' => $data['input']->kategori,
                    'isi'      => $isi,
                ];
                if ($this->visi_misi->create((object) $newData)) {
                    $sukses = true;
                }
            }
        }

        if ($sukses) {
            $this->session->set_flashdata('success', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Tidak ada data yang diperbarui.');
        }

        redirect(base_url('visi_misi'));
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('visi_misi'));
        }

        $visi_misi = $this->visi_misi->where('id', $id)->first();

        if (!$visi_misi) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect(base_url('visi_misi'));
        }

        if ($this->visi_misi->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
        }

        redirect(base_url('visi_misi'));
    }

    public function show()
    {
        $data['title'] = 'Visi dan Misi';

        $semuaData = $this->visi_misi->get();

        $data['visi']    = [];
        $data['misi']    = [];
        $data['tujuan']  = [];

        foreach ($semuaData as $row) {
            if ($row->kategori == 'visi') {
                $data['visi'][] = $row;
            } elseif ($row->kategori == 'misi') {
                $data['misi'][] = $row;
            } elseif ($row->kategori == 'tujuan') {
                $data['tujuan'][] = $row;
            }
        }

        $data['page'] = 'pages/visi_misi/show';
        $this->view($data);
    }
}
