let table;
$(document).ready(function () {
  $("input[type='checkbox']").prop("checked", true);
  list_transaction();
  $("#barcode_search").focus();
  $("body").toggleClass("sidebar-toggled");
  $(".sidebar").toggleClass("toggled");
  $("input[type=checkbox]").change(function () {
    if (this.checked) {
      $("#icon_barcode").addClass("fa-barcode").removeClass("fa-keyboard");
      $("#barcode_search").on("input", function () {
        if ($("#barcode_search").val().length === 13) {
          findProductByBarcode($("#barcode_search").val());
        }
      });
    } else {
      $("#icon_barcode").addClass("fa-keyboard").removeClass("fa-barcode");
      listening_serch_product();
    }
    $("#barcode_search").focus();
  });
  if ($("input[type='checkbox']").prop("checked")) {
    $("#icon_barcode").addClass("fa-barcode").removeClass("fa-keyboard");
    $("#barcode_search").on("input", function () {
      if ($("#barcode_search").val().length === 13) {
        findProductByBarcode($("#barcode_search").val());
      }
    });
  } else {
    $("#icon_barcode").addClass("fa-keyboard").removeClass("fa-barcode");
    listening_serch_product();
  }
});

function list_transaction() {
  table = $("#shoping_cart_table").DataTable({
    paging: false,
    info: false,
    searching: false,
    ajax: {
      url: "<?= site_url('option/list_shoping_cart') ?>",
      type: "POST",
    },
    columnDefs: [
      {
        orderable: false,
      },
    ],
  });
}

function findProductByBarcode(barcode) {
  console.log(barcode);
  $.ajax({
    url: "<?= site_url('barang/find_by_barcode//') ?>" + barcode,
    type: "GET",
    success: function (data) {
      let item = JSON.parse(data);
      $("#product_name").text(item.product_name);
      $("#product_stock").text(item.product_qty);
      $("#selling_price").text(convertToRupiah(item.selling_price));
      $("#product_id").val(item.product_id);
      $("#val_selling_price").val(item.selling_price);
      $("#val_product_name").val(item.product_name);
      $("#val_product_qty").val(item.product_qty);
      $("#barcode_search").val("");
      save_to_cartv2(item.product_id, item.product_name, item.selling_price);
      $("#search").val("");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error adding data");
    },
  });
}

function listening_serch_product(params) {
  $("#barcode_search")
    .autocomplete({
      minLength: 1,
      delay: 100,
      source: function (request, response) {
        jQuery.ajax({
          url: "<?= site_url('option/search_product') ?>",
          data: {
            keyword: request.term,
          },
          dataType: "json",
          success: function (data) {
            response(data);
          },
        });
      },
      select: function (e, ui) {
        $("#barcode_search").val("");
        $("#product_name").text(ui.item.product_name);
        $("#product_stock").text(ui.item.product_qty);
        $("#selling_price").text(convertToRupiah(ui.item.selling_price));
        $("#product_id").val(ui.item.product_id);
        $("#val_selling_price").val(ui.item.selling_price);
        $("#val_product_name").val(ui.item.product_name);
        $("#val_product_qty").val(ui.item.product_qty);
        save_to_cartv2(
          ui.item.product_id,
          ui.item.product_name,
          ui.item.selling_price
        );
        return false;
      },
    })
    .data("ui-autocomplete")._renderItem = function (ul, item) {
    return $("<li>")
      .append(
        "<a style='display: flex;'><div style='width: 150px;'>" +
          item.barcode +
          "</div> " +
          item.product_name +
          "</a>"
      )
      .appendTo(ul);
  };
}

function reload_table() {
  table.ajax.reload(null, false);
}

function subTotal(qty) {
  if (qty > $("#val_product_qty").val()) {
    swal({
      title: "Ups?",
      text: "Qty Melebihi Stok",
      dangerMode: true,
    });
  }
  let harga = $("#val_selling_price").val();
  let promo = $("#jenis_promo").val();
  let potongan = $("#potongan").val();
  let hrg_potong = $("#harga_potongan").val();
  if (promo == "minimal") {
    let induk = Math.floor(qty / potongan);
    let sisa = qty % potongan;
    let sub = induk * hrg_potong + harga * sisa;
    $("#sub_total").val(convertToRupiah(sub));
    $("#tambah").removeAttr("disabled");
  } else {
    let diskon = harga - (harga * potongan) / 100;
    $("#sub_total").text(convertToRupiah(diskon * qty));
    $("#tambah").removeAttr("disabled");
  }
}

