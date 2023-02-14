$(document).ready(function() {
    getCategory();
});
// ------
function getCategory(){
    $.ajax({
        type: 'GET',
        url: '/category/getCategory',
        dataType: 'json',
        success: function(response){
            $('#index-categories').html(" ");
            $.each(response.categories, function(index, category){
                // console.log(response.categories);
                $('#index-categories').append(
                    '<tr>\
                           <td><img style="width:100px; height:100px" src="'+ category.image +'" alt=""></td>\
                           <td class="text-danger">'+ category.name +'</td>\
                           <td><label class="badge badge-danger" >'+ category.description +'</label></td>\
                           <td><button style="text-align: center" class="badge badge-danger" onclick=editCategory('+ category.id +') id="editCategory">Sửa</button> &nbsp;&nbsp; \
                           <button style="text-align: center" class="badge badge-danger" value="'+ category.id +'" id="deleteCategory">Xóa</button></td>\
                         </tr>'
                )
            })
        }
    })
}
// ------

$(document).on('click', '#deleteCategory' ,function(e) {
    e.preventDefault();
    $('#confirm').val("");
    var id = $(this).val();
    $('#confirm-text').html('');
    var node = document.createTextNode("Xóa danh mục này không?");
    $('#confirm-text')[0].appendChild(node);
    $('#confirm').val(id);
    $('#confirm-true').addClass("confirmdeleteCategory");
    $('#confirmCategoryModal').modal('show');
})
// ------
$(document).on('click', '#restoreCategory' ,function(e) {
    e.preventDefault();
    $('#confirm').val("");
    $('#trashCanCategoryModal').modal('hide');
    var id = $(this).val();
    $('#confirm-text').html('');
    var node = document.createTextNode("khôi phục danh mục này không?");
    $('#confirm-text')[0].appendChild(node);
    $('#confirm').val(id);
    $('#confirm-true').addClass("confirmrestoreCategory");
    $('#confirmCategoryModal').modal('show');
})
// ------
$(document).on('click', '#destroyCategory' ,function(e) {
    e.preventDefault();
    $('#confirm').val("");
    $('#trashCanCategoryModal').modal('hide');
    var id = $(this).val();
    $('#confirm-text').html('');
    var node = document.createTextNode("Xóa vĩnh viễn danh mục này không?");
    $('#confirm-text')[0].appendChild(node);
    $('#confirm').val(id);
    $('#confirm-true').addClass("confirmdestroyCategory");
    $('#confirmCategoryModal').modal('show');
})
// -------
$(document).on('click', '.confirmdeleteCategory', function(e){
    e.preventDefault();
    var id = $('#confirm').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url : "/category/deleteCategory/"+id,
        success: function(){
            showSuccess();
            $('#confirm').val("");
            $('#confirm-true').removeClass("confirmdeleteCategory");
            getCategory();
            $('#confirmCategoryModal').modal('hide');
        },
        error: function(e) {
            showError();
        }
    })
})
// --------
$(document).on('click', '.confirmrestoreCategory', function(e){
    e.preventDefault();
    var id = $('#confirm').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url : "/category/restoreCategory/"+id,
        success: function(){
            getCategory();
            showSuccess();
            $('#confirm').val("");
            $('#confirmCategoryModal').modal('hide');
        },
        error: function(e) {
            showError();
        }
    })
})
// ------
$(document).on('click', '.confirmdestroyCategory', function(e){
    e.preventDefault();
    var id = $('#confirm').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url : "/category/destroyCategory/"+id,
        success: function(){
            getCategory();
            showSuccess();
            $('#confirm').val("");
            $('#confirmCategoryModal').modal('hide');
        },
        error: function(e) {
            showError();
        }
    })
})

