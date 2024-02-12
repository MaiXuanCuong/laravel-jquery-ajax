$(document).ready(function () {
    getCategory();
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#index-categories tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
      $("#searchTrashcan").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tbodyTrashCanCategory tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
});
// ------
function getCategory() {
    $.ajax({
        type: "GET",
        url: _appUrl+"/category/getCategory",
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                $("#index-categories").html(" ");
                $.each(response.categories, function (index, category) {
                    $("#index-categories").append(
                        '<tr data-category-id="' + category.id + '">\
                               <td><img style="width:100px; height:100px" src="' +
                            category.image +
                            '" alt=""></td>\
                               <td class="text-danger">' +
                            category.name +
                            '</td>\
                               <td><button style="text-align: center" class="badge badge-danger" value=' +
                            category.id +
                            ' id="editCategory">Sửa</button>\
                               <button style="text-align: center" class="badge badge-danger" value=' +
                            category.id +
                            ' id="inforCategory">Chi tiết</button>\
                               <button style="text-align: center" class="badge badge-danger" value="' +
                            category.id +
                            '" id="deleteCategory">Xóa</button></td>\
                             </tr>'
                    );
                });
            } else {
                showError();
            }
        },
    });
}
// ------


// -------
$(document).on("click", "#deleteCategory", function (e) {
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
                url: _appUrl+"/category/deleteCategory/" + id,
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
$(document).on("click", "#restoreCategory", function (e) {
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
                url: _appUrl+"/category/restoreCategory/" + id,
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


$(document).on("click", "#destroyCategory", function (e) {
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
                url: _appUrl+"/category/destroyCategory/" + id,
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
$(document).on("click", "#editCategory", function (e) {
    e.preventDefault();
    var id = $(this).val();
    $.ajax({
        type: "GET",
        url: _appUrl+"/category/editCategory/" + id,
        success: function (res) {
            if (res.status == 200) {
                let category = res.category;
                $("#idCategoryEdit").val(category.id);
                $("#nameCategoryEdit").val(category.name);
                CKEDITOR.instances.ckeditor1.setData(category.description);

                $("#blah1").attr("src", category.image);

                if ($("#name").val() != "") {
                    $("#nameCategoryEditError").empty();
                }
                if ($("#description").val() != "") {
                    $("#descriptionCategoryEditError").empty();
                }
            }
            $("#editCategoryModal").modal("show");
        },
        error: function (err) {
            showError();
        },
    });
})
// ------
$(document).on("click", "#confirmeditCategory", function (e) {
    e.preventDefault();
    var id = $(this).val();
    var name = $("#nameCategoryEdit").val();
    var description = CKEDITOR.instances.ckeditor1.getData();
    var haserrorEdit = false;
    var id = $("#idCategoryEdit").val();
    if (name == "") {
        $("#nameCategoryEditError").html("Vui Lòng Nhập Tên Danh Mục");
        haserrorEdit = true;
    }
    if (description == "") {
        $("#descriptionCategoryEditError").html("Hãy Nhập Mô Tả");
        haserrorEdit = true;
    }
    if (haserrorEdit == true) {
        $("#editCategoryModal").change("shown.bs.modal", function () {
            if ($("#nameCategory").val() != "") {
                $("#nameCategoryEditError").empty();
            }
            if (CKEDITOR.instances.ckeditor.getData() != "") {
                $("#descriptionCategoryEditError").empty();
            }
        });
    }
    if (haserrorEdit === false) {
        let formdata = new FormData($("#updateCategory")[0]);
        formdata.append("description", description);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "POST",
            url: _appUrl+"/category/updateCategory/" + id,
            data: formdata,
            contentType: false,
            processData: false,

            success: function (res) {
                if (res.status === 200) {
                    var category = res.category
                    $("#editCategoryModal").modal("hide");
                    $("#editCategoryModal").find("input").val("");
                    var tr = $('tr[data-category-id="' + category.id + '"]');

                    // Tạo HTML mới với thông tin sản phẩm đã cập nhật
                    var html = '<tr data-category-id="' + category.id + '">\
                                   <td><img style="width:100px; height:100px" src="' + category.image +'" alt=""></td>\
                                   <td class="text-danger">' + category.name +'</td>\
                                   <td><button style="text-align: center" class="badge badge-danger" value="' + category.id + '" id="editCategory">Sửa</button>\
                                   <button style="text-align: center" class="badge badge-danger" value=' + category.id + ' id="inforCategory">Chi tiết</button>\
                                   <button style="text-align: center" class="badge badge-danger" value="' + category.id + '" id="deleteCategory">Xóa</button></td>\
                                 </tr>';
                
                    // Thay thế thẻ tr hiện tại bằng thẻ tr mới có thông tin sản phẩm đã cập nhật
                    tr.replaceWith(html);
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
})
// ------
$(document).on("click", "#addCategory", function (e) {
    e.preventDefault();
    $("#addCategoryModal").modal("show");
});
// ------
$("#insertCategory").on("submit", function (e) {
    e.preventDefault();
    var name = $("#nameCategory").val();
    var image = $("#imageCategory").val();
    var description = CKEDITOR.instances.ckeditor.getData();
    var haserror = false;

    if (name == "") {
        $("#nameCategoryAddError").html("Hãy Nhập Tên Danh Mục");
        haserror = true;
    }

    if (image == "") {
        $("#imageCategoryAddError").html("Hãy Nhập Chọn Ảnh");
        haserror = true;
    }
    if (description == "") {
        $("#desciptionCategoryAddError").html("Hãy Nhập Mô Tả");
        haserror = true;
    }
    if (haserror == true) {
        $("#addCategoryModal").change("shown.bs.modal", function () {
            if ($("#nameCategory").val() != "") {
                $("#nameCategoryAddError").empty();
            }

            if ($("#imageCategory").val() != "") {
                $("#imageCategoryAddError").empty();
            }
            if (CKEDITOR.instances.ckeditor.getData() != "") {
                $("#desciptionCategoryAddError").empty();
            }
        });
    }
    if (haserror === false) {
        var description = CKEDITOR.instances.ckeditor.getData();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#insertCategory")[0]);
        formdata.append("description", description);
        $.ajax({
            url: _appUrl+"/category/storeCategory",
            method: "post",
            data: formdata,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == 200) {
                    CKEDITOR.instances.ckeditor.setData("");
                    $("#addCategoryModal").modal("hide");
                    $("#addCategoryModal").find("input").val("");
                    let category = res.category;
                    $("#index-categories").prepend(
                        '<tr data-category-id="' + category.id + '">\
                        <td><img style="width:100px; height:100px" src="' +
                     category.image +
                     '" alt=""></td>\
                        <td class="text-danger">' +
                     category.name +
                     '</td>\
                        <td><button style="text-align: center" class="badge badge-danger" value=' +
                     category.id +
                     ' id="editCategory">Sửa</button>\
                        <button style="text-align: center" class="badge badge-danger" value=' +
                     category.id +
                     ' id="inforCategory">Chi tiết</button>\
                        <button style="text-align: center" class="badge badge-danger" value="' +
                     category.id +
                     '" id="deleteCategory">Xóa</button></td>\
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
    $("#imageCategory").change(function () {
        $("#blah").show();
        const file = $(this)[0].files;
        if (file[0]) {
            jQuery("#blah").attr("src", URL.createObjectURL(file[0]));
            jQuery("#blah1").attr("src", URL.createObjectURL(file[0]));
        }
    });
    $("#imageCategoryEdit").change(function () {
        $("#blah1").show();
        const file = $(this)[0].files;
        if (file[0]) {
            jQuery("#blah1").attr("src", URL.createObjectURL(file[0]));
        }
    });
});
$(document).on("click", "#close-modal", function () {
    getCategory();
    $('#searchTrashcan').val("");
    $("#trashCanCategoryModal").modal("hide");
});
// ------
$(document).on("click", "#trashCanCategory", function (e) {
    e.preventDefault();
    $.ajax({
        url: _appUrl+"/category/getTrashCanCategory",
        type: "GET",
        success: function (response) {
            if (response.status === 200) {
                $("#tbodyTrashCanCategory").html(" ");
                $.each(response.categories, function (index, category) {
                    $("#tbodyTrashCanCategory").append(
                        '<tr data-category-id="' + category.id + '">\
                    <td><img style="width:100px; height:100px" src="' +
                            category.image +
                            '" alt=""></td>\
                    <td class="text-danger">' +
                            category.name +
                            '</td>\
                    <td><button style="text-align: center" class="badge badge-danger" value="' +
                            category.id +
                            '" id="restoreCategory">Lấy lại</button> \
                    <button style="text-align: center" class="badge badge-danger" value="' +
                            category.id +
                            '" id="destroyCategory">Xóa vĩnh viễn</button></td>\
                </tr>'
                    );
                });
                $("#trashCanCategoryModal").modal("show");
            } else {
                showError();
            }
        },
    });
});
// ------

$(document).on("click", "#inforCategory", function (e) {
    let id = $(this).val();
    $.ajax({
        url: _appUrl+"/category/inforCategory/" + id,
        method: "GET",
        success: function (categorys) {
            if (categorys.status == 200) {
                let category = categorys.category;
                $("#inforImageCategory").attr("src", category.image);
                $("#inforNameCategory").html("");
                var node = document.createTextNode(category.name);
                $("#inforNameCategory")[0].appendChild(node);
                $("#inforDescriptionCategory").html("");
                $("#inforDescriptionCategory").html(category.description);
            } else {
                showError();
            }
        },
        errors: function () {
            showError();
        },
    }),
        $("#inforCategoryModal").modal("show");
})
$(document).on("click", '#icon-download', function (e) {
  
    e.preventDefault();
    $.ajax({
        url: _appUrl+"/category/export-categories",
        method: "GET",
        success: function (response) {
              var link = document.createElement('a');
              var today = new Date();
              var time = today.getHours()+'h'+today.getMinutes()+'p-'+ today.getDate()+'/'+today.getMonth()+'/'+ today.getFullYear();
              link.href = window.URL.createObjectURL(new Blob([response]));
              link.download = 'Xuat-dang-muc-'+time+'.xlsx';
              link.style.display = 'none';
              document.body.appendChild(link);
              link.click();
              document.body.removeChild(link);
              window.URL.revokeObjectURL(link.href);
                showSuccess();
        }
    })
})
