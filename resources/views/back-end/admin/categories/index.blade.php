@extends('back-end.admin.master')
@section('title')
    Danh mục
@endsection
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper" data-ng-controller="CategoryController">
        <div class="container-fluid hidden">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Danh sách danh mục</h3>
                    <h3 class="c-m">
                        <a data-toggle="modal" href="javascript:void(0)" ng-click="createCategory()" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Thêm danh mục
                        </a>
                    </h3>
                </div>
                <table class="table fix-height-tb table-striped" ng-table="tableParams" show-filter="isSearch">
                    <a class="fixed-search" href="javascript:void(0)" ng-click="isSearch = !isSearch">
                        <i class="fa fa-search"></i>
                    </a>
                    <tbody>
                        <tr  ng-repeat="category in $data">
                            <td class="text-center" data-title="'STT'">
                                @{{$index + 1}}
                            </td>
                            <td class="text-center" data-title="'Tên'" filter="{ 'name': 'text' }" sortable="'name'">
                                @{{category.name}}
                            </td>
                            <td class="text-center" data-title="'Danh mục cha'" sortable="'parent_id'">
                                <span ng-if="listCategories[category.parent_id] == null">None</span>
                                <span ng-if="listCategories[category.parent_id] != null">@{{listCategories[category.parent_id]}}</span>
                            </td>
                            <td class="text-center" data-title="'Vị trí'" filter="{ 'sort_order': 'text' }" sortable="'sort_order'">
                                <span ng-if="category.sort_order == null">None</span>
                                <span ng-if="category.sort_order != null">@{{category.sort_order}}</span>
                            </td>
                            <td class="text-center" data-title="'Từ khóa'" filter="{ 'keywords': 'text' }" sortable="'keywords'">
                                @{{category.keywords}}
                            </td>
                            <td class="text-center" data-title="''">
                                <a href="javascript:void(0)" ng-click="editCategory(category.id)" class="action-icon">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a ng-if="category.parent_id != '0'" href="javascript:void(0)" ng-click="removeCategory(category.id, 'sm')" class="action-icon">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection

@section('script')
    <script>
        window.categories = {!! json_encode($categories) !!};
        window.listsMapCategories = {!! json_encode($listsMapCategories) !!};
        window.linkUpload = '/category/file';
    </script>
    {!! Html::script('/app/components/back-end/categories/CategoryService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/back-end/categories/CategoryController.js?v='.getVersionScript())!!}
@endsection