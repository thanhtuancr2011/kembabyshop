@extends('front-end.master')
@section('title')
    Tìm kiếm
@endsection
@section('breadcrumb')
    Tìm kiếm
@endsection
@section('content')
<div class="columns-container" data-ng-controller="ProductController">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Return to Home">Trang chủ</a>
            <span class="navigation-pipe">&nbsp;</span>
            <span class="navigation_page">@{{category.name}}</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block filter -->
                <div class="block left-module">
                    <p class="title_block">Lọc tìm kiếm</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-filter-price">
                            <!-- filter price -->
                            <div class="layered_subtitle">Giá</div>
                            <div class="layered-content slider-range">
                                
                                <div data-label-reasult="Khoảng:" data-min="0" data-max="10000000" data-unit="₫" class="slider-range-price" data-value-min="0" data-value-max="10000000"></div>
                                <div class="amount-range-price">Khoảng: 0 ₫ - 10,000,000 ₫</div>
                                
                            </div>
                            <!-- ./filter price -->
                            <!-- filter color -->
                            <div class="layered_subtitle">Color</div>
                            <div class="layered-content filter-color">
                                <ul class="check-box-list">
                                    <li>
                                        <input type="checkbox" id="color1" name="cc" />
                                        <label style=" background:#aab2bd;" for="color1"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color2" name="cc" />
                                        <label style=" background:#cfc4a6;" for="color2"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color3" name="cc" />
                                        <label style=" background:#aab2bd;" for="color3"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color4" name="cc" />
                                        <label style=" background:#fccacd;" for="color4"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color5" name="cc" />
                                        <label style="background:#964b00;" for="color5"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color6" name="cc" />
                                        <label style=" background:#faebd7;" for="color6"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color7" name="cc" />
                                        <label style=" background:#e84c3d;" for="color7"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color8" name="cc" />
                                        <label style=" background:#c19a6b;" for="color8"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color9" name="cc" />
                                        <label style=" background:#f39c11;" for="color9"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color10" name="cc" />
                                        <label style=" background:#5d9cec;" for="color10"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color11" name="cc" />
                                        <label style=" background:#a0d468;" for="color11"><span class="button"></span></label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="color12" name="cc" />
                                        <label style=" background:#f1c40f;" for="color12"><span class="button"></span></label>   
                                    </li>

                                </ul>
                            </div>
                            <!-- ./filter color -->
                            <!-- ./filter size -->
                            <div class="layered_subtitle">Size</div>
                            <div class="layered-content filter-size">
                                <ul class="check-box-list">
                                    <li>
                                        <input type="checkbox" id="size1" name="cc" />
                                        <label for="size1">
                                        <span class="button"></span>X
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size2" name="cc" />
                                        <label for="size2">
                                        <span class="button"></span>XXL
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size3" name="cc" />
                                        <label for="size3">
                                        <span class="button"></span>XL
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size4" name="cc" />
                                        <label for="size4">
                                        <span class="button"></span>XXL
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size5" name="cc" />
                                        <label for="size5">
                                        <span class="button"></span>M
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size6" name="cc" />
                                        <label for="size6">
                                        <span class="button"></span>XXS
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size7" name="cc" />
                                        <label for="size7">
                                        <span class="button"></span>S
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size8" name="cc" />
                                        <label for="size8">
                                        <span class="button"></span>XS
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size9" name="cc" />
                                        <label for="size9">
                                        <span class="button"></span>34
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size10" name="cc" />
                                        <label for="size10">
                                        <span class="button"></span>36
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size11" name="cc" />
                                        <label for="size11">
                                        <span class="button"></span>35
                                        </label>   
                                    </li>
                                    <li>
                                        <input type="checkbox" id="size12" name="cc" />
                                        <label for="size12">
                                        <span class="button"></span>37
                                        </label>   
                                    </li>
                                </ul>
                            </div>
                            <!-- ./filter size -->
                        </div>
                        <!-- ./layered -->

                    </div>
                </div>
                <!-- ./block filter  -->
                
                <!-- left silide -->
                <div class="col-left-slide left-module" style="border: 1px solid #eaeaea">
                    <ul style="padding: 10px" class="owl-carousel owl-style2" data-loop="true" data-nav = "false" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true">
                        <li><a href="javascript:void(0)"><img src="/assets/data/slide-left.jpg" alt="slide-left"></a></li>
                        <li><a href="javascript:void(0)"><img src="/assets/data/slide-left2.jpg" alt="slide-left"></a></li>
                        <li><a href="javascript:void(0)"><img src="/assets/data/slide-left3.png" alt="slide-left"></a></li>
                    </ul>
                </div>
                <!--./left silde-->
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- view-product-list-->
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title">Sản phẩm </span>
                    </h2>
                    <ul class="display-product-option">
                        <li class="view-as-grid selected">
                            <span>Xem dạng lưới</span>
                        </li>
                        <li class="view-as-list">
                            <span>Xem dạng danh sách</span>
                        </li>
                    </ul>
                    <!-- PRODUCT LIST -->
                    <ul class="row product-list grid">
                        <li class="col-sx-12 col-sm-4" ng-repeat="product in products">
                            <div class="product-container">
                                <div class="left-block">
                                    <a href="/product-detail/@{{product.id}}">
                                        <img class="img-responsive" alt="product" ng-src="/images/products/@{{product.images.folder}}/@{{product.images.stored_file_name}}" /></a>
                                    </a>
                                    <div class="quick-view">
                                            <a title="Add to my wishlist" class="heart" href="javascript:void(0)"></a>
                                            <a title="Add to compare" class="compare" href="javascript:void(0)"></a>
                                            <a title="Xem nhanh" class="search" href="javascript:void(0)" ng-click="quickViewProduct(product.id)"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="javascript:void(0)" title="Thêm vào giỏ hàng" ng-click="addProductToCart(product.id)">Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h4 class="product-name"><a href="/product-detail/@{{product.id}}">@{{product.name}}</a></h4>
                                    <div class="content_price">
                                        <span class="price product-price">@{{product.price | currency:"":0}} ₫</span>
                                        <span ng-if="product.old_price" class="price old-price">@{{product.old_price | currency:"":0}} ₫</span>
                                    </div>
                                    <div class="info-orther">
                                        <p class="availability">Sẵn có: <span>In stock</span></p>
                                        <p class="availability">Xuất sứ: <span>@{{product.origin}}</span></p>
                                    </div>
                                </div>
                                @if (session('products'))
                                    <div class="alert alert-success">
                                        123
                                    </div>
                                @endif
                            </div>
                        </li>
                    </ul>
                    <!-- ./PRODUCT LIST -->
                </div>
                <!-- ./view-product-list-->
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        window.products = {!! json_encode($products) !!};
    </script>
    {!! Html::script('/app/components/front-end/product/ProductService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/front-end/product/ProductController.js?v='.getVersionScript())!!}
@endsection