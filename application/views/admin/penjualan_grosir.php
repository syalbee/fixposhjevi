<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="card">

                <div class="card-header">
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#largeModal">Cari Barang</a>
                    <hr>
                    <form action="<?php echo base_url() . 'penjualan_grosir/add_to_cart' ?>" method="post">
                        <table>
                            <tr>
                                <th>Barcode</th>
                            </tr>
                            <tr>
                                <th><input style="width:160px;margin-right:5px;" type="text" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>
                            </tr>
                            <div id="detail_barang" style="position:absolute;">
                            </div>
                        </table>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table w-100 table-bordered table-hover" id="tblbarang">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th style="text-align:center;">Satuan</th>
                                <th style="text-align:center;">Harga(Rp)</th>
                                <th style="text-align:center;">Diskon(Rp)</th>
                                <th style="text-align:center;">Qty</th>
                                <th style="text-align:center;">Sub Total</th>
                                <th style="width:100px;text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($this->cart->contents() as $items) : ?>
                                <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                                <form action="<?= base_url('penjualan_grosir/remove'); ?>" method="POST">
                                    <tr>
                                        <input type="hidden" name="BRGiD" value="<?= $items['rowid']; ?>">
                                        <input type="hidden" name="BRGprice" value="<?= $items['amount']; ?>">
                                        <td><?= $items['id']; ?></td>
                                        <td><?= $items['name']; ?></td>
                                        <td style="text-align:center;"><?= $items['satuan']; ?></td>
                                        <td style="text-align:right;"><?php echo number_format($items['amount']); ?></td>
                                        <td><input type="text" name="ETdiskon" value="<?php echo $items['disc']; ?>" class="form-control input-sm" style="width:130px;margin-right:5px;" required></td>
                                        <td><input type="text" name="ETqty" value="<?php echo number_format($items['qty']); ?>" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
                                        <td style="text-align:right;"><?php echo number_format($items['subtotal']); ?></td>
                                        <td style="text-align:center;">
                                            <button type="submit" name="btn" value="btnedt" class="btn btn-warning btn-xs">Edt</button>
                                            <button type="submit" name="btn" value="btnhps" class="btn btn-danger btn-xs">Hps</button>
                                        </td>
                                    </tr>
                                </form>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <form action="<?= base_url('penjualan_grosir/simpan_penjualan'); ?>" method="POST">
                <table>
                    <tr>
                        <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-info btn-lg">Simpan</button></td>
                        <th style="width:140px;">Total Belanja(Rp)</th>
                        <th style="text-align:right;width:140px;"><input type="text" name="total2" value="<?php echo number_format($this->cart->total()); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                        <input type="hidden" id="total" name="total" value="<?php echo $this->cart->total(); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                    </tr>
                    <tr>
                        <th>Tunai(Rp)</th>
                        <th style="text-align:right;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                        <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                    </tr>
                    <tr>
                        <td></td>
                        <th>Kembalian(Rp)</th>
                        <th style="text-align:right;"><input type="text" id="kembalian" name="kembalian" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                    </tr>
                    <tr>
                        <td></td>
                        <th>Pelanggan</th>
                        <th style="text-align:right;"><input type="text" id="pelanggan" name="pelanggan" placeholder="Pelanggan ID" class="form-control input-sm" style="margin-bottom:5px;"></th>
                    </tr>
                </table>
            </form>
            <hr />
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h3 class="modal-title" id="myModalLabel">Data Barang Grosir</h3>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow:scroll;height:500px;">
                <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                    <thead>
                        <tr>
                            <th style="text-align:center;width:40px;">No</th>
                            <th style="width:120px;">Kode Barang</th>
                            <th style="width:240px;">Nama Barang</th>
                            <th>Satuan</th>
                            <th style="width:100px;">Harga (Grosir)</th>
                            <th>Stok</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data->result_array() as $a) :
                            $no++;
                            $barcode = $a['barcode'];
                            $id = $a['barang_id'];
                            $nm = $a['barang_nama'];
                            $satuan = $a['barang_satuan_id'];
                            $harpok = $a['barang_harpok'];
                            $harjul = $a['barang_harjul'];
                            $harjul_grosir = $a['barang_harjul_grosir'];
                            $stok = $a['barang_stok'];
                            $min_stok = $a['barang_min_stok'];
                            $kat_id = $a['barang_kategori_id'];
                            $kat_nama = $a['kategori_nama'];
                        ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $no; ?></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $nm; ?></td>
                                <td style="text-align:center;"><?= $this->db->query("SELECT satuan_nama FROM tbl_satuan WHERE satuan_id =". $satuan."")->result_array()[0]['satuan_nama']; ?></td>
                                <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul_grosir); ?></td>
                                <td style="text-align:center;"><?php echo $stok; ?></td>
                                <td style="text-align:center;">
                                    <form action="<?php echo base_url() . 'penjualan_grosir/add_to_cart' ?>" method="post">
                                        <input type="hidden" name="kode_brg" value="<?php echo $barcode ?>">
                                        <input type="hidden" name="nabar" value="<?php echo $nm; ?>">
                                        <input type="hidden" name="satuan" value="<?php echo $satuan; ?>">
                                        <input type="hidden" name="stok" value="<?php echo $stok; ?>">
                                        <input type="hidden" name="harjul" value="<?php echo number_format($harjul_grosir); ?>">
                                        <input type="hidden" name="diskon" value="0">
                                        <input type="hidden" name="qty" value="1" required>
                                        <button type="submit" class="btn btn-xs btn-info" title="Pilih"><span class="fa fa-edit"></span> Pilih</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Versi</b> 1.0.0
    </div>
    <strong><a href="<?= base_url('dashboard'); ?>"><?=  $this->db->get('tbl_toko')->result_array()[0]['nama']; ?></a></strong>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?php echo base_url() . 'assets/js/jquery.price_format.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/moment.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/js/bootstrap-datetimepicker.min.js' ?>"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
    var dataMSG = '<?= $token; ?>';
    console.log("Data" + dataMSG.length);

    if (dataMSG.length != 0) {
        if (dataMSG === "add") {
            Swal.fire("Sukses", "Sukses Menambah Barang", "success");
        } else if (dataMSG === "edit") {
            Swal.fire("Sukses", "Sukses Edit Barang", "success");
        } else if (dataMSG === "remove") {
            Swal.fire("Sukses", "Sukses Hapus Barang", "success");
        }
        dataMSG = "";
    }


</script>
<script type="text/javascript">
    $(function() {
        $('#jml_uang').on("input", function() {
            var total = $('#total').val();
            var jumuang = $('#jml_uang').val();
            var hsl = jumuang.replace(/[^\d]/g, "");
            $('#jml_uang2').val(hsl);
            $('#kembalian').val(hsl - total);
        })

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#mydata').DataTable();
    });
</script>
<script type="text/javascript">
    $(function() {
        $('.jml_uang').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('#jml_uang2').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ''
        });
        $('#kembalian').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
        $('.harjul').priceFormat({
            prefix: '',
            //centsSeparator: '',
            centsLimit: 0,
            thousandsSeparator: ','
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        //Ajax kabupaten/kota insert
        $("#kode_brg").focus();
        $("#kode_brg").on("input", function() {
            var kobar = {
                kode_brg: $(this).val()
            };
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'penjualan/get_barang'; ?>",
                data: kobar,
                success: function(msg) {
                    $('#detail_barang').html(msg);
                }
            });
        });

        $("#kode_brg").keypress(function(e) {
            if (e.which == 13) {
                $("#jumlah").focus();
            }
        });
    });
</script>


</body>

</html>