<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        };
        $this->load->model('m_kategori');
        $this->load->model('m_barang');
        $this->load->model('m_suplier');
        $this->load->model('m_pembelian');
        $this->load->model('m_penjualan');
        $this->load->model('m_laporan');
        $this->load->model('m_satuan');
    }


    public function index()
    {

        if ($this->session->userdata('akses') == '1') {
            $data = [
                'title' => "Laporan",
                'toko' => "Toko Hj Evi",
                'nama' => $this->session->userdata('nama'),
                'data' => $this->m_barang->tampil_barang(),
                'kat' => $this->m_kategori->tampil_kategori(),
                'jual_bln' => $this->m_laporan->get_bulan_jual(),
                'jual_thn' => $this->m_laporan->get_tahun_jual(),
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/laporan', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function lap_stok_barang()
    {
        $x['data'] = $this->m_laporan->get_stok_barang();
        $this->load->view('laporan/lap_stok_barang', $x);
    }

    public function lap_data_barang()
    {
        $x['data'] = $this->m_laporan->get_data_barang();
        $this->load->view('laporan/lap_data_barang', $x);
    }

    public function lap_data_penjualan()
    {
        $x['data'] = $this->m_laporan->get_data_penjualan();
        $x['jml'] = $this->m_laporan->get_total_penjualan();
        $this->load->view('laporan/lap_penjualan', $x);
    }

    public function lap_penjualan_pertanggal()
    {
        $tanggal = $this->input->post('tgl');
        $tanggal = date("Y-m-d", strtotime($tanggal)); 

        $x['jml'] = $this->m_laporan->get_data__total_jual_pertanggal($tanggal);
        $x['data'] = $this->m_laporan->get_data_jual_pertanggal($tanggal);
        $this->load->view('laporan/lap_jual_pertanggal', $x);
    }

    public function lap_penjualan_perbulan()
    {
        $bulan = $this->input->post('bln');
        $x['jml'] = $this->m_laporan->get_total_jual_perbulan($bulan);
        $x['data'] = $this->m_laporan->get_jual_perbulan($bulan);
        $this->load->view('laporan/lap_jual_perbulan', $x);
    }

    public function lap_penjualan_pertahun()
    {
        $tahun = $this->input->post('thn');
        $x['jml'] = $this->m_laporan->get_total_jual_pertahun($tahun);
        $x['data'] = $this->m_laporan->get_jual_pertahun($tahun);
        $this->load->view('laporan/lap_jual_pertahun', $x);
    }

    public function lap_laba_rugi()
    {
        $bulan = $this->input->post('bln');
        $x['jml'] = $this->m_laporan->get_total_lap_laba_rugi($bulan);
        $x['data'] = $this->m_laporan->get_lap_laba_rugi($bulan);
        $this->load->view('laporan/lap_laba_rugi', $x);
    }
}
