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
            ],
            [
                'field'     => 'email',
                'label'     => 'E-Mail',
                'rules'     => 'trim|required|valid_email|is_unique[user.email]',
                'errors'    => [ 'is_unique' => 'This %s already e']
            ],
            [
                'field'    => 'password',
                'label'    => 'Password',
                'rules'    => 'required|min_length[8]',
            ],
            [
                'field'    => 'password_confirmation',
                'label'    => 'Konfirmasi Password',
                'rules'    => 'required|matches[password]',    // harus sama dengan password
            ],
        ];

        return $validationRules;
    }
    //rules dari getvalidation rules pada mymodel
    //method untuk isian registrasi 
    public function run($input)
    {
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