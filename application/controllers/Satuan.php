<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        };

        $this->load->model('m_satuan');
    }

    public function index()
    {
        if ($this->session->userdata('akses') == '1') {

            $data = [
                'title' => "Satuan",
                'toko' => "Toko Hj Evi",
                'nama' => $this->session->userdata('nama'),
                'data' =>  $this->m_satuan->tampil_satuan()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/satuan', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function tambah_satuan()
    {
        if ($this->session->userdata('akses') == '1') {
            $kat = $this->input->post('satuan');
            $this->m_satuan->simpan_satuan($kat);
            echo $this->session->set_flashdata('msgSatuan', 'add');
            redirect('satuan');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function edit_satuan()
    {
        if ($this->session->userdata('akses') == '1') {
            $kode = $this->input->post('kode');
            $kat = $this->input->post('satuan');
            $this->m_satuan->update_satuan($kode, $kat);
            echo $this->session->set_flashdata('msgSatuan', 'edit');
            redirect('satuan');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function hapus_satuan()
    {
        if ($this->session->userdata('akses') == '1') {
            $kode = $this->input->post('kode');
            $this->m_satuan->hapus_satuan($kode);
            echo $this->session->set_flashdata('msgSatuan', 'remove');
            redirect('satuan');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function coba()
    {
        $this->db->where('jual_nofak', '170322000007');
        $produk = $this->db->get('tbl_jual')->result();
        // var_dump($produk[0]->d_jual_barang_nama);
        // echo $produk['d_jual_barang_nama'];
        echo $produk[0]->jual_member_id;

        if (empty($produk[0]->jual_member_id)) {
            echo "cek";
        }
        // foreach ($produk as $key) {
        //     echo $key->d_jual_barang_nama . "  \n";
        //     // var_dump($key);
        // }
    }
}