function save_to_cartv2(id, name, price) {
  $.ajax({
    url: "<?= site_url('option/add_keranjang') ?>",
    type: "POST",
    dataType: "JSON",
    data: {
      product_id: id,
      product_name: name,
      selling_price: price,
      product_qty: 1,
    },
    success: function (data) {
      $("#total_belanja").text(convertToRupiah(data.total));
      reload_table();
      $("#val_total").val(data.total);
      $("#product_name").text("");
      $("#product_stock").text("");
      $("#selling_price").text("");
      $("#sub_total").text("");
      $("#tambah").attr("disabled", "disabled");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error adding data");
    },
  });
  $(".reset").val("");
}

document.onkeydown = function (e) {
  // let qty = $('#product_qty').val();
  // let bill = $('#bayar').val();
  // if (qty !== '') {
  //   switch (e.keyCode) {
  //     case 13:
  //       save_to_cart();
  //       break;
  //   }
  // }
  // if (bill !== '') {
  //   switch (e.keyCode) {
  //     case 13:
  //       finish_transaction();
  //       break;
  //   }
  // }
  // switch (e.keyCode) {
  //   case 113:
  //     $('#product_name').focus();
  //     break;
  // }
};

function showKembali(bayar) {
  if (bayar === "") {
    $("#total_bayar").text(0);
    $("#total_kembali").text(0);
    $("#selesai").attr("disabled", "disabled");
    $("#kembali").val(0);
  } else {
    let total = $("#val_total").val();
    let kembalian = bayar - total;
    $("#total_bayar").text(convertToRupiah(bayar));
    $("#total_kembali").text(convertToRupiah(kembalian));
    $("#kembali").val(kembalian);
    if (kembalian >= 0) {
      $("#selesai").removeAttr("disabled");
    } else {
      $("#selesai").attr("disabled", "disabled");
    }
  }
}

function convertToRupiah(angka) {
  let rupiah = "";
  let angkarev = angka.toString().split("").reverse().join("");
  for (let i = 0; i < angkarev.length; i++) {
    if (i % 3 == 0) {
      rupiah += angkarev.substr(i, 3) + ".";
    }
  }
  return rupiah
    .split("", rupiah.length - 1)
    .reverse()
    .join("");
}

function preview_struck() {
  let bayar = $("#bayar").val();
  let kembali = $("#kembali").val();
  $.ajax({
    url: "<?= site_url('option/save_orders/') ?>",
    data: {
      bayar: bayar,
      kembali: kembali,
    },
    method: "POST",
    success: function (data) {
      $("#modal_struck").modal("show");
      $("#content_struck").html(data);
    },
  });
}

function print_transaction() {
  document.title = new Date();
  window.print();
  save_transaction();
}

function save_transaction() {
  const d = new Date();
  let year = d.getFullYear();
  let day = d.getDate();
  let month = d.getMonth();
  $.ajax({
    url: "<?= site_url('transaction/create_transaction/') ?>",
    type: "POST",
    data: {
      code_transaction: `TR${year}${day}${month}${"<?= $this->session->userdata('user_id') ?>"}`,
    },
    dataType: "json",
    success: function (result) {
      $("#modal_struck").modal("hide");
      reload_table();
      $("#bayar").val(0);
      $("#total_bayar").text(0);
      $("#total_kembali").text(0);
      $("#total_belanja").text(0);
      $("#search").focus();
      $("#kembali").val(0);
    },
    error: function (err) {
      alert("error transaksi");
    },
  });
}

function delete_cart(rowid) {
  $.ajax({
    url: "<?= site_url('option/delete_shoping_cart') ?>/" + rowid,
    type: "POST",
    dataType: "JSON",
    success: function (data) {
      $("#total_belanja").text(convertToRupiah(data.total));
      reload_table();
      $("#val_total").val(data.total);
      showKembali($("#bayar").val());
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Gagal hapus barang");
    },
  });
}

function plus_cart(id, name, price) {
  $.ajax({
    url: "<?= site_url('option/add_keranjang') ?>",
    type: "POST",
    data: {
      product_id: id,
      product_name: name,
      selling_price: price,
      product_qty: 1,
    },
    dataType: "JSON",
    success: function (data) {
      $("#total_belanja").text(convertToRupiah(data.total));
      reload_table();
      $("#val_total").val(data.total);
      $("#sub_total").text("");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert("Error adding data");
    },
  });
}

function minus_cart(id, name, price, qty, rowid) {
  if (qty < 2) {
    delete_cart(rowid);
  } else {
    $.ajax({
      url: "<?= site_url('option/add_keranjang') ?>",
      type: "POST",
      data: {
        product_id: id,
        product_name: name,
        selling_price: price,
        product_qty: -1,
      },
      dataType: "JSON",
      success: function (data) {
        $("#total_belanja").text(convertToRupiah(data.total));
        reload_table();
        $("#val_total").val(data.total);
        $("#sub_total").text("");
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert("Error adding data");
      },
    });
  }
}
