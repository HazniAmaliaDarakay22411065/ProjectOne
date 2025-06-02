<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Visi_misi_model extends MY_Model
{
    public function getDefaultValues()
    {
        return [

            'kategori'  => '',
            'isi'       => ''
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [

            [
                'field'    => 'kategori',
                'label'    => 'Kategori',
                'rules'    => 'required'
            ],
            [
                'field' => 'isi',
                'label' => 'Deskripsi',
                'rules' => 'trim|required'
            ],
        ];

        return $validationRules;
    }
}
