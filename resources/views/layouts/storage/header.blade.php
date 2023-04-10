<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white fixed-top navbar-icon ">
        <a class="navbar-brand" href="index.html">
            <img class="logo-img" style="height: 50px; object-fit: contain;" src="{{asset('home/img/vdone.png')}}"
                 alt="logo">
        </a>
        <button class="navbar-toggler top-menu-mb" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <div id="custom-search" class="top-search">
                        <input class="form-control" id="search" type="search" placeholder="Tìm kiếm..">
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto navbar-right-top">

                <li class="nav-item dropdown notification">
                    <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span
                            class="indicator"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                        <li>
                            <div class="notification-title"> Thông báo</div>
                            <div class="notification-list">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action active">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img
                                                    src="{{asset('asset/assets/images/avatar-2.jpg')}}"
                                                    alt=""
                                                    class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block"><span
                                                    class="notification-list-user-name">Jeremy
                                                            Rakestraw</span>chấp nhận lời mời vào team.
                                                <div class="notification-date">2 phút trước</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img
                                                    src="{{asset('asset/assets/images/avatar-3.jpg')}}"
                                                    alt=""
                                                    class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block"><span
                                                    class="notification-list-user-name">John Abraham
                                                        </span>không theo dõi bạn
                                                <div class="notification-date">2 ngày trước</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img
                                                    src="{{asset('asset/assets/images/avatar-4.jpg')}}"
                                                    alt=""
                                                    class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block"><span
                                                    class="notification-list-user-name">Monaan Pechi</span> đang
                                                xem dự án của bạn
                                                <div class="notification-date">2 phút trước</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img
                                                    src="{{asset('asset/assets/images/avatar-5.jpg')}}"
                                                    alt=""
                                                    class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block"><span
                                                    class="notification-list-user-name">Jessica
                                                            Caruso</span>chấp nhận lời mời vào team.
                                                <div class="notification-date">2 phút trước</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="list-footer"><a href="./notify.html">Xem tất cả</a></div>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="w-[24px]">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" rx="12" fill="#F5F5F5"/>
                                <path
                                    d="M12 12C13.6108 12 14.9167 10.6942 14.9167 9.08333C14.9167 7.4725 13.6108 6.16667 12 6.16667C10.3892 6.16667 9.08334 7.4725 9.08334 9.08333C9.08334 10.6942 10.3892 12 12 12Z"
                                    stroke="#2F54EB" stroke-width="1.2" stroke-linecap="round"
                                    stroke-linejoin="round"/>
                                <path
                                    d="M17.0108 17.8333C17.0108 15.5758 14.765 13.75 12 13.75C9.235 13.75 6.98917 15.5758 6.98917 17.8333"
                                    stroke="#2F54EB" stroke-width="1.2" stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>


                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                         aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">

                        </div>
                        <a class="dropdown-item" href="./profile.html"><i class="fas fa-user mr-2"></i>Hồ sơ</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Cài đặt</a>
                        <a class="dropdown-item logout" style="color:#FF4D4F"><i
                                class="fas fa-power-off mr-2"></i>Đăng xuất</a>

                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>


