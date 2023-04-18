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
                                <a class="nav-link active" href="./index.html" aria-expanded="false"
                                    data-target="#submenu-1" aria-controls="submenu-1"><i
                                        class="fa fa-fw fas fa-home"></i>Tổng quan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                    data-target="#submenu-2" aria-controls="submenu-2"><i
                                        class="fab fa-product-hunt"></i>Quản lý sản phẩm
                                </a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" id="product" href="{{route('screens.manufacture.product.index')}}">Tất cả sản phẩm</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="addSp" href="#">Thêm sản phẩm</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="request" href="#">Yêu cầu xét duyệt sản phẩm</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="reAcp" href="{{route('screens.manufacture.product.request')}}">Quản lý yêu cầu xét duyệt</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="discount" href="#">Quản lý giảm giá</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="delSp" href="#">Sản phẩm xuất hủy</a>
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
                                    data-target="#submenu-5" aria-controls="submenu-5"><i
                                        class="fas fa-clipboard-list"></i>
                                        Quản lý đơn hàng
                                    </a>
                                <div id="submenu-5" class="collapse submenu" style="">
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
                                <a class="nav-link {{ (request()->is('finances*')) ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="{{ (request()->is('finances*')) ? 'true' : 'false' }}"
                                   data-target="#submenu-6" aria-controls="submenu-6"><i
                                        class="fas fa-fw fa-dollar-sign"></i>
                                    Tài chính</a>
                                <div id="submenu-6" class="{{ (request()->is('finances*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link {{ (request()->is('finances')) ? 'active1' : '' }}" href="{{ route('screens.manufacture.finance.index') }}">Ví</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ (request()->is('finances/history')) ? 'active1' : '' }}" href="{{ route('screens.manufacture.finance.history') }}">Yêu cầu rút tiền</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ (request()->is('finances/revenue')) ? 'active1' : '' }}" href="{{ route('screens.manufacture.finance.revenue') }}">Lịch sử biến động số
                                                dư</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->is('account*')) ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="{{ (request()->is('account*')) ? 'true' : 'false' }}"
                                    data-target="#submenu-7" aria-controls="submenu-7"><i
                                        class="fa fa-fw fa-user-circle"></i>Tài khoản</a>
                                <div id="submenu-7" class="{{ (request()->is('account*')) ? 'collapshow' : 'collapse' }} submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link {{ (request()->is('account')) ? 'active1' : '' }}" href="{{route('screens.manufacture.account.profile')}}">Hồ sơ của tôi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ (request()->is('account/change-password')) ? 'active1' : '' }}" href="{{route('screens.manufacture.account.changePassword')}}">Đổi mật khẩu</a>
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
