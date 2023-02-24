$(document).ready(function(){
    // localStorage.removeItem('token');
    // localStorage.removeItem('customer');
    checkCustomer();
    $("#main-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#List-products #Product-search").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    $(window).scroll(function() {
        var input = $('#main-search');
        var position = input.offset().top;
        var bg = $('body').css('background-color');
        
        if (position < 100) {
          input.css('background-color', 'white');
          input.css('color', 'black');
          input.css('top', '15px');
        } else if (bg === 'rgb(0, 0, 0)') {
          input.css('background-color', 'white');
          input.css('color', 'black');
          input.css('top', '15px');
        } else {
          input.css('background-color', 'black');
          input.css('color', 'white');
          input.css('top', '-1px');
        }
      });
   
});
checkCustomer = () =>{
    if(localStorage.getItem('token')){
        var customer = Cookies.get("customer");
        let arr = customer.split(',');
        $('#name-customer').attr('title', arr[1]);
        $('#id-customer').attr('data-customer', arr[0]);
        $('#check-customer').append(
            '<li> <a ><i class="fas fa-lock-open u-s-m-r-6"></i><span>Đăng xuất</span></a></li>'
        )

    }
     else {
        $('#check-customer').append(
            '<li> <a id="login-customer"><i class="fas fa-user-plus u-s-m-r-6"></i> <span>Đăng nhập</span></a> </li>\
            <li> <a id="register-customer"><i class="fas fa-lock u-s-m-r-6"></i><span>Đăng ký</span></a></li>'
        )
    }
    
}
function history(id){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });
    $.ajax({
        type: "POST",
        url: "/shops/history"+id,
        dataType: "json",
        success: function (response) {
            $.each(response.products, function (index, product) {
                if (response.status == 200) {
                    console.log(response.products);
                $("#index-products").append(
                   
                    );
                } 
            });
        },
    });
}

$(document).on('click','#login-customer, #loginAccount', function(){
    $("#registerModal").modal("hide");
    $("#loginModal").modal("show");
})
$(document).on('click','#register-customer , #createAccount', function(){
    $("#loginModal").modal("hide");
    $("#registerModal").modal("show");
})
//form đăng ký registerCustomer  xác nhận confirmRegister
//form đăng nhâp loginCustomer // xác nhận đăng confirmLogin
// đăng nhập thành công add tên $('li.has-dropdown').attr('title', 'Giá trị mới của title');




$(document).on('click', '#confirmLogin' ,function (e){
    e.preventDefault();
    var email = $("#loginEmail").val();
    var password = $("#loginPassword").val();
    var haserror = false;

    if (email == "") {
        $("#emailLoginError").html("Hãy Nhập Tài Khoản");
        // haserror = true;
    }else if (!isValidEmailAddress(email)) {
        $("#emailLoginError").html("Email không hợp lệ");
        // haserror = true;
    }
    if (isValidEmailAddress(email)) {
        $("#emailLoginError").html("");
        // haserror = true;
    }
    if (password == "") {
        $("#passwordLoginError").html("Hãy Nhập Mật Khẩu");
        // haserror = true;
    }
    if (haserror == false) {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#loginCustomer")[0]);
        $.ajax({
            url: "http://127.0.0.1:8000/api/auth/checklogin",
            method: "post",
            data: formdata,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 200) {
                    var customer = {
                        id: response.user.id,
                        name: response.user.name,
                        email: response.user.email,
                        image: response.user.image
                    }
                   
                    localStorage.setItem('token', response.access_token);
                    Cookies.set("customer", Object.values(customer));
                    $("#loginModal").modal("hide");
                    $('#name-customer').attr('title', response.user.name);
                } else if(response.status == 401) {
                    localStorage.removeItem('token');
                    Cookies.remove('customer');
                    $('li.has-dropdown').attr('title', 'Tài khoản');
                    $("#passwordLoginError").html("Tài khoản hoặc Mật khẩu không đúng");

                } else {
                    $("#passwordLoginError").html("Tài khoản hoặc mật khẩu không đúng");
                }
                   
            },
            error: function (err) {
            
            },
        });
    }
})


