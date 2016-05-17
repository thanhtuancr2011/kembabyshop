<div class="modal-header">
    <button aria-label="Close" data-dismiss="modal" class="close" type="button" ng-click="cancel()"><span aria-hidden="true">×</span></button>
    @if(!empty($item->id))
        <h4 class="modal-title">Chỉnh sửa người dùng {{$item->first_name}} {{$item->last_name}}</h4>
    @else
        <h4 class="modal-title">Thêm người dùng</h4>
    @endif
</div>

<div class="modal-body">
    <div class="innerAll">
        <div class="innerLR">
            <form method="POST" action="{{{ URL::to('users') }}}" accept-charset="UTF-8" name="formAddUser"  ng-init='userItem={{$item}}'>
                <input type="hidden" name="_token" value="csrf_token()" />
                <div class="form-group">

                    <div class="form-group" ng-class="{'has-error':formAddUser.last_name.$touched && formAddUser.last_name.$invalid}">
                        <label for="last_name">Họ (*)</label>
                        <div class="">
                            <input class="form-control" placeholder="Nhập họ" type="text" name="last_name" id="last_name" value="" ng-model="userItem.last_name" ng-required="true">
                            <label class="control-label" ng-show="formAddUser.last_name.$touched && formAddUser.last_name.$invalid">
                                Bạn chưa nhập họ
                            </label>
                        </div>
                    </div>

                    <div class="form-group" ng-class="{'has-error':formAddUser.first_name.$touched && formAddUser.first_name.$invalid}">
                        <label for="first_name">Tên (*)</label>
                            <input class="form-control" placeholder="Nhập tên" type="text" name="first_name" id="first_name" value="" ng-model="userItem.first_name" ng-required="true">
                            <label class="control-label" ng-show="formAddUser.first_name.$touched && formAddUser.first_name.$invalid">
                                Bạn chưa nhập tên
                            </label>
                    </div>

                    <div class="form-group" ng-class="{'has-error':formAddUser.email.$touched && formAddUser.email.$invalid}">
                        <label for="inputEmail3">Email (*)</label>
                        <div class="">
                            <input ng-pattern="/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/" class="form-control" placeholder="Email" type="text" name="email" id="email" ng-model="userItem.email" ng-required="true">
                            <label class="control-label" ng-show="formAddUser.email.$touched && formAddUser.email.$error.pattern">
                                Sai định dạng email
                            </label>
                            <label class="control-label" ng-show="formAddUser.email.$touched && formAddUser.email.$error.required">
                                Bạn chưa nhập email
                            </label>
                        </div>
                    </div>

                    <!-- If create user -->
                    <div ng-if="!userItem.id" class="form-group" ng-class="{'has-error':formAddUser.password.$touched && formAddUser.password.$invalid}">
                        <label for="inputPassword">Mật khẩu (*)</label>
                        <div class="">
                            <input class="form-control" placeholder="Mật khẩu" type="password" name="password" id="password" ng-model="userItem.password" ng-required="true">
                            <label class="control-label" ng-show="formAddUser.password.$touched && formAddUser.password.$invalid" >
                                Bạn chưa nhập mật khẩu
                            </label>
                        </div>
                    </div>

                    <div ng-if="!userItem.id" class="form-group" ng-class="{'has-error':formAddUser.rePassword.$touched && (formAddUser.rePassword.$invalid || userItem.rePassword != userItem.password)}">
                        <label for="inputRePassword">Nhập lại mật khẩu (*)</label>
                        <div class="">
                            <input class="form-control" placeholder="Nhập lại mật khẩu" type="password" name="rePassword" id="rePassword" ng-model="userItem.rePassword" ng-required="true">
                            <label class="control-label" ng-show="formAddUser.rePassword.$touched && formAddUser.rePassword.$error.required" >
                                Mời nhập lại mật khẩu
                            </label>
                            <label class="control-label" ng-show="formAddUser.rePassword.$touched && userItem.rePassword != userItem.password && !formAddUser.rePassword.$error.required" >
                                Nhập lại mật khẩu chưa đúng
                            </label>
                        </div>
                    </div>

                    <!-- If edit user -->
                    <div ng-if="userItem.id" class="form-group" ng-class="{'has-error':formAddUser.password.$touched && formAddUser.password.$invalid}">
                        <label for="inputPassword">Mật khẩu (*)</label>
                        <div class="">
                            <input class="form-control" placeholder="Mật khẩu" type="password" name="password" id="password" ng-model="userItem.password">
                            <label class="control-label" ng-show="formAddUser.password.$touched && formAddUser.password.$invalid" >
                                Bạn chưa nhập mật khẩu
                            </label>
                        </div>
                    </div>

                    <div ng-if="userItem.id" class="form-group" ng-class="{'has-error':formAddUser.rePassword.$touched && (formAddUser.rePassword.$invalid || userItem.rePassword != userItem.password)}">
                        <label for="inputRePassword">Nhập lại mật khẩu (*)</label>
                        <div class="">
                            <input class="form-control" placeholder="Nhập lại mật khẩu" type="password" name="rePassword" id="rePassword" ng-model="userItem.rePassword">
                            <label class="control-label" ng-show="formAddUser.rePassword.$touched && userItem.rePassword != userItem.password && !formAddUser.rePassword.$error.required" >
                                Nhập lại mật khẩu chưa đúng
                            </label>
                        </div>
                    </div>

                    <div class="alert alert-error alert-danger" ng-show="errors">
                        @{{errors}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
    <div class="form-group center-block">
        <button ng-disabled="formAddUser.$invalid || userItem.rePassword != userItem.password" class="btn btn-primary" ng-click="submit()">
        <i class="fa fa-plus"></i>
        <span>
            @if(!empty($item->id))
                Sửa
            @else
                Thêm
            @endif
        </span>
        </button>
        <button class="btn btn-primary" ng-click="cancel()"><i class="fa fa-times"></i> Hủy</button>
    </div>
</div>
