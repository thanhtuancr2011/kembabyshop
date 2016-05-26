@extends('back-end.admin.master')
@section('title')
    Hóa đơn
@endsection
<style type="text/css">
	td {
		text-align: center
	}
</style>
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper" data-ng-controller="OrderController">
        <div class="container-fluid hidden">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Danh sách Hóa Đơn</h3>
                </div>
                <table class="table fix-height-tb table-striped" ng-table="tableParams" show-filter="isSearch">
                    <a class="fixed-search" href="javascript:void(0)" ng-click="isSearch = !isSearch">
                        <i class="fa fa-search"></i>
                    </a>
                    <tbody>
                        <tr ng-repeat="order in $data">
                            <td data-title="'Mã đơn hàng'" filter="{ 'order_id': 'text' }" sortable="'order_id'">
                                @{{order.id}}
                            </td>
                            <td data-title="'Số lượng'" sortable="'quantity'">
                                <span >@{{order.quantity}}</span>
                            </td>
                            <td data-title="'Tổng tiền'" filter="{ 'amount': 'text' }" sortable="'amount'">
                                @{{order.amount | currency:"":0}} ₫
                            </td>
                            <td data-title="'Trạng thái'" filter="{ 'status': 'text' }" sortable="'status'">
                                @{{(order.status) ? 'Đã gửi mail' : 'Chưa gửi mail'}}
                            </td>
                            <td data-title="'Tên sản phẩm'">
                                @{{order.name}}
                            </td>
                            <td data-title="'Tên khách hàng'">
                                @{{order.last_name}} @{{order.first_name}}
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
        window.listOrders = {!! json_encode($listOrders) !!};
    </script>
    {!! Html::script('/app/components/back-end/orders/OrderService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/back-end/orders/OrderController.js?v='.getVersionScript())!!}
@endsection