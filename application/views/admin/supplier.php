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
                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Supplier</a>
                </div>
                <div class="card-body">
                    <table class="table w-100 table-bordered table-hover" id="tblsupplier">
                        <thead>
                            <tr>
                                <th style="text-align:center;width:40px;">No</th>
                                <th>Nama Suplier</th>
                                <th>Alamat</th>
                                <th>No Telp/HP</th>
                                <th style="width:140px;text-align:center;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($data->result_array() as $a) :
                                $no++;
                                $id = $a['suplier_id'];
                                $nm = $a['suplier_nama'];
                                $alamat = $a['suplier_alamat'];
                                $notelp = $a['suplier_notelp'];
                            ?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $no; ?></td>
                                    <td><?php echo $nm; ?></td>
                                    <td><?php echo $alamat; ?></td>
                                    <td><?php echo $notelp; ?></td>
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
                <h5 class="modal-title">Tambah Supplier</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="<?= base_url('supplier/tambah_suplier') ?>">
                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control" placeholder="Telepon" name="notelp" required>
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
    $id = $a['suplier_id'];
    $nm = $a['suplier_nama'];
    $alamat = $a['suplier_alamat'];
    $notelp = $a['suplier_notelp'];
?>
    <div id="modalEditPelanggan<?= $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Supplier</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'supplier/edit_suplier' ?>">
                        <div class="modal-body">
                            <input name="kode" type="hidden" value="<?php echo $id; ?>">

                            <label class="control-label col-xs-3">Nama Suplier</label>
                            <div class="col-xs-9">
                                <input name="nama" class="form-control" type="text" placeholder="Nama Suplier..." value="<?php echo $nm; ?>" style="width:280px;" required>
                            </div>

                            <label class="control-label col-xs-3">Alamat</label>
                            <div class="col-xs-9">
                                <input name="alamat" class="form-control" type="text" placeholder="Alamat..." value="<?php echo $alamat; ?>" style="width:280px;" required>
                            </div>

                            <label class="control-label col-xs-3">No Telp/ HP</label>
                            <div class="col-xs-9">
                                <input name="notelp" class="form-control" type="text" placeholder="No Telp/HP..." value="<?php echo $notelp; ?>" style="width:280px;" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-sm btn-success">Simpan</button>
                            <button class="btn btn-sm btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        </div>
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
    $id = $a['suplier_id'];
    $nm = $a['suplier_nama'];
?>
    <div id="modalHapusPelanggan<?php echo $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Pelanggan</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="<?= base_url('supplier/hapus_suplier') ?>">
                        <input type="hidden" name="kode" value="<?= $id; ?>">
                        <div class="modal-body">
                            <p>Hapus Data Pelanggan <b><?php echo $nm; ?></b> ?</p>
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
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

<script type="text/javascript">
    $('#tblsupplier').DataTable();
    var dataMSG = '<?= $this->session->flashdata('msgSupplier'); ?>';
    console.log("Data" + dataMSG.length);

    if (dataMSG.length != 0) {
        if (dataMSG === "add") {
            Swal.fire("Sukses", "Sukses Menambah Supplier", "success");
        } else if (dataMSG === "edit") {
            Swal.fire("Sukses", "Sukses Edit Supplier", "success");
        } else if (dataMSG === "remove") {
            Swal.fire("Sukses", "Sukses Hapus Supplier", "success");
        }
        dataMSG = "";
    }
</script>
</body>

</html>