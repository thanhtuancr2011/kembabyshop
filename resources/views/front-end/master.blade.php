<!DOCTYPE html>
<html lang="en" data-ng-app="shop-front-end">
    <head>
    	<title>
    		@yield('title') | KEMBABY-SHOP
    	</title>
        @include('front-end.shared.head')
    </head>
    <body class="home hidden" data-ng-controller="MasterController">
        <!-- HEADER -->
        <div id="header" class="header">
            <div class="top-header">
                <div class="container">
                    <div class="nav-top-links">
                        <a class="first-item" href="javascript:void(0)"><img alt="phone" src="{{ URL::to('assets/images/phone.png') }}" />0983-572-636</a>
                        <a href="javascript:void(0)"><img alt="email" src="{{ URL::to('assets/images/email.png') }}" />Lên hệ ngay</a>
                    </div>
                    <div class="language ">
                        <div class="dropdown">
                            <a >
                            	<img alt="email" src="{{ URL::to('assets/images/vi.jpg') }}" />Việt Nam
                            </a>
                        </div>
                    </div>
                    
                    <div class="support-link">
                        <a href="javascript:void(0)">Dịch Vụ</a>
                        <a href="javascript:void(0)">Hỗ Trợ</a>
                    </div>

                    <div id="user-info-top" class="user-info pull-right">
                        <div class="dropdown">
                            <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="javascript:void(0)">
                                <span>
                                    @if(!\Auth::user())
                                        Tài Khoản
                                    @else
                                        {{\Auth::user()->last_name . ' ' . \Auth::user()->first_name}}
                                    @endif
                                </span>
                            </a>
                            
                            <ul class="dropdown-menu mega_dropdown" role="menu">
                                <li><a href="/shopping-cart">Giỏ hàng</a></li>
                                @if(!\Auth::user())
                                    <li><a href="/customer">Tài khoản</a></li>
                                @else
                                    <li><a href="/customer/logout">Đăng xuất</a></li>
                                @endif
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.top-header -->
            <!-- MAIN HEADER -->
            <div class="container main-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 logo">
                        <a href="/"><img alt="Kembaby shop - Kembabyshop.com" src="{{ URL::to('assets/images/logo1.png') }}" /></a>
                    </div>
                    <div class="col-xs-7 col-sm-7 header-search-box">
                        <form class="form-inline">
                            <div class="form-group form-category">
                                <select class="select-category" ng-model="search.categoryId">
                                    <option value="">Tìm kiếm</option>
                                    <option ng-repeat="category in categories" value="@{{category.id}}">@{{category.name}}</option>
                                </select>
                            </div>
                            <div class="form-group input-serach">
                                <input type="text" ng-model="search.productName" placeholder="Nhập từ khóa...">
                            </div>
                            <a href="/product/search/@{{search.productName || ' '}}" class="pull-right btn-search"></a>
                        </form>
                    </div>
                    <div id="cart-block" class="col-xs-5 col-sm-2 shopping-cart-box">
                        <a class="cart-link" href="/shopping-cart">
                            <span class="title">Giỏ hàng</span>
                            <span class="total">Tổng: @{{priceTotal | currency:"":0}} ₫</span>
                            <span class="notify notify-left">@{{numberItem}} sp</span>
                        </a>
                        <div class="cart-block">
                            <div class="cart-block-content">
                                <h5 class="cart-title">@{{numberItem}} sản phẩm trong giỏ hàng</h5>
                                <div class="cart-block-list">
                                    <ul>
                                        <li class="product-info" ng-repeat="cart in carts">
                                            <div class="p-left">
                                                <a href="javascript:void(0)" ng-click="deleteCart(cart.rowid)" class="remove_link"></a>
                                                <a href="javascript:void(0)">
                                                <img class="img-responsive" ng-src="/images/products/@{{cart.options.imagesPath}}" alt="p10">
                                                </a>
                                            </div>
                                            <div class="p-right">
                                                <p class="p-name">@{{cart.name}}</p>
                                                <p class="p-rice">@{{cart.price | currency:"":0}} ₫</p>
                                                <p>Số Lượng: @{{cart.qty}}</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="toal-cart">
                                    <span>Tổng cộng</span>
                                    <span class="toal-price pull-right">@{{priceTotal | currency:"":0}} ₫</span>
                                </div>
                                <div class="cart-buttons">
                                    <a ng-if="numberItem > 0" href="/shopping-cart" class="btn-check-out">Đến giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>
            <!-- END MANIN HEADER -->
            <div id="nav-top-menu" class="nav-top-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3" id="box-vertical-megamenus">
                            <div class="box-vertical-megamenus">
                                <h4 class="title">
                                    <span class="title-menu">Danh mục</span>
                                    <span class="btn-open-mobile pull-right home-page"><i class="fa fa-bars"></i></span>
                                </h4>
                            <div class="vertical-menu-content is-home">
                                <ul class="vertical-menu-list" ng-repeat="category in categories">
                                    <li>
                                        <a href="/category-detail/@{{category.id}}">
                                            <img style="max-height: 45px; max-width: 45px;" class="icon-menu" alt="Funky roots" ng-src="/images/categories/@{{category.imageMenuSrc}}">@{{category.name}}
                                        </a>
                                    </li>

                                </ul>
                                <div class="all-category"><span class="open-cate">Tất cả danh mục</span></div>
                            </div>
                        </div>
                        </div>
                        <div id="main-menu" class="col-sm-9 main-menu">
                            <nav class="navbar navbar-default">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <a class="navbar-brand" href="javascript:void(0)">MENU</a>
                                    </div>
                                    <div id="navbar" class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav">
                                            <li class="active"><a href="javascript:void(0)">@yield('breadcrumb')</a></li>
                                        </ul>
                                    </div><!--/.nav-collapse -->
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- userinfo on top-->
                    <div id="form-search-opntop">
                    </div>
                    <!-- userinfo on top-->
                    <div id="user-info-opntop">
                    </div>
                    <!-- CART ICON ON MMENU -->
                    <div id="shopping-cart-box-ontop">
                        <i class="fa fa-shopping-cart"></i>
                        <div class="shopping-cart-box-ontop-content"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header -->

        <!-- Content -->
    	@yield('content')
        <!-- end Content -->
        
        <!-- Footer -->
        <footer id="footer" style="padding-bottom: 25px; border-top: 1px solid #f0f0f0">
             <div class="container">
                    <!-- introduce-box -->
                    <div id="introduce-box" class="row">
                        <div class="col-md-3">
                            <div id="address-box">
                                <a href="javascript:void(0)"><img src="{{ URL::to('assets/images/logo1.png') }}" alt="" /></a>
                                <div id="address-list">
                                    <div class="tit-contain">Chuyên phân phối sỉ và lẻ các mặt hàng sơ sinh, em bé.</div>
                                    <div class="tit-name">Phone:</div>
                                    <div class="tit-contain">0983-572-636</div>
                                    <div class="tit-name">Email:</div>
                                    <div class="tit-contain">kembabyshop@gmail.com</div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="introduce-title">Kembabyshop</div>
                                    <ul id="introduce-company"  class="introduce-list">
                                        <li><a href="javascript:void(0)">Về chúng tôi</a></li>
                                        <li><a href="javascript:void(0)">Bản đồ</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <div class="introduce-title">Tài khoản của tôi</div>
                                    <ul id = "introduce-Account" class="introduce-list">
                                        <li><a href="javascript:void(0)">Giỏ hàng</a></li>
                                        <li><a href="javascript:void(0)">Danh sách yêu thích</a></li>
                                        <li><a href="javascript:void(0)">Danh sách so sánh</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <div class="introduce-title">Trợ giúp</div>
                                    <ul id = "introduce-support"  class="introduce-list">
                                        <li><a href="javascript:void(0)">Hình thức thanh toán</a></li>
                                        <li><a href="javascript:void(0)">Cước phí vận chuyển</a></li>
                                        <li><a href="javascript:void(0)">Bảo hành, đổi hàng</a></li>
                                        <li><a href="javascript:void(0)">Hướng dẫn mua hàng</a></li>
                                        <li><a href="javascript:void(0)">Liên hệ</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div id="contact-box">
                                <div class="introduce-title">Đăng kí nhận tin khuyến mãi</div>
                                <div class="input-group" id="mail-box">
                                  <input type="text" placeholder="Địa chỉ email"/>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">OK</button>
                                  </span>
                                </div><!-- /input-group -->
                                <div class="introduce-title">Trang xã hội</div>
                                <div class="social-link">
                                    <a href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                    <a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
                                </div>
                            </div>
                            
                        </div>
                    </div><!-- /#introduce-box -->
                </div> 
        </footer>

        <a href="javascript:void(0)" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
    </body>
    <!-- Script-->
    @include('front-end.shared.script')
</html>