<!-- Product -->
<div id="product" class="block-quickview">
    <div class="primary-box row" style="padding: 15px">
        <div class="pb-left-column col-xs-12 col-sm-6">
            <!-- product-imge-->
            <div class="product-image">
                <div class="product-full">
                    <img id="product-zoom" ng-src="/images/products/@{{product.images.folder}}/@{{product.images.stored_file_name}}" data-zoom-image="/images/products/@{{product.images.folder}}/@{{product.images.stored_file_name}}"/>
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
        <a title="Close" class="fancybox-item fancybox-close" href="javascript:void(0)" ng-click="closeModal()">
            <i class="fa fa-times"> </i>
        </a>
    </div>
</div>
<!-- Product -->
<script type="text/javascript">
    window.product = {!! json_encode($product) !!};
</script>