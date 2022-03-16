let url,
  pelanggan = $("#supplier").DataTable({
    responsive: !0,
    scrollX: !0,
    ajax: SPreadUrl,
    columnDefs: [{ searcable: !1, orderable: !1, targets: 0 }],
    order: [[1, "asc"]],
    columns: [
      { data: "no" },
      { data: "kode" },
      { data: "nama" },
      { data: "alamat" },
      { data: "telepon" },
      { data: "action" },
    ],
  });

function reloadTable() {
    pelanggan.ajax.reload();
}

function addData() {
  $.ajax({
    url: SPaddUrl,
    type: "post",
    dataType: "json",
    data: $("#SPaddform").serialize(),
    success: (res) => {
      // $(".modal").modal("hide"),
      Swal.fire("Sukses", "Sukses Menambahkan Data", "success"),
        (window.location.href = SPlisturl);
      // console.log(res);
    },
    error: (a) => {
      console.log(a);
    },
  });
}

function editData() {
  $.ajax({
    url: SPeditUrl,
    type: "post",
    dataType: "json",
    data: $("#SPformedit").serialize(),
    success: () => {
      $(".modal").modal("hide"),
        Swal.fire("Sukses", "Sukses Mengedit Data", "success"),
        (window.location.href = SPlisturl);
    },
    error: (a) => {
      console.log(a);
    },
  });
}

function edit(a) {
  $.ajax({
    url: SPget_supplierUrl,
    type: "post",
    dataType: "json",
    data: { id: a },
    success: (a) => {
      // console.log(a);
      $('[name="id"]').val(a.id),
        $('[name="nama"]').val(a.nama),
        $('[name="alamat"]').val(a.alamat),
        $('[name="telepon"]').val(a.notelp),
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
      url: SPremoveUrl,
      type: "post",
      dataType: "json",
      data: { id: a },
      success: () => {
        Swal.fire("Sukses", "Sukses Menghapus Data", "success"),
          (window.location.href = SPlisturl);
      },
      error: (a) => {
        console.log(a);
      },
    });
  });
}
