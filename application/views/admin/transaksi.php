
                <div class="container-fluid">

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Barcode</label>
                    <div class="form-inline">
                        <select  id="barcode" class="form-control select2 col-sm-12" onchange="getNama()">
                          
                        </select>

                        <h2 class="ml-3 text-muted" id="nama_produk"></h2>
                    </div>  
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control col-sm-12" placeholder="Jumlah" id="jumlah" onkeyup="checkEmpty()">
                </div>

                <div class="form-group">
                    <div class="mb-0">
                        <b class="mr-2">Nota</b> <span id="nota"></span>
                    </div>
                    <span id="total" style="font-size: 80px; line-height: 1" class="text-danger">0</span>
                </div>
                <div class="form-group">

                    <button id="tambah" class="btn btn-success btn-lg btn-block" onclick="getHarga()" disabled>TAMBAH</button>
                    <button id="bayar" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#modal" disabled>BAYAR</button>

                    <!-- <button id="tambah" class="btn btn-success" onclick="getHarga()" disabled>Tambah</button>
                    <button id="bayar" class="btn btn-success" data-toggle="modal" data-target="#modal" disabled>Bayar</button> -->
                </div>
            </div>
            <!-- <div class="col-sm-6 d-flex justify-content-end text-right nota">
                <div>
                    <div class="mb-0">
                        <b class="mr-2">Nota</b> <span id="nota"></span>
                    </div>
                    <span id="total" style="font-size: 80px; line-height: 1" class="text-danger">0</span>
                </div>
            </div> -->

        </div>
    </div>
    <div class="card-body">
        <table class="table w-100 table-bordered table-hover" id="transaksi">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

</div><!-- /.container-fluid -->