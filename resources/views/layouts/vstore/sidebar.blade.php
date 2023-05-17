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
                 
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}"
                           href="{{route('screens.vstore.dashboard.index')}}" aria-expanded="false"
                           data-target="#submenu-1" aria-controls="submenu-1"><i
                                class="fa fa-fw fas fa-home"></i>Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('products*')) ? 'active' : '' }}"
                           href="{{route('screens.vstore.product.index')}}" data-toggle="collapse"
                           aria-expanded="{{ (request()->is('products*')) ? 'true' : 'false' }}"
                           data-target="#submenu-2" aria-controls="submenu-2"><i
                                class="fab fa-product-hunt"></i>Sản phẩm
                        </a>
                        <div id="submenu-2"
                             class="{{ (request()->is('products*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/index*')) ? 'active1' : '' }}"
                                       id="product"
                                       href="{{route('screens.vstore.product.index')}}">Tất cả sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/request-confirm*')) ? 'active1' : '' }}"
                                       id="addSp"
                                       href="{{route('screens.vstore.product.request')}}">Yêu cầu xét duyệt sản phẩm chưa xác nhận</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/requestAll*')) ? 'active1' : '' }}"
                                       id="addSp"
                                       href="{{route('screens.vstore.product.requestAll')}}">Yêu cầu xét duyệt sản phẩm đã xác nhận</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/discount*')) ? 'active1' : '' }}"
                                       id="addSp"
                                       href="{{route('screens.vstore.product.discount')}}">Quản lý giảm giá</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('order*')) ? 'active' : '' }}" href="#"
                           data-toggle="collapse"
                           aria-expanded="{{ (request()->is('order*')) ? 'true' : 'false' }}"
                           data-target="#submenu-3" aria-controls="submenu-3"><i
                                class="fas fa-fw fas fa-warehouse"></i>Quản lý đơn hàng</a>
                        <div id="submenu-3"
                             class="{{ (request()->is('order*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('order/index*')) ? 'active1' : '' }}"
                                       id="proIn"
                                       href="{{route('screens.vstore.order.index')}}">Tất cả đơn hàng</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('partners*')) ? 'active' : '' }}" href=""
                           data-toggle="collapse" aria-expanded="{{ (request()->is('partners*')) ? 'true' : 'false' }}"
                           data-target="#submenu-4" aria-controls="submenu-4"><i
                                class="fab fa-fw fas fa-users"></i>Đối tác</a>
                        <div id="submenu-4"
                             class="{{ (request()->is('partners*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('partners/index*')) ? 'active1' : '' }}"
                                       id="listVstore" href="{{route('screens.vstore.partner.index')}}">Nhà cung cấp</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('partners/vshop*')) ? 'active1' : '' }}"
                                       id="listVstore" href="{{route('screens.vstore.partner.vshop')}}">V-Shop</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('finance*')) ? 'active' : '' }}" href="#"
                           data-toggle="collapse" aria-expanded="{{ (request()->is('finance*')) ? 'true' : 'false' }}"
                           data-target="#submenu-6" aria-controls="submenu-6"><i
                                class="fas fa-fw fa-dollar-sign"></i>
                            Tài chính</a>
                        <div id="submenu-6"
                             class="{{ (request()->is('finance*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('finance')) ? 'active1' : '' }}"
                                       href="{{ route('screens.vstore.finance.index') }}">Ví</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('finance/history')) ? 'active1' : '' }}"
                                       href="{{ route('screens.vstore.finance.history') }}">Yêu cầu rút tiền</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('finance/revenue')) ? 'active1' : '' }}"
                                       href="{{ route('screens.vstore.finance.revenue') }}">Lịch sử biến động số
                                        dư</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('account*')) ? 'active' : '' }}" href="#"
                           data-toggle="collapse" aria-expanded="{{ (request()->is('account*')) ? 'true' : 'false' }}"
                           data-target="#submenu-7" aria-controls="submenu-7"><i
                                class="fa fa-fw fa-user-circle"></i>Tài khoản</a>
                        <div id="submenu-7"
                             class="{{ (request()->is('account*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('account')) ? 'active1' : '' }}"
                                       href="{{route('screens.vstore.account.profile')}}">Hồ sơ của tôi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('account/change-password')) ? 'active1' : '' }}"
                                       href="{{route('screens.vstore.account.changePassword')}}">Đổi mật khẩu</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link logout" href="{{route('logout')}}" aria-expanded="false"
                           data-target="#submenu-8"
                           aria-controls="submenu-8" style="color:#FF4D4F"><i class="fas fa-fw fa-sign-out-alt"
                                                                              style="color:#FF4D4F"></i>Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    </nav>
</div>
</div>
