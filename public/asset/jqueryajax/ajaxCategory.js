$(document).ready(function () {
    getCategory();
});
// ------
function getCategory() {
    $.ajax({
        type: "GET",
        url: "/category/getCategory",
        dataType: "json",
        success: function (response) {
            $("#index-categories").html(" ");
            $.each(response.categories, function (index, category) {
                $("#index-categories").append(
                    '<tr>\
                           <td><img style="width:100px; height:100px" src="' +
                        category.image +
                        '" alt=""></td>\
                           <td class="text-danger">' +
                        category.name +
                        '</td>\
                           <td><button style="text-align: center" class="badge badge-danger" onclick=editCategory(' +
                        category.id +
                        ') id="editCategory">Sửa</button>\
                           <button style="text-align: center" class="badge badge-danger" onclick=inforCategory(' +
                        category.id +
                        ') id="inforCategory">Chi tiết</button>\
                           <button style="text-align: center" class="badge badge-danger" value="' +
                        category.id +
                        '" id="deleteCategory">Xóa</button></td>\
                         </tr>'
                );
            });
        },
    });
}
// ------

$(document).on("click", "#deleteCategory", function (e) {
    e.preventDefault();
    $("#confirm").val("");
    var id = $(this).val();
    $("#confirm-text").html("");
    var node = document.createTextNode("Xóa danh mục này không?");
    $("#confirm-text")[0].appendChild(node);
    $("#confirm").val(id);
    $("#confirm-true").addClass("confirmdeleteCategory");
    $("#confirmCategoryModal").modal("show");
});
// ------
$(document).on("click", "#restoreCategory", function (e) {
    e.preventDefault();
    $("#confirm").val("");
    $("#trashCanCategoryModal").modal("hide");
    var id = $(this).val();
    $("#confirm-text").html("");
    var node = document.createTextNode("khôi phục danh mục này không?");
    $("#confirm-text")[0].appendChild(node);
    $("#confirm").val(id);
    $("#confirm-true").addClass("confirmrestoreCategory");
    $("#confirmCategoryModal").modal("show");
});
// ------
$(document).on("click", "#destroyCategory", function (e) {
    e.preventDefault();
    $("#confirm").val("");
    $("#trashCanCategoryModal").modal("hide");
    var id = $(this).val();
    $("#confirm-text").html("");
    var node = document.createTextNode("Xóa vĩnh viễn danh mục này không?");
    $("#confirm-text")[0].appendChild(node);
    $("#confirm").val(id);
    $("#confirm-true").addClass("confirmdestroyCategory");
    $("#confirmCategoryModal").modal("show");
});
// -------
$(document).on("click", ".confirmdeleteCategory", function (e) {
    e.preventDefault();
    var id = $("#confirm").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "DELETE",
        url: "/category/deleteCategory/" + id,
        success: function () {
            showSuccess();
            $("#confirm").val("");
            $("#confirm-true").removeClass("confirmdeleteCategory");
            getCategory();
            $("#confirmCategoryModal").modal("hide");
        },
        error: function (e) {
            showError();
        },
    });
});
// --------
$(document).on("click", ".confirmrestoreCategory", function (e) {
    e.preventDefault();
    var id = $("#confirm").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: "/category/restoreCategory/" + id,
        success: function () {
            getCategory();
            showSuccess();
            $("#confirm").val("");
            $("#confirmCategoryModal").modal("hide");
        },
        error: function (e) {
            showError();
        },
    });
});
// ------
$(document).on("click", ".confirmdestroyCategory", function (e) {
    e.preventDefault();
    var id = $("#confirm").val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "DELETE",
        url: "/category/destroyCategory/" + id,
        success: function () {
            getCategory();
            showSuccess();
            $("#confirm").val("");
            $("#confirmCategoryModal").modal("hide");
        },
        error: function (e) {
            showError();
        },
    });
});

