let url,
  barang = $("#barang").DataTable({
    responsive: !0,
    scrollX: !0,
    ajax: BRGreadUrl,
    columnDefs: [{ searcable: !1, orderable: !1, targets: 0 }],
    order: [[1, "asc"]],
    columns: [
      { data: "barcode" },
      { data: "supplier" },
      { data: "nama" },
      { data: "satuan" },
      { data: "qty" },
      { data: "Hjual" },
      { data: "Hmodal" },
      { data: "action" },
    ],
  });

function reloadTable() {
    barang.ajax.reload();
}

function addData() {
  $.ajax({
    url: BRGaddUrl,
    type: "post",
    dataType: "json",
    data: $("#BRGaddform").serialize(),
    success: (res) => {
      // $(".modal").modal("hide"),
      Swal.fire("Sukses", "Sukses Menambahkan Data", "success"),
        window.location.href = BRGlisturl;
      // console.log(res);
    },
    error: (a) => {
      console.log(a);
    },
  });
}

function editData() {
  $.ajax({
    url: BRGeditUrl,
    type: "post",
    dataType: "json",
    data: $("#BRGformedit").serialize(),
    success: () => {
      $(".modal").modal("hide"),
        Swal.fire("Sukses", "Sukses Mengedit Data", "success"),
        window.location.href = BRGlisturl;
    },
    error: (a) => {
      console.log(a);
    },
  });
}

function edit(a) {
  $.ajax({
    url: BRGget_barangUrl,
    type: "post",
    dataType: "json",
    data: { id: a },
    success: (a) => {
      // console.log(a);
      $('[name="id"]').val(a.id),
        $('[name="EtBarcode"]').val(a.barcode),
        $('[name="EtNama"]').val(a.nama),
        $('[name="EtHjual"]').val(a.hrg_jual),
        $('[name="EtHbeli"]').val(a.hrg_modal),
        $(".modal").modal("show"),
        $(".modal-title").html("Edit Data"),
        $('.modal button[name="SPEdtbtn"]').html("Edit"),
        (url = "edit");
    },
    error: (a) => {
      console.log(a);
    },
  });
}

function remove(a) {
  Swal.fire({
    title: "Hapus",
    text: "Hapus data ini?",
    type: "warning",
  }).then(() => {
    $.ajax({
      url: BRGremoveUrl,
      type: "post",
      dataType: "json",
      data: { id: a },
      success: () => {
        Swal.fire("Sukses", "Sukses Menghapus Data", "success"),
          window.location.href = BRGlisturl;
      },
      error: (a) => {
        console.log(a);
      },
    });
  });
}