$(document).on('click', '#confirmLogin' ,function (e){
    e.preventDefault();
    var email = $("#loginEmail").val();
    var password = $("#loginPassword").val();
    var haserror = false;

    if (email == "") {
        $("#emailLoginError").html("Hãy Nhập Tài Khoản");
        // haserror = true;
    }else if (!isValidEmailAddress(email)) {
        $("#emailLoginError").html("Email không hợp lệ");
        // haserror = true;
    }
    if (isValidEmailAddress(email)) {
        $("#emailLoginError").html("");
        // haserror = true;
    }
    if (password == "") {
        $("#passwordLoginError").html("Hãy Nhập Mật Khẩu");
        // haserror = true;
    }
    if (haserror == false) {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#loginCustomer")[0]);
        $.ajax({
            url: "http://127.0.0.1:8000/api/auth/checklogin",
            method: "post",
            data: formdata,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 200) {
                    // console.log(response);
                    localStorage.setItem('token', response.access_token);
                    localStorage.setItem('customer', response);
                    $("#loginModal").modal("hide");
                    $('li.has-dropdown').attr('title', response.user.name);
                } else if(response.status == 401) {
                    localStorage.removeItem('token');
                    Cookies.remove('customer');
                    $('li.has-dropdown').attr('title', 'Tài khoản');
                    $("#passwordLoginError").html("Tài khoản hoặc Mật khẩu không đúng");

                } else {
                    $("#passwordLoginError").html("Tài khoản hoặc mật khẩu không đúng");
                }
                   
            },
            error: function (err) {
            
            },
        });
    }
})




// $(document).on('click', '#confirmLogin' ,function (e){
//     e.preventDefault();
//     var email = $("#loginEmail").val();
//     var password = $("#loginPassword").val();
//     var haserror = false;

//     if (email == "") {
//         $("#emailLoginError").html("Hãy Nhập Tài Khoản");
//         haserror = true;
//     }else if (!isValidEmailAddress(email)) {
//         $("#emailLoginError").html("Email không hợp lệ");
//         haserror = true;
//     }
//     if (isValidEmailAddress(email)) {
//         $("#emailLoginError").html("");
//         haserror = true;
//     }
//     if (password == "") {
//         $("#passwordLoginError").html("Hãy Nhập Mật Khẩu");
//         haserror = true;
//     }
//     if (haserror === false) {
//         $.ajaxSetup({
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             },
//         });
//         let formdata = new FormData($("#loginCustomer")[0]);
//         $.ajax({
//             url: "/shops/logout",
//             method: "post",
//             data: formdata,
//             dataType: "json",
//             contentType: false,
//             processData: false,
//             success: function (response) {
//                 if (response.success) {
//                     window.location.replace(response.redirect);
//                 } else {
//                     history.replaceState(null, '', '/');
//                     window.addEventListener('popstate', function() {
//                     history.pushState(null, '', '/');
//                     window.location.replace(response.redirect);
//                 });
//                 $("#passwordUserLogin").html("Tài khoản hoặc Mật khẩu không đúng");

//                 }
                   
//             },
//             error: function (err) {
            
//             },
//         });
//     }
// })

function isValidEmailAddress(email) {
    var pattern = /^[a-zA-Z0-9._-]+@gmail\.com$/;
    return pattern.test(email);
}

$(document).on('click','a', function(e){
    e.preventDefault();
    var page = $(this).data('page')
    if((typeof page !== 'undefined') && page != 'home-page'){
        page = $(this).data('page')
        var id = $(this).data('value');
        $.ajax({
            url: "http://127.0.0.1:8000/api/auth/page",
            method: "get",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'application/json'
            },
            data: {
                page: page,
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('.app-content').html('');
                $('.app-content').append(response.html);
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    localStorage.removeItem('token');
                    Cookies.remove('customer');
                }}
        })
    }
    else if(page == 'home-page'){
        page = $(this).data('page')
        $.ajax({
            url: "http://127.0.0.1:8000/api/auth/page",
            method: "get",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'application/json'
            },
            data: {
                page: page,
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('body').html('');
                $('body').append(response.html);
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    localStorage.removeItem('token');
                    Cookies.remove('customer');
                }}
        })
    }
})
// app-content