// ------
function editCategory(category) {
    $.ajax({
        type: "GET",
        url: "/category/editCategory/" + category,
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
}
// ------
function updateCategory(event) {
    event.preventDefault();
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
            if ($("#name").val() != "") {
                $("#nameCategoryEditError").empty();
            }
            if ($("#description").val() != "") {
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
            url: "/category/updateCategory/" + id,
            data: formdata,
            contentType: false,
            processData: false,

            success: function (res) {
                $("#editCategoryModal").modal("hide");
                $("#editCategoryModal").find("input").val("");
                getCategory();
                showSuccess();
            },
            error: function (err) {
                showError();
            },
        });
    }
}
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
    var haserror = false;

    if (name == "") {
        $("#nameCategoryAddError").html("Hãy Nhập Tên Danh Mục");
        haserror = true;
    }

    if (image == "") {
        $("#imageCategoryAddError").html("Hãy Nhập Chọn Ảnh");
        haserror = true;
    }
    if (haserror == true) {
        $("#addCategoryModal").change("shown.bs.modal", function () {
            if ($("#name").val() != "") {
                $("#nameCategoryAddError").empty();
            }

            if ($("#image").val() != "") {
                $("#imageCategoryAddError").empty();
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
            url: "/category/storeCategory",
            method: "post",
            data: formdata,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (data) {
                CKEDITOR.instances.ckeditor.setData("");
                $("#addCategoryModal").modal("hide");
                $("#addCategoryModal").find("input").val("");
                getCategory();
                $("#blah").hide();
                jQuery("#blah1").attr("src", "");
                showSuccess();
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
// ------
$(document).on("click", "#trashCanCategory", function (e) {
    e.preventDefault();
    $.ajax({
        url: "/category/getTrashCanCategory",
        type: "GET",
        success: function (response) {
            $("#tbodyTrashCanCategory").html(" ");
            $.each(response.categories.data, function (index, category) {
                $("#tbodyTrashCanCategory").append(
                    '<tr>\
                    <td><img style="width:100px; height:100px" src="' +
                        category.image +
                        '" alt=""></td>\
                    <td class="text-danger">' +
                        category.name +
                        '</td>\
                    <td><button style="text-align: center" class="badge badge-danger" value="' +
                        category.id +
                        '" id="restoreCategory">Lấy lại</button> &nbsp;&nbsp; \
                    <button style="text-align: center" class="badge badge-danger" value="' +
                        category.id +
                        '" id="destroyCategory">Xóa vĩnh viễn</button></td>\
                </tr>'
                );
            });
        },
    });
    $("#trashCanCategoryModal").modal("show");
});
// ------
$(document).on("keyup", "#search", function (e) {
    e.preventDefault();
    let search = $("#search").val();
    $.ajax({
        url: "/category/searchCategory",
        method: "GET",
        data: {
            search: search,
        },
        success: function (response) {
            $("#index-categories").html(" ");
            $.each(response.category.data, function (index, category) {
                $("#index-categories").append(
                    '<tr>\
                    <td><img style="width:100px; height:100px" src="' +
                        category.image +
                        '" alt=""></td>\
                    <td class="text-danger">' +
                        category.name +
                        '</td>\
                    <td><button style="text-align: center" class="badge badge-danger" onclick=editCategory(' +
                        category.id +
                        ') id="editCategory">Sửa</button>\
                    <button style="text-align: center" class="badge badge-danger" onclick=inforCategory(' +
                        category.id +
                        ') id="inforCategory">Chi tiết</button>\
                    <button style="text-align: center" class="badge badge-danger" value="' +
                        category.id +
                        '" id="deleteCategory">Xóa</button></td>\
                  </tr>'
                );
            });
        },
    });
});
function inforCategory(id) {
    $.ajax({
        url: "/category/inforCategory/" + id,
        method: "GET",
        success: function (categorys) {
            let category = categorys.category;
            $("#inforImageCategory").attr("src", category.image);
            $("#inforNameCategory").html("");
            var node = document.createTextNode(category.name);
            $("#inforNameCategory")[0].appendChild(node);
            $("#inforDescriptionCategory").html("");
            $("#inforDescriptionCategory").html(category.description);
        },
        errors: function () {
            showError();
        },
    }),
        $("#inforCategoryModal").modal("show");
}
