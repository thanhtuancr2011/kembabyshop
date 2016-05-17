@extends('front-end.master')
@section('title')
    Danh mục
@endsection
@section('breadcrumb')
    Giỏ hàng
@endsection
@section('content')
	<div class="columns-container" data-ng-controller="CartController">
	    <div class="columns-container">
		    <div class="container" id="columns">
		        <!-- breadcrumb -->
		        <div class="breadcrumb clearfix">
		            <a class="home" href="/" title="Return to Home">Trang chủ</a>
		            <span class="navigation-pipe">&nbsp;</span>
		            <span ng-if="currentStep == 1" class="navigation_page">Giỏ hàng của bạn</span>
		            <span ng-if="currentStep == 2" class="navigation_page">Đăng nhập</span>
		            <span ng-if="currentStep == 3" class="navigation_page">Hoàn tất</span>
		        </div>
		        <!-- ./breadcrumb -->
		        <!-- page heading-->
		        <h2 class="page-heading no-line">
		            <span ng-if="currentStep == 1" class="page-heading-title2">Tóm tắt giỏ hàng</span>
		            <span ng-if="currentStep == 2" class="page-heading-title2">Đăng nhập để mua hàng</span>
		        </h2>
		        <!-- ../page heading-->
		        <div class="page-content page-order">
		            <ul class="step">
			        	<div class="col-xs-12 col-sm-3 logo">
		                    <a href="/"><img alt="Kembaby shop - Kembabyshop.com" src="http://kembabyshop.app/assets/images/logo1.png"></a>
		                </div>
		                <li ng-class="{'current-step': currentStep == 1}"><span>01. Tóm tắt</span></li>
		                <li ng-class="{'current-step': currentStep == 2}" ><span>02. Đăng nhập</span></li>
		                <li ng-class="{'current-step': currentStep == 3}"><span>03. Hoàn tất</span></li>
		            </ul>

		            <!-- Current step == 1 -->
		           	<div class="container" ng-if="currentStep == 1">
		           		<div class="heading-counter warning">Có tổng cộng <strong>@{{numberItem}}</strong> sản phẩm trong giỏ hàng của bạn
			            </div>
			            <div class="order-detail-content">
			                <table class="table table-bordered table-responsive cart_summary">
			                    <thead>
			                        <tr>
			                            <th class="cart_product" style="text-align: center;">Hình ảnh</th>
			                            <th style="text-align: center;">Tên</th>
			                            <th style="text-align: center;">Có sẵn</th>
			                            <th style="text-align: center;">Giá</th>
			                            <th style="text-align: center;">Số lượng</th>
			                            <th style="text-align: center;">Tổng tiền</th>
			                            <th style="text-align: center;" class="action"><i class="fa fa-trash-o"></i></th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        <tr ng-repeat="cart in carts">
			                            <td style="text-align: center;" class="cart_product">
			                                <a href="javascript:void(0)"><img ng-src="/images/products/@{{cart.options.imagesPath}}" alt="Product"></a>
			                            </td>
			                            <td style="text-align: center;" class="cart_description">
			                                <p class="product-name"><a href="javascript:void(0)">@{{cart.name}} </a></p>
			                            </td>
			                            <td style="text-align: center;" class="cart_avail"><span class="label label-success">In stock</span></td>
			                            <td style="text-align: center;" class="price"><span>@{{cart.price | currency:"":0}} đ</span></td>
			                            <td style="text-align: center;" class="qty">
			                                <input class="form-control input-sm" type="number" min="1" ng-model="cart.qty">
			                                <a href="javascript:void(0)"><i class="fa fa-caret-up" ng-click="cart.qty = cart.qty+1; updateCart(cart)"></i></a>
			                                <a ng-if="cart.qty > 1" href="javascript:void(0)"><i class="fa fa-caret-down" ng-click="cart.qty = cart.qty-1; updateCart(cart)"></i></a>
			                            </td>
			                            <td style="text-align: center;" class="price">
			                                <span>@{{cart.subtotal | currency:"":0}} đ</span>
			                            </td>
			                            <td style="text-align: center;" class="action">
			                                <a href="javascript:void(0)" ng-click="deleteCart(cart.rowid)">Delete item</a>
			                            </td>
			                        </tr>
			                    </tbody>
			                    <tfoot>
			                        <tr>
			                        	<td style="text-align: center;" colspan="2" rowspan="2"></td>
			                            <td colspan="3"><strong>Tổng tiền</strong></td>
			                            <td style="text-align: center;" colspan="2"><strong>@{{priceTotal | currency:"":0}} đ</strong></td>
			                        </tr>
			                    </tfoot>    
			                </table>
			                <div class="cart_navigation">
			                    <a class="prev-btn" href="/">Tiếp tục mua hàng</a>
			                    <a ng-if="priceTotal > 0" class="next-btn" href="javascript:void(0)" ng-click="continueCheckOut()">Tiếp tục thanh toán</a>
			                </div>
			            </div>
		           	</div>

		           	<!-- Current step == 2 -->
		           	<div class="container" ng-if="currentStep == 2">
		           		<div class="heading-counter warning">Đăng nhập hoặc đăng kí tài khoản để tiếp tục mua hàng
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
			                               	<label class="control-label" ng-show="submitted && emailExists">Email này đã tồn tại trong hệ thống.</label>
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
				                        <button class="button" style="background-color: #ff3366" ng-click="submit(formCustomer.$invalid)"><i class="fa fa-user"></i> Tạo tài khoản</button>
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
					                               ng-model="login.email" 
					                               ng-required="true">
			                               	<label class="control-label" ng-show="submitted1 && formLogin.email.$error.required">Bạn chưa nhập Email.</label>
			                               	<label class="control-label" ng-show="submitted1 && formLogin.email.$error.email">Địa chỉ email ko hợp lệ.</label>
			                               	<label class="control-label" ng-show="submitted1 && emailExists">Email này đã tồn tại trong hệ thống.</label>
					                    </div>
					                    <div class="form-group" ng-class="{true: 'has-error'}[submitted1 && formLogin.password.$invalid]">
					                        <label for="password_register">Mật khẩu</label>
					                        <input class="form-control" placeholder="Mật khẩu" type="password" name="password" id="password" value="" 
					                               ng-model="login.password" 
					                               ng-required="true">
					                        <label class="control-label" ng-show="submitted1 && formLogin.password.$error.required">Bạn chưa nhập Mật khẩu.</label>
					                    </div>
					                    <div ng-if="msg" class="alert alert-danger">
					                    	<a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					                    	@{{msg}}
					                    </div>
					                    <p class="forgot-pass"><a href="javascript:void(0)">Quên mật khẩu?</a></p>
				                        <button style="background-color: #ff3366" class="button" ng-click="login(formLogin.$invalid)"><i class="fa fa-key" aria-hidden="true"></i> Đăng nhập</button>
				                        <button ng-click="logFb()" class="button" style="background-color: #3b5998; padding: 9px; border: 0.5px solid #3b5998">
            								<a href="javascript:void(0)" class="fa fa-facebook" style="margin-top: 1px; color: #fff; "> Đăng nhập với facebook</a> 
          								</button>
			                        </form>
			                    </div>
			                </div>
			            </div>
		           	</div>
		           	<div class="container" ng-if="currentStep == 3">
		           		<p></p>
		           		<div class="row">
		           			<div class="box-authentication" style="padding-top: 50px; margin-top: 30px">
		           				<div class="wrapper-order-info mrg-t-30">
					                <table cellspacing="0" cellpadding="0" border="0">
					                    <tbody><tr>
					                        <td width="245" valign="top">
					                            <img id="imgIconOK" src="/assets/images/icon-OK1.png" >
					                        </td>
					                        <td class="o4Text">
					                            <span style="color: #444; font-weight: bold; font-size: 16px; line-height: 20px;">Cảm ơn @{{customerCreated.last_name}} @{{customerCreated.first_name}} đã cho chúng tôi có cơ hội được phục vụ. Đơn hàng của bạn đã được tạo thành công</span>

												<ul style="margin-top: 30px;">
					    							<li style="list-style-type: disc; margin-left: 18px; font-size: 14px">Thời gian giao hàng dự kiến trong vòng <b>12 - 24 tiếng</b> (nếu bạn ở nội thành TP. HCM) và <b>1-3 ngày</b> nếu bạn ở các tỉnh thành khác.</li>
					    							<li style="list-style-type: disc; margin: 10px 15px 18px; line-height: 20px;font-size: 14px">Thông tin đơn hàng được gửi tới email <b style="color: #000; font-size: 14px;">@{{customerCreated.email}}.</b> Bạn vui lòng kiểm tra lại thông tin, nếu bạn không tìm thấy trong email chính hãy mở thư mục <strong>Spam</strong> hoặc tìm kiếm <span style="color: #000;display: inline;font-size: 16px;font-weight: 700;">@kembabyshop.com.vn</span></li>
												</ul>

												<button style="background-color: #ff3366; color: #ffff" href="/" class="button" ng-click="redirectToHome()">Tiếp tục mua sắm </button>
					                        </td>
					                    </tr>
					                </tbody></table>
					            </div>
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
    	window.customer = {!! json_encode($customer) !!};
    </script>
    {!! Html::script('/app/components/front-end/customer/CustomerService.js?v='.getVersionScript())!!}
    {!! Html::script('/app/components/front-end/cart/CartController.js?v='.getVersionScript())!!}
@endsection