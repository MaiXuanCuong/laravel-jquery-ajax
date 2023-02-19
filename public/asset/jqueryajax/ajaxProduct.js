$(document).ready(function () {
    getProduct();
});
//------
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#index-products tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
    $("#searchTrashcan").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#tbodyTrashCanProduct tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
// ------
function getProduct() {
    $.ajax({
        type: "GET",
        url: "/product/getProduct",
        dataType: "json",
        success: function (response) {
            $("#index-products").html(" ");
            $.each(response.products, function (index, product) {
                if (response.status == 200) {
                $("#index-products").append(
                    '<tr>\
                           <td><img style="width:100px; height:100px" src="' +
                        product.image +
                        '" alt=""></td>\
                           <td class="text-danger">' +
                        product.name +
                        '</td>\
                           <td class="text-danger">' +
                        product.price +
                        '</td>\
                           <td>' +
                        product.price +
                        '</td>\
                           <td><button style="text-align: center" class="badge badge-danger" value="' +
                        product.id +
                        '" id="editProduct">Sửa</button>\
                           <button style="text-align: center" class="badge badge-danger" value=' +
                        product.id +
                        ' id="inforProduct">Chi tiết</button>\
                           <button style="text-align: center" class="badge badge-danger" value="' +
                        product.id +
                        '" id="deleteProduct">Xóa</button></td>\
                         </tr>'
                );
            } else {
                showError();
            }
            });
            
        },
    });
}
// -------

