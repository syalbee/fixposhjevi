<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        };
        $this->load->model('m_suplier');
    }

    public function index()
    {
        if ($this->session->userdata('akses') == '1') {

            $data = [
                'title' => "Supplier",
                'toko' => "Toko Hj Evi",
                'nama' => $this->session->userdata('nama'),
                'data' =>  $this->m_suplier->tampil_suplier()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/supplier', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }

    }

    public function tambah_suplier()
    {
        if ($this->session->userdata('akses') == '1') {
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $notelp = $this->input->post('notelp');
            $this->m_suplier->simpan_suplier($nama, $alamat, $notelp);
            echo $this->session->set_flashdata('msgSupplier', 'add');
            redirect('supplier');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function edit_suplier()
    {
        if ($this->session->userdata('akses') == '1') {
            $kode = $this->input->post('kode');
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $notelp = $this->input->post('notelp');
            $this->m_suplier->update_suplier($kode, $nama, $alamat, $notelp);
            echo $this->session->set_flashdata('msgSupplier', 'edit');
            redirect('supplier');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function hapus_suplier()
    {
        if ($this->session->userdata('akses') == '1') {
            $kode = $this->input->post('kode');
            $this->m_suplier->hapus_suplier($kode);
            echo $this->session->set_flashdata('msgSupplier', 'remove');
            redirect('supplier');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
}
