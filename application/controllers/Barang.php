<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        };
        $this->load->model('m_satuan');
        $this->load->model('m_kategori');
        $this->load->model('m_barang');
        $this->load->model('m_suplier');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {

        if ($this->session->userdata('akses') == '1') {
            $data = [
                'title' => "Barang",
                'toko' => "Toko Hj Evi",
                'nama' => $this->session->userdata('nama'),
                'data' => $this->m_barang->tampil_barang(),
                'kat' => $this->m_kategori->tampil_kategori(),
                'kat2' => $this->m_kategori->tampil_kategori(),
                'sat' => $this->m_satuan->tampil_satuan(),
                'sup' => $this->m_suplier->tampil_suplier()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/barang', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function tambah_barang()
    {
        if ($this->session->userdata('akses') == '1') {
            $kobar = $this->m_barang->get_kobar();
            $barcode = $this->input->post('barcode');
            $suplier = $this->input->post('suplier');
            $nabar = $this->input->post('nabar');
            $kat = $this->input->post('kategori');
            $satuan = $this->input->post('satuan');
            $harpok = str_replace(',', '', $this->input->post('harpok'));
            $harjul = str_replace(',', '', $this->input->post('harjul'));
            $harjul_grosir = str_replace(',', '', $this->input->post('harjul_grosir'));
            $stok = $this->input->post('stok');
            $min_stok = $this->input->post('min_stok');
            $this->m_barang->simpan_barang($kobar, $barcode, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok, $suplier);
            echo $this->session->set_flashdata('msgBarang', 'add');
            redirect('barang');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function edit_barang()
    {
        if ($this->session->userdata('akses') == '1') {
            $kobar = $this->input->post('kobar');
            $barcode = $this->input->post('barcode');
            $suplier = $this->input->post('suplier');
            $nabar = $this->input->post('nabar');
            $kat = $this->input->post('kategori');
            $satuan = $this->input->post('satuan');
            $harpok = str_replace(',', '', $this->input->post('harpok'));
            $harjul = str_replace(',', '', $this->input->post('harjul'));
            $harjul_grosir = str_replace(',', '', $this->input->post('harjul_grosir'));
            // $stok = $this->input->post('stok');
            $min_stok = $this->input->post('min_stok');
            $this->m_barang->update_barang($kobar, $barcode, $nabar, $kat, $satuan, $harpok, $harjul, $harjul_grosir, $min_stok, $suplier);
            echo $this->session->set_flashdata('msgBarang', 'edit');
            redirect('barang');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function hapus_barang()
    {
        if ($this->session->userdata('akses') == '1') {
            $kode = $this->input->post('kode');
            $this->m_barang->hapus_barang($kode);
            echo $this->session->set_flashdata('msgBarang', 'remove');
            redirect('barang');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
}
