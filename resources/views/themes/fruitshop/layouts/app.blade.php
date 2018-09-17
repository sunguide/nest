
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Fruit Shop ine showroom. This is a fully responsive Html theme, with multiple versions for homepage and multiple templates for sub pages as well" />
    <meta name="keywords" content="shop" />
    <meta name="robots" content="noodp,index,follow" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel Shop') - 商城</title>
    <!-- 样式 -->
{{--    <link href="{{ mix('/themes/fruitshop/css/app.css') }}" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/ionicons.min.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/jquery.fancybox.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/jquery-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/owl.carousel.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/owl.transitions.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/jquery.mCustomScrollbar.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/owl.theme.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/animate.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/libs/hover.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/color2.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/theme.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/responsive.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/browser.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="/themes/fruitshop/css/rtl.css" media="all"/>
</head>
<body class="preload">
<div class="wrap">
    <header id="header">
        <div class="header">
            <div class="top-header top-header2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 hidden-xs">
                            <ul class="currency-language list-inline-block pull-left">
                            </ul>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <ul class="info-account list-inline-block pull-right">
                                <li><a href="#"><span class="color"><i class="fa fa-user-o"></i></span>账户</a></li>
                                <li><a href="#"><span class="color"><i class="fa fa-key"></i></span>登录</a></li>
                                <li><a href="#"><span class="color"><i class="fa fa-check-circle-o"></i></span>结账</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Header -->
            <div class="main-header2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="logo logo2 pull-left">
                                <h1 class="hidden">西域甄果</h1>
                                <a href="#"><img src="/themes/fruitshop/images/home/home2/logo.png" alt="" /></a>
                            </div>
                            <div class="mini-cart-box mini-cart1 pull-right">
                                <a class="mini-cart-link" href="cart.html">
                                    <span class="mini-cart-icon title18 color"><i class="fa fa-shopping-basket"></i></span>
                                    <span class="mini-cart-number">0 Item - <span class="color">$ 0.000</span></span>
                                </a>
                                <div class="mini-cart-content text-left">
                                    <h2 class="title18 color">(2) ITEMS IN MY CART</h2>
                                    <div class="list-mini-cart-item">
                                        <div class="product-mini-cart table">
                                            <div class="product-thumb">
                                                <a href="detail.html" class="product-thumb-link"><img alt="" src="/themes/fruitshop/images/product/fruit_01.jpg"></a>
                                                <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="#">Aurore Grape</a></h3>
                                                <div class="product-price">
                                                    <ins><span>$400.00</span></ins>
                                                    <del><span>$520.00</span></del>
                                                </div>
                                                <div class="product-rate">
                                                    <div class="product-rating" style="width:100%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-mini-cart table">
                                            <div class="product-thumb">
                                                <a href="detail.html" class="product-thumb-link"><img alt="" src="/themes/fruitshop/images/product/fruit_02.jpg"></a>
                                                <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="#">Conconut Chips</a></h3>
                                                <div class="product-price">
                                                    <ins><span>$400.00</span></ins>
                                                    <del><span>$520.00</span></del>
                                                </div>
                                                <div class="product-rate">
                                                    <div class="product-rating" style="width:100%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mini-cart-total  clearfix">
                                        <strong class="pull-left title18">TOTAL</strong>
                                        <span class="pull-right color title18">$800.00</span>
                                    </div>
                                    <div class="mini-cart-button">
                                        <a class="mini-cart-view shop-button" href="#">View cart </a>
                                        <a class="mini-cart-checkout shop-button" href="#">Checkout</a>
                                    </div>
                                </div>
                            </div>
                            <form class="search-form search-form2 pull-right">
                                <input onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="搜索" type="text">
                                <input type="submit" value="">
                                <div class="dropdown-box">
                                    <a href="#" class="dropdown-link"><i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-list list-none">
                                        <li><a href="#">干果</a></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main Header -->
            <div class="nav-header2 bg-color header-ontop">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="main-nav main-nav2 pull-left">
                                <ul>
                                    <li class="current-menu-item menu-item-has-children">
                                        <a href="/">首页</a>
                                    </li>
                                    <li class="menu-item-has-children has-mega-menu">
                                        <a href="#">精选</a>
                                        <ul class="sub-menu">
                                            <li>
                                                <div class="mega-menu">
                                                    <div class="row">
                                                        <div class="col-md-5 col-sm-4 col-xs-12">
                                                            <div class="mega-adv">
                                                                <div class="banner-adv fade-out-in">
                                                                    <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/menu/banner-electronics.jpg" alt="" /></a>
                                                                </div>
                                                                <div class="mega-adv-info">
                                                                    <h3 class="title24 text-uppercase"><a href="#">新疆无核白</a></h3>
                                                                    <p class="desc">惺惺惜惺惺想多多 多多。</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 col-sm-8 col-xs-12">
                                                            <div class="mega-new-arrival">
                                                                <h2 class="mega-menu-title title30 text-uppercase">精选商品</h2>
                                                                <div class="mega-new-arrival-slider product-slider">
                                                                    <div class="wrap-item group-navi" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1],[768,2]]">
                                                                        <div class="item-product item-product-grid text-center">
                                                                            <div class="product-thumb">
                                                                                <a href="detail.html" class="product-thumb-link rotate-thumb">
                                                                                    <img src="/themes/fruitshop/images/product/fruit_01.jpg" alt="">
                                                                                    <img src="/themes/fruitshop/images/product/fruit_02.jpg" alt="">
                                                                                </a>
                                                                                <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                                            </div>
                                                                            <div class="product-info">
                                                                                <h3 class="product-title"><a href="detail.html">Conconut Chips</a></h3>
                                                                                <div class="product-price">
                                                                                    <ins class="color"><span>€30.000</span></ins>
                                                                                </div>
                                                                                <div class="product-rate">
                                                                                    <div class="product-rating" style="width:100%"></div>
                                                                                </div>
                                                                                <div class="product-extra-link">
                                                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                                                                    <a href="#" class="addcart-link">Add to cart</a>
                                                                                    <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="item-product item-product-grid text-center">
                                                                            <div class="product-thumb">
                                                                                <a href="detail.html" class="product-thumb-link rotate-thumb">
                                                                                    <img src="/themes/fruitshop/images/product/fruit_03.jpg" alt="">
                                                                                    <img src="/themes/fruitshop/images/product/fruit_04.jpg" alt="">
                                                                                </a>
                                                                                <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                                            </div>
                                                                            <div class="product-info">
                                                                                <h3 class="product-title"><a href="detail.html">Conconut Chips</a></h3>
                                                                                <div class="product-price">
                                                                                    <ins class="color"><span>€30.000</span></ins>
                                                                                </div>
                                                                                <div class="product-rate">
                                                                                    <div class="product-rating" style="width:100%"></div>
                                                                                </div>
                                                                                <div class="product-extra-link">
                                                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                                                                    <a href="#" class="addcart-link">Add to cart</a>
                                                                                    <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="item-product item-product-grid text-center">
                                                                            <div class="product-thumb">
                                                                                <a href="detail.html" class="product-thumb-link rotate-thumb">
                                                                                    <img src="/themes/fruitshop/images/product/fruit_05.jpg" alt="">
                                                                                    <img src="/themes/fruitshop/images/product/fruit_06.jpg" alt="">
                                                                                </a>
                                                                                <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                                            </div>
                                                                            <div class="product-info">
                                                                                <h3 class="product-title"><a href="detail.html">Conconut Chips</a></h3>
                                                                                <div class="product-price">
                                                                                    <ins class="color"><span>€30.000</span></ins>
                                                                                </div>
                                                                                <div class="product-rate">
                                                                                    <div class="product-rating" style="width:100%"></div>
                                                                                </div>
                                                                                <div class="product-extra-link">
                                                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                                                                    <a href="#" class="addcart-link">Add to cart</a>
                                                                                    <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="item-product item-product-grid text-center">
                                                                            <div class="product-thumb">
                                                                                <a href="detail.html" class="product-thumb-link rotate-thumb">
                                                                                    <img src="/themes/fruitshop/images/product/fruit_07.jpg" alt="">
                                                                                    <img src="/themes/fruitshop/images/product/fruit_08.jpg" alt="">
                                                                                </a>
                                                                                <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                                            </div>
                                                                            <div class="product-info">
                                                                                <h3 class="product-title"><a href="detail.html">Conconut Chips</a></h3>
                                                                                <div class="product-price">
                                                                                    <ins class="color"><span>€30.000</span></ins>
                                                                                </div>
                                                                                <div class="product-rate">
                                                                                    <div class="product-rating" style="width:100%"></div>
                                                                                </div>
                                                                                <div class="product-extra-link">
                                                                                    <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                                                                    <a href="#" class="addcart-link">Add to cart</a>
                                                                                    <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Mega Menu -->
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="grid.html">商品</a>
                                        <ul class="sub-menu">
                                            <li><a href="grid.html">Grid Shop</a></li>
                                            <li><a href="list.html">List Shop</a></li>
                                            <li class="menu-item-has-children">
                                                <a href="detail.html">Product Detail</a>
                                                <ul class="sub-menu">
                                                    <li><a href="detail-fullwidth.html">Detail Fullwidth</a></li>
                                                    <li><a href="detail-extra-link.html">Detail Extra Link</a></li>
                                                    <li><a href="detail-group.html">Detail Group</a></li>
                                                    <li><a href="detail-sidebar-right.html">Detail Sidebar Right</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="checkout.html">Check Out</a></li>
                                            <li><a href="login-register.html">Login/Register</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/blog">博客</a></li>
                                    <li><a href="/contact">联系我们</a></li>
                                </ul>
                                <a href="#" class="toggle-mobile-menu"><span></span></a>
                            </nav>
                            <div class="top-social pull-right">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Nav Header -->
        </div>
    </header>
    <!-- End Header -->
    <section id="content">
        <div class="banner-slider bg-slider banner-slider2 parallax-slider">
            <div class="wrap-item" data-pagination="false" data-navigation="true" data-transition="fade" data-autoplay="true" data-itemscustom="[[0,1]]">
                <div class="item-slider item-slider2">
                    <div class="banner-thumb"><a href="#"><img src="/themes/fruitshop/images/home/home2/slide1.jpg" alt="" /></a></div>
                    <div class="banner-info text-center">
                        <div class="img-info animated" data-animated="zoomIn"><img src="/themes/fruitshop/images/home/home2/sl1.png" alt="" /></div>
                        <div class="text-info animated" data-animated="bounceInUp">
                            <h2 class="title30 color paci-font">Food & Nutrition</h2>
                            <h2 class="color2 font-bold text-uppercase title30">10 Health Benefits of Spirulina</h2>
                            <div class="banner-button">
                                <a href="#" class="btn-arrow color style2">Shop now</a>
                                <a href="#" class="btn-arrow bg-color style2">More detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-slider item-slider2">
                    <div class="banner-thumb"><a href="#"><img src="/themes/fruitshop/images/home/home2/slide2.jpg" alt="" /></a></div>
                    <div class="banner-info text-center">
                        <div class="img-info animated" data-animated="flipInY"><img src="/themes/fruitshop/images/home/home2/sl2.png" alt="" /></div>
                        <div class="text-info animated" data-animated="bounceInUp">
                            <h2 class="title30 color paci-font">Fruit Juice The One</h2>
                            <h2 class="color2 font-bold text-uppercase title30">Have look at out beautiful farm</h2>
                            <div class="banner-button">
                                <a href="#" class="btn-arrow color style2">Shop now</a>
                                <a href="#" class="btn-arrow bg-color style2">More detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-slider item-slider2">
                    <div class="banner-thumb"><a href="#"><img src="/themes/fruitshop/images/home/home2/slide3.jpg" alt="" /></a></div>
                    <div class="banner-info text-center">
                        <div class="img-info animated" data-animated="flipInX"><img src="/themes/fruitshop/images/home/home2/sl3.png" alt="" /></div>
                        <div class="text-info animated" data-animated="bounceInUp">
                            <h2 class="title30 color paci-font">Natural Fruits</h2>
                            <h2 class="color2 font-bold text-uppercase title30">Freash And Heathly</h2>
                            <div class="banner-button">
                                <a href="#" class="btn-arrow color style2">Shop now</a>
                                <a href="#" class="btn-arrow bg-color style2">More detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner -->
        <div class="container">

            <div class="featured-product2">
                <h2 class="color2 title30 text-center title-box2">featured products</h2>
                <ul class="list-inline-block text-center title-tab-icon">
                    <li class="active"><a href="#tab1" data-toggle="tab"><img src="/themes/fruitshop/images/home/home2/fru3.png" alt="" /><span>葡萄干</span></a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="tab-pane active">
                        <div class="product-slider">
                            <div class="wrap-item" data-navigation="true" data-pagination="false" data-itemscustom="[[0,1],[560,2],[768,3],[990,4]]">
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_14.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_07.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Conconut Chips</a></h3>
                                        <div class="product-price">
                                            <ins class="color"><span>€30.000</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Fruits</a></li>
                                            <li><a href="#">Breads</a></li>
                                            <li><a href="#">Juices</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_18.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_06.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Apetito Pure Fruit Juice</a></h3>
                                        <div class="product-price">
                                            <del class="silver"><span>$550.00</span></del>
                                            <ins class="color"><span>€450.00</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Refresh</a></li>
                                            <li><a href="#">Health</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_13.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_12.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        <div class="product-label new-label">new</div>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Aurore Grape</a></h3>
                                        <div class="product-price">
                                            <ins class="color"><span>€290.00</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Vegetables</a></li>
                                            <li><a href="#">Vitamin</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_21.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_02.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Fresh Meal Kit</a></h3>
                                        <div class="product-price">
                                            <del class="silver"><span>€550.00</span></del>
                                            <ins class="color"><span>€170.00</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Fruits</a></li>
                                            <li><a href="#">Health</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_01.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_03.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Aurore Grape</a></h3>
                                        <div class="product-price">
                                            <ins class="color"><span>€290.00</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Vegetables</a></li>
                                            <li><a href="#">Vitamin</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_05.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_07.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Fresh Meal Kit</a></h3>
                                        <div class="product-price">
                                            <del class="silver"><span>€550.00</span></del>
                                            <ins class="color"><span>€170.00</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Fruits</a></li>
                                            <li><a href="#">Health</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane">
                        <div class="product-slider">
                            <div class="wrap-item" data-navigation="true" data-pagination="false" data-itemscustom="[[0,1],[560,2],[768,3],[990,4]]">
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_11.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_12.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Conconut Chips</a></h3>
                                        <div class="product-price">
                                            <ins class="color"><span>€30.000</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Fruits</a></li>
                                            <li><a href="#">Breads</a></li>
                                            <li><a href="#">Juices</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_13.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_14.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Apetito Pure Fruit Juice</a></h3>
                                        <div class="product-price">
                                            <del class="silver"><span>$550.00</span></del>
                                            <ins class="color"><span>€450.00</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Refresh</a></li>
                                            <li><a href="#">Health</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_15.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_16.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        <div class="product-label new-label">new</div>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Aurore Grape</a></h3>
                                        <div class="product-price">
                                            <ins class="color"><span>€290.00</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Vegetables</a></li>
                                            <li><a href="#">Vitamin</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_17.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_18.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Fresh Meal Kit</a></h3>
                                        <div class="product-price">
                                            <del class="silver"><span>€550.00</span></del>
                                            <ins class="color"><span>€170.00</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Fruits</a></li>
                                            <li><a href="#">Health</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_19.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_20.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Aurore Grape</a></h3>
                                        <div class="product-price">
                                            <ins class="color"><span>€290.00</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Vegetables</a></li>
                                            <li><a href="#">Vitamin</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-product border text-center">
                                    <div class="product-thumb">
                                        <a href="detail.html" class="product-thumb-link rotate-thumb">
                                            <img src="/themes/fruitshop/images/product/fruit_21.jpg" alt="">
                                            <img src="/themes/fruitshop/images/product/fruit_22.jpg" alt="">
                                        </a>
                                        <a href="quick-view.html" class="quickview-link fancybox fancybox.iframe"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><a href="detail.html">Fresh Meal Kit</a></h3>
                                        <div class="product-price">
                                            <del class="silver"><span>€550.00</span></del>
                                            <ins class="color"><span>€170.00</span></ins>
                                        </div>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <div class="product-extra-link">
                                            <a href="#" class="wishlist-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wishlist</span></a>
                                            <a href="#" class="addcart-link">Add to cart</a>
                                            <a href="#" class="compare-link"><i class="fa fa-compress" aria-hidden="true"></i><span>Compare</span></a>
                                        </div>
                                        <ul class="product-in-cat list-inline-block">
                                            <li><a href="#">Fruits</a></li>
                                            <li><a href="#">Health</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Featured -->
        </div>
        <div class="why-choise box-parallax">
            <div class="container">
                <div class="choise-title text-center wow zoomIn">
                    <h2 class="title30 paci-font color">Why Choose</h2>
                    <h2 class="title30 font-bold text-uppercase">Fruit Store</h2>
                </div>
                <div class="list-service2">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="item-service1 table wow fadeInRight">
                                <div class="service-icon">
                                    <a href="#"><i class="fa fa-bus"></i></a>
                                </div>
                                <div class="service-info">
                                    <h3 class="title18"><a href="#" class="">Free Shipping</a></h3>
                                    <p class="desc ">With €50 or more orders</p>
                                </div>
                            </div>
                            <div class="item-service1 table wow fadeInRight">
                                <div class="service-icon">
                                    <a href="#"><i class="fa fa-refresh"></i></a>
                                </div>
                                <div class="service-info">
                                    <h3 class="title18"><a href="#" class="">Free Refund</a></h3>
                                    <p class="desc ">100% Refund Within 3 days </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="item-service1 table wow fadeInRight">
                                <div class="service-icon">
                                    <a href="#"><i class="fa fa-thumbs-o-up"></i></a>
                                </div>
                                <div class="service-info">
                                    <h3 class="title18"><a href="#" class="">Lowest Price Guarantee</a></h3>
                                    <p class="desc ">Sales commitments at favorable prices</p>
                                </div>
                            </div>
                            <div class="item-service1 table wow fadeInRight">
                                <div class="service-icon">
                                    <a href="#"><i class="fa fa-volume-control-phone"></i></a>
                                </div>
                                <div class="service-info">
                                    <h3 class="title18"><a href="#" class="">Support 24.7</a></h3>
                                    <p class="desc ">Call us anytime you want</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fruit-top wow slideInLeft"><img src="/themes/fruitshop/images/home/home2/fruit-top.png" alt="" /></div>
            </div>
        </div>
        <div class="client-say2 text-center box-parallax">
            <div class="container">
                <h2 class="title30 paci-font color">What Client Say</h2>
                <h2 class="title30 text-uppercase font-bold ">Fruit Store</h2>
                <div class="client-slider2">
                    <div class="wrap-item" data-transition="fade" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1]]">
                        <div class="item-client2">
                            <div class="client-thumb">
                                <a href="#" tabindex="0"><img src="/themes/fruitshop/images/home/home1/av1.png" alt=""></a>
                            </div>
                            <div class="client-info">
                                <h3 class="title18"><a href="#" class="color">Fanbong Fam</a></h3>
                                <span class="">Our happy Customer</span>
                                <p class="desc ">“I love this store. I am always able to find fresh and clean produce for me and my family. Simply love it! Highly Recommended.”</p>
                            </div>
                        </div>
                        <div class="item-client2">
                            <div class="client-thumb">
                                <a href="#" tabindex="0"><img src="/themes/fruitshop/images/home/home1/av2.png" alt=""></a>
                            </div>
                            <div class="client-info">
                                <h3 class="title18"><a href="#" class="color">John Henry</a></h3>
                                <span class="">Our happy Customer</span>
                                <p class="desc ">“I am always able to find fresh and clean produce for me and my family. I love this store. Simply love it! Highly Recommended.”</p>
                            </div>
                        </div>
                        <div class="item-client2">
                            <div class="client-thumb">
                                <a href="#" tabindex="0"><img src="/themes/fruitshop/images/home/home1/av3.png" alt=""></a>
                            </div>
                            <div class="client-info">
                                <h3 class="title18"><a href="#" class="color">Gaston Melor</a></h3>
                                <span class="">Our happy Customer</span>
                                <p class="desc ">“I love this store. I am always able to find fresh and clean produce for me and my family. Simply love it! Highly Recommended.”</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Client -->
        <div class="container">
            <div class="from-blog2">
                <h2 class="color2 title30 text-center title-box2 wow zoomIn">FROM OUR BLOG</h2>
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="item-blog2 wow fadeInUp">
                            <div class="row">
                                <div class="col-md-12 col-sm-6 col-xs-6">
                                    <div class="banner-adv zoom-image overlay-image">
                                        <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/bl1.jpg" alt="" /></a>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6 col-xs-6">
                                    <div class="blog-info2 text-center info-center">
                                        <h2 class="title18"><a href="#" class="black">Food Allergy Survival</a></h2>
                                        <ul class="list-inline-block post-comment-date">
                                            <li><span class="color"><i class="fa fa-calendar-o"></i> August 6, 2017</span></li>
                                            <li><span class="color"><i class="fa fa-commenting-o"></i></span><a href="#" class="color">3</a></li>
                                        </ul>
                                        <p class="desc">Donec porta gravida arcu. Morbi facilisis lorem felis, eu inerdum quam scelerisque eu. Phasellus vel turpis dictum</p>
                                        <a href="#" class="shop-button">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="item-blog2 wow fadeInLeft">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="blog-info2 text-left info-left">
                                        <h2 class="title18"><a href="#" class="black">Tips for Ripening your Fruit</a></h2>
                                        <ul class="list-inline-block post-comment-date">
                                            <li><span class="color"><i class="fa fa-calendar-o"></i> August 6, 2017</span></li>
                                            <li><span class="color"><i class="fa fa-commenting-o"></i></span><a href="#" class="color">3</a></li>
                                        </ul>
                                        <p class="desc">Donec porta gravida arcu. Morbi facilisis lorem felis, eu inerdum quam scelerisque eu. Phasellus vel turpis dictum</p>
                                        <a href="#" class="shop-button">Read more</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="banner-adv zoom-image overlay-image">
                                        <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/bl2.jpg" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-blog2 wow fadeInRight">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="banner-adv zoom-image overlay-image">
                                        <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/bl3.jpg" alt="" /></a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="blog-info2 text-left info-right">
                                        <h2 class="title18"><a href="#" class="black">Change your eating habits with this organic food diet plan</a></h2>
                                        <ul class="list-inline-block post-comment-date">
                                            <li><span class="color"><i class="fa fa-calendar-o"></i> August 6, 2017</span></li>
                                            <li><span class="color"><i class="fa fa-commenting-o"></i></span><a href="#" class="color">3</a></li>
                                        </ul>
                                        <p class="desc">Donec porta gravida arcu. Morbi facilisis lorem felis, eu inerdum quam scelerisque eu. Phasellus vel turpis dictum</p>
                                        <a href="#" class="shop-button">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End From BLog -->
            <div class="banner-guide zoom-image overlay-image banner-adv">
                <a href="#" class="adv-thumb-link wow fadeIn"><img src="/themes/fruitshop/images/home/home2/banner.jpg" alt="" /></a>
                <div class="banner-info text-center">
                    <h2 class="title40  paci-font wow fadeInLeft">Your Guide to Vegetarian Eating</h2>
                    <ul class="list-inline-block">
                        <li><a href="#" class="shop-button wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.4s">Recipes</a></li>
                        <li><a href="#" class="shop-button wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.8s">Tips & Tricks</a></li>
                        <li><a href="#" class="shop-button wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="1.2s">Health Benefits</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Guide -->
        </div>
        <div class="fruit-farmer">
            <div class="container">
                <div class="farm-slider banner-slider">
                    <div class="wrap-item group-navi" data-transition="fade" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1]]">
                        <div class="item-farm item-slider">
                            <div class="farm-thumb banner-adv zoom-image fade-out-in animated" data-animated="bounceInLeft">
                                <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/farm1.jpg" alt="" /></a>
                            </div>
                            <div class="farm-info animated" data-animated="bounceInRight">
                                <h2 class="title18"><a href="#" class="black">Fanbong Fam</a></h2>
                                <div class="farm-cat">
                                    <a href="#" class="silver">Fruit & Refesh</a>
                                </div>
                                <p class="desc">Meet the maker of our bread – our fabulous baker boy alberto Trombin. He creates superb bread in their Melbourne-based bread-quarters.</p>
                                <div class="top-social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item-farm item-slider">
                            <div class="farm-thumb banner-adv zoom-image fade-out-in animated" data-animated="bounceInLeft">
                                <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/farm2.jpg" alt="" /></a>
                            </div>
                            <div class="farm-info animated" data-animated="bounceInRight">
                                <h2 class="title18"><a href="#" class="black">Fanbong Fam</a></h2>
                                <div class="farm-cat">
                                    <a href="#" class="silver">Fruit & Refesh</a>
                                </div>
                                <p class="desc">Meet the maker of our bread – our fabulous baker boy alberto Trombin. He creates superb bread in their Melbourne-based bread-quarters.</p>
                                <div class="top-social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item-farm item-slider">
                            <div class="farm-thumb banner-adv zoom-image fade-out-in animated" data-animated="bounceInLeft">
                                <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/farm3.jpg" alt="" /></a>
                            </div>
                            <div class="farm-info animated" data-animated="bounceInRight">
                                <h2 class="title18"><a href="#" class="black">Fanbong Fam</a></h2>
                                <div class="farm-cat">
                                    <a href="#" class="silver">Fruit & Refesh</a>
                                </div>
                                <p class="desc">Meet the maker of our bread – our fabulous baker boy alberto Trombin. He creates superb bread in their Melbourne-based bread-quarters.</p>
                                <div class="top-social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Farm -->
        <div class="container">
            <div class="vege-banner wow bounceIn">
                <a href="#" class="push"><img src="/themes/fruitshop/images/home/home2/vege-banner.png" alt="" /></a>
            </div>
            <!-- End vege banner -->
            <div class="photo-instagram">
                <h2 class="color2 title-box2 title30 text-center">#Photo in Instagram</h2>
                <ul class="list-inline-block text-center list-photo-in">
                    <li>
                        <div class="banner-adv zoom-image overlay-image">
                            <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/in1.png" alt="" /></a>
                        </div>
                    </li>
                    <li>
                        <div class="banner-adv zoom-image overlay-image">
                            <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/in2.png" alt="" /></a>
                        </div>
                    </li>
                    <li>
                        <div class="banner-adv zoom-image overlay-image">
                            <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/in3.png" alt="" /></a>
                        </div>
                    </li>
                    <li>
                        <div class="banner-adv zoom-image overlay-image">
                            <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/in4.png" alt="" /></a>
                        </div>
                    </li>
                    <li>
                        <div class="banner-adv zoom-image overlay-image">
                            <a href="#" class="adv-thumb-link"><img src="/themes/fruitshop/images/home/home2/in5.png" alt="" /></a>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- End Photo -->
        </div>
    </section>
    <!-- End Content -->
    <footer id="footer">
        <div class="footer2 box-parallax">
            <div class="container">
                <div class="main-footer2">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="footer-box2">
                                <h2 class="title18 font-bold color">关于我们</h2>
                                <p class="desc">西域恒臻</p>
                            </div>
                            <div class="footer-box2 payment-method">
                                <h2 class="title18 font-bold color">Online Payments by</h2>
                                <a href="#" class="wobble-top"><img src="/themes/fruitshop/images/icon/pay11.png" alt=""></a>
                                <a href="#" class="wobble-top"><img src="/themes/fruitshop/images/icon/pay21.png" alt=""></a>
                                <a href="#" class="wobble-top"><img src="/themes/fruitshop/images/icon/pay31.png" alt=""></a>
                                <a href="#" class="wobble-top"><img src="/themes/fruitshop/images/icon/pay41.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="footer-box2">
                                <h2 class="title18 font-bold color">联系我们</h2>
                                <div class="contact-footer2">
                                    <p class="desc "><span class="color"><i class="fa fa-map-marker" aria-hidden="true"></i></span>新疆维吾尔族自治区</p>
                                    <p class="desc "><span class="color"><i class="fa fa-phone" aria-hidden="true"></i></span>+86 185-9285-9286</p>
                                    <p class="desc "><span class="color"><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="#" class="">sales@putao.im</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="footer-box2">
                                <h2 class="title18 font-bold color">关注我们</h2>
                                <a href="#" class="float-shadow"><img src="/themes/fruitshop/images/icon/icon-fb.png" alt=""></a>
                                <a href="#" class="float-shadow"><img src="/themes/fruitshop/images/icon/icon-tw.png" alt=""></a>
                                <a href="#" class="float-shadow"><img src="/themes/fruitshop/images/icon/icon-pt.png" alt=""></a>
                                <a href="#" class="float-shadow"><img src="/themes/fruitshop/images/icon/icon-gp.png" alt=""></a>
                                <a href="#" class="float-shadow"><img src="/themes/fruitshop/images/icon/icon-ig.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main Footer -->
                <div class="logo-footer2 text-center">
                    <a href="#" class="pulse"><img src="/themes/fruitshop/images/home/home2/logo-footer.png" alt="" /></a>
                </div>
                <div class="bottom-footer2 text-center">
                    <ul class="menu-footer2 list-inline-block">
                        <li><a href="#" class="white">Home</a></li>
                        <li><a href="#" class="white">Help Center</a></li>
                        <li><a href="#" class="white">Terms & Conditions</a></li>
                        <li><a href="#" class="white">Privacy Policy</a></li>
                        <li><a href="#" class="white">Blog</a></li>
                        <li><a href="#" class="white">About Us</a></li>
                        <li><a href="#" class="white">Contact Us</a></li>
                    </ul>
                    <p class="copyright2 desc">西域甄果 © 2018 新疆吐鲁番西域恒臻商贸有限公司. All Rights Reserved.</p>
                    <p class="design2 desc">Design by <a href="#" class="color">Piu.IO</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <div class="wishlist-mask">
        <div class="wishlist-popup">
            <span class="popup-icon color"><i class="fa fa-bullhorn" aria-hidden="true"></i></span>
            <p class="wishlist-alert">"Fruit Product" was added to wishlist</p>
            <div class="wishlist-button">
                <a href="#">Continue Shopping (<span class="wishlist-countdown">10</span>)</a>
                <a href="#">Go To Shopping Cart</a>
            </div>
        </div>
    </div>
    <!-- End Wishlist Mask -->
    <a href="#" class="scroll-top round"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_four"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_one"></div>
            </div>
        </div>
    </div>
    <!-- End Preload -->
</div>
<script type="text/javascript" src="/themes/fruitshop/js/libs/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/bootstrap.min.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/jquery.fancybox.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/jquery-ui.min.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/owl.carousel.min.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/jquery.jcarousellite.min.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/slick.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/popup.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/timecircles.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/libs/wow.js"></script>
<script type="text/javascript" src="/themes/fruitshop/js/theme.js"></script>
</body>
</html>