$(document).ready(function(){

});
$(document).on('click','#login-customer',function(){
    e.preventDefault();
    var email = $("#email").val();
    var password = $("#password").val();
    var haserror = false;
    if (email == "") { $("#emailUserLogin").html("Hãy Nhập Tài Khoản"); haserror = true; }
    if (password == "") {  $("#passwordUserLogin").html("Hãy Nhập Mật Khẩu"); haserror = true; }
    if (haserror === false) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#loginCustomer")[0]);
        $.ajax({
            url: "/shops/checklogin",
            method: "post",
            data: formdata,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status) {
                    window.location.replace(response.redirect);
                    // localStorage.setItem('auth_token', response.token);
                } else {
                    history.replaceState(null, '', '/');
                    window.addEventListener('popstate', function() {
                    history.pushState(null, '', '/');
                    window.location.replace(response.redirect);
                });
                $("#passwordCustomerLogin").html("Tài khoản hoặc Mật khẩu không đúng");

                }
                   
            },
            error: function (err) {
            
            },
        });
    }

});
// $.ajax({
//     url: '/api/login',
//     method: 'POST',
//     data: {
//         email: 'john@example.com',
//         password: 'secret'
//     },
//     success: function(response) {
//         // Lưu trữ Token xác thực
//         localStorage.setItem('auth_token', response.token);
//     }
// });

// $.ajax({
//     url: '/api/profile',
//     method: 'GET',
//     headers: {
//         'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
//     },
//     success: function(response) {
//         // Lấy thông tin profile thành công
//     }
// });