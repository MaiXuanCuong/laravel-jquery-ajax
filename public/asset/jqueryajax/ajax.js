$(document).ready(function() {
    getUser();
});
// ------
function getUser(){
    $.ajax({
        type: 'GET',
        url: '/user/get_user',
        dataType: 'json',
        success: function(response){
            $('tbody').html(" ");
            $.each(response.users, function(index, user){
                $('tbody').append(
                    '<tr>\
                           <td><img style="width:100px; height:100px" src="'+ user.image +'" alt=""></td>\
                           <td class="text-danger">'+ user.name +'</td>\
                           <td class="text-danger">'+ user.gender +'</td>\
                           <td><label class="badge badge-danger" ><input onclick="myFunction('+ user.id +')" id="copyPhone'+ user.id +'" value="'+ user.phone +'" hidden/>'+ user.phone +'</label></td>\
                           <td><button style="text-align: center" class="badge badge-danger" onclick=editUser('+ user.id +') id="editUser">Sửa</button> &nbsp;&nbsp; \
                           <button style="text-align: center" class="badge badge-danger" value="'+ user.id +'" id="deleteUser">Xóa</button></td>\
                         </tr>'
                )
            })
        }
    })
}
// ------
function myFunction(id) {
    // Get the text field
    var copyText = document.getElementById("copyPhone"+id);
    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);
    // Alert the copied text
    alert("Sao chép thành công: " + copyText.value);
  }