$(document).on("click", "#deleteProduct", function (e) {
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
                url: "/product/deleteProduct/" + id,
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

$(document).on("click", "#restoreProduct", function (e) {
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
                url: "/product/restoreProduct/" + id,
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
$(document).on("click", "#destroyProduct", function (e) {
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
                url: "/product/destroyProduct/" + id,
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
$(document).on("click", "#addProduct", function (e) {
    e.preventDefault();
    $("#addProductModal").modal("show");
});
// ------
$(document).on("click", "#editProduct", function (e) {
    let id = $(this).val();


    $.ajax({
        type: "GET",
        url: "/product/editProduct/" + id,
        success: function (res) {
            if (res.status == 200) {
                $("#idProductEdit").val(res.product.id);
                $("#nameProductEdit").val(res.product.name);
                $("#phoneProductEdit").val(res.product.phone);
                $("#emailProductEdit").val(res.product.email);
                $("#genderProductEdit").val(res.product.gender);
                $("#birthdayProductEdit").val(res.product.birthday);
                $("#blah1").attr("src", res.product.image);
          
            
                if ($("#name").val() != "") {
                    $("#nameProductEditError").empty();
                }
                if ($("#phone").val() != "") {
                    $("#phoneProductEditError").empty();
                }
                if ($("#email").val() != "") {
                    $("#emailProductEditError").empty();
                }
                if ($("#gender").val() != "") {
                    $("#genderProductEditError").empty();
                }
                if ($("#birthday").val() != "") {
                    $("#birthdayProductEditError").empty();
                }
             
                $("#editProductModal").modal("show");
            }
        },
        error: function (err) {
            showError();
        },
    });
});
// ------
$(document).on("click", "#confirmUpdateProduct", function (event) {
    event.preventDefault();
    var name = $("#nameProductEdit").val();
    var phone = $("#phoneProductEdit").val();
    var email = $("#emailProductEdit").val();
    var gender = $("#genderProductEdit").val();
    var birthday = $("#birthdayProductEdit").val();
   
    var haserrorEdit = false;
    var id = $("#idProductEdit").val();
    if (name == "") {
        $("#nameProductEditError").html("Vui Lòng Nhập Tên");
        haserrorEdit = true;
    }
    if (phone == "") {
        $("#phoneProductEditError").html("Hãy Nhập Số Điện Thoại");
        haserrorEdit = true;
    }
    if (email == "") {
        $("#emailProductEditError").html("Hãy Nhập email");
        haserrorEdit = true;
    }
    if (gender == "") {
        $("#genderProductEditError").html("Hãy Chọn Giới Tính");
        haserrorEdit = true;
    }
    if (birthday == "") {
        $("#birthdayProductEditError").html("Hãy Nhập Ngày Sinh");
        haserrorEdit = true;
    }

    if (province == "") {
        $("#provincesProductEditError").html("Hãy Chọn Tỉnh/Thành Phố");
        haserrorEdit = true;
    }
    if (district == "") {
        $("#districtsProductEditError").html("Hãy Chọn Quận/Huyện");
        haserrorEdit = true;
    }
    if (ward == "") {
        $("#wardProductEditError").html("Hãy Chọn Xã/Phường");
        haserrorEdit = true;
    }
    if (haserrorEdit == true) {
        $("#editProductModal").change("shown.bs.modal", function () {
            if ($("#name").val() != "") {
                $("#nameProductEditError").empty();
            }
            if ($("#phone").val() != "") {
                $("#phoneProductEditError").empty();
            }
            if ($("#email").val() != "") {
                $("#emailProductEditError").empty();
            }
            if ($("#gender").val() != "") {
                $("#genderProductEditError").empty();
            }
            if ($("#birthday").val() != "") {
                $("#birthdayProductEditError").empty();
            }
            if ($("#province_edit_id").val() != "") {
                $("#provincesProductEditError").empty();
            }
            if ($("#district_edit_id").val() != "") {
                $("#districtsProductEditError").empty();
            }
            if ($("#ward_edit_id").val() != "") {
                $("#wardProductEditError").empty();
            }
        });
    }
    if (haserrorEdit === false) {
        let formdata = new FormData($("#updateProduct")[0]);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: "/product/updateProduct/" + id,
            data: formdata,
            contentType: false,
            processData: false,

            success: function (res) {
                if (res.status == 200) {
                    $("#editProductModal").modal("hide");
                    $("#editProductModal").find("input").val("");
                    $("#editProductModal").find("select").val("");
                    getProduct();
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
$("#insertProduct").on("submit", function (e) {
    e.preventDefault();
    var name = $("#nameProduct").val();
    var price = $("#priceProduct").val();
    var quantity = $("#quantityProduct").val();
    var description = $("#descriptionProduct").val();
    var supplier_id = $("#supplierProduct").val();
    var category_id = $("#categoryProduct").val();
    var type_gender = $("#type_genderProduct").val();
    var image = $("#imageProduct").val();
    var imageMany = $("#file_name").val();

    var haserror = false;
    if (name == "") {
        $("#nameProductAddError").html("Vui Lòng Nhập Tên Sản Phẩm");
        haserror = true;
    }
    if (price == "") {
        $("#priceProductAddError").html("Hãy Nhập Giá Sản Phẩm");
        haserror = true;
    }
    if (quantity == "") {
        $("#quantityProductAddError").html("Hãy Nhập Số Lượng Sản Phẩm");
        haserror = true;
    }
    if (description == "") {
        $("#descriptionProductAddError").html("Hãy Nhập Mô Tả Sản Phẩm");
        haserror = true;
    }
    if (supplier_id == "") {
        $("#supplierProductAddError").html("Hãy Chọn Nhà Cung Cấp");
        haserror = true;
    }
    if (image == "") {
        $("#imageProductAddError").html("Hãy Nhập Chọn Ảnh");
        haserror = true;
    }
    if (category_id == "") {
        $("#categoryProductAddError").html("Chọn Danh Mục");
        haserror = true;
    }
    if (type_gender == "") {
        $("#type_genderProductAddError").html("Chọn Hạng Mục");
        haserror = true;
    }
    if (imageMany == "") {
        $("#imageManyProductAddError").html("Chọn Ảnh Chi Tiết Sản Phẩm");
        haserror = true;
    }
    if (haserror == true) {
        $("#addProductModal").change("shown.bs.modal", function () {
            if ($("#name").val() != "") {
                $("#nameProductAddError").empty();
            }
            if ($("#phone").val() != "") {
                $("#phoneProductAddError").empty();
            }
            if ($("#email").val() != "") {
                $("#emailProductAddError").empty();
            }
            if ($("#gender").val() != "") {
                $("#genderProductAddError").empty();
            }
            if ($("#birthday").val() != "") {
                $("#birthdayProductAddError").empty();
            }
            if ($("#image").val() != "") {
                $("#imageProductAddError").empty();
            }
            if ($("#province_id").val() != "") {
                $("#provincesProductAddError").empty();
            }
            if ($("#district_id").val() != "") {
                $("#districtsProductAddError").empty();
            }
            if ($("#ward_id").val() != "") {
                $("#wardsProductAddError").empty();
            }
        });
    }
    if (haserror === false) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#insertProduct")[0]);
        $.ajax({
            url: "/product/storeProduct",
            method: "post",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == 200) {
                    $("#addProductModal").modal("hide");
                    $("#addProductModal").find("input").val("");
                    $("#addProductModal").find("select").val("");
                    let product = res.product;
                    $("#index-products").prepend(
                        '<tr>\
                           <td><img style="width:100px; height:100px" src="' +
                        product.image +
                        '" alt=""></td>\
                           <td class="text-danger">' +
                        product.name +
                        '</td>\
                           <td class="text-danger">' +
                        product.gender +
                        '</td>\
                           <td><label class="badge badge-danger" ><input onclick="myFunction(' +
                        product.id +
                        ')" id="copyPhone' +
                        product.id +
                        '" value="' +
                        product.phone +
                        '" hidden/>' +
                        product.phone +
                        '</label></td>\
                           <td><button style="text-align: center" class="badge badge-danger" value="' +
                        product.id +
                        '" id="editProduct">Sửa</button>\
                           <button style="text-align: center" class="badge badge-danger" value=' +
                        product.id +
                        ' id="inforProduct">Chi tiết</button>\
                           <button style="text-align: center" class="badge badge-danger" value="' +
                        product.id +
                        '" id="deleteProduct">Xóa"</button></td>\
                         </tr>'
                    )
                    $("#blah").hide();
                    jQuery("#blah1").attr("src", "");
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

$(document).ready(function () {
    if ($("#blah").hide()) {
        $("#blah").hide();
    }
    $("#imageProduct").change(function () {
        $("#blah").show();
        const file = $(this)[0].files;
        if (file[0]) {
            jQuery("#blah").attr("src", URL.createObjectURL(file[0]));
            jQuery("#blah1").attr("src", URL.createObjectURL(file[0]));
        }
    });
    $("#imageProductEdit").change(function () {
        $("#blah1").show();
        const file = $(this)[0].files;
        if (file[0]) {
            jQuery("#blah1").attr("src", URL.createObjectURL(file[0]));
        }
    });
});
//---------
$(document).on("click", "#close-modal", function () {
    getProduct();
    $('#searchTrashcan').val("");
    $("#trashCanProductModal").modal("hide");
});
// ------
$(document).on("click", "#trashCanProduct", function (e) {
    e.preventDefault();
    $.ajax({
        url: "/product/getTrashCanProduct",
        type: "GET",
        success: function (response) {
            if (response.status == 200) {
                $("#tbodyTrashCanProduct").html(" ");
                $.each(response.products, function (index, product) {
                    $("#tbodyTrashCanProduct").append(
                        '<tr>\
                    <td><img style="width:100px; height:100px" src="' +
                            product.image +
                            '" alt=""></td>\
                    <td class="text-danger">' +
                            product.name +
                            '</td>\
                    <td class="text-danger">' +
                            product.gender +
                            '</td>\
                    <td><label class="badge badge-danger" ><input onclick="myFunction(' +
                            product.id +
                            ')" id="copyPhone' +
                            product.id +
                            '" value="' +
                            product.phone +
                            '" hidden/>' +
                            product.phone +
                            '</label></td>\
                    <td><button style="text-align: center" class="badge badge-danger" value="' +
                            product.id +
                            '" id="restoreProduct">Lấy lại</button>\
                    <button style="text-align: center" class="badge badge-danger" value="' +
                            product.id +
                            '" id="destroyProduct">Xóa vĩnh viễn</button></td>\
                </tr>'
                    );
                });
                $("#trashCanProductModal").modal("show");
            } else {
                showError();
            }
        },
    });
});
// ------
$(document).on("click", "#inforProduct", function (e) {
    let id = $(this).val();
    $.ajax({
        url: "/product/inforProduct/" + id,
        method: "GET",
        success: function (products) {
            if (products.status == 200) {
                product = products.product;
                $("#inforImageProduct").attr("src", product.image);
                $("#inforNameProduct").html("");
                var node = document.createTextNode(product.name);
                $("#inforNameProduct")[0].appendChild(node);
                $("#inforEmailProduct").html("");
                var node = document.createTextNode(product.email);
                $("#inforEmailProduct")[0].appendChild(node);

                $("#inforPhoneProduct").html("");
                var node = document.createTextNode(product.phone);
                $("#inforPhoneProduct")[0].appendChild(node);

                $("#inforGenderProduct").html("");
                var node = document.createTextNode(product.gender);
                $("#inforGenderProduct")[0].appendChild(node);

                $("#inforBirthdayProduct").html("");
                var node = document.createTextNode(product.birthday);
                $("#inforBirthdayProduct")[0].appendChild(node);
                $("#inforProductModal").modal("show");
            } else {
                showError();
            }
        },
        errors: function () {
            showError();
        },
    });
})
