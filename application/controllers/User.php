<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');

        if ($this->session->userdata('role') != 'admin') {
            redirect('/');
        }
    }

    public function index($page = null)
    {
        $data['title']      = 'Manajemen User';
        $data['content']    = $this->user->paginate($page)->get();
        $data['total_rows'] = $this->user->count();
        $data['pagination'] = $this->user->makePagination(base_url('user'), 2, $data['total_rows']);
        $data['page']       = 'pages/user/index';

        $this->viewAdmin($data);
    }

    public function create()
    {
        $input = !$_POST ? (object) $this->user->getDefaultValues() : (object) $this->input->post(null, true);

        if (!$this->user->validate()) {
            $data['title'] = 'Tambah User';
            $data['input'] = $input;
            $data['form_action'] = base_url('user/create');
            $data['page'] = 'pages/user/form';
            return $this->viewAdmin($data);
        }

        $input->password = hashEncrypt($input->password);

        if ($this->user->create($input)) {
            $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan.');
        }

        redirect('user');
    }

    public function edit($id)
    {
        $user = $this->user->where('id_user', $id)->first();

        if (!$user) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan.');
            redirect('user');
        }

        $input = !$_POST ? $user : (object) $this->input->post(null, true);

        $isEmailSame = $user->email == $input->email;
        $isEdit = true;

        $rules = $this->user->getValidationRules($isEdit);
        if ($isEmailSame) {
            foreach ($rules as &$rule) {
                if ($rule['field'] == 'email') {
                    $rule['rules'] = 'required|trim|valid_email';
                }
            }
        }

        $this->form_validation->set_rules($rules);

        if (!$this->form_validation->run()) {
            $data['title'] = 'Edit User';
            $data['input'] = $input;
            $data['form_action'] = base_url("user/edit/$id");
            $data['page'] = 'pages/user/form';
            return $this->viewAdmin($data);
        }

        if (!empty($input->password)) {
            $input->password = hashEncrypt($input->password);
        } else {
            unset($input->password);
        }

        if ($this->user->update($id, $input)) {
            $this->session->set_flashdata('success', 'User berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan.');
        }

        redirect('user');
    }

    public function delete($id)
    {
        if (!$_POST) {
            redirect('user');
        }

        if ($this->user->delete($id)) {
            $this->session->set_flashdata('success', 'User berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan.');
        }

        redirect('user');
    }
}
