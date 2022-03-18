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
                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Barang</a>
                </div>
                <div class="card-body">
                    <table class="table w-100 table-bordered table-hover" id="tblbarang">
                        <thead>
                            <tr>
                                <th style="text-align:center;width:40px;">No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Harga Pokok</th>
                                <th>Harga (Eceran)</th>
                                <th>Harga (Grosir)</th>
                                <th>Stok</th>
                                <th>Min Stok</th>
                                <th>Kategori</th>
                                <th style="width:100px;text-align:center;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 0;
                            // var_dump($data->result_array());
                            // die;
                            foreach ($data->result_array() as $a) :
                                $no++;
                                $id = $a['barang_id'];
                                $nm = $a['barang_nama'];
                                $satuan = $a['satuan_nama'];
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
                                    <td style="text-align:center;"><?php echo $satuan; ?></td>
                                    <td style="text-align:right;"><?php echo 'Rp ' . number_format($harpok); ?></td>
                                    <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                                    <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul_grosir); ?></td>
                                    <td style="text-align:center;"><?php echo $stok; ?></td>
                                    <td style="text-align:center;"><?php echo $min_stok; ?></td>
                                    <td><?php echo $kat_nama; ?></td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id ?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                                        <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id ?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span> Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Add -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('barang/tambah_barang') ?>">
                    <div class="form-group">
                        <label>Barcode</label>
                        <input name="barcode" class="form-control" type="text" placeholder="Barcode">
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input name="nabar" class="form-control" type="text" placeholder="Nama Barang" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control select2" style="width: 100%;" name="kategori">
                            <?php foreach ($kat->result_array() as $kt) { ?>
                                <option value="<?= $kt['kategori_id']; ?>"><?= $kt['kategori_nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Satuan</label>
                        <select class="form-control select2" style="width: 100%;" name="satuan">
                            <?php foreach ($sat->result_array() as $s) { ?>
                                <option value="<?= $s['satuan_id']; ?>"><?= $s['satuan_nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Supplier</label>
                        <select class="form-control select2" style="width: 100%;" name="suplier">
                            <?php foreach ($sup->result_array() as $s) { ?>
                                <option value="<?= $s['suplier_id']; ?>"><?= $s['suplier_nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga Pokok</label>
                        <input name="harpok" class="harpok form-control" type="text" placeholder="Harga Pokok">
                    </div>

                    <div class="form-group">
                        <label>Harga (Eceran)</label>
                        <input name="harjul" class="harjul form-control" type="text" placeholder="Harga Jual Eceran">
                    </div>

                    <div class="form-group">
                        <label>Harga (Grosir)</label>
                        <input name="harjul_grosir" class="harjul form-control" type="text" placeholder="Harga Jual Grosir">
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input name="stok" class="form-control" type="number" placeholder="Stok">
                    </div>

                    <div class="form-group">
                        <label>Minimal Stok</label>
                        <input name="min_stok" class="form-control" type="number" placeholder="Minimal Stok">
                    </div>

                    <button class="btn btn-sm btn-success">Simpan</button>
                    <button class="btn btn-sm btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Add -->

<!-- Modal Edit -->
<?php
foreach ($data->result_array() as $a) {
    $barcode = $a['barcode'];
    $id = $a['barang_id'];
    $nm = $a['barang_nama'];
    $satuan = $a['satuan_nama'];
    $harpok = $a['barang_harpok'];
    $harjul = $a['barang_harjul'];
    $harjul_grosir = $a['barang_harjul_grosir'];
    $stok = $a['barang_stok'];
    $min_stok = $a['barang_min_stok'];
    $kat_id = $a['barang_kategori_id'];
    $sat_id = $a['barang_satuan_id'];
    $kat_nama = $a['kategori_nama'];
    $sup_id = $a['barang_suplier_id'];
?>
    <div id="modalEditPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="<?= base_url('barang/edit_barang') ?>">
                        <input name="kobar" type="hidden" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label>Barcode</label>
                            <input name="barcode" value="<?= $barcode; ?>" class="form-control" type="text" placeholder="Barcode">
                        </div>

                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input name="nabar" value="<?= $nm; ?>" class="form-control" type="text" placeholder="Nama Barang" required>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control select2" style="width: 100%;" name="kategori">
                                <?php foreach ($kat->result_array() as $kt) {
                                    $id_kat = $kt['kategori_id'];
                                    $nm_kat = $kt['kategori_nama'];
                                    if ($id_kat == $kat_id) {
                                        echo "<option value='$id_kat' selected>$nm_kat</option>";
                                    } else {
                                        echo "<option value='$id_kat'>$nm_kat</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Suplier</label>
                            <select class="form-control select2" style="width: 100%;" name="suplier">
                                <?php foreach ($sup->result_array() as $s) {
                                    $id_sup = $s['suplier_id'];
                                    $nm_sup = $s['suplier_nama'];
                                    if ($id_sup == $sup_id) {
                                        echo "<option value='$id_sup' selected>$nm_sup</option>";
                                    } else {
                                        echo "<option value='$id_sup'>$nm_sup</option>";
                                    }
                                } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Satuan</label>
                            <select class="form-control select2" style="width: 100%;" name="satuan">
                                <?php foreach ($sat->result_array() as $s) {
                                    $id_sat = $s['satuan_id'];
                                    $nm_sat = $s['satuan_nama'];
                                    if ($id_sat == $sat_id) {
                                        echo "<option value='$id_sat' selected>$nm_sat</option>";
                                    } else {
                                        echo "<option value='$id_sat'>$nm_sat</option>";
                                    }
                                } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Harga Pokok</label>
                            <input name="harpok" value="<?= $harpok; ?>" class="harpok form-control" type="text" placeholder="Harga Pokok">
                        </div>

                        <div class="form-group">
                            <label>Harga (Eceran)</label>
                            <input name="harjul" value="<?= $harjul; ?>" class="harjul form-control" type="text" placeholder="Harga Jual Eceran">
                        </div>

                        <div class="form-group">
                            <label>Harga (Grosir)</label>
                            <input name="harjul_grosir" value="<?= $harjul_grosir; ?>" class="harjul form-control" type="text" placeholder="Harga Jual Grosir">
                        </div>

                        <!-- <div class="form-group">
                            <label>Stok</label>
                            <input name="stok" value="" class="form-control" type="number" placeholder="Stok">
                        </div> -->

                        <div class="form-group">
                            <label>Minimal Stok</label>
                            <input name="min_stok" value="<?= $min_stok; ?>" class="form-control" type="number" placeholder="Minimal Stok">
                        </div>

                        <button class="btn btn-sm btn-success">Simpan</button>
                        <button class="btn btn-sm btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Edit -->


<!-- Modal Hapus -->
<?php
foreach ($data->result_array() as $a) {
    $id = $a['barang_id'];
    $nm = $a['barang_nama'];
?>
    <div id="modalHapusPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Barang</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="<?= base_url('barang/hapus_barang') ?>">
                        <input type="hidden" name="kode" value="<?= $id; ?>">
                        <div class="modal-body">
                            <p>Hapus Data Barang <b><?php echo $nm; ?></b> ?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal Hapus -->


<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0-rc
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
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
<!-- Select2 -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
    $('#tblbarang').DataTable();
    //Initialize Select2 Elements
    // $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    // })
    var dataMSG = '<?= $this->session->flashdata('msgBarang'); ?>';
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
</body>

</html>