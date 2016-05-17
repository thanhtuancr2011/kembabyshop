@extends('back-end.admin.master')
@section('title')
    Chỉnh sửa sản phẩm
@endsection
@section('content')
    
    <!-- Page Content -->
    <div id="page-wrapper" data-ng-controller="ModalEditProductCtrl">
        <div class="container-fluid hidden">
            <div class="modal-body">
                <div class="innerAll">
                    <div class="col-lg-12">
                        <h3 class="page-header">Chi tiết sản phẩm {{$product->name}}</h3>
                    </div>
                    <div class="innerLR">
                        <form method="POST" accept-charset="UTF-8" name="formProduct" ng-init="productItem={{$product}};categorySelected={{$categorySelected}}; filesUpload={{$filesUpload}}">
                            <input type="hidden" name="_token" value="csrf_token()" />
                            <div class="form-group" ng-class="{true: 'has-error'}[submitted && requiredCategory]" ng-if="categoriesTree.length > 0">
                                <label for="last_name">Danh mục sản phẩm</label>
                                <div class="">
                                    <select-level-category items="categoriesTree" text="Danh mục" title="Chọn danh mục" ng-model="productItem.category_id" selected-item="categorySelected" on-click="chooseCategory(productItem.category_id)"></select-level-category>
                                    <label class="control-label" ng-show="submitted && requiredCategory">Bạn chưa chọn danh mục cho sản phẩm</label>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{true: 'has-error'}[submitted && (formProduct.name.$invalid || nameExists)]">
                                <label for="last_name">Tên sản phẩm (*)</label>
                                <div class="">
                                    <input class="form-control" placeholder="Tên sản phẩm" type="text" name="name" id="name" value="" 
                                           ng-model="productItem.name" 
                                           ng-minlength=1
                                           ng-maxlength=125
                                           ng-required="true">
                                    <label class="control-label" ng-show="submitted && nameExists">@{{messageNameExists}}</label>
                                    <label class="control-label" ng-show="submitted && formProduct.name.$error.required">Bạn chưa nhập tên sản phẩm</label>
                                    <label class="control-label" ng-show="submitted && formProduct.name.$error.maxlength">Tên sản phẩm tối đa 125 kí tự</label>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{true: 'has-error'}[submitted && formProduct.price.$invalid]">
                                <label for="last_name">Giá (*)</label>
                                <div class="">
                                    <input class="form-control" placeholder="Giá" type="text" ng-init="initCurrency('price')" name="price" id="price" 
                                           string-to-number
                                           ng-model="productItem.price" 
                                           ng-required="true">
                                    <label class="control-label" ng-show="submitted && formProduct.price.$error.required">Bạn chưa nhập giá sản phẩm</label>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{true: 'has-error'}[submitted && formProduct.old_price.$invalid]">
                                <label for="last_name">Giá cũ </label>
                                <div class="">
                                    <input class="form-control" placeholder="Giá cũ" type="text" ng-init="initCurrency('old_price')" name="old_price" id="old_price" ng-model="productItem.old_price">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="last_name">Từ khóa </label>
                                <div class="">
                                    <input class="form-control" placeholder="Từ khóa" type="text" name="keywords" id="keywords" 
                                           ng-model="productItem.keywords"
                                           ng-required >
                                    <label class="control-label" ng-show="submitted && formProduct.keywords.$error.max">Số kí tự tối đa là 250</label>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{true: 'has-error'}[submitted && formProduct.meta_description.$invalid]">
                                <label for="comment">Mô tả khái quát (*)</label>
                                <div class="">
                                    <textarea class="form-control" rows="5" name="meta_description" id="meta-description" ng-model="productItem.meta_description" ng-required="true"></textarea>
                                    <label class="control-label" ng-show="submitted && formProduct.meta_description.$error.required">Bạn chưa nhập mô tả khái quát cho sản phẩm</label>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{true: 'has-error'}[submitted && requiredDescription]">
                                <label for="last_name">Mô tả (*)</label>
                                <div class="">
                                    <textarea class="form-control" rows="5" id="description" name="description" placeholder="Mô tả" 
                                              ng-model="productItem.description">
                                    </textarea>
                                    <label class="control-label" ng-show="submitted && requiredDescription">Bạn chưa nhập mô tả cho sản phẩm</label>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{true: 'has-error'}[submitted && formProduct.origin.$invalid]">
                                <label for="last_name">Xuất sứ (*)</label>
                                <div class="">
                                    <input class="form-control" placeholder="Xuất sứ" type="text" name="origin" id="origin" 
                                           ng-model="productItem.origin"
                                           ng-required="true">
                                    <label class="control-label" ng-show="submitted && formProduct.origin.$error.required">Bạn chưa nhập xuất sứ cho sản phẩm</label>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="last_name">Nhà sản xuất</label>
                                <div class="">
                                    <input class="form-control" placeholder="Nhà sản xuất" type="text" name="manufacturer" id="manufacturer" ng-model="productItem.manufacturer">
                                </div>
                            </div>
                            <div class="form-group" ng-class="{true: 'has-error'}[submitted && formProduct.availibility.$invalid]">
                                <label for="last_name">Có sẵn trong kho </label>
                                <div class="">
                                    <input class="form-control" ng-init="initNumberAvailibility()" placeholder="Số lượng" type="text" name="availibility" id="availibility" ng-model="productItem.availibility">
                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="last_name">Size</label>
                                <div class="">
                                    <input class="form-control" placeholder="Size" type="text" name="size" id="size" ng-model="productItem.size">
                                </div>
                            </div><div class="form-group" >
                                <label for="last_name">Kích thước</label>
                                <div class="">
                                    <input class="form-control" placeholder="Kích thước" type="text" name="dimension" id="dimension" ng-model="productItem.dimension">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Trọng lượng (gam) </label>
                                <div class="">
                                    <input class="form-control" ng-init="initNumberWeight()" placeholder="Trọng lượng" type="text" name="weight" id="weight" ng-model="productItem.weight">
                                </div>
                            </div>
                            <div class="form-group" ng-class="{true: 'has-error'}[submitted && requireFile]">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-none">
                                    <file-upload ng-model="fileUploaded" multiple-file="true" file-type="'/jpg'" files-upload="filesUpload" is-saved="isSavedData" on-select="selectedFile(selected)" on-edit="editItem(edited)"></file-upload>
                                    <label class="control-label" ng-show="submitted && requireFile">Bạn chưa chọn hình ảnh cho sản phẩm</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div style="padding-top: 30px" class="form-group center-block pull-right">
                <button class="btn btn-primary" ng-click="submit(productItem.$invalid)">
                <i class="fa fa-plus"></i>
                <span>Sửa</span>
                </button>
                <button class="btn btn-primary" ng-click="cancel()"><i class="fa fa-times"></i> Hủy</button>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        window.product = {!! json_encode($product) !!};
        window.categoriesTree = {!! json_encode($categoriesTree) !!};
        window.categorySelected = {!! json_encode($categorySelected) !!};
        window.linkUpload = '/product/file';
    </script>
    {!! Html::script('/bower_components/ckeditor/ckeditor.js?v='.getVersionScript())!!}
    {!! Html::script('/bower_components/ckeditor/adapters/jquery.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/back-end/products/ProductService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/back-end/products/ProductController.js?v='.getVersionScript())!!}
    {!! Html::script('/app/shared/select-category/SelectLevelCategory.js?v='.getVersionScript())!!}
    {!! Html::script('/app/shared/file-upload/fileUploadDirective.js?v='.getVersionScript())!!}
    {!! Html::script('/app/shared/file-upload/fileService.js?v='.getVersionScript())!!}
@endsection