@extends('back-end.admin.master')
@section('title')
    User
@endsection
@section('content')
    <div id="page-wrapper" data-ng-controller="UserControler">
        <div class="container-fluid hidden">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Danh sách người dùng</h3>
                    <h3 class="c-m">
                        <a data-toggle="modal" href="javascript:void(0)" ng-click="getModalUser()" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> Thêm người dùng
                        </a>
                    </h3>
                </div>
                <table class="table table-hover fix-height-tb table-striped" ng-table="tableParams" show-filter="isSearch">
                    <a class="fixed-search" href="javascript:void(0)" ng-click="isSearch = !isSearch">
                        <i class="fa fa-search"></i>
                    </a>
                    <tbody>
                        <tr ng-repeat="user in $data">
                            <td data-title="'Họ Tên'" filter="{ 'name': 'text' }" sortable="'name'" >
                                <img class="img-circle" ng-src="@{{user.avatar}}" alt="" height="40">
                                @{{user.name}}
                            </td>
                            <td class="text-center" data-title="'Email'" filter="{ 'email': 'text' }" sortable="'email'">
                                @{{user.email}}
                            </td>
                            <td class="text-center" data-title="''">
                                <a ng-click="getModalUser(user.id)" class="action-icon">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>
                                <a ng-click="removeUser(user.id, 'sm')" class="action-icon">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        window.users = {!! json_encode($users) !!}
    </script>
    {!! Html::script('/app/components/back-end/users/UserService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/back-end/users/UserController.js?v='.getVersionScript())!!}
@endsection