<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{

    public function hapus_barang($kode)
    {
        $hsl = $this->db->query("DELETE FROM tbl_barang where barang_id='$kode'");
        return $hsl;
    }

    public function update_barang($kobar, $barcode, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok)
    {
        $user_id = $this->session->userdata('idadmin');
        $hsl = $this->db->query("UPDATE tbl_barang SET barang_nama='$nabar', barang_satuan_id='$satuan', barcode = '$barcode', barang_harpok='$harpok',barang_harjul='$harjul',barang_harjul_grosir='$harjul_grosir',barang_stok='$stok',barang_min_stok='$min_stok',barang_tgl_last_update=NOW(),barang_kategori_id='$kat',barang_user_id='$user_id' WHERE barang_id='$kobar'");
        return $hsl;
    }

    public function tampil_barang()
    {
        $hsl = $this->db->query("SELECT tbl_barang.*, tbl_kategori.`kategori_nama`, tbl_satuan.`satuan_nama`
        FROM tbl_barang JOIN tbl_kategori ON tbl_barang.`barang_kategori_id` = tbl_kategori.`kategori_id` 
        JOIN tbl_satuan ON tbl_satuan.`satuan_id` = tbl_barang.`barang_satuan_id`");
        return $hsl;
    }

    public function simpan_barang($kobar,$barcode, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok)
    {
        $user_id = $this->session->userdata('idadmin');
        $hsl = $this->db->query("INSERT INTO tbl_barang (barang_id, barcode, barang_nama,barang_satuan_id,barang_harpok,barang_harjul,barang_harjul_grosir,barang_stok,barang_min_stok,barang_kategori_id,barang_user_id) VALUES ('$kobar', '$barcode' ,'$nabar','$satuan','$harpok','$harjul','$harjul_grosir','$stok','$min_stok','$kat','$user_id')");
        return $hsl;
    }


    public function get_barang($kobar)
    {
        $hsl = $this->db->query("SELECT tbl_barang.*, tbl_satuan.`satuan_nama` AS barang_satuan FROM tbl_barang JOIN tbl_satuan ON tbl_barang.`barang_satuan_id` = tbl_satuan.`satuan_id` WHERE barcode='$kobar'");
        return $hsl;
    }

    public function get_kobar()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(barang_id,6)) AS kd_max FROM tbl_barang");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        return "BR" . $kd;
    }
}
