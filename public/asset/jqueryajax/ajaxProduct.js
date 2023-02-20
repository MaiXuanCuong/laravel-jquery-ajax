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
                    '<tr data-product-id="' + product.id + '">\
                           <td><img style="width:100px; height:100px" src="' + product.image +'" alt=""></td>\
                           <td class="text-danger">' + product.name +'</td>\
                           <td class="text-danger">' +product.category.name +'</td>\
                           <td class="text-danger">' + product.price + '</td>\
                           <td><button style="text-align: center" class="badge badge-danger" value="' + product.id + '" id="editProduct">Sửa</button>\
                           <button style="text-align: center" class="badge badge-danger" value=' + product.id + ' id="inforProduct">Chi tiết</button>\
                           <button style="text-align: center" class="badge badge-danger" value="' + product.id + '" id="deleteProduct">Xóa</button></td>\
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
var files = []
$(document).on("click", "#addProduct", function (e) {
    e.preventDefault();
    
    form = document.querySelector('form'),
    container = document.querySelector('.container_image'),
    browses = document.querySelector('.select'),
    inputs = document.querySelector('.form_input input');
    browses.addEventListener('click', () => inputs.click());
    inputs.addEventListener('change', () => {
    let file = inputs.files;
    for (let i = 0; i < file.length; i++) {
        if (files.every(e => e.name !== file[i].name)) {
            files.push(file[i]);
        }
    }
    form.reset();
    showImages();
    })
   
   
    $("#addProductModal").modal("show");
});
const showImages = () => {
    let images = '';
    files.forEach((e, i) => {
        images += `
        <img style="width:110px; height:110px" style="cursor:pointer" src=" ${URL.createObjectURL(e)}" alt="image">
        <span style="cursor:pointer" onclick="delImage(${i})">&times;</span>`
    })
    container.innerHTML = images;
    }
const delImage = index => {
    files.splice(index, 1)
    showImages()
    }
    function changeImage(element) {
    var main_prodcut_image = document.getElementById('main_product_image');
    main_prodcut_image.src = element.src;
    }

