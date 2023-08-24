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
                           href="{{route('screens.admin.dashboard.index')}}" aria-expanded="false"
                           data-target="#submenu-1" aria-controls="submenu-1"><i
                                class="fa fa-fw fas fa-home"></i>Tổng quan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('users*')) ? 'active' : '' }}"
                           href="{{route('screens.admin.user.list_user')}}" data-toggle="collapse"
                           aria-expanded="{{ (request()->is('products*')) ? 'true' : 'false' }}"
                           data-target="#submenu-2" aria-controls="submenu-2"><i
                                class="fab fa-fw fas fa-users"></i>Quản lý tài khoản
                        </a>
                        <div id="submenu-2"
                             class="{{ (request()->is('users*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('users/list*')) ? 'active1' : '' }}"
                                       id="product"
                                       href="{{route('screens.admin.user.list_user')}}">Danh sách tài khoản</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('users/register-account*')) ? 'active1' : '' }}"
                                       id="addSp"
                                       href="{{route('screens.admin.user.index')}}">Quản lý yêu cầu đăng ký tài
                                        khoản</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('users/request-change-tax-code*')) ? 'active1' : '' }}"
                                       id="addSp"
                                       href="{{route('screens.admin.user.tax_code')}}">Quản lý yêu cầu cập nhật mã số
                                        thuế</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       id="addSp"
                                       href="#">Tài khoản hết hạn</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('users/history-payment*')) ? 'active1' : '' }}"
                                       id="addSp"
                                       href="{{route('screens.admin.user.historyPayment')}}">Lịch sử thanh toán đăng ký
                                        tài
                                        khoản</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('products*')) ? 'active' : '' }}" href="#"
                           data-toggle="collapse"
                           aria-expanded="{{ (request()->is('products*')) ? 'true' : 'false' }}"
                           data-target="#submenu-3" aria-controls="submenu-3"><i
                                class="fab fa-product-hunt"></i>Quản lý sản phẩm</a>
                        <div id="submenu-3"
                             class="{{ (request()->is('products*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/all-product*')) ? 'active1' : '' }}"
                                       id="proIn"
                                       href="{{route('screens.admin.product.all')}}">Tất cả sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/index*')) ? 'active1' : '' }}"
                                       id="proIn"
                                       href="{{route('screens.admin.product.index')}}">Quản lý yêu cầu xét duyệt sản
                                        phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('products/categories*')) ? 'active1' : '' }}"
                                       id="proIn"
                                       href="{{route('screens.admin.category.index')}}">Danh mục ngành hàng</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                           data-toggle="collapse" aria-expanded="false"
                           data-target="#submenu-6" aria-controls="submenu-6"><i
                                class="fas fa-thumbs-down"></i>
                            Quản lý gian lận, bất <br> thường</a>
                        <div id="submenu-6"
                             class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="#">Quản lý khiếu nại</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="#">Nhà cung cấp</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="#">Kho</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="#">Shop</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="#">Người mua hàng</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('finances*')) ? 'active' :  ( (request()->is('bank*')) ? 'active' : '' ) }}" href="#"
                           data-toggle="collapse" aria-expanded="{{ (request()->is('finances*')) ? 'true' : 'false' }}"
                           data-target="#submenu-7" aria-controls="submenu-7"><i
                                class="fas fa-fw fa-dollar-sign"></i>Quản lý tài chính</a>
                        <div id="submenu-7"
                             class="{{ (request()->is('finances*')) ? 'collapshow' : ( (request()->is('bank*')) ? 'collapshow' : 'collapse' ) }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('finances/request-deposit*')) ? 'active1' : '' }}"
                                       href="{{route('screens.admin.finance.index')}}">Quản lý yêu cầu rút tiền</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('bank/index')) ? 'active1' : '' }}"
                                       href="{{route('screens.admin.bank.index')}}">Danh sách ngân hàng</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('account*')) ? 'active' : '' }}" href="#"
                            data-toggle="collapse" aria-expanded="{{ (request()->is('account*')) ? 'true' : 'false' }}"
                           data-target="#submenu-8" aria-controls="submenu-8"><i
                                class="fa fa-fw fa-user-circle"></i>Tài khoản</a>
                        <div id="submenu-8"
                                class="{{ (request()->is('account*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('account/change-password')) ? 'active1' : '' }}"
                                       href="{{route('screens.admin.account.changePassword')}}">Đổi mật khẩu</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link logout" href="{{route('logout')}}" aria-expanded="false"
                           data-target="#submenu-9"
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
