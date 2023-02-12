// window.onload = function() {
//     getUser();
       
//   }
$(document).ready(function() {
    getUser();
});

function getUser(){
    $.ajax({
        type: 'GET',
        url: '/get_user',
        dataType: 'json',
        success: function(response){
            // console.log(response.users);
            $('tbody').html(" ");
            $.each(response.users, function(index, user){
                // console.log(user);
                $('tbody').append(
                    '<tr>\
                           <td><img style="width:100px; height:100px" src="'+ user.image +'" alt=""></td>\
                           <td class="text-danger">'+ user.name +'</td>\
                           <td class="text-danger">'+ user.gender +'</td>\
                           <td><label class="badge badge-danger" ><input onclick="myFunction()" id="copyPhone" value="'+ user.phone +'" hidden/>'+ user.phone +'</label></td>\
                           <td><button style="text-align: center" class="badge badge-danger" onclick=editUser('+ user.id +') id="editUser">Sửa</button> &nbsp;&nbsp; \
                           <button style="text-align: center" class="badge badge-danger" value="'+ user.id +'" id="deleteUser">Xóa</button></td>\
                         </tr>'
                )
            })

        }
    })
}



function myFunction() {
    // Get the text field
    var copyText = document.getElementById("copyPhone");
  
    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
  
    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);
    
    // Alert the copied text
    alert("Sao chép thành công: " + copyText.value);
  }

// delete user 
// function deleteUser(id) {
//     $.ajax({
//         url: "/delete_user/"+id,
//         type: "DELETE",
//         data: {
//             delete: id,
//         },
//         success: function(data, status) {
//             // console.log(status);
//             // console.log(data);
//             getUser();
//             showSuccess();
        
//         },
//         error: function() {
//             showError();
//         }
//     });

// }

$(document).on('click', '#deleteUser' ,function(e) {
    e.preventDefault();
    var id = $(this).val();
    $('#confirm_delete_user').val(id);
    $('#confirmUserModal').modal('show');
})
$(document).on('click', '#confirm-true', function(e){
    e.preventDefault();
    var id = $('#confirm_delete_user').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url : "/delete_user/"+id,
        success: function(){
            getUser();
            showSuccess();
            $('#confirmUserModal').modal('hide');
        },
        error: function(e) {
            console.log(id);
            console.log(e);
            showError();
        }
    })
})

//add vs lấy tỉnh
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


// edit user
function editUser(user){
    $('#editUserModal').modal('show');
    $.ajax({
        type: 'GET',
        url: '/edit_user/'+user,
        success: function(res){
            if(res.status == 200){
    console.log(res);

                $('#idUserEdit').val(res.user.id)
                $('#nameUserEdit').val(res.user.name)
                $('#phoneUserEdit').val(res.user.phone)
                $('#emailUserEdit').val(res.user.email)
                $('#genderUserEdit').val(res.user.gender)
                $('#birthdayUserEdit').val(res.user.birthday)
                $('#blah1').attr('src', res.user.image);
                
            }
        },
        error: function(err) {
            showError();
        }
        
    })

}

