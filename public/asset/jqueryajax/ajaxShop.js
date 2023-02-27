$(document).ready(function(){
    getHistoryProduct()
    // localStorage.removeItem('token');
    // localStorage.removeItem('customer');
    $('#check-customer').empty();
    checkCustomer();
    $("#main-search").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#List-products #Product-search").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });getCart
      });
    $(window).scroll(function() {
        let input = $('#main-search');
        let position = input.offset().top;
        let bg = $('body').css('background-color');
        
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
$(document).on('click','#Add-to-cart-item',function(e){
    e.preventDefault();
    let id = $(this).data('value');
    var size = $('input[name="size"]:checked').val();
    var Name = $('input[name="size"]:checked').data('name');
    var quantity = $('#quantity-product-detail').val();
    $.ajax({
        type: "POST",
        url: "http://127.0.0.1:8000/api/auth/addCart",
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Content-Type': 'application/json'
        },
        data: JSON.stringify({
            id: id,
            size: size,
            quantity: quantity,
            Name: Name
        }),
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                var product_cart_success = response.product
                getCart()
                $('#modal-cart-success').html('')
                $('#modal-cart-success').append(
                    '<div class="col-lg-6 col-md-12">\
                    <div class="success u-s-m-b-30">\
                        <div class="success__text-wrap"><i class="fas fa-check"></i>\
                            <span>Thêm sản phẩm vào giỏ hàng thành công!</span></div>\
                        <div class="success__img-wrap" style="magrin:30px">\
                            <img class="u-img-fluid" style="width:100px;height:120px" src="http://127.0.0.1:8000/'+product_cart_success.image+'" alt=""></div>\
                        <div class="success__info-wrap">\
                            <span class="success__name">'+product_cart_success.name+'</span>\
                            <span class="success__size">Size: '+product_cart_success.size+'</span>\
                            <span class="success__quantity">Số lượng sản phẩm này trong giỏ: '+product_cart_success.quantity+'</span>\
                            <span class="success__price">'+(product_cart_success.price-((product_cart_success.discount/100)*product_cart_success.price)).toLocaleString() + ' VNĐ'+'</span></div>\
                    </div>\
                    </div>\
                    <div class="col-lg-6 col-md-12">\
                    <div class="s-option">\
                        <div class="s-option__link-box">\
                            <a class="s-option__link btn--e-white-brand-shadow" data-dismiss="modal">Tiếp tục mua sắm</a>\
                            <a class="s-option__link btn--e-brand-shadow" href="">Đên trang thanh toán</a></div>\
                    </div>\
                    </div>'
                )
                $('#add-to-cart').modal('show');
            } 
        },
    });
})


$(document).on('click','.remove-cart',function(e){
    e.preventDefault();
    var size_name = $(this).data('size_name');
    var name = $(this).data('name');
    var size = $(this).data('size');
    Swal.fire({
        title: 'Bạn có muốn xóa sản phẩm?',
        text: name+' Size: '+size_name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đúng vậy, xóa nó!',
        cancelButtonText: 'Hủy, không xóa'
      }).then((result) => {
        if (result.isConfirmed) {
            let id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/auth/removeCart",
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({
                    id: id,
                    size: size,
                }),
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == 200) {
                        getCart()
                        Swal.fire(
                            'Đã xóa thành công sản phẩm!',
                            name+' Size: '+size_name,
                            'success'
                          )
                    } 
                },
            });
        }
      })
 
})


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
                localStorage.removeItem('token');
                Cookies.remove('customer');
                $('#check-customer').empty();
                checkCustomer();
                $("#list-cart").html("")
                $("#list-cart-wishlist").html("")
                $("#count-carts").text(0);
                $("#count-carts-wishlist").text(0);
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
    if(!checkTokenExpiration()){
        let customer = Cookies.get("customer");
        let arr = customer.split(',');
        $('#name-customer').attr('title', arr[1]);
        getCart()
        getCartWishlist()
        $('#check-customer').append(
            '<li><a id="id-customer" data-customer="'+arr[0]+'"><i class="fas fa-user-circle u-s-m-r-6"></i> <span>Tài khoản</span></a></li>\
            <li> <a id="logout-customer"><i class="fas fa-lock-open u-s-m-r-6"></i><span>Đăng xuất</span></a></li>'
        )
    }
     else {
        localStorage.removeItem('token');
        Cookies.remove('customer');
        $('#check-customer').append(
            '<li> <a id="login-customer"><i class="fas fa-user-plus u-s-m-r-6"></i> <span>Đăng nhập</span></a> </li>\
            <li> <a id="register-customer"><i class="fas fa-lock u-s-m-r-6"></i><span>Đăng ký</span></a></li>'
        )
    }
    
}
function checkTokenExpiration() {
    const token = localStorage.getItem('token');
    if (token) {
      const tokenData = JSON.parse(atob(token.split('.')[1]));
      const expirationTime = tokenData.exp * 1000;
      const currentTime = new Date().getTime();
      if (expirationTime < currentTime) {
       return true;
      }
    } else {
        return true;
    } 
    return false;
  }



