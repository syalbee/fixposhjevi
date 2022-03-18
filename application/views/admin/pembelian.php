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

                    <form action="<?php echo base_url('pembelian/add_to_cart') ?>" method="post">
                        <table>
                            <tr>
                                <th style="width:100px;padding-bottom:5px;">No Faktur</th>
                                <th style="width:300px;padding-bottom:5px;"><input type="text" name="nofak" value="<?php echo $this->session->userdata('nofak'); ?>" class="form-control input-sm" style="width:200px;" required></th>
                                <th style="width:90px;padding-bottom:5px;">Suplier</th>
                                <td style="width:350px;">
                                    <select name="suplier" class="form-control select2" style="width: 100%;" required>
                                        <?php foreach ($sup->result_array() as $i) {
                                            $id_sup = $i['suplier_id'];
                                            $nm_sup = $i['suplier_nama'];
                                            $al_sup = $i['suplier_alamat'];
                                            $notelp_sup = $i['suplier_notelp'];
                                            $sess_id = $this->session->userdata('suplier');
                                            if ($sess_id == $id_sup)
                                                echo "<option value='$id_sup' selected>$nm_sup - $al_sup - $notelp_sup</option>";
                                            else
                                                echo "<option value='$id_sup'>$nm_sup - $al_sup - $notelp_sup</option>";
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>
                                    <div class='input-group date' id='datepicker' style="width:200px;">
                                        <input type='text' name="tgl" class="form-control" value="<?php echo $this->session->userdata('tglfak'); ?>" placeholder="Tanggal..." required />
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                   
                                </td>
                            </tr>
                        </table>
                        <hr>
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

                    <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th style="text-align:center;">Satuan</th>
                                <th style="text-align:center;">Harga Pokok</th>
                                <th style="text-align:center;">Harga Jual</th>
                                <th style="text-align:center;">Jumlah Beli</th>
                                <th style="text-align:center;">Sub Total</th>
                                <th style="width:100px;text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($this->cart->contents() as $items) : ?>
                                <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                                <tr>
                                    <td><?= $items['id']; ?></td>
                                    <td><?= $items['name']; ?></td>
                                    <td style="text-align:center;"><?= $items['satuan']; ?></td>
                                    <td style="text-align:right;"><?php echo number_format($items['price']); ?></td>
                                    <td style="text-align:right;"><?php echo number_format($items['harga']); ?></td>
                                    <td style="text-align:center;"><?php echo number_format($items['qty']); ?></td>
                                    <td style="text-align:right;"><?php echo number_format($items['subtotal']); ?></td>
                                    <td style="text-align:center;"><a href="<?php echo base_url() . 'admin/pembelian/remove/' . $items['rowid']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" style="text-align:center;">Total</td>
                                <td style="text-align:right;">Rp. <?php echo number_format($this->cart->total()); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <br>
                    <a href="<?php echo base_url('pembelian/simpan_pembelian') ?>" class="btn btn-info btn-lg"><span class="fa fa-save"></span> Simpan</a>
                </div>
            </div>

            <hr />
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
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
<!-- <script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js') ?>"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
    var dataMSG = '<?= $this->session->flashdata('msg'); ?>';
    console.log("Data" + dataMSG);

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
    //Date picker
    // $.datetimepicker.setLocale('id');
    // $('#reservationdate').datetimepicker({
    //     format: 'L'
    // });

    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    $(function() {
        $('#datetimepicker').datetimepicker({
            format: 'DD MMMM YYYY HH:mm',
        });

        $('#datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#datepicker2').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('#timepicker').datetimepicker({
            format: 'HH:mm'
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('.harpok').priceFormat({
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
        $("#kode_brg").keyup(function() {
            var kobar = {
                kode_brg: $(this).val()
            };
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'pembelian/get_barang'; ?>",
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