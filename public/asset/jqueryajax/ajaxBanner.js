
$(document).ready(function(){
    getBanner();
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#index-banners tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
// -------
function getBanner() {
    $.ajax({
        type: "GET",
        url: "/banner/getBanner",
        dataType: "json",
        success: function (response) {
            if (response.status == 200) {
                $("#index-banners").html(" ");
                $.each(response.banners, function (index, banner) {
                    $("#index-banners").append(
                        '<tr data-banner-id="' + banner.id + '">\
                               <td><img style="width:100px; height:100px" src="' + banner.image +'" alt=""></td>\
                               <td>' + (banner.status == 1 ? '<i data-value="'+banner.status+'" data-id="'+banner.id+'" style="color:green;" class="mdi mdi-eye"></i>' : '<i data-value="'+banner.status+'" data-id="'+banner.id+'" style="color:red" class="mdi mdi-eye-off"></i>') +'</td>\
                               <td><button style="text-align: center" class="badge badge-danger" data-status="' + banner.status + '" data-image="' + banner.image + '" value=' + banner.id + ' id="editBanner">Sửa</button>\
                               <button style="text-align: center" class="badge badge-danger" data-status="' + banner.status + '" data-image="' + banner.image + '" value=' + banner.id +' id="inforBanner">Chi tiết</button>\
                               <button style="text-align: center" class="badge badge-danger" value="' + banner.id + '" id="deleteBanner">Xóa</button></td>\
                             </tr>'
                    );
                });
            } else {
                showError();
            }
        },
    });
}

$(document).on('click', '.mdi', function(e){
    e.preventDefault();
    var status = $(this).data('value');
    var id = $(this).data('id');
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
            "content"
        ),
    },
});
$.ajax({
    type: "POST",
    url: "/banner/updateStatus/"+id+'/'+ status,
    success: function (res) {
        if (res.status == 200) {
            var banner = res.banner;
            var tr = $('tr[data-banner-id="' + banner.id + '"]');
            var html =  '<tr data-banner-id="' + banner.id + '">\
            <td><img style="width:100px; height:100px" src="' + banner.image +'" alt=""></td>\
            <td>' + (banner.status == 1 ? '<i data-value="'+banner.status+'" data-id="'+banner.id+'" style="color:green;" class="mdi mdi-eye"></i>' : '<i data-value="'+banner.status+'" data-id="'+banner.id+'" style="color:red" class="mdi mdi-eye-off"></i>') +'</td>\
            <td><button style="text-align: center" class="badge badge-danger" data-status="' + banner.status + '" data-image="' + banner.image + '" value=' + banner.id + ' id="editBanner">Sửa</button>\
            <button style="text-align: center" class="badge badge-danger" data-status="' + banner.status + '" data-image="' + banner.image + '" value=' + banner.id +' id="inforBanner">Chi tiết</button>\
            <button style="text-align: center" class="badge badge-danger" value="' + banner.id + '" id="deleteBanner">Xóa</button></td>\
          </tr>';
            tr.replaceWith(html);
        }
    },
    error: function (e) {
    },
});
})
$(document).on("click", "#deleteBanner", function (e) {
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
                url: "/banner/deleteBanner/" + id,
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
$(document).on("click", "#editBanner", function (e) {
    e.preventDefault();
    var id = $(this).val();
    var status = $(this).data('status');
    var image = $(this).data('image');
  
    $("#idBannerEdit").val(id);
    $("#statusBannerEdit").val(status);
    $("#blah1").attr("src", image);
    $("#editBannerModal").modal("show");
     
    });
$(document).on("click", "#confirmeditBanner", function (e) {
    e.preventDefault();
        var id = $("#idBannerEdit").val();
        let formdata = new FormData($("#updateBanner")[0]);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: "/banner/updateBanner/" + id,
            data: formdata,
            contentType: false,
            processData: false,

            success: function (res) {
                if (res.status === 200) {
                    var banner = res.banner
                    $("#editBannerModal").modal("hide");
                    $("#editBannerModal").find("input").val("");
                    var tr = $('tr[data-banner-id="' + banner.id + '"]');
                    var html =   '<tr data-banner-id="' + banner.id + '">\
                    <td><img style="width:100px; height:100px" src="' + banner.image +'" alt=""></td>\
                    <td>' + (banner.status == 1 ? '<i data-value="'+banner.status+'" data-id="'+banner.id+'" style="color:green;" class="mdi mdi-eye"></i>' : '<i data-value="'+banner.status+'" data-id="'+banner.id+'" style="color:red" class="mdi mdi-eye-off"></i>') +'</td>\
                    <td><button style="text-align: center" class="badge badge-danger" data-status="' + banner.status + '" data-image="' + banner.image + '" value=' + banner.id + ' id="editBanner">Sửa</button>\
                    <button style="text-align: center" class="badge badge-danger" data-status="' + banner.status + '" data-image="' + banner.image + '" value=' + banner.id +' id="inforBanner">Chi tiết</button>\
                    <button style="text-align: center" class="badge badge-danger" value="' + banner.id + '" id="deleteBanner">Xóa</button></td>\
                  </tr>';
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
})
// ------
$(document).on("click", "#addBanner", function (e) {
    e.preventDefault();
    $("#addBannerModal").modal("show");
});
// ------
$("#insertBanner").on("submit", function (e) {
    e.preventDefault();
    var status = $("#statusBanner").val();
    var image = $("#imageBanner").val();
    var haserror = false;

    if (status == "") {
        $("#statusBannerAddError").html("Hãy chọn trạng thái");
        haserror = true;
    }

    if (image == "") {
        $("#imageBannerAddError").html("Hãy Nhập Chọn Ảnh");
        haserror = true;
    }
    if (haserror == true) {
        $("#addBannerModal").change("shown.bs.modal", function () {
            if ($("#statusBanner").val() != "") {
                $("#statusBannerAddError").empty();
            }
            if ($("#imageBanner").val() != "") {
                $("#imageBannerAddError").empty();
            }
        });
    }
    if (haserror === false) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#insertBanner")[0]);
        $.ajax({
            url: "/banner/storeBanner",
            method: "post",
            data: formdata,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == 200) {
                    $("#addBannerModal").modal("hide");
                    $("#addBannerModal").find("input").val("");
                    let banner = res.banner;
                    $("#index-banners").prepend(
                        '<tr data-banner-id="' + banner.id + '">\
                        <td><img style="width:100px; height:100px" src="' + banner.image +'" alt=""></td>\
                        <td>' + (banner.status == 1 ? '<i data-value="'+banner.status+'" data-id="'+banner.id+'" style="color:green;" class="mdi mdi-eye"></i>' : '<i data-value="'+banner.status+'" data-id="'+banner.id+'" style="color:red" class="mdi mdi-eye-off"></i>') +'</td>\
                        <td><button style="text-align: center" class="badge badge-danger" data-status="' + banner.status + '" data-image="' + banner.image + '" value=' + banner.id + ' id="editBanner">Sửa</button>\
                        <button style="text-align: center" class="badge badge-danger" data-status="' + banner.status + '" data-image="' + banner.image + '" value=' + banner.id +' id="inforBanner">Chi tiết</button>\
                        <button style="text-align: center" class="badge badge-danger" value="' + banner.id + '" id="deleteBanner">Xóa</button></td>\
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
    $("#imageBanner").change(function () {
        $("#blah").show();
        const file = $(this)[0].files;
        if (file[0]) {
            jQuery("#blah").attr("src", URL.createObjectURL(file[0]));
            jQuery("#blah1").attr("src", URL.createObjectURL(file[0]));
        }
    });
    $("#imageBannerEdit").change(function () {
        $("#blah1").show();
        const file = $(this)[0].files;
        if (file[0]) {
            jQuery("#blah1").attr("src", URL.createObjectURL(file[0]));
        }
    });
});
// ------
$(document).on("click", "#inforBanner", function (e) {
    var status = $(this).data('status');
    var image = $(this).data('image');  
        $("#inforImageBanner").attr("src", image);
        var sts = status == 1 ? "Trạng thái ảnh: Hiện" : "Trạng thái ảnh: Ẩn"
        var node = document.createTextNode(sts);
        $("#inforStatusBanner").html('')
        $("#inforStatusBanner")[0].appendChild(node);
        $("#inforBannerModal").modal("show");
})
