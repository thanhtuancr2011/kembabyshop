@extends('back-end.admin.master')
@section('title')
    Chỉnh sửa danh mục
@endsection
@section('content')
    
<!-- Page Content -->
<div id="page-wrapper" data-ng-controller="ModalEditCategoryCtrl">
    <div class="container-fluid">
        <div class="innerAll">
            <div class="col-lg-12">
                <h3 class="page-header">Chỉnh sửa danh mục {{$category->name}}</h3>
            </div>
            <div class="innerLR">
                <form method="POST" accept-charset="UTF-8" name="formCategory" ng-init="categoryItem={{$category}}; categorySelected={{$categorySelected}}; filesUpload={{$filesUpload}}">
                    <input type="hidden" name="_token" value="csrf_token()" />
                    <div class="form-group" ng-class="{true: 'has-error'}[submitted && requiredCategoryParent]" ng-if="categoriesTree.length > 0">
                        <label for="last_name">Danh mục cha</label>
                        <div class="">
                            <select-level-category items="categoriesTree" text="Danh mục" title="Chọn danh mục" ng-model="categoryItem.parent_id" selected-item="categorySelected" current-category="categoryItem"></select-level-category>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[submitted && (formCategory.name.$invalid || nameExists)]">
                        <label for="last_name">Tên danh mục (*)</label>
                        <div class="">
                            <input class="form-control" placeholder="Tên danh mục" type="text" name="name" id="name" value="" 
                                   ng-model="categoryItem.name" 
                                   ng-minlength=1
                                   ng-maxlength=125
                                   ng-required="true">
                            <label class="control-label" ng-show="submitted && nameExists">@{{messageNameExists}}</label>
                            <label class="control-label" ng-show="submitted && formCategory.name.$invalid">Bạn chưa nhập tên danh mục</label>
                            <label class="control-label" ng-show="submitted && formCategory.name.$error.minlength">Tên danh mục phải có ít nhất 1 kí tự</label>
                            <label class="control-label" ng-show="submitted && formCategory.name.$error.maxlength">Tên danh mục tối đa 125 kí tự</label>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[submitted && formCategory.sort_order.$invalid]">
                        <label for="last_name">Vị trí </label>
                        <div class="">
                            <input class="form-control" ng-init="initSortNumber()" placeholder="Vị trí" type="text" name="sort_order" id="sort-order" ng-model="categoryItem.sort_order" ng-required="true">
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="last_name">Từ khóa </label>
                        <div class="">
                            <input class="form-control" placeholder="Từ khóa" type="text" name="keywords" id="keywords" 
                                   ng-model="categoryItem.keywords" 
                                   ng-maxlength=250 >
                            <label class="control-label" ng-show="submitted && formCategory.keywords.$error.max">Số kí tự tối đa là 250</label>
                        </div>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[submitted && requireFile]">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-none">
                            <file-upload ng-model="fileUploaded" multiple-file="true" file-type="'/png'" is-saved="isSavedData" files-upload="filesUpload" on-select="selectedFile(selected)" on-edit="editItem(edited)"></file-upload>
                            <label class="control-label" ng-show="submitted && requireFile">Bạn chưa chọn hình ảnh cho danh mục</label>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="last_name">Mô tả </label>
                        <div class="">
                            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Mô tả" 
                                      ng-model="categoryItem.description"
                                      ng-maxlength=500 >
                            </textarea>
                            <label class="control-label" ng-show="submitted && formCategory.keywords.$error.max">Số kí tự tối đa là 500</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="form-group center-block pull-right">
            <button class="btn btn-primary" ng-click="submit(formCategory.$invalid)">
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
        window.category = {!! json_encode($category) !!};
        window.categoriesTree = {!! json_encode($categoriesTree) !!};
        window.categorySelected = {!! json_encode($categorySelected) !!};
        window.linkUpload = '/category/file';
    </script>
    {!! Html::script('/app/components/back-end/categories/CategoryService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/back-end/categories/CategoryController.js?v='.getVersionScript())!!}
    {!! Html::script('/app/shared/select-category/SelectLevelCategory.js?v='.getVersionScript())!!}
    {!! Html::script('/app/shared/file-upload/fileUploadDirective.js?v='.getVersionScript())!!}
    {!! Html::script('/app/shared/file-upload/fileService.js?v='.getVersionScript())!!}
@endsection