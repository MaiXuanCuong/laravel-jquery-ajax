
@include('shop.header')

<style>
    .swal2-modal {
        padding-bottom: 0px;
    }

    </style>
        <script type="text/javascript">
            var _appUrl = '{!! url('/') !!}';
            var _token = '{!! csrf_token() !!}';
        </script>
<body class="config">
    <div class="preloader is-active">
            <div class="preloader__wrap">
        
            <img class="preloader__img" src="{{ asset('shop/images/preloader.png') }}" alt=""></div>
    </div>  
            <!--====== Main App ======-->
        <div id="app">

            <div class="app-content" >
            @yield('content')
            
     
        </div>
        @include('shop.footer')

        <!--====== Add to Cart Modal ======-->
        <div class="modal fade" data-modal="add-to-cart" id="add-to-cart">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-radius modal-shadow">

                    <button class="btn dismiss-button fas fa-times" type="button" data-dismiss="modal"></button>
                    <div class="modal-body">
                        <div class="row" id="modal-cart-success">
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
     
    </div>

    <div class="modal fade" data-modal="loginModal" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
               @include('shop.components.login')
            </div>
        </div>
    </div>
    <div class="modal fade" data-modal="registerModal" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
               @include('shop.components.register')
            </div>
        </div>
    </div>
    <div class="modal fade" data-modal="resetPasswordModal" id="resetPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
    
               @include('shop.components.changepassword')
            </div>
        </div>
    </div>

    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="exampleModalFullscreenXxlLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-xxl-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="exampleModalFullscreenXxlLabel">Thông tin đặt hàng</h1>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">...
               @include('shop.components.checkout')

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    <script src="{{ asset('shop/js/vendor.js ') }}"></script>
    <script src="{{ asset('shop/js/jquery.shopnav.js ') }}"></script>
    <script src="{{ asset('shop/js/app.js ') }}"></script>
    <script src="{{ asset('asset/jqueryajax/ajaxShop.js ') }}"></script>

</body>
</html>