<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_satuan extends CI_Model
{

    function hapus_satuan($kode)
    {
        $hsl = $this->db->query("DELETE FROM tbl_satuan where satuan_id ='$kode'");
        return $hsl;
    }

    function update_satuan($kode, $kat)
    {
        $hsl = $this->db->query("UPDATE tbl_satuan set satuan_nama='$kat' where satuan_id='$kode'");
        return $hsl;
    }

    function tampil_satuan()
    {
        return $this->db->get('tbl_satuan');
    }

    function simpan_satuan($kat)
    {
        $hsl = $this->db->query("INSERT INTO tbl_satuan(satuan_nama) VALUES ('$kat')");
        return $hsl;
    }
}
