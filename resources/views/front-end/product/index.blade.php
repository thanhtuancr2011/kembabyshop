@extends('front-end.master')
@section('title')
	Sản phẩm
@endsection
@section('breadcrumb')
	Sản phẩm
@endsection
@section('content')
	<div class="columns-container" data-ng-controller="ProductController">
	    <div class="container" id="columns">
	        <!-- row -->
	        <div class="row">
	            <!-- Left colunm -->
	            <div class="column col-xs-12 col-sm-3" id="left_column">
	                <!-- block best sellers -->
	                <div class="block left-module">
	                    <p class="title_block">Đang giảm giá</p>
	                    <div class="block_content product-onsale">
	                        <ul class="product-list owl-carousel" data-loop="true" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true">
	                            <li ng-repeat="saleProduct in saleProducts">
	                                <div class="product-container">
	                                    <div class="left-block">
	                                        <a href="javascript:void(0)">
	                                            <img class="img-responsive" alt="product" ng-src="/images/products/@{{saleProduct.images.folder}}/@{{saleProduct.images.stored_file_name}}" />
	                                        </a>
	                                        <div ng-if="saleProduct.old_price > saleProduct.price" class="price-percent-reduction2">
	                                        	@{{100 - (saleProduct.price/saleProduct.old_price)*100 | number:1}}% OFF
	                                        </div>
	                                    </div>
	                                    <div class="right-block">
	                                        <h4 class="product-name"><a href="javascript:void(0)">@{{saleProduct.name}}</a></h4>
	                                        <div class="content_price">
	                                        	<span class="price product-price">@{{saleProduct.price | currency:"":0}} ₫</span>
	                                    		<span ng-if="saleProduct.old_price" class="old-price old-price">@{{saleProduct.old_price | currency:"":0}} ₫</span>
	                                        </div>
	                                    </div>
	                                    <div class="product-bottom">
	                                        <a class="btn-add-cart" title="Thêm vào giỏ" href="javascript:void(0)" ng-click="addProductToCart(saleProduct.id)">Thêm vào giỏ</a>
	                                    </div>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	            <!-- ./left colunm -->
	            <!-- Center colunm-->
	            <div class="center_column col-xs-12 col-sm-9" id="center_column">
	                <!-- Product -->
	                    <div id="product">
	                        <div class="primary-box row">
	                            <div class="pb-left-column col-xs-12 col-sm-6">
	                                <!-- product-imge-->
	                                <div class="product-image">
						                <div class="product-full">
						                    <img id="product-zoom" ng-src="/images/products/@{{product.images[0].folder}}/@{{product.images[0].stored_file_name}}" data-zoom-image="/images/products/@{{product.images[0].folder}}/@{{product.images[0].stored_file_name}}"/>
						                </div>
						                <div class="product-img-thumb" id="gallery_01">
						                    <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false" data-margin="20" data-loop="true">
						                        <li ng-repeat="image in product.images">
						                            <a href="javascript:void(0)" data-image="/images/products/@{{image.folder}}/@{{image.stored_file_name}}" data-zoom-image="/images/products/@{{image.folder}}/@{{image.stored_file_name}}">
						                                <img id="product-zoom" ng-src="/images/products/@{{image.folder}}/@{{image.stored_file_name}}" /> 
						                            </a>
						                        </li>
						                    </ul>
						                </div>
						            </div>
	                                <!-- End product-imge-->
	                            </div>
	                            <div class="pb-right-column col-xs-12 col-sm-6">
	                                <h1 class="product-name">@{{product.name}}</h1>
		                            <div class="product-comments">
		                                <div class="product-star">
		                                    <i class="fa fa-star"></i>
		                                    <i class="fa fa-star"></i>
		                                    <i class="fa fa-star"></i>
		                                    <i class="fa fa-star"></i>
		                                    <i class="fa fa-star-half-o"></i>
		                                </div>
		                                <div class="comments-advices">
		                                    <a href="javascript:void(0)">Dựa trên 3 đánh giá</a>
		                                    <a href="javascript:void(0)"><i class="fa fa-pencil"></i> Viết bình luận</a>
		                                </div>
		                            </div>
	                                <div class="product-price-group">
	                                    <span class="price">@{{product.price | currency:"":0}} ₫</span>
		                                <span ng-if="product.old_price" class="old-price">
		                                    @{{product.old_price | currency:"":0}} ₫
		                                </span>
		                                <span ng-if="product.old_price >= product.price" class="discount">
		                                    - @{{100 - (product.price/product.old_price)*100 | number:1}}% OFF
		                                </span>
	                                </div>
	                                <div class="info-orther">
	                                    <p>Có sẵn: <span class="in-stock">Trong kho</span></p>
	                                    <p>Tình trạng: Còn mới</p>
	                                </div>
	                                <div class="product-desc">
		                                @{{product.meta_description}} 
		                            </div>
	                                <div class="form-action">
	                                    <div class="button-group">
	                                        <a class="btn-add-cart" href="javascript:void(0)" ng-click="addProductToCart(product.id)">Thêm vào giỏ</a>
	                                    </div>
	                                    <div class="button-group">
	                                        <a class="wishlist" href="javascript:void(0)"><i class="fa fa-heart-o"></i>
	                                        <br>Wishlist</a>
	                                        <a class="compare" href="javascript:void(0)"><i class="fa fa-signal"></i>
	                                        <br>        
	                                        Compare</a>
	                                    </div>
	                                </div>
	                                <div class="form-share">
	                                    <div class="sendtofriend-print">
	                                        <a href="javascript:print();"><i class="fa fa-print"></i> Print</a>
	                                        <a href="javascript:void(0)"><i class="fa fa-envelope-o fa-fw"></i>Send to a friend</a>
	                                    </div>
	                                    <div class="network-share">
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- tab product -->
	                        <div class="product-tab">
	                            <ul class="nav-tab">
	                                <li class="active">
	                                    <a aria-expanded="false" data-toggle="tab" href="#product-detail">Chi tiết sản phẩm</a>
	                                </li>
	                                <li>
	                                    <a aria-expanded="true" data-toggle="tab" href="#information">Thông tin sản phẩm</a>
	                                </li>                                
	                            </ul>
	                            <div class="tab-container">
	                                <div id="product-detail" class="tab-panel active" ng-bind-html="product.description">
	                                </div>
	                                <div id="information" class="tab-panel">
	                                    <table class="table table-bordered">
	                                        <tr>
	                                            <td>Xuất sứ</td>
	                                            <td>@{{product.origin}}</td>
	                                        </tr>
	                                        <tr>
	                                            <td>Nhà sản xuất</td>
	                                            <td>@{{product.manufacturer}}</td>
	                                        </tr>
	                                        <tr>
	                                            <td>Size</td>
	                                            <td>@{{product.size}}</td>
	                                        </tr>
	                                        <tr>
	                                            <td>Kích thước</td>
	                                            <td>@{{product.dimension}}</td>
	                                        </tr>
	                                        <tr>
	                                            <td>Trọng lượng</td>
	                                            <td>@{{product.weight}}</td>
	                                        </tr>
	                                    </table>
	                                </div>
	                                <div id="comment" class="tab-panel">
	                                </div>
	                            </div>
	                        </div>
	                        <div class="comment-fb">
	                        	<div id="fb-root" class="form-control"></div>
								<script>(function(d, s, id) {
								  	var js, fjs = d.getElementsByTagName(s)[0];
								  	if (d.getElementById(id)) return;
								  	js = d.createElement(s); js.id = id;
								  	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=716374128444280";
								  	fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
								<div class="fb-comments" data-width="870" data-href="http://kembabyshop.app/product-detail/@{{product.id}}" data-numposts="5"></div>
	                        </div>
	                        <!-- ./tab product -->
	                        <!-- box product -->
	                        <div class="page-product-box">
	                            <h3 class="heading">Sản phẩm liên quan</h3>
	                            <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
	                                <li ng-repeat="productRelate in listProductMapCategoryId[product.category_id]">
	                                    <div class="product-container">
	                                        <div class="left-block">
	                                            <a href="/product-detail/@{{productRelate.id}}">
	                                                <img class="img-responsive" alt="product" ng-src="/images/products/@{{productRelate.images.folder}}/@{{productRelate.images.stored_file_name}}" /></a>
	                                            </a>
	                                            <div class="quick-view">
	                                                    <a title="Add to my wishlist" class="heart" href="javascript:void(0)"></a>
	                                                    <a title="Add to compare" class="compare" href="javascript:void(0)"></a>
	                                                    <a title="Quick view" class="search" href="javascript:void(0)"></a>
	                                            </div>
	                                            <div class="add-to-cart">
	                                                <a title="Thêm vào giỏ" href="javascript:void(0)" ng-click="addProductToCart(productRelate.id)">Thêm vào giỏ</a>
	                                            </div>
	                                        </div>
	                                        <div class="right-block">
	                                            <h4 class="product-name"><a href="/product-detail/@{{productRelate.id}}">@{{productRelate.name}}</a></h4>
	                                            <div class="content_price">
	                                            	<span class="price product-price">@{{productRelate.price | currency:"":0}} ₫</span>
                                        			<span ng-if="productRelate.old_price" class="price old-price">@{{productRelate.old_price | currency:"":0}} ₫</span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </li>
	                            </ul>
	                        </div>
	                        <!-- ./box product -->
	                    </div>
	                <!-- Product -->
	            </div>
	            <!-- ./ Center colunm -->
	        </div>
	        <!-- ./row-->
	    </div>
	</div>
	
@endsection


@section('script')
    <script>
        window.product = {!! json_encode($product) !!};
        window.saleProducts = {!! json_encode($saleProducts) !!};
        window.listProductMapCategoryId = {!! json_encode($listProductMapCategoryId) !!};
    </script>
    {!! Html::script('/app/components/front-end/product/ProductService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/front-end/product/ProductController.js?v='.getVersionScript())!!}
@endsection