// update user 
function updateUser(event){
    event.preventDefault();
    var name = $('#nameUserEdit').val();
    var phone = $('#phoneUserEdit').val();
    var email = $('#emailUserEdit').val();
    var gender = $('#genderUserEdit').val();
    var birthday = $('#birthdayUserEdit').val();
    var image = $('#imageUserEdit').val();
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
    if(image == ""){
        $('#imageUserEditError').html('Hãy Nhập Chọn Ảnh');
        haserrorEdit = true;
    }
        if(haserrorEdit == true){
            $('#editUserModal').keyup('shown.bs.modal', function() {
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
                if($('#image').val() != ""){
                    $('#imageUserEditError').empty()
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
        type: "PUT",
        url: "update_user/"+id,
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
         $('#addUserModal').keyup('shown.bs.modal', function() {
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
             url:"/store_user",
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
                 console.log(err);
             showError();
             }
         });

     }
})

$(function() {
    $(document).on('change', '.province_id, .add_user', function() {
        var province_id = $(this).val();
        var district_name = $('.district_id').find('option:selected').text();
        $.ajax({
            url: "/user/getDistricts",
            type: "GET",
            data: {
                province_id: province_id
            },
            success: function(data) {
                console.log(data);
                var html = '<option value="">Chọn Quận/Huyện</option>';
                $.each(data, function(key, v) {
                    console.log(v);
                    html += '<option value=" ' + v.id + ' "> ' + v
                        .name + '</option>';
                });
                $('.district_id').html(html);
            }
        })
    });
});
$(function() {
    $(document).on('change', '#district_id, .add_user', function() {
        var district_id = $(this).val();
        var ward_id = $(this).val();
        $.ajax({
            url: "/user/getWards",
            type: "GET",
            data: {
                district_id: district_id
            },
            success: function(data) {
                console.log(data);
                var html = '<option value="">Chọn Xã/Phường</option>';
                $.each(data, function(key, v) {
                    html += '<option value =" ' + v.id + ' "> ' + v.name +
                        '</option>';
                });
                $('#ward_id').html(html);
            }
        })
    });
});





// create user 
// function add(event) {
//     event.preventDefault();
//     var name = $('#nameUser').val();
//     var phone = $('#phoneUser').val();
//     var email = $('#emailUser').val();
//     var gender = $('#genderUser').val();
//     var birthday = $('#birthdayUser').val();
//     var image = $('#imageUser').val();
//     var haserror = false;
// if(name == ""){
//     $('#nameUserAddError').html('Vui Lòng Nhập Tên');
//     haserror = true;
// }
// if(phone == ""){
//     $('#phoneUserAddError').html('Hãy Nhập Số Điện Thoại');
//     haserror = true;
// }
// if(email == ""){
//     $('#emailUserAddError').html('Hãy Nhập email');
//     haserror = true;
// }
// if(gender == ""){
//     $('#genderUserAddError').html('Hãy Chọn Giới Tính');
//     haserror = true;
// }
// if(birthday == ""){
//     $('#birthdayUserAddError').html('Hãy Nhập Ngày Sinh');
//     haserror = true;
// }
// if(image == ""){
//     $('#imageUserAddError').html('Hãy Nhập Chọn Ảnh');
//     haserror = true;
// }
//     if(haserror == true){
//         $('#addUserModal').keyup('shown.bs.modal', function() {
//             if($('#name').val() != ""){
//                 $('#nameUserAddError').empty()
//             }
//             if($('#phone').val() != ""){
//                 $('#phoneUserAddError').empty()
//             }
//             if($('#email').val() != ""){
//                 $('#emailUserAddError').empty()
//             }
//             if($('#gender').val() != ""){
//                 $('#genderUserAddError').empty()
//             }
//             if($('#birthday').val() != ""){
//                 $('#birthdayUserAddError').empty()
//             }
//             if($('#image').val() != ""){
//                 $('#imageUserAddError').empty()
//             }
//     })
    
//     }
//     if(haserror === false){
//         $.ajaxSetup({
//             headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         $.ajax({
//             url:"/store_user",
//             method: "post",
//             data: {
//                 name: name,
//                 phone: phone,
//                 email: email,
//                 gender: gender,
//                 birthday: birthday,
//                 image: image,
                
//             },
           
//             success: function(data) {
//                 $('#addUserModal').modal('hide');
//                 $('#addUserModal').find('input').val("");
//                 $('#addUserModal').find('select').val("");
//                 getUser();
//                 showSuccess();

//             },
//             error: function(err) {
//                 console.log(err);
//             showError();
//             }
//         });

//     }
// };








//     function Show(id) {
//         $('#show').val(id);
//         var showid = id;
//         $.ajax({
//             url: "update.php",
//             type: "get",
//             dataType: 'json',
//             data: {
//                 id: showid,
//             },
//             success: function(data, status) {
//                 $('#UpdateName').val(data.name);
//                 $('#UpdatePhone').val(data.phone);
//                 $('#UpdateEmail').val(data.email);
//                 $('#UpdateAddress').val(data.address);
//                 $('#UpdatePassword').val(data.password);
//                 $('#updateModal').modal('show');
//             }
//         });
//     };
//     function update() {
//         var name = $('#UpdateName').val();
//         var phone = $('#UpdatePhone').val();
//         var email = $('#UpdateEmail').val();
//         var address = $('#UpdateAddress').val();
//         var password = $('#UpdatePassword').val();
//         var id = $('#show').val();
//         console.log(password);
//         var haserror = false;
//     if(name == ""){
//         $('#nameError1').html('Vui Lòng Nhập Tên');
//         haserror = true;
//     }
//     if(phone == ""){
//         $('#phoneError1').html('Hãy Nhập số Điện Thoại');
//         haserror = true;
//     }
//     if(email == ""){
//         $('#emailError1').html('Hãy Nhập email');
//         haserror = true;
//     }
//     if(address == ""){
//         $('#addressError1').html('Hãy Nhập Địa Chỉ');
//         haserror = true;
//     }
//     if(password == ""){
//         $('#passwordError1').html('Hãy Nhập Mật Khẩu');
//         haserror = true;
//     }
// if(haserror === false){
//         $.ajax({
//             url: "update.php",
//             type: "post",
//             data: {
//                 nameVal: name,
//                 phoneVal: phone,
//                 emailVal: email,
//                 addressVal: address,
//                 passwordVal: password,
//                 idVal: id,
//             },
//             success: function(data, status) {
//                 console.log(status);
//                 console.log(data);
//                 List();
//                 $('#updateModal').modal('hide');
//                 showSuccess();

//             },
//             error: function() {
//                 showError();
//             }
//         });
//     }}