$(document).on('click','#login-customer, #loginAccount', function(){
    $("#registerModal").modal("hide");
    $("#loginModal").modal("show");
    $("#resetPasswordModal").modal("hide");
})
$(document).on('click','#register-customer , #createAccount', function(){
    $("#loginModal").modal("hide");
    $("#registerModal").modal("show");
})
$(document).on('click','#reset-password', function(){
    $("#loginModal").modal("hide");
    $("#resetPasswordModal").modal("show");
})




$(document).on('click', '#confirmLogin' ,function (e){
    e.preventDefault();
    let email = $("#loginEmail").val();
    let password = $("#loginPassword").val();
    let haserror = false;

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
                    let customer = {
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
    let email = $("#registerEmail").val();
    let password = $("#registerPassword").val();
    let name = $("#registerName").val();
    let confirmPassword = $("#confirmPassword").val();
    let haserror = false;
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
    let pattern = /^[a-zA-Z0-9._-]+@gmail\.com$/;
    // let pattern =  /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern.test(email);
}
let canSendRequest = true;
$(document).on('click','.my-link', function(e){
    e.preventDefault();
    let $this = $(this);
    if (canSendRequest) {
        canSendRequest = false;
    let page = $(this).data('page')
    if((typeof page != 'undefined') && page != 'home-page'){
            page = $(this).data('page')
            let id = $(this).data('value');

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
                    $('body').html('');
                    $('body').append(response.html);
                    history_product_detail(response.products['original'])
                    checkCustomer();
                    getCart()
                    getCartWishlist()
                    document.getElementById('scroll-product').scrollIntoView({behavior: 'smooth'});
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
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/auth/history/"+id,
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'application/json'
                },
                dataType: "json",
                success: function (response) {
          
                },
            });
        
    }
    else if(page == 'home-page'){
    
            location.reload();
    }
}

})

getHistoryProduct = () => {
    $.ajax({
        url: "http://127.0.0.1:8000/api/auth/getHistoryProduct",
        method: "get",
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Content-Type': 'application/json'
        },
        dataType: "json",
        success: function(response) {
            if (response.status === 200) {
                $.each((response.historyProducts).reverse(), function (index, product) {
                $("#history-product-main").append(
                '<div class="col-lg-3 col-md-4 col-sm-6 u-s-m-b-30">\
                    <div class="product-short u-h-100">\
                        <div class="product-short__container">\
                            <div class="product-short__img-wrap">\
                                <a class="aspect aspect--bg-grey-fb aspect--square u-d-block my-link" data-page="product-detail-page" data-value="'+product.id+'">\
                                    <img class="aspect__img product-short__img" src="http://127.0.0.1:8000/'+product.image+'" alt=""></a></div>\
                            <div class="product-short__info">\
                                <span class="product-short__price">' + (product.price).toLocaleString() + ' VNĐ'+ '</span>\
                                <span class="product-short__name">\
                                    <a data-page="product-detail-page" class="my-link" data-value="'+product.id+'">'+product.name+'</a></span>\
                                <span class="product-short__category">\
                                    <a href="">'+product.category+'</a></span></div>\
                        </div>\
                    </div>\
                </div>')})
            }
        },
        error: function(xhr) {
   }
    })
}
getCart = () => {
    $.ajax({
        url: "http://127.0.0.1:8000/api/auth/getCart",
        method: "get",
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Content-Type': 'application/json'
        },
        dataType: "json",
        success: function(response) {
            var totalcarts= 0;
            var countID= 0;
            if (response.status === 200) {
                $("#list-cart").html("")
                $("#total-carts").text("")
                $.each(response.carts, function (index, products) {
                    $.each(products, function (count, product) {
                        ++countID
                    var totalproduct = (product.quantity * (product.price-((product.discount/100)*product.price)));
                        totalcarts += totalproduct;
                $("#list-cart").append(
                    '<div class="card-mini-product">\
                    <div class="mini-product">\
                        <div class="mini-product__image-wrapper">\
                            <a class="mini-product__link my-link" data-page="product-detail-page" data-value="'+product.id+'">\
                                <img class="u-img-fluid" style="width:90px;height:90px" src="http://127.0.0.1:8000/'+product.image+'" alt=""></a></div>\
                        <div class="mini-product__info-wrapper">\
                            <span class="mini-product__category">\
                                <a>'+product.category+' Size '+product.size+'</a></span>\
                            <span class="mini-product__name">\
                                <a data-page="product-detail-page" class="my-link" data-value="'+product.id+'">'+product.name+'</a></span>\
                            <span class="mini-product__quantity">'+product.quantity+' x</span>\
                            <span class="mini-product__quantity">' + (product.price-((product.discount/100)*product.price)).toLocaleString() + ' VNĐ'+ ' = '+totalproduct.toLocaleString() + ' VNĐ'+'</span></div>\
                    </div>\
                    <a class="mini-product__delete-link far fa-trash-alt remove-cart" data-id="'+product.id+'" data-size="'+product.size_id+'" data-size_name="'+product.size+'" data-name="'+product.name+'"></a>\
                </div>'
                )
            })
        })
                $("#total-carts").text(totalcarts.toLocaleString() + " VNĐ");
                $("#count-carts").text(countID);
            }
        },
        error: function(xhr) {
   }
    })
}   






