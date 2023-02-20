$(document).ready(function () {
    getUser();
});
//------
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#index-users tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
    $("#searchTrashcan").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#tbodyTrashCanUser tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
// ------
function getUser() {
    $.ajax({
        type: "GET",
        url: "/user/getUser",
        dataType: "json",
        success: function (response) {
            $("#index-users").html(" ");
            $.each(response.users, function (index, user) {
                if (response.status == 200) {
                $("#index-users").append(
                    '<tr data-user-id="' + user.id + '">\
                           <td><img style="width:100px; height:100px" src="' +
                        user.image +
                        '" alt=""></td>\
                           <td class="text-danger">' +
                        user.name +
                        '</td>\
                           <td class="text-danger">' +
                        user.gender +
                        '</td>\
                           <td><label class="badge badge-danger" ><input onclick="myFunction(' +
                        user.id +
                        ')" id="copyPhone' +
                        user.id +
                        '" value="' +
                        user.phone +
                        '" hidden/>' +
                        user.phone +
                        '</label></td>\
                           <td><button style="text-align: center" class="badge badge-danger" value="' +
                        user.id +
                        '" id="editUser">Sửa</button>\
                           <button style="text-align: center" class="badge badge-danger" value=' +
                        user.id +
                        ' id="inforUser">Chi tiết</button>\
                           <button style="text-align: center" class="badge badge-danger" value="' +
                        user.id +
                        '" id="deleteUser">Xóa</button></td>\
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
function myFunction(id) {
    var copyText = document.getElementById("copyPhone" + id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    Swal.fire({
        title: "Sao chép thành công <br><br>"+copyText.value,
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        }
      })
}
// ------

$(document).on("click", "#deleteUser", function (e) {
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
                url: "/user/deleteUser/" + id,
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

$(document).on("click", "#restoreUser", function (e) {
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
                url: "/user/restoreUser/" + id,
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
$(document).on("click", "#destroyUser", function (e) {
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
                url: "/user/destroyUser/" + id,
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
$(document).on("click", "#addUser", function (e) {
    e.preventDefault();
    $("#addUserModal").modal("show");
    $.ajax({
        url: "/user/getProvinces",
        type: "GET",
        dataType: "json",
        success: function (response) {
            $.each(response.Provinces, function (index, Provinces) {
                $("#province_id").append(
                    '<option value="' +
                        Provinces.id +
                        '">' +
                        Provinces.name +
                        "</option>"
                );
            });
        },
    });
});
// ------
$(document).on("click", "#editUser", function (e) {
    let id = $(this).val();
    $.ajax({
        url: "/user/getProvinces",
        type: "GET",
        dataType: "json",
        success: function (response) {
            $.each(response.Provinces, function (index, Provinces) {
                $("#province_edit_id").append(
                    '<option value="' +
                        Provinces.id +
                        '">' +
                        Provinces.name +
                        "</option>"
                );
            });
        },
    });

    $.ajax({
        type: "GET",
        url: "/user/editUser/" + id,
        success: function (res) {
            if (res.status == 200) {
                $("#idUserEdit").val(res.user.id);
                $("#nameUserEdit").val(res.user.name);
                $("#phoneUserEdit").val(res.user.phone);
                $("#emailUserEdit").val(res.user.email);
                $("#genderUserEdit").val(res.user.gender);
                $("#birthdayUserEdit").val(res.user.birthday);
                $("#blah1").attr("src", res.user.image);
                $.ajax({
                    url: "/user/getDistricts",
                    type: "GET",
                    data: {
                        province_id: res.user.province_id,
                    },
                    success: function (data) {
                        $.each(data, function (key, v) {
                            $("#district_edit_id").append(
                                '<option value="' +
                                    v.id +
                                    '">' +
                                    v.name +
                                    "</option>"
                            );
                        });
                    },
                });
                $.ajax({
                    url: "/user/getWards",
                    type: "GET",
                    data: {
                        district_id: res.user.district_id,
                    },
                    success: function (data) {
                        $.each(data, function (key, v) {
                            $("#ward_edit_id").append(
                                '<option value="' +
                                    v.id +
                                    '">' +
                                    v.name +
                                    "</option>"
                            );
                        });
                    },
                });
                $("#province_edit_id").val(res.user.province_id);
                $("#district_edit_id").val(res.user.district_id);
                $("#ward_edit_id").val(res.user.ward_id);
                if ($("#name").val() != "") {
                    $("#nameUserEditError").empty();
                }
                if ($("#phone").val() != "") {
                    $("#phoneUserEditError").empty();
                }
                if ($("#email").val() != "") {
                    $("#emailUserEditError").empty();
                }
                if ($("#gender").val() != "") {
                    $("#genderUserEditError").empty();
                }
                if ($("#birthday").val() != "") {
                    $("#birthdayUserEditError").empty();
                }
                if ($("#province_edit_id").val() != "") {
                    $("#provincesUserEditError").empty();
                }
                if ($("#district_edit_id").val() != "") {
                    $("#districtsUserEditError").empty();
                }
                if ($("#ward_edit_id").val() != "") {
                    $("#wardUserEditError").empty();
                }
                $("#editUserModal").modal("show");
            }
        },
        error: function (err) {
            showError();
        },
    });
});
// ------
$(document).on("click", "#confirmUpdateUser", function (event) {
    event.preventDefault();
    var name = $("#nameUserEdit").val();
    var phone = $("#phoneUserEdit").val();
    var email = $("#emailUserEdit").val();
    var gender = $("#genderUserEdit").val();
    var birthday = $("#birthdayUserEdit").val();
    var province = $("#province_edit_id").val();
    var district = $("#district_edit_id").val();
    var ward = $("#ward_edit_id").val();
    var regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    var phoneRegex =  regex.test(phone);
    var haserrorEdit = false;
    var id = $("#idUserEdit").val();
    if (name == "") {
        $("#nameUserEditError").html("Vui Lòng Nhập Tên");
        haserrorEdit = true;
    }
    if (phone == "") {
        $("#phoneUserEditError").html("Hãy Nhập Số Điện Thoại");
        haserrorEdit = true;
    }
    if (!phoneRegex && phone != "") {
        $("#phoneUserEditError").html("Hãy Nhập Đúng Định Dạng");
        haserrorEdit = true;
    }
    if (email == "") {
        $("#emailUserEditError").html("Hãy Nhập email");
        haserrorEdit = true;
    }
    if (gender == "") {
        $("#genderUserEditError").html("Hãy Chọn Giới Tính");
        haserrorEdit = true;
    }
    if (birthday == "") {
        $("#birthdayUserEditError").html("Hãy Nhập Ngày Sinh");
        haserrorEdit = true;
    }

    if (province == "") {
        $("#provincesUserEditError").html("Hãy Chọn Tỉnh/Thành Phố");
        haserrorEdit = true;
    }
    if (district == "") {
        $("#districtsUserEditError").html("Hãy Chọn Quận/Huyện");
        haserrorEdit = true;
    }
    if (ward == "") {
        $("#wardUserEditError").html("Hãy Chọn Xã/Phường");
        haserrorEdit = true;
    }
    if (haserrorEdit == true) {
        $("#editUserModal").change("shown.bs.modal", function () {
            if ($("#nameUser").val() != "") {
                $("#nameUserEditError").empty();
            }
            if ($("#phoneUser").val() != "") {
                $("#phoneUserEditError").empty();
            }
            if ($("#emailUser").val() != "") {
                $("#emailUserEditError").empty();
            }
            if ($("#genderUser").val() != "") {
                $("#genderUserEditError").empty();
            }
            if ($("#birthdayUser").val() != "") {
                $("#birthdayUserEditError").empty();
            }
            if ($("#province_edit_id").val() != "") {
                $("#provincesUserEditError").empty();
            }
            if ($("#district_edit_id").val() != "") {
                $("#districtsUserEditError").empty();
            }
            if ($("#ward_edit_id").val() != "") {
                $("#wardUserEditError").empty();
            }
        });
    }
    if (haserrorEdit === false) {
        let formdata = new FormData($("#updateUser")[0]);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: "/user/updateUser/" + id,
            data: formdata,
            contentType: false,
            processData: false,

            success: function (res) {
                if (res.status == 200) {
                    var user = res.user
                    $("#editUserModal").modal("hide");
                    $("#editUserModal").find("input").val("");
                    $("#editUserModal").find("select").val("");
                    var tr = $('tr[data-user-id="' + user.id + '"]');

                    // Tạo HTML mới với thông tin sản phẩm đã cập nhật
                    var html = '<tr data-user-id="' + user.id + '">\
                                   <td><img style="width:100px; height:100px" src="' + user.image +'" alt=""></td>\
                                   <td class="text-danger">' + user.name +'</td>\
                                   <td class="text-danger">' + user.gender +'</td>\
                                   <td><label class="badge badge-danger" ><input onclick="myFunction(' + user.id +')" id="copyPhone' +  user.id + '" value="' + user.phone + '" hidden/>' + user.phone + '</label></td>\
                                   <td><button style="text-align: center" class="badge badge-danger" value="' + user.id + '" id="editUser">Sửa</button>\
                                   <button style="text-align: center" class="badge badge-danger" value=' + user.id + ' id="inforUser">Chi tiết</button>\
                                   <button style="text-align: center" class="badge badge-danger" value="' + user.id + '" id="deleteUser">Xóa</button></td>\
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
$("#insertUser").on("submit", function (e) {
    e.preventDefault();
    var name = $("#nameUser").val();
    var phone = $("#phoneUser").val();
    var email = $("#emailUser").val();
    var gender = $("#genderUser").val();
    var birthday = $("#birthdayUser").val();
    var image = $("#imageUser").val();
    var province = $("#province_id").val();
    var district = $("#district_id").val();
    var ward = $("#ward_id").val();
    var regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    var phoneRegex =  regex.test(phone);
    var haserror = false;
    if (name == "") {
        $("#nameUserAddError").html("Vui Lòng Nhập Tên");
        haserror = true;
    }
    if (phone == "") {
        $("#phoneUserAddError").html("Hãy Nhập Số Điện Thoại");
        haserror = true;
    }
    if (!phoneRegex && phone != "") {
        $("#phoneUserAddError").html("Hãy Nhập Đúng Định Dạng");
        haserror = true;
    }
    if (email == "") {
        $("#emailUserAddError").html("Hãy Nhập email");
        haserror = true;
    }
    if (gender == "") {
        $("#genderUserAddError").html("Hãy Chọn Giới Tính");
        haserror = true;
    }
    if (birthday == "") {
        $("#birthdayUserAddError").html("Hãy Nhập Ngày Sinh");
        haserror = true;
    }
    if (image == "") {
        $("#imageUserAddError").html("Hãy Nhập Chọn Ảnh");
        haserror = true;
    }
    if (province == "") {
        $("#provincesUserAddError").html("Chọn Tình/Thành Phố");
        haserror = true;
    }
    if (district == "") {
        $("#districtsUserAddError").html("Chọn Quận/Huyện");
        haserror = true;
    }
    if (ward == "") {
        $("#wardsUserAddError").html("Chọn Xã/Phường");
        haserror = true;
    }
    if (haserror == true) {
        $("#addUserModal").change("shown.bs.modal", function () {
           
            if ($("#nameUser").val() != "") {
                $("#nameUserAddError").empty();
            }
            if ($("#phoneUser").val() != "") {
                $("#phoneUserAddError").empty();
            }
            if ($("#emailUser").val() != "") {
                $("#emailUserAddError").empty();
            }
            if ($("#genderUser").val() != "") {
                $("#genderUserAddError").empty();
            }
            if ($("#birthdayUser").val() != "") {
                $("#birthdayUserAddError").empty();
            }
            if ($("#imageUser").val() != "") {
                $("#imageUserAddError").empty();
            }
            if ($("#province_id").val() != "") {
                $("#provincesUserAddError").empty();
            }
            if ($("#district_id").val() != "") {
                $("#districtsUserAddError").empty();
            }
            if ($("#ward_id").val() != "") {
                $("#wardsUserAddError").empty();
            }
        });
    }
    if (haserror === false) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#insertUser")[0]);
        $.ajax({
            url: "/user/storeUser",
            method: "post",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == 200) {
                    $("#addUserModal").modal("hide");
                    $("#addUserModal").find("input").val("");
                    $("#addUserModal").find("select").val("");
                    let user = res.user;
                    $("#index-users").prepend(
                        '<tr data-user-id="' + user.id + '">\
                           <td><img style="width:100px; height:100px" src="' +
                        user.image +
                        '" alt=""></td>\
                           <td class="text-danger">' +
                        user.name +
                        '</td>\
                           <td class="text-danger">' +
                        user.gender +
                        '</td>\
                           <td><label class="badge badge-danger" ><input onclick="myFunction(' +
                        user.id +
                        ')" id="copyPhone' +
                        user.id +
                        '" value="' +
                        user.phone +
                        '" hidden/>' +
                        user.phone +
                        '</label></td>\
                           <td><button style="text-align: center" class="badge badge-danger" value="' +
                        user.id +
                        '" id="editUser">Sửa</button>\
                           <button style="text-align: center" class="badge badge-danger" value=' +
                        user.id +
                        ' id="inforUser">Chi tiết</button>\
                           <button style="text-align: center" class="badge badge-danger" value="' +
                        user.id +
                        '" id="deleteUser">Xóa"</button></td>\
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
$(function () {
    $(document).on("change", ".province_id, .add_user", function () {
        var province_id = $(this).val();
        $.ajax({
            url: "/user/getDistricts",
            type: "GET",
            data: {
                province_id: province_id,
            },
            success: function (data) {
                let district = '<option value="">Chọn Quận/Huyện</option>';
                $(".district_id").html(district);
                let ward = '<option value="">Chọn Xã/Phường</option>';
                $(".ward_id").html(ward);
                $.each(data, function (key, v) {
                    $(".district_id").append(
                        '<option value="' + v.id + '">' + v.name + "</option>"
                    );
                });
            },
        });
    });
});
// ------
$(function () {
    $(document).on("change", ".district_id, .add_user", function () {
        var district_id = $(this).val();
        $.ajax({
            url: "/user/getWards",
            type: "GET",
            data: {
                district_id: district_id,
            },
            success: function (data) {
                var html = '<option value="">Chọn Xã/Phường</option>';
                $(".ward_id").html(html);
                $.each(data, function (key, v) {
                    $(".ward_id").append(
                        '<option value="' + v.id + '">' + v.name + "</option>"
                    );
                });
            },
        });
    });
});
// ------
$(document).ready(function () {
    if ($("#blah").hide()) {
        $("#blah").hide();
    }
    $("#imageUser").change(function () {
        $("#blah").show();
        const file = $(this)[0].files;
        if (file[0]) {
            jQuery("#blah").attr("src", URL.createObjectURL(file[0]));
            jQuery("#blah1").attr("src", URL.createObjectURL(file[0]));
        }
    });
    $("#imageUserEdit").change(function () {
        $("#blah1").show();
        const file = $(this)[0].files;
        if (file[0]) {
            jQuery("#blah1").attr("src", URL.createObjectURL(file[0]));
        }
    });
});
//---------
$(document).on("click", "#close-modal", function () {
    getUser();
    $('#searchTrashcan').val("");
    $("#trashCanUserModal").modal("hide");
});
// ------
$(document).on("click", "#trashCanUser", function (e) {
    e.preventDefault();
    $.ajax({
        url: "/user/getTrashCanUser",
        type: "GET",
        success: function (response) {
            if (response.status == 200) {
                $("#tbodyTrashCanUser").html(" ");
                $.each(response.users, function (index, user) {
                    $("#tbodyTrashCanUser").append(
                        '<tr data-user-id="' + user.id + '">\
                    <td><img style="width:100px; height:100px" src="' +
                            user.image +
                            '" alt=""></td>\
                    <td class="text-danger">' +
                            user.name +
                            '</td>\
                    <td class="text-danger">' +
                            user.gender +
                            '</td>\
                    <td><label class="badge badge-danger" ><input onclick="myFunction(' +
                            user.id +
                            ')" id="copyPhone' +
                            user.id +
                            '" value="' +
                            user.phone +
                            '" hidden/>' +
                            user.phone +
                            '</label></td>\
                    <td><button style="text-align: center" class="badge badge-danger" value="' +
                            user.id +
                            '" id="restoreUser">Lấy lại</button>\
                    <button style="text-align: center" class="badge badge-danger" value="' +
                            user.id +
                            '" id="destroyUser">Xóa vĩnh viễn</button></td>\
                </tr>'
                    );
                });
                $("#trashCanUserModal").modal("show");
            } else {
                showError();
            }
        },
    });
});
// ------
$(document).on("click", "#inforUser", function (e) {
    let id = $(this).val();
    $.ajax({
        url: "/user/inforUser/" + id,
        method: "GET",
        success: function (users) {
            if (users.status == 200) {
                user = users.user;
                $("#inforImageUser").attr("src", user.image);
                $("#inforNameUser").html("");
                var node = document.createTextNode(user.name);
                $("#inforNameUser")[0].appendChild(node);
                $("#inforEmailUser").html("");
                var node = document.createTextNode(user.email);
                $("#inforEmailUser")[0].appendChild(node);

                $("#inforPhoneUser").html("");
                var node = document.createTextNode(user.phone);
                $("#inforPhoneUser")[0].appendChild(node);

                $("#inforGenderUser").html("");
                var node = document.createTextNode(user.gender);
                $("#inforGenderUser")[0].appendChild(node);

                $("#inforBirthdayUser").html("");
                var node = document.createTextNode(user.birthday);
                $("#inforBirthdayUser")[0].appendChild(node);
                $("#inforUserModal").modal("show");
            } else {
                showError();
            }
        },
        errors: function () {
            showError();
        },
    });
})
