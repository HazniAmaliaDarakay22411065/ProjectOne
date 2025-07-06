<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends MY_Model
{
	protected $table = 'user';

	public function getDefaultValues()
	{
		return [
			'email'    => '',
			'password' => '',
		];
	}

	public function getValidationRules()
	{
		return [
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			],
		];
	}

	public function run($input)
	{
		$user = $this->db->where('email', strtolower($input->email))->get($this->table)->row();

		if (!$user) return false;
		if (!hashEncryptVerify($input->password, $user->password)) return false;
		if ($user->role !== 'admin') return false;
		if ($user->is_active != 1) return false;

		$session_data = [
			'id_user' => $user->id_user,
			'email'   => $user->email,
			'name'    => $user->name,
			'role'    => $user->role,
			'is_login' => true
		];

		$this->session->set_userdata($session_data);
		return true;
	}
}