function history_product_detail(response){
    if (response.status == 200) {
        $.each(response['historyProducts'].reverse(), function (index, product) {
              
                $('#history-product-detail').append(
                '<div class="owl-item active" style="width: 277.5px;">\
                <div class="u-s-m-b-30">\
                <div class="product-o product-o--hover-on">\
                    <div class="product-o__wrap">\
                        <a class="aspect aspect--bg-grey aspect--square u-d-block my-link" data-page="product-detail-page" data-value="'+product.id+'">\
                            <img class="aspect__img" src="http://127.0.0.1:8000/'+product.image+'"></a>\
                    </div>\
                    <span class="product-o__category">\
                        <a>'+product.category+'</a></span>\
                    <span class="product-o__name">\
                        <a data-page="product-detail-page" class="my-link" data-value="'+product.id+'">'+product.name+'</a></span>\
                    <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>\
                        <span class="product-o__review">(20)</span></div>\
                    <span class="product-o__price">'+ (product.discount != null ? (product.price -((product.discount/100)*product.price)).toLocaleString() + ' VNĐ' : (product.price).toLocaleString() + ' VNĐ')+'\
                        <span class="product-o__discount">' + (product.discount == null ? " " : (product.price).toLocaleString() + ' VNĐ' )+ '</span></span>\
                </div>\
                </div>\
            </div>'
            )
            });
        } 
}


$(document).on('click','#Add-to-cart-wishlist',function(e){
    e.preventDefault();
    let id = $(this).data('value');
    var size = $('input[name="size"]:checked').val();
    var Name = $('input[name="size"]:checked').data('name');
    var quantity = $('#quantity-product-detail').val();
    $.ajax({
        type: "POST",
        url: "http://127.0.0.1:8000/api/auth/addCartWishlist",
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Content-Type': 'application/json'
        },
        data: JSON.stringify({
            id: id,
            size: size,
            quantity: quantity,
            Name: Name
        }),
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                var product_cart_success = response.product
                getCartWishlist()
                $('#modal-cart-success').html('')
                $('#modal-cart-success').append(
                    '<div class="col-lg-6 col-md-12">\
                    <div class="success u-s-m-b-30">\
                        <div class="success__text-wrap"><i class="fas fa-check"></i>\
                            <span>Thêm vào giỏ hàng yêu thích thành công!</span></div>\
                        <div class="success__img-wrap" style="magrin:30px">\
                            <img class="u-img-fluid" style="width:100px;height:120px" src="http://127.0.0.1:8000/'+product_cart_success.image+'" alt=""></div>\
                        <div class="success__info-wrap">\
                            <span class="success__name">'+product_cart_success.name+'</span>\
                            <span class="success__size">Size: '+product_cart_success.size+'</span>\
                            <span class="success__quantity">Số lượng sản phẩm này trong giỏ: '+product_cart_success.quantity+'</span>\
                            <span class="success__price">'+(product_cart_success.price-((product_cart_success.discount/100)*product_cart_success.price)).toLocaleString() + ' VNĐ'+'</span></div>\
                    </div>\
                    </div>\
                    <div class="col-lg-6 col-md-12">\
                    <div class="s-option">\
                        <div class="s-option__link-box">\
                            <a class="s-option__link btn--e-white-brand-shadow" data-dismiss="modal">Tiếp tục mua sắm</a>\
                    </div>\
                    </div>'
                )
                $('#add-to-cart').modal('show');
            } 
        },
    });
})




$(document).on('click','.remove-cart-wishlist',function(e){
    e.preventDefault();
    var size_name = $(this).data('size_name');
    var name = $(this).data('name');
    var size = $(this).data('size');
    Swal.fire({
        title: 'Bạn có muốn xóa sản phẩm yêu thích?',
        text: name+' Size: '+size_name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đúng vậy, xóa nó!',
        cancelButtonText: 'Hủy, không xóa'
      }).then((result) => {
        if (result.isConfirmed) {
            let id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/auth/removeCartWishlist",
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({
                    id: id,
                    size: size,
                }),
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == 200) {
                        getCartWishlist()
                        Swal.fire(
                            'Đã xóa thành công sản phẩm yêu thích!',
                            name+' Size: '+size_name,
                            'success'
                          )
                    } 
                },
            });
        }
      })
 
})

