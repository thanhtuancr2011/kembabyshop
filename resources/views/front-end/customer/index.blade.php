@extends('front-end.master')
@section('title')
    Khách hàng
@endsection
@section('breadcrumb')
    Tài Khoản
@endsection
@section('content')
	<div class="columns-container" data-ng-controller="CustomerController">
	    <div class="container" id="columns">
	        <!-- breadcrumb -->
	        <div class="breadcrumb clearfix">
	            <a class="home" href="/" title="Return to Home">Trang chủ</a>
	            <span class="navigation-pipe">&nbsp;</span>
	            <!-- <span class="navigation_page">Giỏ hàng của bạn</span> -->
	            <span class="navigation_page">Tài khoản</span>
	            <!-- <span class="navigation_page">Hoàn tất</span> -->
	        </div>
	        <!-- ./breadcrumb -->
	        <div class="page-content page-order">
	           	<!-- Current step == 2 -->
	           	<div class="container" style="margin-top: -60px">
	           		<div class="heading-counter warning">Đăng nhập hoặc đăng kí để tiếp tục sử dụng các dịch vụ của Kembabyshop
		            </div>
	           		<div class="row">
		                <div class="col-sm-6">
		                    <div class="box-authentication">
		                        <h3>Đăng kí tài khoản</h3>
		                        <p></p>
		                        <form method="POST" accept-charset="UTF-8" name="formCustomer" novalidate="">
               						<input type="hidden" name="_token" value="csrf_token()" />

               						<div class="form-group" ng-class="{'has-error' : submitted && formCustomer.last_name.$invalid}">
				                        <label for="emmail_register">Họ (*)</label>
				                        <input class="form-control" placeholder="" type="text" name="last_name" id="last_name" value="" 
				                               ng-model="customer.last_name" 
				                               ng-required="true">
		                               	<label class="control-label" ng-show="submitted && formCustomer.last_name.$error.required">Bạn chưa nhập Họ.</label>
				                    </div>

				                    <div class="form-group" ng-class="{'has-error' : submitted && formCustomer.first_name.$invalid}">
				                        <label for="emmail_register">Tên (*)</label>
				                        <input class="form-control" placeholder="" type="text" name="first_name" id="first_name" value="" 
				                               ng-model="customer.first_name" 
				                               ng-required="true">
		                               	<label class="control-label" ng-show="submitted && formCustomer.first_name.$error.required">Bạn chưa nhập Tên.</label>
				                    </div>

		                        	<div class="form-group" ng-class="{'has-error' : submitted && (formCustomer.email.$invalid || emailExists)}">
				                        <label for="emmail_register">Email (*)</label>
				                        <input class="form-control" placeholder="" type="email" name="email" id="email" value="" 
				                               ng-model="customer.email" 
				                               ng-required="true">
		                               	<label class="control-label" ng-show="submitted && formCustomer.email.$error.required">Bạn chưa nhập Email.</label>
		                               	<label class="control-label" ng-show="submitted && formCustomer.email.$error.email">Địa chỉ email ko hợp lệ.</label>
				                    </div>

				                    <div class="form-group" ng-class="{'has-error' : submitted && formCustomer.address.$invalid}">
				                        <label for="emmail_register">Địa chỉ (*)</label>
				                        <input class="form-control" placeholder="" type="text" name="address" id="address" value="" 
				                               ng-model="customer.address" 
				                               ng-required="true">
		                               	<label class="control-label" ng-show="submitted && formCustomer.address.$error.required">Bạn chưa nhập địa chỉ.</label>
				                    </div>

				                    <div class="form-group" ng-class="{'has-error' : submitted && formCustomer.phone.$invalid}">
				                        <label for="emmail_register">Số điện thoại (*)</label>
				                        <input class="form-control" placeholder="" type="text" name="phone" id="phone" value="" 
				                               ng-model="customer.phone" 
				                               pattern="[0-9]{6,11}"
				                               ng-required="true">
		                               	<label class="control-label" ng-show="submitted && formCustomer.phone.$error.required">Bạn chưa nhập số điện thoại.</label>
		                               	<label class="control-label" ng-show="submitted && formCustomer.phone.$error.pattern">Số điện thoại không hợp lệ.</label>
				                    </div>

				                    <div class="form-group" ng-class="{true: 'has-error'}[submitted && formCustomer.password.$invalid]">
				                        <label for="password_register">Mật khẩu (*)</label>
				                        <input class="form-control" placeholder="" type="password" name="password" id="password" value="" 
				                               ng-model="customer.password" 
				                               ng-required="true">
				                        <label class="control-label" ng-show="submitted && formCustomer.password.$error.required">Bạn chưa nhập Mật khẩu.</label>
				                    </div>
				                    <div class="form-group" ng-class="{true: 'has-error'}[submitted && (formCustomer.rePassword.$invalid || customer.rePassword != customer.password)]">
				                        <label for="inputRePassword">Nhập lại mật khẩu (*)</label>
				                        <div class="">
				                            <input class="form-control" type="password" name="rePassword" id="rePassword" 
				                            	   ng-model="customer.rePassword"
				                            	   ng-required="true">
				                            <label class="control-label" ng-show="submitted && customer.rePassword != customer.password && !formCustomer.rePassword.$error.required" >
				                                Nhập lại mật khẩu chưa đúng
				                            </label>
				                            <label class="control-label" ng-show="submitted && formCustomer.rePassword.$error.required">Mời nhập lại Mật khẩu.</label>
				                        </div>
				                    </div>
			                        <button class="button" style="background-color: #ff3366" ng-click="submit(formCustomer.$invalid || customer.rePassword != customer.password)"><i class="fa fa-user"></i> Tạo tài khoản</button>
			                        <div style="margin-top: 50px;" ng-if="messageCreateSuccess" class="alert alert-success">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										@{{messageCreateSuccess}}
									</div>
									<div style="margin-top: 50px;" ng-if="emailExists" class="alert alert-warning">
  										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  										@{{emailExists}}
									</div>
		                        </form>
		                    </div>
		                </div>
		                <div class="col-sm-6">
		                    <div class="box-authentication">
		                        <h3>Đã có tài khoản?</h3>
		                        <form method="POST" accept-charset="UTF-8" name="formLogin" novalidate="">
               						<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		                        	<div class="form-group" ng-class="{'has-error' : submitted1 && (formLogin.email.$invalid || emailExists)}">
				                        <label for="emmail_register">Email</label>
				                        <input class="form-control" placeholder="Email" type="email" name="email" id="email" value="" 
				                               ng-model="customerLogin.email" 
				                               ng-required="true">
		                               	<label class="control-label" ng-show="submitted1 && formLogin.email.$error.required">Bạn chưa nhập Email.</label>
		                               	<label class="control-label" ng-show="submitted1 && formLogin.email.$error.email">Địa chỉ email ko hợp lệ.</label>
				                    </div>
				                    <div class="form-group" ng-class="{true: 'has-error'}[submitted1 && formLogin.password.$invalid]">
				                        <label for="password_register">Mật khẩu</label>
				                        <input class="form-control" placeholder="Mật khẩu" type="password" name="password" id="password" value="" 
				                               ng-model="customerLogin.password" 
				                               ng-required="true">
				                        <label class="control-label" ng-show="submitted1 && formLogin.password.$error.required">Bạn chưa nhập Mật khẩu.</label>
				                    </div>
				                    <div ng-if="msg" class="alert alert-danger">
				                    	<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                    	@{{msg}}
				                    </div>
				                    <div ng-if="msgSuccess" class="alert alert-success">
				                    	<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                    	@{{msgSuccess}}
				                    </div>
				                    <p class="forgot-pass"><a href="javascript:void(0)">Quên mật khẩu?</a></p>
			                        <button style="background-color: #ff3366" class="button" ng-click="login(formLogin.$invalid)"><i class="fa fa-key" aria-hidden="true"></i> Đăng nhập</button>
			                        <button class="btn-facebook" style="background-color: #3b5998; padding: 10px;">
        								<a ng-click="logFb()" href="javascript:void(0)" class="fa fa-facebook" style="margin-top: 2px; color: #fff; "> Đăng nhập với facebook</a> 
      								</button>
		                        </form>
		                    </div>
		                </div>
		            </div>
	           	</div>
	        </div>
	    </div>
	</div>
@endsection

@section('script')
    <script>
    </script>
    {!! Html::script('/app/components/front-end/customer/CustomerService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/front-end/customer/CustomerController.js?v='.getVersionScript())!!}
@endsection