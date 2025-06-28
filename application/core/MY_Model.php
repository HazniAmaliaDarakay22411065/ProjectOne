<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $table      = '';
    protected $primaryKey = ''; // ditambahkan untuk menentukan kolom primary key
    protected $perPage    = 5;

    public function __construct()
    {
        parent::__construct();

        if (!$this->table) {
            $this->table = strtolower(
                str_replace('_model', '', get_class($this))
            );
        }

        // Jika primaryKey tidak ditentukan, pakai default id_namatable
        if (!$this->primaryKey) {
            $this->primaryKey = 'id_' . $this->table;
        }
    }

    public function validate()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters(
            '<small class="form-text text-danger">',
            '</small>'
        );

        $validationRules = $this->getValidationRules();
        $this->form_validation->set_rules($validationRules);

        return $this->form_validation->run();
    }

    public function select($columns)
    {
        $this->db->select($columns);
        return $this;
    }

    public function where($column, $condition)
    {
        $this->db->where($column, $condition);
        return $this;
    }

    public function like($column, $condition)
    {
        $this->db->like($column, $condition);
        return $this;
    }

    public function orLike($column, $condition)
    {
        $this->db->or_like($column, $condition);
        return $this;
    }

    public function join($table, $type = 'left')
    {
        $this->db->join($table, "$this->table.id_$table = $table.id", $type);
        return $this;
    }

    public function orderBy($column, $order = 'asc')
    {
        $this->db->order_by($column, $order);
        return $this;
    }

    public function limit($limit, $offset = 0)
    {
        $this->db->limit($limit, $offset);
        return $this;
    }

    public function first()
    {
        return $this->db->get($this->table)->row();
    }

    public function get()
    {
        return $this->db->get($this->table)->result();
    }

    public function count()
    {
        return $this->db->count_all_results($this->table);
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data = null)
    {
        if ($data === null) {
            // Jika hanya 1 parameter (chaining where sebelumnya)
            $data = $id;
            return $this->db->update($this->table, $data);
        } else {
            // 2 parameter: ID dan data
            return $this->db->update($this->table, $data, [$this->primaryKey => $id]);
        }
    }

    public function delete($id = null)
    {
        if ($id !== null) {
            $this->db->where($this->primaryKey, $id);
        }
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function paginate($page)
    {
        $this->db->limit(

            $this->perPage,
            $this->calculateRealOffset($page)
        );
        return $this;
    }

    public function calculateRealOffset($page)
    {
        return (is_null($page) || empty($page)) ? 0 : ($page * $this->perPage) - $this->perPage;
    }

    public function makePagination($baseUrl, $uriSegment, $totalRows = null)
    {
        $this->load->library('pagination');

        $config = [
            'base_url'        => $baseUrl,
            'uri_segment'     => $uriSegment,
            'per_page'        => $this->perPage,
            'total_rows'      => $totalRows,
            'use_page_numbers' => true,

            'full_tag_open'   => '<ul class="pagination">',
            'full_tag_close'  => '</ul>',
            'attributes'      => ['class' => 'page-link'],
            'first_link'      => false,
            'last_link'       => false,
            'prev_link'       => '&laquo',
            'next_link'       => '&raquo',
            'prev_tag_open'   => '<li class="page-item">',
            'prev_tag_close'  => '</li>',
            'next_tag_open'   => '<li class="page-item">',
            'next_tag_close'  => '</li>',
            'cur_tag_open'    => '<li class="page-item active"><a href="#" class="page-link">',
            'cur_tag_close'   => '<span class="sr-only">(current)</span></a></li>',
            'num_tag_open'    => '<li class="page-item">',
            'num_tag_close'   => '</li>',
        ];

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}
