<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_grosir extends CI_Controller
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
		$this->load->model('m_penjualan');
		$this->load->model('m_pelanggan');
	}

	public function index()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$data = [
				'title' => "Penjualan Grosir",
				'toko' => "Toko Hj Evi",
				'nama' => $this->session->userdata('nama'),
				'data' => $this->m_barang->tampil_barang(),
			];

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('admin/penjualan_grosir', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	public function get_barang()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$kobar = $this->input->post('kode_brg');
			$x['brg'] = $this->m_barang->get_barang($kobar);
			$this->load->view('penjualan/v_detail_barang_jual_grosir', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	public function add_to_cart()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$kobar = $this->input->post('kode_brg');
			$produk = $this->m_barang->get_barang($kobar);
			$i = $produk->row_array();
			$data = array(
				'id'       => $i['barang_id'],
				'name'     => $i['barang_nama'],
				'satuan'   => $i['barang_satuan'],
				'harpok'   => $i['barang_harpok'],
				'price'    => str_replace(",", "", $this->input->post('harjul')) - $this->input->post('diskon'),
				'disc'     => $this->input->post('diskon'),
				'qty'      => $this->input->post('qty'),
				'amount'	=> str_replace(",", "", $this->input->post('harjul'))
			);
			if (!empty($this->cart->total_items())) {
				foreach ($this->cart->contents() as $items) {
					$id = $items['id'];
					$qtylama = $items['qty'];
					$rowid = $items['rowid'];
					$kobar = $this->input->post('kode_brg');
					$qty = $this->input->post('qty');
					if ($id == $kobar) {
						$up = array(
							'rowid' => $rowid,
							'qty' => $qtylama + $qty
						);
						$this->cart->update($up);
					} else {
						$this->cart->insert($data);
					}
				}
			} else {
				$this->cart->insert($data);
			}

			redirect('penjualan_grosir');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	public function remove()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$row_id = $this->input->post('BRGiD');
			if ($this->input->post('btn') === 'btnhps') {

				$this->cart->update(array(
					'rowid'      => $row_id,
					'qty'     => 0
				));
				redirect('penjualan');
			} else if ($this->input->post('btn') === 'btnedt') {

				$qty = $this->input->post('ETqty');
				$diskon = $this->input->post('ETdiskon');
				$price = $this->input->post('BRGprice');
				$this->cart->update(array(
					'rowid' => $row_id,
					'qty' => $qty,
					'price' => $price - $diskon,
					'disc' => $diskon
				));
				redirect('penjualan');
			}
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	public function simpan_penjualan()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$total = $this->input->post('total');
			
			if (!empty($this->input->post('pelanggan')) || $this->input->post('pelanggan') != "" || $this->input->post('pelanggan') != null) {
				$this->db->where('kode', $this->input->post('pelanggan'));
				$pelanggan = $this->db->get('tbl_member')->result_array()[0]['id'];
				$this->setPoint($this->input->post('pelanggan'), $total);
			} else {
				$pelanggan = false;
			}

			$jml_uang = str_replace(",", "", $this->input->post('jml_uang'));
			$kembalian = $jml_uang - $total;
			if (!empty($total) && !empty($jml_uang)) {
				if ($jml_uang < $total) {
					echo $this->session->set_flashdata('msg', '<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
					redirect('penjualan_grosir');
				} else {
					$nofak = $this->m_penjualan->get_nofak();
					$this->session->set_userdata('nofak', $nofak);
					$order_proses = $this->m_penjualan->simpan_penjualan_grosir($nofak, $total, $jml_uang, $kembalian, $pelanggan);
					if ($order_proses) {
						$this->cart->destroy();

						$this->session->unset_userdata('tglfak');
						$this->session->unset_userdata('suplier');
						$this->session->set_flashdata('msgpenjualan', $nofak);
						
						// redirect('cetak/struk/' . $nofak);
						$data = [
							'title' => "Penjualan Grosir",
							'toko' => "Toko Hj Evi",
							'nama' => $this->session->userdata('nama'),
							'token' => $nofak,
                            'jenis' => 'grosir'
						];
						$this->load->view('template/header', $data);
						$this->load->view('template/sidebar', $data);
						$this->load->view('penjualan/alert_sukses', $data);
						// $this->load->view('admin/alert/alert_sukses');
						
					} else {
						redirect('penjualan_grosir');
					}
				}
			} else {
				echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
				redirect('penjualan_grosir');
			}
		} else {
			echo "Halaman tidak ditemukan";
		}
	}


	private function setPoint($id, $totalBelanja)
    {
        $pelanggan = $this->m_pelanggan->getPoint($id);
        $toko =  $this->db->get('tbl_toko')->row();

        $point = $pelanggan->point;
        $minUang = $toko->jumUang;
        $pointKelipatan = round($totalBelanja / $minUang);

        if ($totalBelanja >= $minUang) {
            $hasilPoint = $toko->point * $pointKelipatan;
            $this->m_pelanggan->setPoint($id, $hasilPoint + $point);
        }
    }

}