// ------
function editCategory(category){
    $.ajax({
        type: 'GET',
        url: '/category/editCategory/'+category,
        success: function(res){
            if(res.status == 200){
               let category = res.category
                $('#idCategoryEdit').val(category.id);
                $('#nameCategoryEdit').val(category.name);
                $('#descriptionCategoryEdit').val(category.description);
        
                $('#blah1').attr('src', category.image);
         
                if($('#name').val() != ""){
                    $('#nameCategoryEditError').empty()
                }
                if($('#description').val() != ""){
                    $('#descriptionCategoryEditError').empty()
                }
              
            }
    $('#editCategoryModal').modal('show');
        },
        error: function(err) {
            showError();
        }
    })
}
// ------
function updateCategory(event){
    event.preventDefault();
    var name = $('#nameCategoryEdit').val();
    var description = $('#descriptionCategoryEdit').val();
 
    var haserrorEdit = false;
    var id = $('#idCategoryEdit').val();
    if(name == ""){
        $('#nameCategoryEditError').html('Vui Lòng Nhập Tên Danh Mục');
        haserrorEdit = true;
    }
    if(description == ""){
        $('#descriptionCategoryEditError').html('Hãy Nhập Mô Tả');
        haserrorEdit = true;
    }
   
        if(haserrorEdit == true){
            $('#editCategoryModal').change('shown.bs.modal', function() {
                if($('#name').val() != ""){
                    $('#nameCategoryEditError').empty()
                }
                if($('#description').val() != ""){
                    $('#descriptionCategoryEditError').empty()
                }
               
        })
        }
        if(haserrorEdit === false){
            let formdata = new FormData($('#updateCategory')[0]);
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
        type: "POST",
        url: "/category/updateCategory/"+id,
        data: formdata,
        contentType:false,
        processData:false,
        
        success: function(res){
            $('#editCategoryModal').modal('hide');
            $('#editCategoryModal').find('input').val("");
            getCategory();
            showSuccess();
        },
        error: function(err) {
            showError();
        }
    })
    }
}
// ------
$(document).on('click','#addCategory', function(e){
    e.preventDefault();
    $('#addCategoryModal').modal('show');
})
// ------
$('#insertCategory').on('submit', function(e){
    e.preventDefault();
    var name = $('#nameCategory').val();
     var image = $('#imageCategory').val();
    
     
     var haserror = false;
 if(name == ""){
     $('#nameCategoryAddError').html('Hãy Nhập Tên Danh Mục');
     haserror = true;
 }

 if(image == ""){
     $('#imageCategoryAddError').html('Hãy Nhập Chọn Ảnh');
     haserror = true;
 }
     if(haserror == true){
         $('#addCategoryModal').change('shown.bs.modal', function() {
             if($('#name').val() != ""){
                 $('#nameCategoryAddError').empty()
             }
            
             if($('#image').val() != ""){
                 $('#imageCategoryAddError').empty()
             }
           
     })
     }
     if(haserror === false){
         $.ajaxSetup({
             headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         let formdata = new FormData($('#insertCategory')[0]);
         $.ajax({
             url:"/category/storeCategory",
             method: "post",
             data: formdata,
             dataType: 'json',
             contentType:false,
             processData:false,
             success: function(data) {
                 $('#addCategoryModal').modal('hide');
                 $('#addCategoryModal').find('input').val("");
                 getCategory();
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
$(document).ready(function() {
    if( $('#blah').hide()){
      $('#blah').hide();
    }
    $('#imageCategory').change(function() {
          $('#blah').show();
          const file = $(this)[0].files;
          if (file[0]) {
              jQuery('#blah').attr('src', URL.createObjectURL(file[0]));
              jQuery('#blah1').attr('src', URL.createObjectURL(file[0]));
          }
      });
    $('#imageCategoryEdit').change(function() {
          $('#blah1').show();
          const file = $(this)[0].files;
          if (file[0]) {
              jQuery('#blah1').attr('src', URL.createObjectURL(file[0]));
          }
      });
  });
// ------
  $(document).on('click','#trashCanCategory', function(e){
    e.preventDefault();
    $.ajax({
        url: '/category/getTrashCanCategory',
        type: 'GET',
        success: function(response){
            $('#tbodyTrashCanCategory').html(" ");
                $.each(response.categories.data, function(index, category){
                    $('#tbodyTrashCanCategory').append(
                '<tr>\
                    <td><img style="width:100px; height:100px" src="'+ category.image +'" alt=""></td>\
                    <td class="text-danger">'+ category.name +'</td>\
                    <td><label class="badge badge-danger" >'+ category.description +'</label></td>\
                    <td><button style="text-align: center" class="badge badge-danger" value="'+ category.id +'" id="restoreCategory">Lấy lại</button> &nbsp;&nbsp; \
                    <button style="text-align: center" class="badge badge-danger" value="'+ category.id +'" id="destroyCategory">Xóa vĩnh viễn</button></td>\
                </tr>'
                    )
                })
        }
    });
    $('#trashCanCategoryModal').modal('show');

})
// ------
// $(document).on('keyup', function (e){
//     e.preventDefault();
//     let search = $('#search').val();
//     // console.log(search);
//     $.ajax({
//         url: "/user/search_user",
//         method: 'GET',
//         data: {
//             search: search
//         },
//         success: function(response){
//             $('#index-users').html(" ");
//             $.each(response.users.data, function(index, user){
//                 $('#index-users').append(
//                     '<tr>\
//                            <td><img style="width:100px; height:100px" src="'+ user.image +'" alt=""></td>\
//                            <td class="text-danger">'+ user.name +'</td>\
//                            <td class="text-danger">'+ user.gender +'</td>\
//                            <td><label class="badge badge-danger" ><input onclick="myFunction('+ user.id +')" id="copyPhone'+ user.id +'" value="'+ user.phone +'" hidden/>'+ user.phone +'</label></td>\
//                            <td><button style="text-align: center" class="badge badge-danger" onclick=editUser('+ user.id +') id="editUser">Sửa</button>\
//                            <button style="text-align: center" class="badge badge-danger" onclick=inforUser('+ user.id +') id="inforUser">Chi tiết</button>\
//                            <button style="text-align: center" class="badge badge-danger" value="'+ user.id +'" id="deleteUser">Xóa</button></td>\
//                          </tr>'
//                 )
//             })
//         }
//     })
// })
