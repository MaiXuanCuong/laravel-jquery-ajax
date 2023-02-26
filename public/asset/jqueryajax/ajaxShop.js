$(document).ready(function(){
    // localStorage.removeItem('token');
    // localStorage.removeItem('customer');
    $('#check-customer').empty();
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
        
        if (position < 600) {
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
function scrollToProductList() {
    document.getElementById('list_products').scrollIntoView({behavior: 'smooth'});
  }
  
  document.getElementById('main-search').addEventListener('click', scrollToProductList);
$(document).on('click','#logout-customer',function() {
    $.ajax({
        url: "http://127.0.0.1:8000/api/auth/logout",
        method: "post",
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Content-Type': 'application/json'
        },
        success: function(response) {
            if(response.status === 200) {
                $('#name-customer').removeAttr('title');
                // $('#id-customer').removeAttr('data-customer');
                localStorage.removeItem('token');
                Cookies.remove('customer');
                $('#check-customer').empty();
                checkCustomer();
                Swal.fire({
                    title: 'Bạn đã đăng xuất thành công, Ghét quá đy -.-',
                    width: 615,
                    color: '#716add',
                    background: '#fff url(https://scr.vn/wp-content/uploads/2020/07/h%C3%ACnh-%C4%91%E1%BB%99ng-cho-powerpoint-3.gif)',
                  
                  })
            }
        },
        error: function(xhr) {
            if (xhr.status === 401) {
                localStorage.removeItem('token');
                Cookies.remove('customer');
                $('#check-customer').empty();
                checkCustomer();
            }}
    })
})


function checkCustomer(){
    if(localStorage.getItem('token')){
        var customer = Cookies.get("customer");
        let arr = customer.split(',');
        $('#name-customer').attr('title', arr[1]);
        // $('#id-customer').attr('data-customer', arr[0]);
        $('#check-customer').append(
            '<li><a id="id-customer" data-customer="'+arr[0]+'"><i class="fas fa-user-circle u-s-m-r-6"></i> <span>Tài khoản</span></a></li>\
            <li> <a id="logout-customer"><i class="fas fa-lock-open u-s-m-r-6"></i><span>Đăng xuất</span></a></li>'
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
        haserror = true;
    }else if (!isValidEmailAddress(email)) {
        $("#emailLoginError").html("Email không hợp lệ");
        haserror = true;
    }
    if (isValidEmailAddress(email)) {
        $("#emailLoginError").html("");
    }
    if (password == "") {
        $("#passwordLoginError").html("Hãy Nhập Mật Khẩu");
        haserror = true;
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
                    $('#check-customer').empty();
                    checkCustomer();
                    Swal.fire({
                        title: 'Chào mừng quý khách yêu dấu đã đến với shop nha, hãy lướt shop để tìm kiếm sản phẩm phù hợp -.-',
                        width: 850,
                        color: '#716add',
                        background: '#fff url(https://allimages.sgp1.digitaloceanspaces.com/tipeduvn/2022/01/Tai-hinh-dong-de-thuong-cute-va-ngo-nghinh-dang.gif)',
                      })
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
$("#confirmPassword,#registerPassword").on("keyup", function() {
if($("#registerPassword").val() == $("#confirmPassword").val()){
    $("#passwordConfirmError").html("")
} else {
    $("#passwordConfirmError").html("Xác Nhận Mật Khẩu Không Đúng")
}
})

$(document).on('click', '#confirmRegister' ,function (e){
    e.preventDefault();
    var email = $("#registerEmail").val();
    var password = $("#registerPassword").val();
    var name = $("#registerName").val();
    var confirmPassword = $("#confirmPassword").val();
    var haserror = false;
    if (name == "") {$("#nameRegisterError").html("Hãy Nhập Tài Khoản"); haserror = true; }
    if (email == "") {$("#emailRegisterError").html("Hãy Nhập Tài Khoản");  haserror = true;}
    else if (!isValidEmailAddress(email)) {  $("#emailRegisterError").html("Email không hợp lệ"); haserror = true; }
    if (isValidEmailAddress(email)) {$("#emailRegisterError").html(""); }
    if (password == "") {$("#passwordRegisterError").html("Hãy Nhập Mật Khẩu");  haserror = true; }
    if (confirmPassword == "") {$("#passwordConfirmError").html("Hãy Nhập Mật Khẩu"); haserror = true;  }
    if (confirmPassword != password) { $("#passwordConfirmError").html("Xác Nhận Mật Khẩu Không Đúng");haserror = true; }
    if (confirmPassword == password) { $("#passwordConfirmError").html("")}
    if (haserror == false) {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formdata = new FormData($("#registerCustomer")[0]);
        $.ajax({
            url: "http://127.0.0.1:8000/api/auth/registerCustomer",
            method: "post",
            data: formdata,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 200) {
                console.log(response.customer);
                $("#registerModal").modal("hide");
                $("#loginEmail").val(response.customer.email);
                $("#loginPassword").val(response.customer.password);
                $("#loginModal").modal("show");
                } else {
                    $("#emailRegisterError").html("Email đã tồn tại")
                } 
                   
            },
            error: function (err) {
            
            },
        });
    }
})


function isValidEmailAddress(email) {
    var pattern = /^[a-zA-Z0-9._-]+@gmail\.com$/;
    return pattern.test(email);
}
let canSendRequest = true;
$(document).on('click','a', function(e){
    let $this = $(this);
    e.preventDefault();
    if (!$this.attr('disabled')) {
        $this.attr('disabled', true);
    if (canSendRequest) {
        canSendRequest = false;
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
                    canSendRequest = true;
                    $this.attr('disabled', false);
                    $('body').html('');
                    $('body').append(response.html);
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        canSendRequest = true;
                        $this.attr('disabled', false);
                        localStorage.removeItem('token');
                        Cookies.remove('customer');
                        $('#check-customer').empty();
                        checkCustomer();
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
                },
                dataType: "json",
                success: function(response) {
                    canSendRequest = true;
                    $('body').html('');
                    $('body').append(response.html);
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        canSendRequest = true;
                        localStorage.removeItem('token');
                        Cookies.remove('customer');
                        $('#check-customer').empty();
                        checkCustomer();
                    }}
            })
    }
}}
})


