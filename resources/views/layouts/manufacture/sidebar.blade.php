<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#"> Trang chủ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}" href="{{route('screens.manufacture.dashboard.index')}}" aria-expanded="false"
                           data-target="#submenu-1" aria-controls="submenu-1"><i
                                class="fa fa-fw fas fa-home"></i>Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('products*')) ? 'active' : '' }}"
                           href="{{route('screens.manufacture.product.index')}}" data-toggle="collapse" aria-expanded="{{ (request()->is('products*')) ? 'true' : 'false' }}"
                           data-target="#submenu-2" aria-controls="submenu-2"><i
                                class="fab fa-product-hunt"></i>Quản lý sản phẩm
                        </a>
                        <div id="submenu-2" class="{{ (request()->is('products*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/index')) ? 'active1' : '' }}" id="product"
                                       href="{{route('screens.manufacture.product.index')}}">Tất cả sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/create')) ? 'active1' : '' }}" id="addSp"
                                       href="{{route('screens.manufacture.product.create')}}">Thêm sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/create-request')) ? 'active1' : '' }}" id="request"
                                       href="{{route('screens.manufacture.product.createRequest')}}">Yêu cầu xét duyệt
                                        sản phẩm</a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link {{ (request()->is('products/request-delete')) ? 'active1' : '' }}" id="request"--}}
{{--                                       href="{{route('screens.manufacture.product.requestDeleteProduct')}}">Yêu cầu hủy--}}
{{--                                        niêm yết sản phẩm</a>--}}
{{--                                </li>--}}
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/request')) ? 'active1' : '' }}" id="reAcp"
                                       href="{{route('screens.manufacture.product.request')}}">Quản lý yêu cầu xét
                                        duyệt</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/discount')) ? 'active1' : '' }}" id="discount"
                                       href="{{route('screens.manufacture.product.discount')}}">Quản lý giảm giá</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false"
                           data-target="#submenu-3" aria-controls="submenu-3"><i
                                class="fas fa-fw fas fa-warehouse"></i>Quản lý kho hàng</a>
                        <div id="submenu-3" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" id="proIn" href="#">Danh sách kho hàng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="proOut" href="#">Yêu cầu thêm sản phẩm vào kho</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="proDel" href="#">Quản lý xuất nhập sản phẩm</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                           data-target="#submenu-4" aria-controls="submenu-4"><i
                                class="fab fa-fw fas fa-users"></i>Liên kết V-Store</a>
                        <div id="submenu-4" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" id="listVstore" href="#">Danh sách V-Store liên kết</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                           data-target="#submenu-6" aria-controls="submenu-6"><i
                                class="fas fa-clipboard-list"></i>
                            Quản lý đơn hàng
                        </a>
                        <div id="submenu-6" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" id="keyP" href="#">Yêu cầu nhập sẵn sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="orderIn" href="#">Đơn hàng nhập sẵn</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="orBuy" href="#">Đơn hàng khách mua sản phẩm</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                           data-target="#submenu-6" aria-controls="submenu-6"><i
                                class="fas fa-fw fa-dollar-sign"></i>
                            Tài chính
                        </a>
                        <div id="submenu-6" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" id="finance" href="#">Ví</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="history" href="#">Lịch sử thay đổi số dư</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="listGetm" href="#">Quản lý yêu cầu rút tiền</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                           data-target="#submenu-7" aria-controls="submenu-7"><i
                                class="fa fa-fw fa-user-circle"></i>Tài khoản</a>
                        <div id="submenu-7" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" id="profile" href="./profile.html">Hồ sơ của tôi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="change-password" href="./change-password.html">Đổi
                                        mật khẩu</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link logout" aria-expanded="false" data-target="#submenu-8"
                           aria-controls="submenu-8" style="color:#FF4D4F"><i class="fas fa-fw fa-sign-out-alt"
                                                                              style="color:#FF4D4F"></i>Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