$(document).on('click','#Add-cart-to-wishlist',function(e){
    e.preventDefault();
    let id = $(this).data('value');
    let size = $(this).data('size');
    let Name = $(this).data('name');
    let quantity = $(this).data('quantity');
    $.ajax({
        type: "POST",
        url: "http://127.0.0.1:8000/api/auth/addCart",
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Content-Type': 'application/json'
        },
        data: JSON.stringify({
            id: id,
            size: size,
            quantity: quantity,
            Name: Name
        }),
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == 200) {
                var product_cart_success = response.product
                getCart()
                $('#modal-cart-success').html('')
                $('#modal-cart-success').append(
                    '<div class="col-lg-6 col-md-12">\
                    <div class="success u-s-m-b-30">\
                        <div class="success__text-wrap"><i class="fas fa-check"></i>\
                            <span>Thêm sản phẩm vào giỏ hàng thành công!</span></div>\
                        <div class="success__img-wrap" style="magrin:30px">\
                            <img class="u-img-fluid" style="width:100px;height:120px" src="http://127.0.0.1:8000/'+product_cart_success.image+'" alt=""></div>\
                        <div class="success__info-wrap">\
                            <span class="success__name">'+product_cart_success.name+'</span>\
                            <span class="success__size">Size: '+product_cart_success.size+'</span>\
                            <span class="success__quantity">Số lượng sản phẩm này trong giỏ: '+product_cart_success.quantity+'</span>\
                            <span class="success__price">'+(product_cart_success.price).toLocaleString() + ' VNĐ'+'</span></div>\
                    </div>\
                    </div>\
                    <div class="col-lg-6 col-md-12">\
                    <div class="s-option">\
                        <div class="s-option__link-box">\
                            <a class="s-option__link btn--e-white-brand-shadow" data-dismiss="modal">Tiếp tục mua sắm</a>\
                    </div>\
                    </div>'
                )
                $('#add-to-cart').modal('show');
            } 
        },
    });
})
getCartWishlist = () => {
    $.ajax({
        url: "http://127.0.0.1:8000/api/auth/getCartWishlist",
        method: "get",
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Content-Type': 'application/json'
        },
        dataType: "json",
        success: function(response) {
            var countID= 0;
            if (response.status === 200) {
                $("#list-cart-wishlist").html("")
                $.each(response.cartsWishlist, function (index, products) {
                    $.each(products, function (count, product) {
                        ++countID
                $("#list-cart-wishlist").append(
                    '<div class="card-mini-product">\
                    <div class="mini-product">\
                        <div class="mini-product__image-wrapper">\
                            <a class="mini-product__link my-link" data-page="product-detail-page" data-value="'+product.id+'">\
                                <img class="u-img-fluid" style="width:90px;height:90px" src="http://127.0.0.1:8000/'+product.image+'" alt=""></a></div>\
                        <div class="mini-product__info-wrapper">\
                            <span class="mini-product__category">\
                                <a>'+product.category+' Size '+product.size+' x '+product.quantity +'</a></span>\
                            <span class="mini-product__name">\
                                <a data-page="product-detail-page" class="my-link" data-value="'+product.id+'">'+product.name+'</a></span>\
                            <span class="mini-product__quantity"><button class="btn btn--e-brand-b-2" data-value="'+product.id+'" data-size="'+product.size_id+'" data-name="'+product.size+'" data-quantity="'+product.quantity+'" id="Add-cart-to-wishlist">Thêm vào giỏ hàng</button></span>\
                    </div>\
                    <a class="mini-product__delete-link far fa-trash-alt remove-cart-wishlist" data-id="'+product.id+'" data-size="'+product.size_id+'" data-size_name="'+product.size+'" data-name="'+product.name+'"></a>\
                </div>'
                )
            })
        })
                $("#count-carts-wishlist").text(countID);
            }
        },
        error: function(xhr) {
   }
    })
}   

$(document).on('click','#sendmail',function (e){
    e.preventDefault();
    var email = $('input[name="email-reset"]').val();
    let haserror = false;
    if (email == "") {$("#resetError").html("Hãy Nhập Tài Khoản");  haserror = true;}
    else if (!isValidEmailAddress(email)) {  $("#resetError").html("Email không hợp lệ"); haserror = true; }
    if (isValidEmailAddress(email)) {$("#resetError").html(""); }
    if (haserror == false) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "http://127.0.0.1:8000/api/auth/changePassMailCustomer",
            method: "post",
            data: {
                email: email
            },
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 200) {

                } else {
                    $("#resetError").html("Email không tồn tại")
                } 
            },
            error: function (err) {
            
            },
        });
    }
})