<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pelanggan extends CI_Model
{
    private $table = 'tbl_member';

    function get_pelanggan()
    {
        $hsl = $this->db->query("SELECT * FROM tbl_member WHERE active = '1' ");
        return $hsl;
    }

    public function simpanPelanggan($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('kode', $id);
        return $this->db->update($this->table, $data);
    }

    public function getPelanggan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }

    public function getPoint($id)
    {
        $this->db->select('point');
        $this->db->where('kode', $id);
        return $this->db->get($this->table)->row();
    }

    public function setPoint($id, $data)
    {
        $this->db->set('point', $data);
        $this->db->where('kode', $id);
        return $this->db->update($this->table);
    }

    public function cariPoint($id)
    {
        $this->db->select('nama, point');
        $this->db->where('kode', $id);
        return $this->db->get($this->table)->row();
    }

    public function updatePoint($id, $data)
    {
        $this->db->where('kode', $id);
        return $this->db->update($this->table, $data);
    }
}
