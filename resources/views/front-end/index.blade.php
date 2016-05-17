@extends('front-end.master')
@section('title')
    Trang chủ
@endsection
@section('breadcrumb')
    Trang chủ
@endsection
@section('content')

<div class="content hidden" data-ng-controller="HomeController">
    <!-- <img src="{{ URL::to('assets/images/loading.gif') }}"> -->
    <!-- Home slideder-->
    <div id="home-slider">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 slider-left"></div>
                <div class="col-sm-9 header-top-right">
                    <div class="homeslider">
                        <div class="content-slide">
                            <ul id="contenhomeslider">
                              <li><img alt="Funky roots" src="{{ URL::to('assets/images-slider/image_1.jpg') }}" title="Funky roots" /></li>
                              <li><img alt="Funky roots" src="{{ URL::to('assets/images-slider/image_2.jpg') }}" title="Funky roots" /></li>
                              <li><img  alt="Funky roots" src="{{ URL::to('assets/images-slider/image_3.jpg') }}" title="Funky roots" /></li>
                            </ul>
                        </div>
                    </div>
                    <div class="header-banner banner-opacity">
                        <a href="javascript:void(0)"><img alt="Funky roots" src="{{ URL::to('assets/images-slider/ads.jpg') }}" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Home slideder-->
    <!-- servives -->
    <div class="container" >
        <div class="service ">
            <div class="col-xs-6 col-sm-3 service-item">
                <div class="icon">
                    <img alt="services" src="{{ URL::to('assets/images-service/plan.png') }}" />
                </div>
                <div class="info">
                    <a href=""><h3>Free Shipping</h3></a>
                    <span>Nội thị thành phố HCM</span>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 service-item">
                <div class="icon">
                    <img alt="services" src="{{ URL::to('assets/images-service/clock.png') }}" />
                </div>
                <div class="info">
                    <a href=""><h3>Đổi trả</h3></a>
                    <span>Đảm bảo hoàn tiền</span>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 service-item">
                <div class="icon">
                    <img alt="services" src="{{ URL::to('assets/images-service/support.png') }}" />
                </div>
                
                <div class="info" >
                    <a href=""><h3>Hỗ trợ 24/7</h3></a>
                    <span>Tư vấn trực tuyến</span>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 service-item">
                <div class="icon">
                    <img alt="services" src="{{ URL::to('assets/images-service/safe.png') }}" />
                </div>
                <div class="info">
                    <a href=""><h3>Mua sắm an toàn</h3></a>
                    <span>Đảm bảo. uy tín, tin cậy</span>
                </div>
            </div>
        </div>
    </div>
    <!-- end services -->

    <div class="page-top" data-ng-controller="ProductController">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-9 page-top-left">
                    <div class="popular-tabs">
                          <ul class="nav-tab">
                            <!-- <li><a data-toggle="tab" href="#tab-1">Bán chạy nhất</a></li> -->
                            <li class="active"><a data-toggle="tab" href="#tab-2">Đang giảm giá</a></li>
                            <li><a data-toggle="tab" href="#tab-3">Sản phẩm mới</a></li>
                          </ul>
                          <div class="tab-container">
                                <div id="tab-2" class="tab-panel active">
                                    <ul class="product-list owl-carousel"  data-dots="false" data-loop="true" data-nav = "true" data-margin = "30"  data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                                        <li ng-repeat="saleProduct in saleProducts">
                                            <div class="left-block">
                                                <a href="/product-detail/@{{saleProduct.id}}">
                                                <img class="img-responsive" alt="product" ng-src="/images/products/@{{saleProduct.images.folder}}/@{{saleProduct.images.stored_file_name}}" /></a>
                                                <div class="quick-view">
                                                    <!-- <a title="Thêm vào danh sách yêu thích" class="heart" href="javascript:void(0)"></a>
                                                    <a title="Thêm vào so sánh" class="compare" href="javascript:void(0)"></a> -->
                                                    <a title="Xem nhanh" class="search" href="javascript:void(0)" ng-click="quickViewProduct(saleProduct.id)"></a>
                                                </div>
                                                <div class="add-to-cart">
                                                    <a href="javascript:void(0)" title="Thêm vào giỏ hàng" ng-click="addProductToCart(saleProduct.id)">Thêm vào giỏ hàng</a>
                                                </div>
                                                <div class="group-price">
                                                    <span class="product-sale">sale</span>
                                                </div>
                                            </div>
                                            <div class="right-block">
                                                <h5 class="product-name"><a href="/product-detail/@{{saleProduct.id}}">@{{saleProduct.name}}</a></h5>
                                                <div class="content_price">
                                                    <span class="price product-price">@{{saleProduct.price | currency:"":0}} ₫</span>
                                                    <span ng-if="saleProduct.old_price" class="price old-price">@{{saleProduct.old_price | currency:"":0}} ₫</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div id="tab-3" class="tab-panel">
                                    <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
                                        <li ng-repeat="newProduct in newProducts">
                                            <div class="left-block">
                                                <a href="/product-detail/@{{newProduct.id}}">
                                                    <img class="img-responsive" alt="product" ng-src="/images/products/@{{newProduct.images.folder}}/@{{newProduct.images.stored_file_name}}" /></a>
                                                <div class="quick-view">
                                                        <!-- <a title="Add to my wishlist" class="heart" href="javascript:void(0)"></a>
                                                        <a title="Add to compare" class="compare" href="javascript:void(0)"></a> -->
                                                        <a title="Quick view" class="search" href="javascript:void(0)"></a>
                                                </div>
                                                <div class="add-to-cart">
                                                    <a title="Thêm vào giỏ hàng" ng-click="addProductToCart(newProduct.id)">Thêm vào giỏ hàng</a>
                                                </div>
                                                <div class="group-price">
                                                    <span class="product-new">new</span>
                                                </div>
                                            </div>
                                            <div class="right-block">
                                                <h5 class="product-name"><a href="/product-detail/@{{newProduct.id}}">@{{newProduct.name}}</a></h5>
                                                <div class="content_price">
                                                    <span class="price product-price">@{{newProduct.price | currency:"":0}} ₫</span>
                                                    <span ng-if="newProduct.old_price" class="price old-price">@{{newProduct.old_price | currency:"":0}} ₫</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                          </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 page-top-right">
                    <div class="latest-deals">
                        <h2 class="latest-deal-title">Mới nhất</h2>
                        <div class="latest-deal-content">
                            <ul class="product-list" data-dots="false" data-loop="true" data-nav = "true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":1}}'>
                                <li>
                                    <div class="count-down-time" data-countdown="2016/06/20"></div>
                                    <div class="left-block">
                                        <a href="javascript:void(0)"><img class="img-responsive" alt="product" src="{{ URL::to('assets/data/ld1.jpg') }}" /></a>
                                        <div class="quick-view">
                                            <!-- <a title="Add to my wishlist" class="heart" href="javascript:void(0)"></a>
                                            <a title="Add to compare" class="compare" href="javascript:void(0)"></a> -->
                                            <a title="Quick view" class="search" href="javascript:void(0)"></a>
                                        </div>
                                        <div class="add-to-cart">
                                            <a title="Thêm vào giỏ hàng" href="javascript:void(0)">Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <h5 class="product-name"><a href="javascript:void(0)">Maecenas consequat mauris</a></h5>
                                        <div class="content_price">
                                            <span class="price product-price">$38,95</span>
                                            <span class="price old-price">$52,00</span>
                                            <span class="colreduce-percentage">(-10%)</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-page" data-ng-controller="ProductController">
        <div class="container">

            <!-- featured category fashion -->
            <div class="category-featured" ng-repeat="(key, value) in categories">
                <nav class="navbar nav-menu nav-menu-red show-brand">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-brand"><a href="/category-detail/@{{value.id}}"><img alt="fashion" width="32" ng-src="/images/categories/@{{value.imageMenuSrc}}" />@{{value.name}}</a></div>
                        <span class="toggle-menu"></span>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse">           
                            <ul class="nav navbar-nav">
                                <li class="active"><a data-toggle="tab" href="#tab-4">Sản Phẩm</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-fluid -->
                    <div id="elevator-@{{key}}" class="floor-elevator">
                        <a ng-if="$first" href="javascript:void(0)" class="btn-elevator up disabled fa fa-angle-up"></a>
                        <a ng-if="!$first" href="#elevator-@{{key - 1}}" class="btn-elevator up fa fa-angle-up"></a>
                        <a ng-if="!$last" href="#elevator-@{{key + 1}}" class="btn-elevator down fa fa-angle-down"></a>
                        <a ng-if="$last" href="javascript:void(0)" class="btn-elevator down disabled fa fa-angle-down"></a>
                    </div>

                </nav>

                <!--<div class="category-banner">
                    <div class="col-sm-6 banner">
                        <a href="javascript:void(0)"><img alt="ads2" class="img-responsive" src="{{ URL::to('assets/data/ads2.jpg') }}" /></a>
                    </div>
                    <div class="col-sm-6 banner">
                        <a href="javascript:void(0)"><img alt="ads2" class="img-responsive" src="{{ URL::to('assets/data/ads3.jpg') }}" /></a>
                    </div>
                </div> -->
                <div class="product-featured clearfix">
                     <div class="banner-featured">
                        <div class="featured-text"><span>featured</span></div>
                        <div class="banner-img">
                            <a ng-if="value.imageFeatureSrc" href="javascript:void(0)"><img alt="Featurered 1" ng-src="/images/categories/@{{value.imageFeatureSrc}}" /></a>
                            <a ng-if="!value.imageFeatureSrc" href="javascript:void(0)"><img alt="Featurered 1" src="{{ URL::to('assets/data/f1.jpg') }}" /></a>
                        </div>
                    </div>
                    <div class="product-featured-content">
                        <div class="product-featured-list">
                            <div class="tab-container">
                                <!-- tab product -->
                                <div class="tab-panel active" id="tab-4">
                                    <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                        <li ng-repeat="product in listProductMapCategoryId[value.id]">
                                            <div class="left-block">
                                                <a href="/product-detail/@{{product.id}}">
                                                    <img class="img-responsive" alt="product" ng-src="/images/products/@{{product.images.folder}}/@{{product.images.stored_file_name}}" />
                                                </a>
                                                <div class="quick-view">
                                                    <!-- <a title="Thêm vào danh sách yêu thích" class="heart" href="javascript:void(0)"></a>
                                                    <a title="Thêm vào so sánh" class="compare" href="javascript:void(0)"></a> -->
                                                    <a title="Xem nhanh" class="search" href="javascript:void(0)" ng-click="quickViewProduct(product.id)"></a>
                                                </div>
                                                <div class="add-to-cart">
                                                    <a title="Thêm vào giỏ hàng" href="javascript:void(0)" ng-click="addProductToCart(product.id)">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                            <div class="right-block">
                                                <h5 class="product-name"><a href="/product-detail/@{{product.id}}">@{{product.name}}</a></h5>
                                                <div class="content_price">
                                                    <span class="price product-price">@{{product.price | currency:"":0}} ₫</span>
                                                    <span ng-if="product.old_price" class="price old-price">@{{product.old_price | currency:"":0}} ₫</span>
                                                </div>
                                                <!-- <div class="product-star">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div> -->
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- tab product -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end featured category fashion -->

            <!-- Baner bottom -->
            <div class="row banner-bottom">
                <div class="col-sm-6">
                    <div class="banner-boder-zoom">
                        <a href="javascript:void(0)"><img alt="ads" class="img-responsive" src="{{ URL::to('assets/data/ads-bottom-1.jpg') }}" /></a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="banner-boder-zoom">
                        <a href="javascript:void(0)"><img alt="ads" class="img-responsive" src="{{ URL::to('assets/data/ads-bottom-2.jpg') }}" /></a>
                    </div>
                </div>
            </div>
            <!-- end banner bottom -->
        </div>
    </div>

</div>

@endsection

@section('script')
    <script>
        window.newProducts = {!! json_encode($newProducts) !!};
        window.saleProducts = {!! json_encode($saleProducts) !!};
        window.listProductMapCategoryId = {!! json_encode($listProductMapCategoryId) !!};
    </script>
    {!! Html::script('/app/components/front-end/home/HomeService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/front-end/home/HomeController.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/front-end/product/ProductService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/front-end/product/ProductController.js?v='.getVersionScript())!!}
@endsection

