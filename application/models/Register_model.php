<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_model extends MY_Model
{

    protected $table = 'user';
    // method get_value 
    // saat membuka form registrasi, maka akan langsung terisi 
    public function getDefaultValues()
    {
        return [
            'name'        => '',
            'email'       => '',
            'password'    => '',
            'role'        => '',
            'is_active'   => ''
        ];
    }
    // get_validation ada pada my_model untuk validasi 

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field'    => 'name',
                'label'    => 'Nama',
                'rules'    => 'trim|required',  // validasi | agar tidak ada spasi sebelum atau sesudah inputan
                'errors' => [
                    'required' => 'Nama wajib diisi.'
                ]
            ],
            [
                'field'     => 'email',
                'label'     => 'E-Mail',
                'rules'     => 'trim|required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required'    => 'Email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique'   => 'Email sudah digunakan.'
                ]
            ],
            [
                'field'    => 'password',
                'label'    => 'Password',
                'rules' => 'required|min_length[8]|callback_validate_password_strength',
                'errors' => [
                    'required'    => 'Password wajib diisi.',
                    'min_length'  => 'Password minimal 8 karakter.' // Untuk error dari callback, pesannya sudah kamu set di controller.

                ]
            ],
            [
                'field'    => 'password_confirmation',
                'label'    => 'Konfirmasi Password',
                'rules'    => 'required|matches[password]',    // harus sama dengan password
                'errors' => [
                    'required' => 'Konfirmasi password wajib diisi.',
                    'matches'  => 'Konfirmasi password tidak cocok.'
                ]
            ],
        ];

        return $validationRules;
    }


    //rules dari getvalidation rules pada mymodel
    //method untuk isian registrasi 
    public function run($input)
    {
        // Validasi manual kekuatan password
        $password_errors = [];

        if (strlen($input->password) < 8) {
            $password_errors[] = 'Password minimal 8 karakter.';
        }
        if (!preg_match('@[A-Z]@', $input->password)) {
            $password_errors[] = 'Password harus mengandung huruf besar.';
        }
        if (!preg_match('@[a-z]@', $input->password)) {
            $password_errors[] = 'Password harus mengandung huruf kecil.';
        }
        if (!preg_match('@[0-9]@', $input->password)) {
            $password_errors[] = 'Password harus mengandung angka.';
        }
        if (!preg_match('@[^\w]@', $input->password)) {
            $password_errors[] = 'Password harus mengandung simbol.';
        }

        if (!empty($password_errors)) {
            $this->session->set_flashdata('password_errors', $password_errors);
            return false;
        }

        $data        = [
            'name'        => $input->name,
            'email'        => strtolower($input->email),
            'password'    => hashEncrypt($input->password),
            'role'        => 'users'
        ];

        $user        = $this->create($data);

        return true;
    }
}

/* End of file Register_model.php */