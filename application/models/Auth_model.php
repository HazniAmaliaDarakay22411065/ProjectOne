<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends MY_Model
{
    public $table = 'user';
    public $primaryKey = 'id_user';

    // Nilai default saat pertama kali form login ditampilkan
    public function getDefaultValues()
    {
        return [
            'username' => '',
            'password' => ''
        ];
    }

    // Aturan validasi form login
    public function getValidationRules()
    {
        return [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            ]
        ];
    }

    // Fungsi untuk mengambil user berdasarkan username (khusus admin)
    public function login($username)
    {
        return $this->db->where('username', $username)
            ->where('role', 'admin') // hanya role admin yang boleh login
            ->get($this->table)
            ->row(); // hasilnya berupa object (id_user, username, password, dll)
    }
}
