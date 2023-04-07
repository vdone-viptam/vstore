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
                        <a class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}"
                           href="{{route('screens.storage.dashboard.index')}}" aria-expanded="false"
                           data-target="#submenu-1" aria-controls="submenu-1"><i
                                class="fa fa-fw fas fa-home"></i>Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('products*')) ? 'active' : '' }}" href="#"
                           data-toggle="collapse" aria-expanded="false"
                           data-target="#submenu-2" aria-controls="submenu-2"><i
                                class="fa fa-fw fas fa-truck"></i>Hàng hóa
                        </a>
                        <div id="submenu-2"
                             class="{{ (request()->is('products*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/index')) ? 'active1' : '' }}" id=""
                                       href="{{route('screens.storage.product.index')}}">Tất cả
                                        sản
                                        phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/request')) ? 'active1' : '' }}"
                                       id="requests"
                                       href="{{route('screens.storage.product.request')}}">Quản lý yêu
                                        cầu nhập kho</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/requestOut')) ? 'active1' : '' }}"
                                       id="requestOut"
                                       href="{{route('screens.storage.product.requestOut')}}">Xác nhận
                                        đơn hàng</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('warehouses*')) ? 'active' : '' }}" href="#"
                           data-toggle="collapse" aria-expanded="false"
                           data-target="#submenu-3" aria-controls="submenu-3"><i
                                class="fas fa-fw fas fa-warehouse"></i>Quản lý kho</a>
                        <div id="submenu-3"
                             class="{{ (request()->is('warehouses*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('warehouses/import')) ? 'active1' : '' }}"
                                       href="{{route('screens.storage.warehouse.import')}}">Nhập
                                        hàng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('warehouses/export')) ? 'active1' : '' }}"
                                       href="{{route('screens.storage.warehouse.export')}}">Xuất
                                        hàng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('warehouses/export-destroy')) ? 'active1' : '' }}"
                                       href="{{route('screens.storage.warehouse.exportDestroyProduct')}}">Xuất hủy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('warehouses/order-destroy')) ? 'active1' : '' }}"
                                       href="{{route('screens.storage.warehouse.destroyOrder')}}">Đơn
                                        hàng hủy</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('partners*')) ? 'active' : '' }}" href="#"
                           data-toggle="collapse" aria-expanded="false"
                           data-target="#submenu-4" aria-controls="submenu-4"><i
                                class="fab fa-fw fas fa-users"></i>Đối tác</a>
                        <div id="submenu-4"
                             class="{{ (request()->is('partners*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item">
                                                                <a class="nav-link {{ (request()->is('partners')) ? 'active1' : '' }}" href="{{ route('screens.storage.partner.index')}}">Nhà cung cấp</a>
                                                            </li>
{{--                                                            <li class="nav-item">--}}
{{--                                                                <a class="nav-link {{ (request()->is('partners/delivery-partner*')) ? 'active1' : '' }}" href="{{ route('screens.storage.delivery.partner')}}">Đối tác giao hàng</a>--}}
{{--                                                            </li>--}}
                                                        </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                           data-target="#submenu-6" aria-controls="submenu-6"><i
                                class="fas fa-fw fa-dollar-sign"></i>
                            Tài chính</a>
                        <div id="submenu-6" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="./finance.html">Ví</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./history.html">Lịch sử thay đổi số
                                        dư</a>
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
                                    <a class="nav-link" href="./profile.html">Hồ sơ của tôi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./change-password.html">Đổi mật khẩu</a>
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
