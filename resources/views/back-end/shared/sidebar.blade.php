<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Tìm kiếm...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>

            <li>
                <a href="/admin/dashboard"><i class="fa fa-dashboard fa-fw"></i> Bảng điều khiển</a>
            </li>

            @if(Auth::check() && (Auth::user()->is('super.admin') || Auth::user()->is('super.mod')))
                <li @if(Request::is('admin/category') || Request::is('admin/category/*')) class="active" @endif>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Danh mục<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/admin/category" class="active">Danh sách danh mục</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li @if(Request::is('admin/product') || Request::is('admin/product/*')) class="active" @endif>
                    <a href="#"><i class="fa fa-cube fa-fw"></i> Sản phẩm<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/admin/product" class="active">Danh sách sản phẩm</a>
                        </li>
                        {{-- <li>
                            <a href="#">Add Product</a>
                        </li> --}}
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
           	@endif

           	@if(Auth::user()->is('super.admin'))
                <li @if(Request::is('admin/user')) class="active" @endif>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Người dùng<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/admin/user" class="active">Danh sách người dùng</a>
                        </li>
                        {{-- <li>
                            <a href="#">Add User</a>
                        </li> --}}
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            @endif
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>