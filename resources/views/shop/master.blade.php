
@include('shop.header')

<style>
    .swal2-modal {
        padding-bottom: 0px;
    }
    </style>
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
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    <script src="{{ asset('shop/js/vendor.js ') }}"></script>
    <script src="{{ asset('shop/js/jquery.shopnav.js ') }}"></script>
    <script src="{{ asset('shop/js/app.js ') }}"></script>
    <script src="{{ asset('asset/jqueryajax/ajaxShop.js ') }}"></script>
</body>
</html>