// ------
$(document).on('click', '#deleteUser' ,function(e) {
    e.preventDefault();
    var id = $(this).val();
    $('#confirm-text').html('');
    var node = document.createTextNode("Xóa User này không?");
    $('#confirm-text')[0].appendChild(node);
    $('#confirm').val(id);
    $('#confirm-true').addClass("confirmdeleteUser");
    $('#confirmUserModal').modal('show');
})
// ------
$(document).on('click', '#restoreUser' ,function(e) {
    e.preventDefault();
    $('#trashCanUserModal').modal('hide');
    var id = $(this).val();
    $('#confirm-text').html('');
    var node = document.createTextNode("khôi phục User này không?");
    $('#confirm-text')[0].appendChild(node);
    $('#confirm').val(id);
    $('#confirm-true').addClass("confirmrestoreUser");
    $('#confirmUserModal').modal('show');
})
// ------
$(document).on('click', '#destroyUser' ,function(e) {
    e.preventDefault();
    $('#trashCanUserModal').modal('hide');
    var id = $(this).val();
    $('#confirm-text').html('');
    var node = document.createTextNode("Xóa vĩnh viễn User này không?");
    $('#confirm-text')[0].appendChild(node);
    $('#confirm').val(id);
    $('#confirm-true').addClass("confirmdestroyUser");
    $('#confirmUserModal').modal('show');
})
// -------
$(document).on('click', '.confirmdeleteUser', function(e){
    e.preventDefault();
    var id = $('#confirm').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url : "/user/delete_user/"+id,
        success: function(){
            showSuccess();
            $('#confirm').val("");
            $('#confirm-true').removeClass("confirmdeleteUser");
            getUser();
            $('#confirmUserModal').modal('hide');
        },
        error: function(e) {
            showError();
        }
    })
})
// --------
$(document).on('click', '.confirmrestoreUser', function(e){
    e.preventDefault();
    var id = $('#confirm').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url : "/user/restore_user/"+id,
        success: function(){
            getUser();
            showSuccess();
            $('#confirm').val("");
            $('#confirmUserModal').modal('hide');
        },
        error: function(e) {
            showError();
        }
    })
})
// ------
$(document).on('click', '.confirmdestroyUser', function(e){
    e.preventDefault();
    var id = $('#confirm').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url : "/user/destroy_user/"+id,
        success: function(){
            getUser();
            showSuccess();
            $('#confirm').val("");
            $('#confirmUserModal').modal('hide');
        },
        error: function(e) {
            showError();
        }
    })
})
// ------
$(document).on('click','#addUser', function(e){
    e.preventDefault();
    $('#addUserModal').modal('show');
    $.ajax({
        url: '/user/getProvinces',
        type: 'GET',
        dataType: 'json',
        success: function(response){
            $.each(response.Provinces, function(index, Provinces){
                $('#province_id').append(
                    '<option value="'+Provinces.id+'">'+Provinces.name+'</option>'
                )
            })
        }
    });
})
// ------
function editUser(user){
    $('#editUserModal').modal('show');
    $.ajax({
        url: '/user/getProvinces',
        type: 'GET',
        dataType: 'json',
        success: function(response){
            $.each(response.Provinces, function(index, Provinces){
                $('#province_edit_id').append(
                    '<option value="'+Provinces.id+'">'+Provinces.name+'</option>'
                )
            })
        }
    });
   
    $.ajax({
        type: 'GET',
        url: '/user/edit_user/'+user,
        success: function(res){
            if(res.status == 200){
                $('#idUserEdit').val(res.user.id);
                $('#nameUserEdit').val(res.user.name);
                $('#phoneUserEdit').val(res.user.phone);
                $('#emailUserEdit').val(res.user.email);
                $('#genderUserEdit').val(res.user.gender);
                $('#birthdayUserEdit').val(res.user.birthday);
                $('#blah1').attr('src', res.user.image);
                $.ajax({
                    url: "/user/getDistricts",
                    type: "GET",
                    data: {
                        province_id: res.user.province_id
                    },
                    success: function(data) {
                      
                        var html = '<option value="">Chọn Quận/Huyện</option>';
                        $.each(data, function(key, v) {
                            $('#district_edit_id').append(
                                '<option value="'+v.id+'">'+v.name+'</option>'
                            )
                        });
                    }
                });
                $.ajax({
                    url: "/user/getWards",
                    type: "GET",
                    data: {
                        district_id: res.user.district_id
                    },
                    success: function(data) {
                        var html = '<option value="">Chọn Xã/Phường</option>';
                        $.each(data, function(key, v) {
                            $('#ward_edit_id').append(
                                '<option value="'+v.id+'">'+v.name+'</option>'
                            )
                        });
                    }
                })
                $('#province_edit_id').val(res.user.province_id);
                $('#district_edit_id').val(res.user.district_id);
                $('#ward_edit_id').val(res.user.ward_id);
            }
        },
        error: function(err) {
            showError();
        }
    })
}
// ------
function updateUser(event){
    event.preventDefault();
    var name = $('#nameUserEdit').val();
    var phone = $('#phoneUserEdit').val();
    var email = $('#emailUserEdit').val();
    var gender = $('#genderUserEdit').val();
    var birthday = $('#birthdayUserEdit').val();
    var province = $('#province_edit_id').val();
    var district = $('#district_edit_id').val();
    var ward = $('#ward_edit_id').val();
    // var image = $('#imageUserEdit').val();
    var haserrorEdit = false;
    var id = $('#idUserEdit').val();
    if(name == ""){
        $('#nameUserEditError').html('Vui Lòng Nhập Tên');
        haserrorEdit = true;
    }
    if(phone == ""){
        $('#phoneUserEditError').html('Hãy Nhập Số Điện Thoại');
        haserrorEdit = true;
    }
    if(email == ""){
        $('#emailUserEditError').html('Hãy Nhập email');
        haserrorEdit = true;
    }
    if(gender == ""){
        $('#genderUserEditError').html('Hãy Chọn Giới Tính');
        haserrorEdit = true;
    }
    if(birthday == ""){
        $('#birthdayUserEditError').html('Hãy Nhập Ngày Sinh');
        haserrorEdit = true;
    }

    if(province == ""){
        $('#provincesUserEditError').html('Hãy Chọn Tỉnh/Thành Phố');
        haserrorEdit = true;
    }
    if(district == ""){
        $('#districtsUserEditError').html('Hãy Chọn Quận/Huyện');
        haserrorEdit = true;
    }
    if(ward == ""){
        $('#wardUserEditError').html('Hãy Chọn Xã/Phường');
        haserrorEdit = true;
    }
        if(haserrorEdit == true){
            $('#editUserModal').change('shown.bs.modal', function() {
                if($('#name').val() != ""){
                    $('#nameUserEditError').empty()
                }
                if($('#phone').val() != ""){
                    $('#phoneUserEditError').empty()
                }
                if($('#email').val() != ""){
                    $('#emailUserEditError').empty()
                }
                if($('#gender').val() != ""){
                    $('#genderUserEditError').empty()
                }
                if($('#birthday').val() != ""){
                    $('#birthdayUserEditError').empty()
                }
                if($('#province_edit_id').val() != ""){
                    $('#provincesUserEditError').empty()
                }
                if($('#district_edit_id').val() != ""){
                    $('#districtsUserEditError').empty()
                }
                if($('#ward_edit_id').val() != ""){
                    $('#wardUserEditError').empty()
                }
        })
        }
        if(haserrorEdit === false){
            let formdata = new FormData($('#updateUser')[0]);
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
        type: "POST",
        url: "/user/update_user/"+id,
        data: formdata,
        contentType:false,
        processData:false,
        
        success: function(res){
            $('#editUserModal').modal('hide');
            $('#editUserModal').find('input').val("");
            $('#editUserModal').find('select').val("");
            getUser();
            showSuccess();
        },
        error: function(err) {
            showError();
        }
    })
    }
}
// ------
$('#insertUser').on('submit', function(e){
    e.preventDefault();
    var name = $('#nameUser').val();
     var phone = $('#phoneUser').val();
     var email = $('#emailUser').val();
     var gender = $('#genderUser').val();
     var birthday = $('#birthdayUser').val();
     var image = $('#imageUser').val();
     var province = $('#province_id').val();
     var district = $('#district_id').val();
     var ward = $('#ward_id').val();
     
     var haserror = false;
 if(name == ""){
     $('#nameUserAddError').html('Vui Lòng Nhập Tên');
     haserror = true;
 }
 if(phone == ""){
     $('#phoneUserAddError').html('Hãy Nhập Số Điện Thoại');
     haserror = true;
 }
 if(email == ""){
     $('#emailUserAddError').html('Hãy Nhập email');
     haserror = true;
 }
 if(gender == ""){
     $('#genderUserAddError').html('Hãy Chọn Giới Tính');
     haserror = true;
 }
 if(birthday == ""){
     $('#birthdayUserAddError').html('Hãy Nhập Ngày Sinh');
     haserror = true;
 }
 if(image == ""){
     $('#imageUserAddError').html('Hãy Nhập Chọn Ảnh');
     haserror = true;
 }
 if(province == ""){
    $('#provincesUserAddError').html('Chọn Tình/Thành Phố');
    haserror = true;
}
if(district == ""){
    $('#districtsUserAddError').html('Chọn Quận/Huyện');
    haserror = true;
}
if(ward == ""){
    $('#wardsUserAddError').html('Chọn Xã/Phường');
    haserror = true;
}
     if(haserror == true){
         $('#addUserModal').change('shown.bs.modal', function() {
             if($('#name').val() != ""){
                 $('#nameUserAddError').empty()
             }
             if($('#phone').val() != ""){
                 $('#phoneUserAddError').empty()
             }
             if($('#email').val() != ""){
                 $('#emailUserAddError').empty()
             }
             if($('#gender').val() != ""){
                 $('#genderUserAddError').empty()
             }
             if($('#birthday').val() != ""){
                 $('#birthdayUserAddError').empty()
             }
             if($('#image').val() != ""){
                 $('#imageUserAddError').empty()
             }
             if($('#province_id').val() != ""){
                $('#provincesUserAddError').empty()
            }
            if($('#district_id').val() != ""){
                $('#districtsUserAddError').empty()
            }
            if($('#ward_id').val() != ""){
                $('#wardsUserAddError').empty()
            }
     })
     }
     if(haserror === false){
         $.ajaxSetup({
             headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         let formdata = new FormData($('#insertUser')[0]);
         $.ajax({
             url:"/user/store_user",
             method: "post",
             data: formdata,
             contentType:false,
             processData:false,
             success: function(data) {
                 $('#addUserModal').modal('hide');
                 $('#addUserModal').find('input').val("");
                 $('#addUserModal').find('select').val("");
                 getUser();
                 $('#blah').hide();
                 jQuery('#blah1').attr('src', '');
                 showSuccess();

             },
             error: function(err) {
             showError();
             }
         });
     }
})
// ------
$(function() {
    $(document).on('change', '.province_id, .add_user', function() {
        var province_id = $(this).val();
        $.ajax({
            url: "/user/getDistricts",
            type: "GET",
            data: {
                province_id: province_id
            },
            success: function(data) {
                let district = '<option value="">Chọn Quận/Huyện</option>';
                $('.district_id').html(district);
                let ward = '<option value="">Chọn Xã/Phường</option>';
                $('.ward_id').html(ward);
                $.each(data, function(key, v) {
                    $('.district_id').append(
                        '<option value="'+v.id+'">'+v.name+'</option>'
                    )
                });
            }
        })
    });
});
// ------
$(function() {
    $(document).on('change', '.district_id, .add_user', function() {
        var district_id = $(this).val();
        $.ajax({
            url: "/user/getWards",
            type: "GET",
            data: {
                district_id: district_id
            },
            success: function(data) {
                var html = '<option value="">Chọn Xã/Phường</option>';
                $('.ward_id').html(html);
                $.each(data, function(key, v) {
                    $('.ward_id').append(
                        '<option value="'+v.id+'">'+v.name+'</option>'
                    )
                });
            }
        })
    });
});
// ------
$(document).ready(function() {
    if( $('#blah').hide()){
      $('#blah').hide();
    }
    $('#imageUser').change(function() {
          $('#blah').show();
          const file = $(this)[0].files;
          if (file[0]) {
              jQuery('#blah').attr('src', URL.createObjectURL(file[0]));
              jQuery('#blah1').attr('src', URL.createObjectURL(file[0]));
          }
      });
    $('#imageUserEdit').change(function() {
          $('#blah1').show();
          const file = $(this)[0].files;
          if (file[0]) {
              jQuery('#blah1').attr('src', URL.createObjectURL(file[0]));
          }
      });
  });
// ------
  $(document).on('click','#trashCanUser', function(e){
    e.preventDefault();
    $('#trashCanUserModal').modal('show');
    $.ajax({
        url: '/user/getTrashCanUser',
        type: 'GET',
        success: function(response){
            $('#tbodyTrashCanUser').html(" ");
                $.each(response.users.data, function(index, user){
                    $('#tbodyTrashCanUser').append(
                '<tr>\
                    <td><img style="width:100px; height:100px" src="'+ user.image +'" alt=""></td>\
                    <td class="text-danger">'+ user.name +'</td>\
                    <td class="text-danger">'+ user.gender +'</td>\
                    <td><label class="badge badge-danger" ><input onclick="myFunction('+ user.id +')" id="copyPhone'+ user.id +'" value="'+ user.phone +'" hidden/>'+ user.phone +'</label></td>\
                    <td><button style="text-align: center" class="badge badge-danger" value="'+ user.id +'" id="restoreUser">Lấy lại</button> &nbsp;&nbsp; \
                    <button style="text-align: center" class="badge badge-danger" value="'+ user.id +'" id="destroyUser">Xóa vĩnh viễn</button></td>\
                </tr>'
                    )
                })
        }
    });
})
// ------

