$(document).ready(function (){

})
$(document).on('click', '#login-user' ,function (e){
    e.preventDefault();
    var email = $("#loginEmail").val();
    var password = $("#loginPassword").val();
    var haserror = false;

    if (email == "") {
        $("#emailUserLogin").html("Hãy Nhập Tài Khoản");
        haserror = true;
    }else if (!isValidEmailAddress(email)) {
        $("#emailUserLogin").html("Email không hợp lệ");
        haserror = true;
    }
    if (isValidEmailAddress(email)) {
        $("#emailUserLogin").html("");
        haserror = true;
    }

    if (password == "") {
        $("#passwordUserLogin").html("Hãy Nhập Mật Khẩu");
        haserror = true;
    }
    if (haserror === false) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#loginUser")[0]);
        $.ajax({
            url: "/checklogin",
            method: "post",
            data: formdata,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    window.location.replace(response.redirect);
                } else {
                    history.replaceState(null, '', '/');
                    window.addEventListener('popstate', function() {
                    history.pushState(null, '', '/');
                    window.location.replace(response.redirect);
                });
                $("#passwordUserLogin").html("Tài khoản hoặc Mật khẩu không đúng");

                }
                   
            },
            error: function (err) {
            
            },
        });
    }
})

$(document).on('click', '#logout-user' ,function (e){
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
        $.ajax({
            url: "/logout",
            method: "post",
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    history.replaceState(null, '', '/');
                    window.addEventListener('popstate', function() {
                    history.pushState(null, '', '/');
                    window.location.replace(response.redirect);
                    });
                   
                } else {
                    window.location.replace(response.redirect);
                }
                   
            },
            error: function (err) {
            
            },
        });
    })
    function isValidEmailAddress(email) {
        var pattern = /^[a-zA-Z0-9._-]+@gmail\.com$/;
        return pattern.test(email);
    }