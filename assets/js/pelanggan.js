let url,
  pelanggan = $("#pelanggan").DataTable({
    responsive: !0,
    scrollX: !0,
    ajax: PLreadUrl,
    columnDefs: [{ searcable: !1, orderable: !1, targets: 0 }],
    order: [[1, "asc"]],
    columns: [
      { data: "kode" },
      { data: "nama" },
      { data: "alamat" },
      { data: "telepon" },
      { data: "nik" },
      { data: "point" },
      { data: "action" },
    ],
  });

function reloadTable() {
  pelanggan.ajax.reload();
}

function addData() {
  $.ajax({
    url: PLaddUrl,
    type: "post",
    dataType: "json",
    data: $("#PLaddform").serialize(),
    success: (res) => {
      // $(".modal").modal("hide"),
      Swal.fire("Sukses", "Sukses Menambahkan Data", "success"),
        (window.location.href = PLlisturl);
      // console.log(res);
    },
    error: (a) => {
      console.log(a);
    },
  });
}

function editData() {
  $.ajax({
    url: PLeditUrl,
    type: "post",
    dataType: "json",
    data: $("#PLformedit").serialize(),
    success: () => {
      $(".modal").modal("hide"),
        Swal.fire("Sukses", "Sukses Mengedit Data", "success"),
        (window.location.href = PLlisturl);
    },
    error: (a) => {
      console.log(a);
    },
  });
}

function edit(a) {
  $.ajax({
    url: PLget_pelangganUrl,
    type: "post",
    dataType: "json",
    data: { id: a },
    success: (a) => {
      // console.log(a);
      $('[name="id"]').val(a.id),
        $('[name="nama"]').val(a.nama),
        $('[name="alamat"]').val(a.alamat),
        $('[name="telepon"]').val(a.notelp),
        $('[name="nik"]').val(a.nik),
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
      url: PLremoveUrl,
      type: "post",
      dataType: "json",
      data: { id: a },
      success: () => {
        Swal.fire("Sukses", "Sukses Menghapus Data", "success"),
          (window.location.href = PLlisturl);
      },
      error: (a) => {
        console.log(a);
      },
    });
  });
}
