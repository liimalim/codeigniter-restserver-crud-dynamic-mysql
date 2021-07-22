<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Data extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get($table, $id)
    {
        return $this->db
                    ->from($table)
                    ->where('id', $id)
                    ->get()->result();
    }
    public function gets($table)
    {
        return $this->db
                    ->get($table)
                    ->result();
    }
    public function set($table, $data)
    {
        return $this->db->insert($table, $data);
    }
    public function update($table, $data, $key, $column = "id")
    {
        return $this->db->where($column, $key)->update($table, $data);
    }
    
    public function delete($table, $id)
    {
        return $this->db->where('id', $id)->delete($table);
    }
}
 