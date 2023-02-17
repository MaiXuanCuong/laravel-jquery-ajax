$(document).ready(function () {
    getSupplier();
});
//------
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#index-suppliers tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
    $("#searchTrashcan").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#tbodyTrashCanSupplier tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
// ------
function getSupplier() {
    $.ajax({
        type: "GET",
        url: "/supplier/getSupplier",
        dataType: "json",
        success: function (response) {
            $("#index-suppliers").html(" ");
            $.each(response.suppliers.data, function (index, supplier) {
                if (response.status == 200) {
                $("#index-suppliers").append(
                    '<tr>\
                    <td class="text-danger">' +
                 supplier.name +
                 '</td>\
                    <td class="text-danger">' +
                 supplier.email +
                 '</td>\
                 <td class="text-danger">' +
                 supplier.phone +
                 '</td>\
                 <td class="text-danger">' +
                 supplier.address +
                 '</td>\
                    <td><button style="text-align: center" class="badge badge-danger" value=' +
                 supplier.id +
                 'id="editSupplier">Sửa</button>\
                    <button style="text-align: center" class="badge badge-danger" value="' +
                 supplier.id +
                 '" id="deleteSupplier">Xóa</button></td>\
                  </tr>'
                );
            } else {
                showError();
            }
            });
            
        },
    });
}
// ------
$(document).on("click", "#deleteSupplier", function (e) {
    e.preventDefault();
    let tr = $(this);
    Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Bạn sẽ không thể hoàn tác này!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đúng vậy,Tôi đồng ý!",
        cancelButtonText : "Hủy",
    }).then((result) => {
        if (result.isConfirmed) {
            var id = $(this).val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "DELETE",
                url: "/supplier/deleteSupplier/" + id,
                success: function (res) {
                    if (res.status == 200) {
                        tr.parent().parent().remove();
                        Swal.fire(
                            "Đã xóa!",
                            "Xóa thành công",
                            "success"
                        );
                    } else {
                        Swal.fire(
                            "Lỗi xãy ra!",
                            "Xóa không thành công",
                            "error"
                        );
                    }
                },
                error: function (e) {
                    Swal.fire(
                        "Lỗi xãy ra!",
                        "Xóa không thành công",
                        "error"
                    );
                },
            });
        }
    });
});
// --------