// ------
$(document).on("click", "#editProduct", function (e) {
    files = []
    let id = $(this).val();
    form = document.querySelector('form'),
    container = document.querySelector('.container_image_edit'),
    browses = document.querySelector('.selectEdit'),
    inputs = document.querySelector('.form_input_edit input');
    browses.addEventListener('click', () => inputs.click());
    inputs.addEventListener('change', () => {
    let file = inputs.files;
    for (let i = 0; i < file.length; i++) {
        if (files.every(e => e.name !== file[i].name)) {
            files.push(file[i]);
        }
    }
    form.reset();
    showImages();
    })
    $.ajax({
        type: "GET",
        url: "/product/editProduct/" + id,
        success: function (res) {
            console.log(res);
            if (res.status == 200) {
                $("#idProductEdit").val(res.product.id);
                $("#nameProductEdit").val(res.product.name);
                $("#priceProductEdit").val(res.product.price);
                $("#quantityProductEdit").val(res.product.quantity);
                $("#type_genderProductEdit").val(res.product.type_gender);
                $("#statusProductEdit").val(res.product.status);
                $("#categoryProductEdit").val(res.product.category_id);
                $("#supplierProductEdit").val(res.product.supplier_id);
                CKEDITOR.instances.ckeditor1.setData(res.product.description);
                $("#blah1").attr("src", res.product.image);
          
                let imagesEdit = '';
                res.productsImage.forEach((e, i) => {
                    imagesEdit += `
                    <img style="width:110px; height:110px" style="cursor:pointer" src=" ${e.image}" alt="image">`
                })
                container.innerHTML = imagesEdit;

            
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
$(document).on("click", "#confirmUpdateProductEdit", function (event) {
    event.preventDefault();
    var id = $("#idProductEdit").val();
    var name = $("#nameProductEdit").val();
    var price = $("#priceProductEdit").val();
    var quantity = $("#quantityProductEdit").val();
    var description = CKEDITOR.instances.ckeditor1.getData();
    var supplier_id = $("#supplierProductEdit").val();
    var category_id = $("#categoryProductEdit").val();
    var type_gender = $("#type_genderProductEdit").val();
    // var image = $("#imageProductEdit").val();
    // var imageMany = $("#file_names").val();
    var regex = /((^[0-9]{1,9}$)\b)/g;
    var quantityRegex =  regex.test(quantity);
    var regexs = /((^[0-9]{1,19}$)\b)/g;
    var priceRegex =  regexs.test(price);
    var haserrorEdit = false;
    if (name == "") { $("#nameProductEditError").html("Vui Lòng Nhập Tên Sản Phẩm");haserrorEdit = true;}
    if (price == "") { $("#priceProductEditError").html("Hãy Nhập Giá Sản Phẩm");haserrorEdit = true;}
    if (!priceRegex && price != '')  { $("#priceProductEditError").html("Giá Sản Phẩm Quá Lớn");haserrorEdit = true;}
    if (quantity == "") {$("#quantityProductEditError").html("Hãy Nhập Số Lượng Sản Phẩm");haserrorEdit = true;}
    if (!quantityRegex && quantity != '') {$("#quantityProductEditError").html("Số Lượng Sản Phẩm Quá Lớn");haserrorEdit = true;}
    if (description == "") {$("#descriptionProductEditError").html("Hãy Nhập Mô Tả Sản Phẩm"); haserrorEdit = true;}
    if (supplier_id == "") { $("#supplierProductEditError").html("Hãy Chọn Nhà Cung Cấp"); haserrorEdit = true;}
    // if (image == "") { $("#imageProductEditError").html("Hãy Nhập Chọn Ảnh");haserrorEdit = true; }
    if (category_id == "") { $("#categoryProductEditError").html("Chọn Danh Mục");haserrorEdit = true;}
    if (type_gender == "") { $("#type_genderProductEditError").html("Chọn Hạng Mục"); haserrorEdit = true;}
    // if (imageMany == "") { $("#imageManyProductEditError").html("Chọn Ảnh Chi Tiết Sản Phẩm"); haserrorEdit = true;}
    if (haserrorEdit == true) {
        $("#editProductModal").change("shown.bs.modal", function () {
            if ($("#nameProductEdit").val() != "") { $("#nameProductEditError").empty();}
            if ($("#priceProductEdit").val() != "") {$("#priceProductEditError").empty();}
            if ($("#quantityProductEdit").val() != "") { $("#quantityProductEditError").empty();}
            if ($("#supplierProductEdit").val() != "") { $("#supplierProductEditError").empty();}
            if ($("#categoryProductEdit").val() != "") {$("#categoryProductEditError").empty();}
            if ($("#imageProductEdit").val() != "") {$("#imageProductEditError").empty();}
            if ($("#type_genderProductEdit").val() != "") { $("#type_genderProductEditError").empty();}
            if ($("#file_name").val() != "") { $("#imageManyProductEditError").empty();}
            if (CKEDITOR.instances.ckeditor1.getData() != "") {$("#descriptionProductEditError").empty();}
        });
    }
    if (haserrorEdit === false) {
        let formdata = new FormData($("#updateProductEdit")[0]);
            formdata.append("description", description);
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
                    var product = res.product
                    $("#editProductModal").modal("hide");
                    $("#editProductModal").find("input").val("");
                    $("#editProductModal").find("select").val("");
                 
                    var tr = $('tr[data-product-id="' + product.id + '"]');

                    // Tạo HTML mới với thông tin sản phẩm đã cập nhật
                    var html = '<tr data-product-id="' + product.id + '">\
                                   <td><img style="width:100px; height:100px" src="' + product.image +'" alt=""></td>\
                                   <td class="text-danger">' + product.name +'</td>\
                                   <td class="text-danger">' + product.category.name +'</td>\
                                   <td class="text-danger">' + product.price + '</td>\
                                   <td><button style="text-align: center" class="badge badge-danger" value="' + product.id + '" id="editProduct">Sửa</button>\
                                   <button style="text-align: center" class="badge badge-danger" value=' + product.id + ' id="inforProduct">Chi tiết</button>\
                                   <button style="text-align: center" class="badge badge-danger" value="' + product.id + '" id="deleteProduct">Xóa</button></td>\
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
});
// ------
$("#insertProduct").on("submit", function (e) {
    e.preventDefault();
    var name = $("#nameProduct").val();
    var price = $("#priceProduct").val();
    var quantity = $("#quantityProduct").val();
    var description = CKEDITOR.instances.ckeditor.getData();
    var supplier_id = $("#supplierProduct").val();
    var category_id = $("#categoryProduct").val();
    var type_gender = $("#type_genderProduct").val();
    var image = $("#imageProduct").val();
    var imageMany = $("#file_name").val();
    var regex = /((^[0-9]{1,9}$)\b)/g;
    var quantityRegex =  regex.test(quantity);
    var regexs = /((^[0-9]{1,19}$)\b)/g;
    var priceRegex =  regexs.test(price);
    var haserror = false;
    if (name == "") { $("#nameProductAddError").html("Vui Lòng Nhập Tên Sản Phẩm");haserror = true;}
    if (price == "") { $("#priceProductAddError").html("Hãy Nhập Giá Sản Phẩm");haserror = true;}
    if (!priceRegex && price != '')  { $("#priceProductAddError").html("Giá Sản Phẩm Quá Lớn");haserror = true;}
    if (quantity == "") {$("#quantityProductAddError").html("Hãy Nhập Số Lượng Sản Phẩm");haserror = true;}
    if (!quantityRegex && quantity != '') {$("#quantityProductAddError").html("Số Lượng Sản Phẩm Quá Lớn");haserror = true;}
    if (description == "") {$("#descriptionProductAddError").html("Hãy Nhập Mô Tả Sản Phẩm"); haserror = true;}
    if (supplier_id == "") { $("#supplierProductAddError").html("Hãy Chọn Nhà Cung Cấp"); haserror = true;}
    if (image == "") { $("#imageProductAddError").html("Hãy Nhập Chọn Ảnh");haserror = true; }
    if (category_id == "") { $("#categoryProductAddError").html("Chọn Danh Mục");haserror = true;}
    if (type_gender == "") { $("#type_genderProductAddError").html("Chọn Hạng Mục"); haserror = true;}
    if (imageMany == "") { $("#imageManyProductAddError").html("Chọn Ảnh Chi Tiết Sản Phẩm"); haserror = true;}
    if (haserror == true) {
        $("#addProductModal").change("shown.bs.modal", function () {
            if ($("#nameProduct").val() != "") { $("#nameProductAddError").empty();}
            if ($("#priceProduct").val() != "") {$("#priceProductAddError").empty();}
            if ($("#quantityProduct").val() != "") { $("#quantityProductAddError").empty();}
            if ($("#supplierProduct").val() != "") { $("#supplierProductAddError").empty();}
            if ($("#categoryProduct").val() != "") {$("#categoryProductAddError").empty();}
            if ($("#imageProduct").val() != "") {$("#imageProductAddError").empty();}
            if ($("#type_genderProduct").val() != "") { $("#type_genderProductAddError").empty();}
            if ($("#file_name").val() != "") { $("#imageManyProductAddError").empty();}
            if (CKEDITOR.instances.ckeditor.getData() != "") {$("#descriptionProductAddError").empty();}
        });
    }
    if (haserror === false) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#insertProduct")[0]);
        formdata.append("description", description);
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
                        '<tr data-product-id="' + product.id + '">\
                        <td><img style="width:100px; height:100px" src="' + product.image +'" alt=""></td>\
                        <td class="text-danger">' + product.name +'</td>\
                        <td class="text-danger">' +product.category.name +'</td>\
                        <td class="text-danger">' + product.price + '</td>\
                        <td><button style="text-align: center" class="badge badge-danger" value="' + product.id + '" id="editProduct">Sửa</button>\
                        <button style="text-align: center" class="badge badge-danger" value=' + product.id + ' id="inforProduct">Chi tiết</button>\
                        <button style="text-align: center" class="badge badge-danger" value="' + product.id + '" id="deleteProduct">Xóa</button></td>\
                      </tr>'
                    )
                    $("#blah").hide();
                    $('#insertProduct')[0].reset();
                    container.innerHTML = '';
                    CKEDITOR.instances.ckeditor.setData("");
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
                    '<tr data-product-id="' + product.id + '">\
                        <td><img style="width:100px; height:100px" src="' + product.image +'" alt=""></td>\
                        <td class="text-danger">' + product.name +'</td>\
                        <td class="text-danger">' +product.category.name +'</td>\
                        <td class="text-danger">' + product.price + '</td>\
                        <td><button style="text-align: center" class="badge badge-danger" value="' + product.id + '" id="restoreProduct">Lấy lại</button>\
                        <button style="text-align: center" class="badge badge-danger" value="' + product.id +'" id="destroyProduct">Xóa vĩnh viễn</button></td>\
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
                // console.log(products.category);
                product = products.product;
                category = product.category;
                supplier = product.supplier;
                images = product.product_images;
                $("#inforImageProduct").attr("src", product.image);
                $("#inforNameProduct").html("");
                var node = document.createTextNode(product.name);
                $("#inforNameProduct")[0].appendChild(node);
                $("#inforCategoryProduct").html("");
                var node = document.createTextNode(category.name);
                $("#inforCategoryProduct")[0].appendChild(node);

                $("#inforSupplierProduct").html("");
                var node = document.createTextNode(supplier.phone);
                $("#inforSupplierProduct")[0].appendChild(node);

                $("#inforPriceProduct").html("");
                var node = document.createTextNode(product.price);
                $("#inforPriceProduct")[0].appendChild(node);

                $("#inforQuantityProduct").html("");
                var node = document.createTextNode(product.quantity);
                $("#inforQuantityProduct")[0].appendChild(node);

                $("#inforStatusProduct").html("");

                var sts = product.status ? 'Hiện' : 'Ẩn';
                var node = document.createTextNode(sts);
                $("#inforStatusProduct")[0].appendChild(node);

                $("#inforGenderProduct").html("");
                var gender = product.type_gender == 'All' ? "Nam/Nữ" : product.type_gender
                var node = document.createTextNode(gender);
                $("#inforGenderProduct")[0].appendChild(node);


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
