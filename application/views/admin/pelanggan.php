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
                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Pelanggan</a>
                </div>
                <div class="card-body">
                    <table class="table w-100 table-bordered table-hover" id="tblpelanggan">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>NIK</th>
                                <th>Point</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($data->result_array() as $a) :
                                $no++;
                                $id = $a['kode'];
                                $nm = $a['nama'];
                                $alamat = $a['alamat'];
                                $telepon = $a['notelp'];
                                $nik = $a['nik'];
                                $point = $a['point'];
                            ?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $id; ?></td>
                                    <td><?php echo $nm; ?></td>
                                    <td><?php echo $alamat; ?></td>
                                    <td><?php echo $telepon; ?></td>
                                    <td><?php echo $nik; ?></td>
                                    <td style="text-align:center;"><?php echo $point; ?></td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id ?>" data-toggle="modal" title="Edit">Edit</a>
                                        <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id ?>" data-toggle="modal" title="Hapus">Hapus</a>
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
                <h5 class="modal-title">Tambah Data</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="<?= base_url('pelanggan/tambah_pelanggan') ?>">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control" placeholder="Telepon" name="telepon" required>
                    </div>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" maxlength="16" placeholder="NIK" name="nik">
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
    $id = $a['kode'];
    $nm = $a['nama'];
    $alamat = $a['alamat'];
    $telepon = $a['notelp'];
    $nik = $a['nik'];
    $point = $a['point'];
?>
    <div id="modalEditPelanggan<?= $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="<?= base_url('pelanggan/edit_pelanggan') ?>">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="<?= $nm; ?>" placeholder="Nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="<?= $alamat; ?>" placeholder="Alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" class="form-control" value="<?= $telepon; ?>" placeholder="Telepon" name="telepon" required>
                        </div>
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control" value="<?= $nik; ?>" maxlength="16" placeholder="NIK" name="nik">
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
    $id = $a['kode'];
    $nm = $a['nama'];
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
                    <form class="form-horizontal" method="post" action="<?= base_url('pelanggan/hapus_pelanggan') ?>">
                        <input type="hidden" name="id" value="<?= $id; ?>">
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
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

<script type="text/javascript">
    $('#tblpelanggan').DataTable();
    var dataMSG = '<?= $this->session->flashdata('msgPelanggan'); ?>';
    console.log("Data" + dataMSG.length);

    if (dataMSG.length != 0) {
        if (dataMSG === "add") {
            Swal.fire("Sukses", "Sukses Menambah Pelanggan", "success");
        } else if (dataMSG === "edit") {
            Swal.fire("Sukses", "Sukses Edit Pelanggan", "success");
        } else if (dataMSG === "remove") {
            Swal.fire("Sukses", "Sukses Hapus Pelanggan", "success");
        }
        dataMSG = "";
    }
</script>
</body>

</html>