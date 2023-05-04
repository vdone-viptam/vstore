<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white fixed-top navbar-icon ">
        @if(\Illuminate\Support\Facades\Auth::user()->role_id == 4)
            <a class="navbar-brand" href="{{route('screens.storage.dashboard.index')}}">
                <img class="logo-img" style="height: 50px; object-fit: contain;" src="{{asset('home/img/titleK.png')}}"
                     alt="logo">
            </a>
        @elseif(\Illuminate\Support\Facades\Auth::user()->role_id == 3)
            <a class="navbar-brand" href="{{route('screens.vstore.dashboard.index')}}">
                <img class="logo-img" style="height: 40px; object-fit: contain;" src="{{asset('home/img/Logo.png')}}"
                     alt="logo">
            </a>
        @elseif(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
            <a class="navbar-brand" href="{{route('screens.admin.dashboard.index')}}">
                <img class="logo-img" style="height: 40px; object-fit: contain;" src="{{asset('home/img/Logo.png')}}"
                     alt="logo">
            </a>
        @else
            <a class="navbar-brand" href="{{route('screens.manufacture.dashboard.index')}}">
                <img class="logo-img" style="height: 40px; object-fit: contain;" src="{{asset('home/img/NCC.png')}}"
                     alt="logo">
            </a>
        @endif
        <button class="navbar-toggler top-menu-mb" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 4)
                        <div id="custom-search" class="top-search">
                            <input class="form-control" id="search" type="search" placeholder="Nhập từ khóa tìm kiếm..">
                        </div>
                    @endif
                </li>
            </ul>
            <ul class="navbar-nav ml-auto navbar-right-top">
                <li class="nav-item  nav-active-web">

                    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 4)
                        <a class="nav-link nav-user-img" href="#" id="" data-toggle="" aria-haspopup="true"
                           aria-expanded="false">
                            <span>Trạng thái điểm giao nhận: </span>
                            <div class="switch-button switch-button-success switch-button-xs">
                                <input type="checkbox" data-checked="{{\Illuminate\Support\Facades\DB::table('warehouses')
->select('is_off')->where('user_id',\Illuminate\Support\Facades\Auth::id())->first()->is_off}}" {{\Illuminate\Support\Facades\DB::table('warehouses')
->select('is_off')->where('user_id',\Illuminate\Support\Facades\Auth::id())->first()->is_off == 1 ? 'checked' : ''}} name="switch12"
                                       id="switch12"><span>
                                        <label for="switch12"></label></span>
                            </div>
                        </a>
                    @endif
                </li>
                <li class="nav-item dropdown notification ">
                    <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i>
                        <div class="indicato">
                            <span>{{count(Auth::user()->unreadNotifications)}}</span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                        <li>
                            <div class="notification-title"> Thông báo</div>
                            <div class="slimScrollDiv"
                                 style="position: relative; overflow: scroll; width: auto; height: 300px;">
                                <div class="notification-list" style="overflow: hidden; width: auto;">
                                    <div class="list-group">
                                        @if(count(Auth::user()->unreadNotifications) > 0)
                                            @foreach (Auth::user()->unreadNotifications as $index =>$notification)
                                                <a href="{{$notification['data']['href']}}&noti_id={{$notification->id}}"
                                                   class="list-group-item list-group-item-action @if($index == 0) active @endif">
                                                    <div class="notification-info">
                                                        <div class="notification-list-user-img"><img
                                                                src="{{'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQm09_Y6zT012BqEo2bUpaTRWmIYuOC916iiGJzJ7nEGYoESBumhdt4qDsn3ZO-LhZe1fs&usqp=CAU'}}"
                                                                alt=""
                                                                class="user-avatar-md rounded-circle"></div>
                                                        <div
                                                            class="notification-list-user-block">{{$notification['data']['message']}}
                                                            <div
                                                                class="notification-date">{{\Illuminate\Support\Carbon::parse($notification->created_at)->format('d/m/Y H:i')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <a href="#" class="text-center">
                                                Bạn chưa có thông báo mới nào !

                                            </a>
                                        @endif
                                    </div>

                                </div>
                                <div class="slimScrollBar"
                                     style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px;"></div>
                                <div class="slimScrollRail"
                                     style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                            </div>
                        </li>
                        <li>
                            @if(count(Auth::user()->unreadNotifications) > 0)
                                <div class="list-footer"><a href="#" data-toggle="modal" data-target="#noti">Xem tất
                                        cả</a>
                                </div>
                            @endif
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href=""
                       id="navbarDropdownMenuLink2" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <div class="w-[24px]">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" rx="12" fill="#F5F5F5"></rect>
                                <path
                                    d="M12 12C13.6108 12 14.9167 10.6942 14.9167 9.08333C14.9167 7.4725 13.6108 6.16667 12 6.16667C10.3892 6.16667 9.08334 7.4725 9.08334 9.08333C9.08334 10.6942 10.3892 12 12 12Z"
                                    stroke="#2F54EB" stroke-width="1.2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M17.0108 17.8333C17.0108 15.5758 14.765 13.75 12 13.75C9.235 13.75 6.98917 15.5758 6.98917 17.8333"
                                    stroke="#2F54EB" stroke-width="1.2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>


                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                         aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                            {{\Illuminate\Support\Facades\Auth::user()->name}}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->role_id == 4)
                            <a class="dropdown-item" href=
                                "{{route('screens.storage.account.profile')}}"><i class="fas fa-user mr-2"></i>Hồ sơ</a>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->role_id == 3)
                            <a class="dropdown-item" href=
                                "{{route('screens.vstore.account.profile')}}"><i class="fas fa-user mr-2"></i>Hồ sơ</a>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->role_id ==2 )
                            <a href="{{route('screens.manufacture.account.profile')}}"><i class="fas fa-user mr-2"></i>Hồ
                                sơ</a>
                        @endif
                        <a class="dropdown-item logout" href="{{route('logout')}}" style="color:#FF4D4F"><i
                                class="fas fa-power-off mr-2"></i>Đăng
                            xuất</a>

                    </div>
                </li>
            </ul>
        </div>
    </nav>


</div>
<div class="modal fade" id="noti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tất cả thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="position: relative; overflow: scroll; width: auto; height: 500px;">
                @foreach(Auth::user()->notifications as $notification)
                    <p>
                        <img style="width: 32px;height: 32px"
                             src="https://cdn.icon-icons.com/icons2/2643/PNG/512/male_boy_person_people_avatar_icon_159358.png">
                        {{$notification['data']['message']}}
                        <a href="{{$notification['data']['href']}}&noti_id={{$notification->id}}" class="text-primary">Xem
                            chi tiết</a>

                    </p>
                    <span>{{\Illuminate\Support\Carbon::parse($notification->created_at)->format('d/m/Y H:i')}}</span>
                    <hr>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