$(document).on("click", "#restoreSupplier", function (e) {
    e.preventDefault();
    let tr = $(this);
    Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Bạn sẽ không thể hoàn tác này!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đúng vậy,Tôi đồng ý!",
        cancelButtonText : "Hủy",
    }).then((result) => {
        if (result.isConfirmed) {
            var id = $(this).val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: "/supplier/restoreSupplier/" + id,
                success: function (res) {
                    if (res.status == 200) {
                        tr.parent().parent().remove();
                        Swal.fire(
                            "Đã khôi phục",
                            "Khôi phục thành công",
                            "success"
                        );
                    } else {
                        Swal.fire(
                            "Lỗi xãy ra!",
                            "Khôi phục không thành công",
                            "error"
                        );
                    }
                },
                error: function (e) {
                    Swal.fire(
                        "Lỗi xãy ra!",
                        "Xóa không thành công",
                        "error"
                    );
                },
            });
        }
    });
});
// ------
$(document).on("click", "#destroySupplier", function (e) {
    e.preventDefault();
    let tr = $(this);
    Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Bạn sẽ không thể hoàn tác này!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đúng vậy,Tôi đồng ý!",
        cancelButtonText : "Hủy",
    }).then((result) => {
        if (result.isConfirmed) {
            var id = $(this).val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "DELETE",
                url: "/supplier/destroySupplier/" + id,
                success: function (res) {
                    if (res.status == 200) {
                        tr.parent().parent().remove();
                        Swal.fire(
                            "Đã xóa!",
                            "Xóa thành công",
                            "success"
                        );
                    } else {
                        Swal.fire(
                            "Lỗi xãy ra!",
                            "Xóa không thành công",
                            "error"
                        );
                    }
                },
                error: function (e) {
                    Swal.fire(
                        "Lỗi xãy ra!",
                        "Xóa không thành công",
                        "error"
                    );
                },
            });
        }
    });
});
// ------
$(document).on("click", "#addSupplier", function (e) {
    e.preventDefault();
    $("#addSupplierModal").modal("show");
});
// ------
$(document).on("click", "#editSupplier", function (e) {
    let id = $(this).val();
    $.ajax({
        type: "GET",
        url: "/supplier/editSupplier/" + supplier,
        dataType: "json",
        success: function (response) {
            if (res.status == 200) {
                $("#idSupplierEdit").val(res.supplier.id);
                $("#nameSupplierEdit").val(res.supplier.name);
                $("#phoneSupplierEdit").val(res.supplier.phone);
                $("#emailSupplierEdit").val(res.supplier.email);
                $("#addressSupplierEdit").val(res.supplier.address);
             
                if ($("#name").val() != "") {
                    $("#nameSupplierEditError").empty();
                }
                if ($("#phone").val() != "") {
                    $("#phoneSupplierEditError").empty();
                }
                if ($("#email").val() != "") {
                    $("#emailSupplierEditError").empty();
                }
                if ($("#address").val() != "") {
                    $("#addressSupplierEditError").empty();
                }
                $("#editSupplierModal").modal("show");
            }
        },
        error: function (err) {
            showError();
        },
    });
});
// ------
$(document).on("click", "#confirmUpdateSupplier", function (event) {
    event.preventDefault();
    var name = $("#nameSupplierEdit").val();
    var phone = $("#phoneSupplierEdit").val();
    var email = $("#emailSupplierEdit").val();
    var address = $("#addressSupplierEdit").val();

    var haserrorEdit = false;
    var id = $("#idSupplierEdit").val();
    if (name == "") {
        $("#nameSupplierEditError").html("Vui Lòng Nhập Tên");
        haserrorEdit = true;
    }
    if (phone == "") {
        $("#phoneSupplierEditError").html("Hãy Nhập Số Điện Thoại");
        haserrorEdit = true;
    }
    if (email == "") {
        $("#emailSupplierEditError").html("Hãy Nhập email");
        haserrorEdit = true;
    }
    if (address == "") {
        $("#addressSupplierEditError").html("Hãy Chọn Giới Tính");
        haserrorEdit = true;
    }
    if (haserrorEdit == true) {
        $("#editSupplierModal").change("shown.bs.modal", function () {
            if ($("#name").val() != "") {
                $("#nameSupplierEditError").empty();
            }
            if ($("#phone").val() != "") {
                $("#phoneSupplierEditError").empty();
            }
            if ($("#email").val() != "") {
                $("#emailSupplierEditError").empty();
            }
            if ($("#address").val() != "") {
                $("#addressSupplierEditError").empty();
            }
        });
    }
    if (haserrorEdit === false) {
        let formdata = new FormData($("#updateSupplier")[0]);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: "/supplier/updateSupplier/" + id,
            data: formdata,
            contentType: false,
            processData: false,

            success: function (res) {
                if (res.status == 200) {
                    $("#editSupplierModal").modal("hide");
                    $("#editSupplierModal").find("input").val("");
                    $("#editSupplierModal").find("select").val("");
                    getSupplier();
                    showSuccess();
                } else {
                    showError();
                }
            },
            error: function (err) {
                showError();
            },
        });
    }
});
// ------
$("#insertSupplier").on("submit", function (e) {
    e.preventDefault();
    var name = $("#nameSupplier").val();
    var phone = $("#phoneSupplier").val();
    var email = $("#emailSupplier").val();
    var gender = $("#genderSupplier").val();
    var birthday = $("#birthdaySupplier").val();
    var haserror = false;
    if (name == "") {
        $("#nameSupplierAddError").html("Vui Lòng Nhập Tên");
        haserror = true;
    }
    if (phone == "") {
        $("#phoneSupplierAddError").html("Hãy Nhập Số Điện Thoại");
        haserror = true;
    }
    if (email == "") {
        $("#emailSupplierAddError").html("Hãy Nhập email");
        haserror = true;
    }
    if (address == "") {
        $("#addressSupplierAddError").html("Hãy nhập địa chỉ");
        haserror = true;
    }
    if (haserror == true) {
        $("#addSupplierModal").change("shown.bs.modal", function () {
            if ($("#name").val() != "") {
                $("#nameSupplierAddError").empty();
            }
            if ($("#phone").val() != "") {
                $("#phoneSupplierAddError").empty();
            }
            if ($("#email").val() != "") {
                $("#emailSupplierAddError").empty();
            }
            if ($("#address").val() != "") {
                $("#addressSupplierAddError").empty();
            }
           
          
        });
    }
    if (haserror === false) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#insertSupplier")[0]);
        $.ajax({
            url: "/Supplier/storeSupplier",
            method: "post",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == 200) {
                    $("#addSupplierModal").modal("hide");
                    $("#addSupplierModal").find("input").val("");
                    let supplier = res.supplier;
                    $("#index-suppliers").prepend(
                        '<tr>\
                        <td class="text-danger">' +
                     supplier.name +
                     '</td>\
                        <td class="text-danger">' +
                     supplier.email +
                     '</td>\
                     <td class="text-danger">' +
                     supplier.phone +
                     '</td>\
                     <td class="text-danger">' +
                     supplier.address +
                     '</td>\
                        <td><button style="text-align: center" class="badge badge-danger" value=' +
                     supplier.id +
                     'id="editSupplier">Sửa</button>\
                        <button style="text-align: center" class="badge badge-danger" value="' +
                     supplier.id +
                     '" id="deleteSupplier">Xóa</button></td>\
                      </tr>'
                    )
                  
                    showSuccess();
                } else {
                    showError();
                }
            },
            error: function (err) {
                showError();
            },
        });
    }
});
// ------
$(document).on("click", "#close-modal", function () {
    getSupplier();
    $('#searchTrashcan').val("");
    $("#trashCanSupplierModal").modal("hide");
});
// ------
$(document).on("click", "#trashCanSupplier", function (e) {
    e.preventDefault();
    $.ajax({
        url: "/supplier/getTrashCanSupplier",
        type: "GET",
        success: function (response) {
            if (response.status == 200) {
                $("#tbodyTrashCanSupplier").html(" ");
                $.each(response.suppliers.data, function (index, supplier) {
                    $("#tbodyTrashCanSupplier").append(
                        '<tr>\
                <td class="text-danger">' +
             supplier.name +
             '</td>\
                <td class="text-danger">' +
             supplier.email +
             '</td>\
             <td class="text-danger">' +
             supplier.phone +
             '</td>\
             <td class="text-danger">' +
             supplier.address +
             '</td>\
             <td><button style="text-align: center" class="badge badge-danger" value="' +
             supplier.id +
             '" id="restoreSupplier">Lấy lại</button> &nbsp;&nbsp; \
             <button style="text-align: center" class="badge badge-danger" value="' +
             supplier.id +
             '" id="destroySupplier">Xóa vĩnh viễn</button></td>\
              </tr>'
                    );
                });
                $("#trashCanSupplierModal").modal("show");
            } else {
                showError();
            }
        }, error: function(){
            showError();
        }

    });
    
});
// ------
