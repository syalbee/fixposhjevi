<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        };
        $this->load->model('m_pelanggan');
    }

    public function index()
    {
        if ($this->session->userdata('akses') == '1') {

            $data = [
                'title' => "Pelanggan",
                'toko' => "Toko Hj Evi",
                'nama' => $this->session->userdata('nama'),
                'data' =>  $this->m_pelanggan->get_pelanggan()
            ];

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/pelanggan', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function tambah_pelanggan()
    {
        if ($this->session->userdata('akses') == '1') {
            $data = array(
                'kode' => $this->_generateKodepelanggan(),
                'nama' => $this->input->post('nama'),
                'notelp' => $this->input->post('telepon'),
                'alamat' => $this->input->post('alamat'),
                'nik' => $this->input->post('nik'),
                'active' => '1',
                'point' => 0
            );

            $this->m_pelanggan->simpanPelanggan($data);
            echo $this->session->set_flashdata('msgPelanggan', 'add');
            redirect('pelanggan');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    public function edit_pelanggan()
    {
        if ($this->session->userdata('akses') == '1') {
            $id = $this->input->post('id');
            $data = array(
                'nama' => $this->input->post('nama'),
                'notelp' => $this->input->post('telepon'),
                'alamat' => $this->input->post('alamat'),
                'nik' => $this->input->post('nik'),
            );

            $this->m_pelanggan->update($id, $data);
            echo $this->session->set_flashdata('msgPelanggan', 'edit');
            redirect('pelanggan');
        } else {
            echo "Halaman tidak ditemukan";
        } 
    }

    public function hapus_pelanggan()
    {
        if ($this->session->userdata('akses') == '1') {
            $id = $this->input->post('id');

            $data = array(
                'active' => '0',
            );

            $this->m_pelanggan->update($id, $data);
            echo $this->session->set_flashdata('msgPelanggan', 'remove');
            redirect('pelanggan');
        }
    }

    private function _generateKodepelanggan()
    {

        $this->db->select('RIGHT(kode,4) as kode', false);
        $this->db->order_by("kode", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('tbl_member');

        if ($query->num_rows() <> 0) {

            $data       = $query->row();
            $kodepelanggan  = intval($data->kode) + 1;
        } else {
            $kodepelanggan  = 1;
        }

        $lastKode = str_pad($kodepelanggan, 4, "0", STR_PAD_LEFT);
        $tahun    = date("y");
        $PLG      = "PLG";

        $newKode  = $PLG . $tahun . $lastKode;

        return $newKode;
    }
}
