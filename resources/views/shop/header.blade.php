<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href=" {{asset('shop/images/favicon.png') }}" rel="shortcut icon">
    <title>Ludus - Electronics, Apparel, Computers, Books, DVDs & more</title>

    <!--====== Google Font ======-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">

    <!--====== Vendor Css ======-->
    <link rel="stylesheet" href=" {{asset('shop/css/vendor.css') }}">

    <!--====== Utility-Spacing ======-->
    <link rel="stylesheet" href=" {{asset('shop/css/utility.css') }}">

    <!--====== App ======-->
    <link rel="stylesheet" href=" {{asset('shop/css/app.css') }}">
</head>
<body class="config">
    <div class="preloader is-active">
        <div class="preloader__wrap">

            <img class="preloader__img" src="{{ asset('shop/images/preloader.png') }}" alt=""></div>
    </div>
   
    <!--====== Main App ======-->
    <div id="app">

        <!--====== Header Wrapper ======-->
        <div class="header-wrapper">

            <!--====== Main Header ======-->
            <header class="header--style-3">

                <!--====== Nav 1 ======-->
                <nav class="primary-nav-wrapper">
                    <div class="container">

                        <!--====== Primary Nav ======-->
                        <div class="primary-nav">

                            <!--====== Main Logo ======-->
                           
                            <a class="main-logo" href="{{ asset('shop/index-3.html') }}">

                                <img src="{{ asset('shop/images/logo/logo-2.png') }}" alt=""></a>
                            <!--====== End - Main Logo ======-->


                            <!--====== Search Form ======-->
                            <form class="main-form">

                                <label for="main-search"></label>

                                <input class="input-text input-text--border-radius input-text--only-white" type="text" id="main-search" placeholder="Search">

                                <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button></form>
                            <!--====== End - Search Form ======-->


                            <!--====== Dropdown Main plugin ======-->
                            <div class="menu-init" id="navigation">

                                <button class="btn btn--icon toggle-button toggle-button--white fas fa-cogs" type="button"></button>

                                <!--====== Menu ======-->
                                <div class="ah-lg-mode">

                                    <span class="ah-close">✕ Close</span>

                                    <!--====== List ======-->
                                    <ul class="ah-list ah-list--design1 ah-list--link-color-white">
                                        <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Account">

                                            <a><i class="far fa-user-circle"></i></a>

                                            <!--====== Dropdown ======-->

                                            <span class="js-menu-toggle"></span>
                                            <ul style="width:120px">
                                                <li>

                                                    <a href="{{ asset('shop/dashboard.html') }}"><i class="fas fa-user-circle u-s-m-r-6"></i>

                                                        <span>Account</span></a></li>
                                                <li>

                                                    <a href="{{ asset('shop/signup.html') }}"><i class="fas fa-user-plus u-s-m-r-6"></i>

                                                        <span>Signup</span></a></li>
                                                <li>

                                                    <a href="{{ asset('shop/signin.html') }}"><i class="fas fa-lock u-s-m-r-6"></i>

                                                        <span>Signin</span></a></li>
                                                <li>

                                                    <a href="{{ asset('shop/signup.html') }}"><i class="fas fa-lock-open u-s-m-r-6"></i>

                                                        <span>Signout</span></a></li>
                                            </ul>
                                            <!--====== End - Dropdown ======-->
                                        </li>
                                        <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Settings">

                                            <a><i class="fas fa-user-cog"></i></a>

                                            <!--====== Dropdown ======-->

                                            <span class="js-menu-toggle"></span>
                                            <ul style="width:120px">
                                                <li class="has-dropdown has-dropdown--ul-right-100">

                                                    <a>Language<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                                    <!--====== Dropdown ======-->

                                                    <span class="js-menu-toggle"></span>
                                                    <ul style="width:120px">
                                                        <li>

                                                            <a class="u-c-brand">ENGLISH</a></li>
                                                        <li>

                                                            <a>ARABIC</a></li>
                                                        <li>

                                                            <a>FRANCAIS</a></li>
                                                        <li>

                                                            <a>ESPANOL</a></li>
                                                    </ul>
                                                    <!--====== End - Dropdown ======-->
                                                </li>
                                                <li class="has-dropdown has-dropdown--ul-right-100">

                                                    <a>Currency<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                                    <!--====== Dropdown ======-->

                                                    <span class="js-menu-toggle"></span>
                                                    <ul style="width:225px">
                                                        <li>

                                                            <a class="u-c-brand">$ - US DOLLAR</a></li>
                                                        <li>

                                                            <a>£ - BRITISH POUND STERLING</a></li>
                                                        <li>

                                                            <a>€ - EURO</a></li>
                                                    </ul>
                                                    <!--====== End - Dropdown ======-->
                                                </li>
                                            </ul>
                                            <!--====== End - Dropdown ======-->
                                        </li>
                                        <li data-tooltip="tooltip" data-placement="left" title="Contact">

                                            <a href="tel:+0900901904"><i class="fas fa-phone-volume"></i></a></li>
                                        <li data-tooltip="tooltip" data-placement="left" title="Mail">

                                            <a href="mailto:contact@domain.com"><i class="far fa-envelope"></i></a></li>
                                    </ul>
                                    <!--====== End - List ======-->
                                </div>
                                <!--====== End - Menu ======-->
                            </div>
                            <!--====== End - Dropdown Main plugin ======-->
                        </div>
                        <!--====== End - Primary Nav ======-->
                    </div>
                </nav>
                <!--====== End - Nav 1 ======-->


                <!--====== Nav 2 ======-->
                <nav class="secondary-nav-wrapper">
                    <div class="container">

                        <!--====== Secondary Nav ======-->
                        <div class="secondary-nav">

                            <!--====== Dropdown Main plugin ======-->
                            <div class="menu-init" id="navigation1">

                                <button class="btn btn--icon toggle-mega-text toggle-button" type="button">M</button>

                                <!--====== Menu ======-->
                                <div class="ah-lg-mode">

                                    <span class="ah-close">✕ Close</span>

                                    <!--====== List ======-->
                                    <ul class="ah-list">
                                        <li class="has-dropdown">

                                            <span class="mega-text">M</span>

                                            <!--====== Mega Menu ======-->

                                            <span class="js-menu-toggle"></span>
                                            <div class="mega-menu">
                                                <div class="mega-menu-wrap">
                                                    <div class="mega-menu-list">
                                                        <ul>
                                                            <li class="js-active">

                                                                <a href="{{ asset('shop/shop-side-version-2.html') }}"><i class="fas fa-tv u-s-m-r-6"></i>

                                                                    <span>Electronics</span></a>

                                                                <span class="js-menu-toggle js-toggle-mark"></span></li>
                                                            <li>

                                                                <a href="{{ asset('shop/shop-side-version-2.html') }}"><i class="fas fa-female u-s-m-r-6"></i>

                                                                    <span>Women's Clothing</span></a>

                                                                <span class="js-menu-toggle"></span></li>
                                                            <li>

                                                                <a href="{{ asset('shop/shop-side-version-2.html') }}"><i class="fas fa-male u-s-m-r-6"></i>

                                                                    <span>Men's Clothing</span></a>

                                                                <span class="js-menu-toggle"></span></li>
                                                            <li>

                                                                <a href="{{ asset('shop/index-3.html') }}"><i class="fas fa-utensils u-s-m-r-6"></i>

                                                                    <span>Food & Supplies</span></a>

                                                                <span class="js-menu-toggle"></span></li>
                                                            <li>

                                                                <a href="{{ asset('shop/index-3.html') }}"><i class="fas fa-couch u-s-m-r-6"></i>

                                                                    <span>Furniture & Decor</span></a>

                                                                <span class="js-menu-toggle"></span></li>
                                                            <li>

                                                                <a href="{{ asset('shop/index-3.html') }}"><i class="fas fa-football-ball u-s-m-r-6"></i>

                                                                    <span>Sports & Game</span></a>

                                                                <span class="js-menu-toggle"></span></li>
                                                            <li>

                                                                <a href="{{ asset('shop/index-3.html') }}"><i class="fas fa-heartbeat u-s-m-r-6"></i>

                                                                    <span>Beauty & Health</span></a>

                                                                <span class="js-menu-toggle"></span></li>
                                                        </ul>
                                                    </div>

                                                    <!--====== Electronics ======-->
                                                    <div class="mega-menu-content js-active">

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">3D PRINTER & SUPPLIES</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">3d Printer</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">3d Printing Pen</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">3d Printing Accessories</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">3d Printer Module Board</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">HOME AUDIO & VIDEO</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">TV Boxes</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">TC Receiver & Accessories</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Display Dongle</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Home Theater System</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">MEDIA PLAYERS</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Earphones</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Mp3 Players</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Speakers & Radios</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Microphones</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">VIDEO GAME ACCESSORIES</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Nintendo Video Games Accessories</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Sony Video Games Accessories</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Xbox Video Games Accessories</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                        <br>

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">SECURITY & PROTECTION</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Security Cameras</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Alarm System</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Security Gadgets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">CCTV Security & Accessories</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">PHOTOGRAPHY & CAMERA</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Digital Cameras</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Sport Camera & Accessories</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Camera Accessories</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Lenses & Accessories</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">ARDUINO COMPATIBLE</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Raspberry Pi & Orange Pi</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Module Board</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Smart Robot</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Board Kits</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">DSLR Camera</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Nikon Cameras</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Canon Camera</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Sony Camera</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">DSLR Lenses</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                        <br>

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">NECESSARY ACCESSORIES</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Flash Cards</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Memory Cards</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Flash Pins</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Compact Discs</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-9 mega-image">
                                                                <div class="mega-banner">

                                                                    <a class="u-d-block" href="{{ asset('shop/shop-side-version-2.html') }}">

                                                                        <img class="u-img-fluid u-d-block" src="{{ asset('shop/images/banners/banner-mega-0.jpg') }}" alt=""></a></div>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                    </div>
                                                    <!--====== End - Electronics ======-->


                                                    <!--====== Women ======-->
                                                    <div class="mega-menu-content">

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-6 mega-image">
                                                                <div class="mega-banner">

                                                                    <a class="u-d-block" href="{{ asset('shop/shop-side-version-2.html') }}">

                                                                        <img class="u-img-fluid u-d-block" src="{{ asset('shop/images/banners/banner-mega-1.jpg') }}" alt=""></a></div>
                                                            </div>
                                                            <div class="col-lg-6 mega-image">
                                                                <div class="mega-banner">

                                                                    <a class="u-d-block" href="{{ asset('shop/shop-side-version-2.html') }}">

                                                                        <img class="u-img-fluid u-d-block" src="{{ asset('shop/images/banners/banner-mega-2.jpg') }}" alt=""></a></div>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                        <br>

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">HOT CATEGORIES</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Dresses</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Blouses & Shirts</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">T-shirts</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Rompers</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">INTIMATES</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Bras</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Brief Sets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Bustiers & Corsets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Panties</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">WEDDING & EVENTS</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Wedding Dresses</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Evening Dresses</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Prom Dresses</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Flower Dresses</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">BOTTOMS</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Skirts</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Shorts</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Leggings</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Jeans</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                        <br>

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">OUTWEAR</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Blazers</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Basics Jackets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Trench</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Leather & Suede</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">JACKETS</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Denim Jackets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Trucker Jackets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Windbreaker Jackets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Leather Jackets</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">ACCESSORIES</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Tech Accessories</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Headwear</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Baseball Caps</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Belts</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">OTHER ACCESSORIES</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Bags</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Wallets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Watches</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Sunglasses</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                        <br>

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-9 mega-image">
                                                                <div class="mega-banner">

                                                                    <a class="u-d-block" href="{{ asset('shop/shop-side-version-2.html') }}">

                                                                        <img class="u-img-fluid u-d-block" src="{{ asset('shop/images/banners/banner-mega-3.jpg') }}" alt=""></a></div>
                                                            </div>
                                                            <div class="col-lg-3 mega-image">
                                                                <div class="mega-banner">

                                                                    <a class="u-d-block" href="{{ asset('shop/shop-side-version-2.html') }}">

                                                                        <img class="u-img-fluid u-d-block" src="{{ asset('shop/images/banners/banner-mega-4.jpg') }}" alt=""></a></div>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                    </div>
                                                    <!--====== End - Women ======-->


                                                    <!--====== Men ======-->
                                                    <div class="mega-menu-content">

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-4 mega-image">
                                                                <div class="mega-banner">

                                                                    <a class="u-d-block" href="{{ asset('shop/shop-side-version-2.html') }}">

                                                                        <img class="u-img-fluid u-d-block" src="{{ asset('shop/images/banners/banner-mega-5.jpg') }}" alt=""></a></div>
                                                            </div>
                                                            <div class="col-lg-4 mega-image">
                                                                <div class="mega-banner">

                                                                    <a class="u-d-block" href="{{ asset('shop/shop-side-version-2.html') }}">

                                                                        <img class="u-img-fluid u-d-block" src="{{ asset('shop/images/banners/banner-mega-6.jpg') }}" alt=""></a></div>
                                                            </div>
                                                            <div class="col-lg-4 mega-image">
                                                                <div class="mega-banner">

                                                                    <a class="u-d-block" href="{{ asset('shop/shop-side-version-2.html') }}">

                                                                        <img class="u-img-fluid u-d-block" src="{{ asset('shop/images/banners/banner-mega-7.jpg') }}" alt=""></a></div>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                        <br>

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">HOT SALE</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">T-Shirts</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Tank Tops</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Polo</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Shirts</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">OUTWEAR</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Hoodies</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Trench</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Parkas</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Sweaters</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">BOTTOMS</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Casual Pants</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Cargo Pants</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Jeans</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Shorts</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">UNDERWEAR</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Boxers</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Briefs</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Robes</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Socks</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                        <br>

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">JACKETS</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Denim Jackets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Trucker Jackets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Windbreaker Jackets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Leather Jackets</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">SUNGLASSES</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Pilot</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Wayfarer</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Square</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Round</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">ACCESSORIES</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Eyewear Frames</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Scarves</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Hats</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Belts</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <ul>
                                                                    <li class="mega-list-title">

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">OTHER ACCESSORIES</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Bags</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Wallets</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Watches</a></li>
                                                                    <li>

                                                                        <a href="{{ asset('shop/shop-side-version-2.html') }}">Tech Accessories</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                        <br>

                                                        <!--====== Mega Menu Row ======-->
                                                        <div class="row">
                                                            <div class="col-lg-6 mega-image">
                                                                <div class="mega-banner">

                                                                    <a class="u-d-block" href="{{ asset('shop/shop-side-version-2.html') }}">

                                                                        <img class="u-img-fluid u-d-block" src="{{ asset('shop/images/banners/banner-mega-8.jpg') }}" alt=""></a></div>
                                                            </div>
                                                            <div class="col-lg-6 mega-image">
                                                                <div class="mega-banner">

                                                                    <a class="u-d-block" href="{{ asset('shop/shop-side-version-2.html') }}">

                                                                        <img class="u-img-fluid u-d-block" src="{{ asset('shop/images/banners/banner-mega-9.jpg') }}" alt=""></a></div>
                                                            </div>
                                                        </div>
                                                        <!--====== End - Mega Menu Row ======-->
                                                    </div>
                                                    <!--====== End - Men ======-->


                                                    <!--====== No Sub Categories ======-->
                                                    <div class="mega-menu-content">
                                                        <h5>No Categories</h5>
                                                    </div>
                                                    <!--====== End - No Sub Categories ======-->


                                                    <!--====== No Sub Categories ======-->
                                                    <div class="mega-menu-content">
                                                        <h5>No Categories</h5>
                                                    </div>
                                                    <!--====== End - No Sub Categories ======-->


                                                    <!--====== No Sub Categories ======-->
                                                    <div class="mega-menu-content">
                                                        <h5>No Categories</h5>
                                                    </div>
                                                    <!--====== End - No Sub Categories ======-->


                                                    <!--====== No Sub Categories ======-->
                                                    <div class="mega-menu-content">
                                                        <h5>No Categories</h5>
                                                    </div>
                                                    <!--====== End - No Sub Categories ======-->
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu ======-->
                                        </li>
                                    </ul>
                                    <!--====== End - List ======-->
                                </div>
                                <!--====== End - Menu ======-->
                            </div>
                            <!--====== End - Dropdown Main plugin ======-->


                            <!--====== Dropdown Main plugin ======-->
                            <div class="menu-init" id="navigation2">

                                <button class="btn btn--icon toggle-button toggle-button--white fas fa-cog" type="button"></button>

                                <!--====== Menu ======-->
                                <div class="ah-lg-mode">

                                    <span class="ah-close">✕ Close</span>

                                    <!--====== List ======-->
                                    <ul class="ah-list ah-list--design2 ah-list--link-color-white">
                                        <li>

                                            <a href="http://127.0.0.1:8000/shops">Trang chủ</a></li>
                                        <li class="has-dropdown">

                                            <a>Trang<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                            <!--====== Dropdown ======-->

                                            <span class="js-menu-toggle"></span>
                                            <ul style="width:170px">
                                        
                                                <li class="has-dropdown has-dropdown--ul-left-100">

                                                    <a>Tài khoản<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                                    <!--====== Dropdown ======-->

                                                    <span class="js-menu-toggle"></span>
                                                    <ul style="width:200px">
                                                        <li>

                                                            <a href="{{ asset('shop/signin.html') }}">Đăng nhập</a></li>
                                                        <li>

                                                            <a href="{{ asset('shop/signup.html') }}">Đăng ký</a></li>
                                                        <li>

                                                            <a href="{{ asset('shop/lost-password.html') }}">Quên mật khẩu</a></li>
                                                    </ul>
                                                    <!--====== End - Dropdown ======-->
                                                </li>
                                                <li class="has-dropdown has-dropdown--ul-left-100">

                                                    <a href="{{ asset('shop/dashboard.html') }}">Quản lý<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>

                                                    <!--====== Dropdown ======-->

                                                    <span class="js-menu-toggle"></span>
                                                    <ul style="width:200px">
                                                        <li class="has-dropdown has-dropdown--ul-left-100">

                                                            <a href="{{ asset('shop/dash-manage-order.html') }}">Quản lý đơn hàng</a></li>

                                                            <!--====== Dropdown ======-->

                                                            <span class="js-menu-toggle"></span>
                                               
                                                            <!--====== End - Dropdown ======-->
                                                        </li>
                                                      
                                                    </ul>
                                                    <!--====== End - Dropdown ======-->
                                                </li>
                                        
                                                <li>

                                                    <a href="{{ asset('shop/cart.html') }}">Giỏ hàng</a></li>
                                                <li>

                                                    <a href="{{ asset('shop/wishlist.html') }}">Giỏ yêu thích</a></li>
                                                <li>

                                                    <a href="{{ asset('shop/checkout.html') }}">Thanh toán</a></li>
                                              
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">

                                            <a>Bài viết<i class="fas fa-angle-down u-s-m-l-6"></i></a>

                                            <!--====== Dropdown ======-->

                                            <span class="js-menu-toggle"></span>
                                            <ul style="width:200px">
                                              
                                                <li>

                                                    <a href="{{ asset('shop/blog-right-sidebar.html') }}">Trang blogs</a></li>
                                              
                                            </ul>
                                            <!--====== End - Dropdown ======-->
                                        </li>
                                    </ul>
                                    <!--====== End - List ======-->
                                </div>
                                <!--====== End - Menu ======-->
                            </div>
                            <!--====== End - Dropdown Main plugin ======-->


                            <!--====== Dropdown Main plugin ======-->
                            <div class="menu-init" id="navigation3">

                                <button class="btn btn--icon toggle-button toggle-button--white fas fa-shopping-bag toggle-button-shop" type="button"></button>

                                <span class="total-item-round">2</span>

                                <!--====== Menu ======-->
                                <div class="ah-lg-mode">

                                    <span class="ah-close">✕ Close</span>

                                    <!--====== List ======-->
                                    <ul class="ah-list ah-list--design1 ah-list--link-color-white">
                                        <li>

                                            <a href="http://127.0.0.1:8000/shops"><i class="fas fa-home u-c-brand"></i></a></li>
                                        <li>

                                            <a href="{{ asset('shop/wishlist.html') }}"><i class="far fa-heart"></i></a></li>
                                        <li class="has-dropdown">

                                            <a class="mini-cart-shop-link"><i class="fas fa-shopping-bag"></i>

                                                <span class="total-item-round">2</span></a>

                                            <!--====== Dropdown ======-->

                                            <span class="js-menu-toggle"></span>
                                            <div class="mini-cart">

                                                <!--====== Mini Product Container ======-->
                                                <div class="mini-product-container gl-scroll u-s-m-b-15">

                                                    <!--====== Card for mini cart ======-->
                                                    <div class="card-mini-product">
                                                        <div class="mini-product">
                                                            <div class="mini-product__image-wrapper">

                                                                <a class="mini-product__link" href="{{ asset('shop/product-detail.html') }}">

                                                                    <img class="u-img-fluid" src="{{ asset('shop/images/product/electronic/product3.jpg') }}" alt=""></a></div>
                                                            <div class="mini-product__info-wrapper">

                                                                <span class="mini-product__category">

                                                                    <a href="{{ asset('shop/shop-side-version-2.html') }}">Electronics</a></span>

                                                                <span class="mini-product__name">

                                                                    <a href="{{ asset('shop/product-detail.html') }}">Yellow Wireless Headphone</a></span>

                                                                <span class="mini-product__quantity">1 x</span>

                                                                <span class="mini-product__price">$8</span></div>
                                                        </div>

                                                        <a class="mini-product__delete-link far fa-trash-alt"></a>
                                                    </div>
                                                    <!--====== End - Card for mini cart ======-->


                                                    <!--====== Card for mini cart ======-->
                                                    <div class="card-mini-product">
                                                        <div class="mini-product">
                                                            <div class="mini-product__image-wrapper">

                                                                <a class="mini-product__link" href="{{ asset('shop/product-detail.html') }}">

                                                                    <img class="u-img-fluid" src="{{ asset('shop/images/product/electronic/product18.jpg') }}" alt=""></a></div>
                                                            <div class="mini-product__info-wrapper">

                                                                <span class="mini-product__category">

                                                                    <a href="{{ asset('shop/shop-side-version-2.html') }}">Electronics</a></span>

                                                                <span class="mini-product__name">

                                                                    <a href="{{ asset('shop/product-detail.html') }}">Nikon DSLR Camera 4k</a></span>

                                                                <span class="mini-product__quantity">1 x</span>

                                                                <span class="mini-product__price">$8</span></div>
                                                        </div>

                                                        <a class="mini-product__delete-link far fa-trash-alt"></a>
                                                    </div>
                                                    <!--====== End - Card for mini cart ======-->


                                                    <!--====== Card for mini cart ======-->
                                                    <div class="card-mini-product">
                                                        <div class="mini-product">
                                                            <div class="mini-product__image-wrapper">

                                                                <a class="mini-product__link" href="{{ asset('shop/product-detail.html') }}">

                                                                    <img class="u-img-fluid" src="{{ asset('shop/images/product/women/product8.jpg') }}" alt=""></a></div>
                                                            <div class="mini-product__info-wrapper">

                                                                <span class="mini-product__category">

                                                                    <a href="{{ asset('shop/shop-side-version-2.html') }}">Women Clothing</a></span>

                                                                <span class="mini-product__name">

                                                                    <a href="{{ asset('shop/product-detail.html') }}">New Dress D Nice Elegant</a></span>

                                                                <span class="mini-product__quantity">1 x</span>

                                                                <span class="mini-product__price">$8</span></div>
                                                        </div>

                                                        <a class="mini-product__delete-link far fa-trash-alt"></a>
                                                    </div>
                                                    <!--====== End - Card for mini cart ======-->


                                                    <!--====== Card for mini cart ======-->
                                                    <div class="card-mini-product">
                                                        <div class="mini-product">
                                                            <div class="mini-product__image-wrapper">

                                                                <a class="mini-product__link" href="{{ asset('shop/product-detail.html') }}">

                                                                    <img class="u-img-fluid" src="{{ asset('shop/images/product/men/product8.jpg') }}" alt=""></a></div>
                                                            <div class="mini-product__info-wrapper">

                                                                <span class="mini-product__category">

                                                                    <a href="{{ asset('shop/shop-side-version-2.html') }}">Men Clothing</a></span>

                                                                <span class="mini-product__name">

                                                                    <a href="{{ asset('shop/product-detail.html') }}">New Fashion D Nice Elegant</a></span>

                                                                <span class="mini-product__quantity">1 x</span>

                                                                <span class="mini-product__price">$8</span></div>
                                                        </div>

                                                        <a class="mini-product__delete-link far fa-trash-alt"></a>
                                                    </div>
                                                    <!--====== End - Card for mini cart ======-->
                                                </div>
                                                <!--====== End - Mini Product Container ======-->


                                                <!--====== Mini Product Statistics ======-->
                                                <div class="mini-product-stat">
                                                    <div class="mini-total">

                                                        <span class="subtotal-text">SUBTOTAL</span>

                                                        <span class="subtotal-value">$16</span></div>
                                                    <div class="mini-action">

                                                        <a class="mini-link btn--e-brand-b-2" href="{{ asset('shop/checkout.html') }}">PROCEED TO CHECKOUT</a>

                                                        <a class="mini-link btn--e-transparent-secondary-b-2" href="{{ asset('shop/cart.html') }}">VIEW CART</a></div>
                                                </div>
                                                <!--====== End - Mini Product Statistics ======-->
                                            </div>
                                            <!--====== End - Dropdown ======-->
                                        </li>
                                    </ul>
                                    <!--====== End - List ======-->
                                </div>
                                <!--====== End - Menu ======-->
                            </div>
                            <!--====== End - Dropdown Main plugin ======-->
                        </div>
                        <!--====== End - Secondary Nav ======-->
                    </div>
                </nav>
                <!--====== End - Nav 2 ======-->
            </header>