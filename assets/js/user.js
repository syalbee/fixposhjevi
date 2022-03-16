let url,
  user = $("#user").DataTable({
    responsive: !0,
    scrollX: !0,
    ajax: USreadUrl,
    columnDefs: [{ searcable: !1, orderable: !1, targets: 0 }],
    order: [[1, "asc"]],
    columns: [
      { data: "no" },
      { data: "nama" },
      { data: "username" },
      { data: "role" },
      { data: "action" },
    ],
  });

console.log(user);

function reloadTable() {
  user.ajax.reload();
}

function addData() {
  $.ajax({
    url: USaddUrl,
    type: "post",
    dataType: "json",
    data: $("#USaddform").serialize(),
    success: (res) => {
      // $(".modal").modal("hide"),
      Swal.fire("Sukses", "Sukses Menambahkan Data", "success"), reloadTable();
      window.location.href = SPlisturl;
      // console.log(res);
    },
    error: (a) => {
      console.log(a);
    },
  });
}

function editData() {
  $.ajax({
    url: USeditUrl,
    type: "post",
    dataType: "json",
    data: $("#USformedit").serialize(),
    success: () => {
      $(".modal").modal("hide"),
        Swal.fire("Sukses", "Sukses Mengedit Data", "success"),
        reloadTable();
    },
    error: (a) => {
      console.log(a);
    },
  });
}

function edit(a) {
  $.ajax({
    url: USget_userUrl,
    type: "post",
    dataType: "json",
    data: { id: a },
    success: (a) => {
      // console.log(a);
      $('[name="id"]').val(a.id),
        $('[name="nama"]').val(a.nama),
        $('[name="username"]').val(a.username),
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
    showCancelButton: !0,
  }).then(() => {
    $.ajax({
      url: USremoveUrl,
      type: "post",
      dataType: "json",
      data: { id: a },
      success: () => {
        Swal.fire("Sukses", "Sukses Menghapus Data", "success"), reloadTable();
      },
      error: (a) => {
        console.log(a);
      },
    });
  });
}
