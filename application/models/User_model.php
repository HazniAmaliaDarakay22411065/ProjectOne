<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends MY_Model
{
	protected $table = 'user';
	protected $primaryKey = 'id_user';

	public function getDefaultValues()
	{
		return [
			'name'      => '',
			'email'     => '',
			'password'  => '',
			'role'      => 'admin',
			'is_active' => 1
		];
	}

	public function getValidationRules($isEdit = false)
	{
		$rules = [
			[
				'field' => 'name',
				'label' => 'Nama Lengkap',
				'rules' => 'required|trim'
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => $isEdit
					? 'required|trim|valid_email'
					: 'required|trim|valid_email|is_unique[user.email]'
			],
			[
				'field' => 'role',
				'label' => 'Role',
				'rules' => 'required|in_list[admin]'
			],
			[
				'field' => 'is_active',
				'label' => 'Status',
				'rules' => 'required|in_list[0,1]'
			]
		];

		if (!$isEdit || ($isEdit && !empty($this->input->post('password')))) {
			$rules[] = [
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|min_length[6]'
			];
		}

		return $rules;
	}
}
