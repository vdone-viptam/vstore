@extends('layouts.manufacture.main')

@section('page_title','Ví')

@section('custom_css')

    <link rel="stylesheet" href="{{asset('asset/dist/output.css')}}">
    <style>

        .dropdown-finance {
            width: 100%;
            display: inline-block;
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 0 2px rgb(204, 204, 204);
            transition: all .5s ease;
            position: relative;
            font-size: 14px;
            color: #474747;
            height: 100%;
            text-align: left;
            outline: none;
        }

        .dropdown-finance .select {
            cursor: pointer;
            display: block;
            padding: 10px;


        }

        .dropdown-finance div > i {
            font-size: 13px;
            color: #888;
            cursor: pointer;
            transition: all .3s ease-in-out;

            line-height: 20px
        }

        .dropdown-finance:hover {
            box-shadow: 0 0 4px rgb(204, 204, 204)
        }

        .dropdown-finance:active {
            background-color: #f8f8f8
        }

        .dropdown-finance.active:hover,
        .dropdown-finance.active {
            box-shadow: 0 0 4px rgb(204, 204, 204);
            border-radius: 2px 2px 0 0;
            background-color: #f8f8f8
        }

        .dropdown-finance.active div > i {
            transform: rotate(-90deg);
            transition: .5s all;
        }

        .dropdown-finance .dropdown-menu-finan {
            position: absolute;
            background-color: #fff;
            width: 100%;
            left: 0;
            margin-top: 1px;
            box-shadow: 0 1px 2px rgb(204, 204, 204);
            border-radius: 0 1px 2px 2px;
            overflow: hidden;
            display: none;
            max-height: 120px;
            overflow-y: auto;
            z-index: 9
        }

        .dropdown-finance .dropdown-menu-finan li {
            padding: 10px;

            transition: all .2s ease-in-out;
            cursor: pointer
        }

        .dropdown-finance .dropdown-menu-finan {
            padding: 0;
            list-style: none
        }

        .dropdown-finance .dropdown-menu-finan li:hover {
            background-color: #f2f2f2
        }

        .dropdown-finance .dropdown-menu-finan li:active {
            background-color: #e2e2e2
        }
    </style>
@endsection
@section('modal')

@endsection
@section('content')
    <div class="container-fluid dashboard-content ">
        <!-- modal -->
        @if($wallet)
            <div class="modal fade editBank" id="editBank" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{route('screens.manufacture.finance.updateWall',['id' => $wallet->id])}}"
                              method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" style="font-size: 18px;">Cập nhật ngân hàng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="justify-start items-start gap-4 py-3 w-100" id="modal-update">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên chủ thẻ:</label>
                                        <input required type="text" name="name" value="{{$wallet->name}}"
                                               class="nameWallet form-control"
                                               id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                        @error('name')
                                        <p class="text-red-600 mt-2">{{$message}}</p>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label>Tên ngân hàng:</label>
                                        <div class="dropdown-finance">
                                            <div class="select">
                                                <ul id="current">
                                                    <li id="{{$wallet->bank->id}}">
                                                        <div class="item-nh d-flex align-items-center" style="gap:10px">
                                                            <div style="width:121px !important;">
                                                                <div
                                                                    style="width:120px; !important; height:40px!important;">
                                                                    <img
                                                                        style="width:100%; height:100%; object-fit:contain !important;"
                                                                        src="{{$wallet->bank->image}}"></div>
                                                            </div> {{$wallet->bank->full_name}} </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="hidden" name="bank_id" value="{{$wallet->bank->id}}">
                                            <ul class="dropdown-menu-finan">
                                                @foreach($banks as $bank)
                                                    <li id="{{$bank->id}}">
                                                        <div class="item-nh d-flex align-items-center" style="gap:10px">
                                                            <div style="width:121px !important;">
                                                                <div
                                                                    style="width:120px; !important; height:40px!important;">
                                                                    <img
                                                                        style="width:100%; height:100%; object-fit:contain !important;"
                                                                        src="{{$bank->image}}"></div>
                                                            </div> {{$bank->full_name}} </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- <select name="bank_id" required
                                            class="form-control nameBank0">
                                        <option hidden value=""><div class="d-flex align-items-center" style="gap:10px"><div style="width:200px !important; height:50px!important;"><img style="width:100%; object-fit-cover;" ></div>Lựa chọn ngân hàng</div></option>
                                        @foreach($banks as $bank)
                                            <option
                                                value="{{$bank->id}}"><div class="d-flex align-items-center" style="gap:10px"><div style="width:200px !important; height:50px!important;"><img style="width:100%; object-fit-cover;"></div> {{$bank->name.' - '.$bank->full_name}} </div></option>


                                        @endforeach
                                        </select> -->
                                        @error('bank_id')
                                        <p class="text-red-600 mt-2">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số thẻ:</label>
                                        <input required type="text" name="account_number"
                                               value="{{$wallet->account_number}}" class="stk form-control only-number"
                                               id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                        @error('account_number')
                                        <p class="text-red-600 mt-2">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn_save_update btn btn-primary bg-primary">Lưu lại
                                </button>
                                <button type="button" class="btn btn-secondary bg-secondary " data-dismiss="modal">
                                    Đóng
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        <div class="modal fade addBank" id="addBank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{route('screens.manufacture.finance.storeWall')}}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-size: 18px;">Thêm ngân hàng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="justify-start items-start gap-4 py-3 w-100" id="modal-update">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên chủ thẻ:</label>
                                    <input required type="text" name="name" value="" class="nameWallet0 form-control"
                                           id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                    @error('name')
                                    <p class="text-red-600 mt-2">{{$message}}</p>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Tên ngân hàng:</label>
                                    <div class="dropdown-finance">
                                        <div class="d-flex justify-content-between align-items-center px-2">
                                            <div class="select">
                                                <span>Lựa chọn ngân hàng</span>

                                            </div>
                                            <i class="fa fa-chevron-left"></i>
                                        </div>
                                        <input type="hidden" name="bank_id">
                                        <ul class="dropdown-menu-finan">
                                            @foreach($banks as $bank)
                                                <li id="{{$bank->id}}">
                                                    <div class="item-nh d-flex align-items-center" style="gap:10px">
                                                        <div style="width:121px !important;">
                                                            <div
                                                                style="width:120px; !important; height:40px!important;">
                                                                <img
                                                                    style="width:100%; height:100%; object-fit:contain !important;"
                                                                    src="{{$bank->image}}"></div>
                                                        </div> {{$bank->name.' - '.$bank->full_name}} </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- <select name="bank_id" required
                                            class="form-control nameBank0">
                                        <option hidden value=""><div class="d-flex align-items-center" style="gap:10px"><div style="width:200px !important; height:50px!important;"><img style="width:100%; object-fit-cover;" ></div>Lựa chọn ngân hàng</div></option>
                                        @foreach($banks as $bank)
                                        <option
                                            value="{{$bank->id}}"><div class="d-flex align-items-center" style="gap:10px"><div style="width:200px !important; height:50px!important;"><img style="width:100%; object-fit-cover;"></div> {{$bank->name.' - '.$bank->full_name}} </div></option>


                                    @endforeach
                                    </select> -->
                                    @error('bank_id')
                                    <p class="text-red-600 mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số thẻ:</label>
                                    <input required type="text" name="account_number" value=""
                                           class="stk0 form-control only-number"
                                           id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                    @error('account_number')
                                    <p class="text-red-600 mt-2">{{$message}}</p>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn_save_add btn btn-primary bg-primary">Lưu lại</button>
                            <button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Đóng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- pageheader  -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Ví </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tài
                                        chính</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Ví</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- end pageheader  -->
        <div class="row ">
            <div class="card mx-auto cardFinance">
                <form action="{{route('screens.manufacture.finance.deposit')}}" class="w-100" method="POST">
                    @csrf

                    <div class="row m-4 py-4" style="border-bottom: 1px solid #d2d2e4;">
                        <div class="fiNumber"
                             style="width:100%; max-width:780px; background-color: #E6F7FF; border: 1px solid #69C0FF; border-radius: 10px; padding: 10px 40px; display: flex; justify-content: space-between;align-items: center;">
                            <div class="number-cost">
                                <h3 style="font-weight: 600; color: #1890FF; font-size: 20px;">{{number_format(round(\Illuminate\Support\Facades\Auth::user()->money ,0) + round($waiting,0),0,',','.') }}
                                    đ</h3>
                                <span style="color: black; font-size: 14px;">Tổng số dư</span>
                            </div>
                            <div class="number-cost"
                                 style="border-left: 1px solid #d2d2e4; border-right: 1px solid #d2d2e4;">
                                <h3 style="font-weight: 600; color: #1890FF; font-size: 20px;">{{number_format(\Illuminate\Support\Facades\Auth::user()->money,0,',','.')}}
                                    đ</h3>
                                <span style="color: black; font-size: 14px;">Số dư khả dụng</span>
                            </div>
                            <div class="number-cost">
                                <h3 style="font-weight: 600; color: #1890FF; font-size: 20px;">{{number_format($waiting,0,',','.') }}
                                    đ</h3>
                                <span style="color: black; font-size: 14px;">Chờ rút</span>
                            </div>
                        </div>
                    </div>


                    <div class="row p-4">
                        <div
                            class="col-sm-12 col-md-12   w-100 px-[20px] md:px-[60px] ">
                            <div class="d-flex flex-column items-start w-100 ">

                                <p class="text-success"></p>
                                <div class="flex-column items-center gap-2 w-100">
                                    <div class="form-group">
                                        <label for="val-username">Số tiền cần rút <strong
                                                class="text-[#FF4D4F]">*</strong></label>
                                        <input required type="text" class="only-number form-control number-show-vnd"
                                               data-name="money"
                                               data-min="100000"
                                               data-max="{{ round(Auth::user()->money)}}"
                                               placeholder="0đ"
                                        >
                                    </div>
                                </div>
                                <div class="d-flex flex-column items-start w-100 flex-wrap md:flex-nowrap my-4">
                                    <label class="w-100 text-[#6A6A6A]  text-sm" for="val-username">Phương thức
                                        nhận
                                        tiền:
                                    </label>
                                    @if($wallet)
                                        <div class="w-100" data-toggle="modal" data-target="#editBank" id="btnEditBank">
                                            <div class="cursor-pointer min-h-[100px]" id="btnEdit"
                                                 style="border: 1px solid #ced4da; border-radius: 0.25rem; padding: 0.375rem 0.75rem; width: 100%;">
                                                <input type="hidden" name="bank" value="">
                                                <div class="update d-flex justify-center items-center w-100"
                                                     style="gap: 10px;">
                                                </div>
                                                <input type="hidden" name="bank" value="{{$wallet->id}}">
                                                <div class="d-flex align-items-center" style="gap:10px;">
                                                    <div type="button"
                                                         style="width:150px;height:50px; cursor: pointer;">
                                                        <img class="img_bank" src="{{$wallet->bank->image}}" alt=""
                                                             style="max-width:100%; width:100%; height:100%; object-fit:contain">
                                                    </div>
                                                    <div>
                                                        <h4 class="m-0">{{$wallet->bank->full_name}}</h4>
                                                        <span style="font-size: 12px; line-height: 14px">
                                            @for($i = 0;$i < strlen($wallet->account_number) - 4;$i++)
                                                                *
                                                            @endfor
                                                            {{substr($wallet->account_number,strlen($wallet->account_number) - 4)}}
                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @else
                                        <div class="w-100" data-toggle="modal" data-target="#addBank" id="btnAddBank">
                                            <div class="cursor-pointer min-h-[100px]" id="btnEdit"
                                                 style="border: 1px solid #ced4da; border-radius: 0.25rem; padding: 0.375rem 0.75rem; width: 100%;">
                                                <input type="hidden" name="bank" value="">
                                                <div class="update d-flex justify-center items-center w-100"
                                                     style="gap: 10px;">
                                                </div>

                                                <a type="button"
                                                   href="javascript:void(0)"
                                                   class="btn-add-bank w-100">
                                                    <div class="add"
                                                         style="border: 1px dashed #1E90FF; border-radius: 0.25rem; padding: 0.375rem 0.75rem; margin-top: 20px; margin-bottom: 20px;">
                                                        <div
                                                            class="d-flex justify-content-start align-items-center w-100"
                                                            style="gap: 20px;">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M18.5714 11.4286H11.4286V18.5714C11.4286 18.9503 11.2781 19.3137 11.0102 19.5816C10.7422 19.8495 10.3789 20 10 20C9.62112 20 9.25776 19.8495 8.98985 19.5816C8.72194 19.3137 8.57143 18.9503 8.57143 18.5714V11.4286H1.42857C1.04969 11.4286 0.686328 11.2781 0.418419 11.0102C0.15051 10.7422 0 10.3789 0 10C0 9.62112 0.15051 9.25776 0.418419 8.98985C0.686328 8.72194 1.04969 8.57143 1.42857 8.57143H8.57143V1.42857C8.57143 1.04969 8.72194 0.686328 8.98985 0.418419C9.25776 0.150509 9.62112 0 10 0C10.3789 0 10.7422 0.150509 11.0102 0.418419C11.2781 0.686328 11.4286 1.04969 11.4286 1.42857V8.57143H18.5714C18.9503 8.57143 19.3137 8.72194 19.5816 8.98985C19.8495 9.25776 20 9.62112 20 10C20 10.3789 19.8495 10.7422 19.5816 11.0102C19.3137 11.2781 18.9503 11.4286 18.5714 11.4286Z"
                                                                    fill="#FF9A62"/>
                                                            </svg>

                                                            <div>
                                                                <h4 class="m-0 text-[#1E90FF]">Thêm ngân hàng</h4>
                                                                <span
                                                                    style="font-size: 12px; line-height: 14px; color:#AEAEAE;">Miễn
                                                        phí nạp, rút tiền</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>


                                <div class="text-center md:text-right w-100 my-4">
                                    <button type="submit"
                                            class="btn btn-primary rounded-6 btnGra btn-withdrawl bg-primary withdraw-money">
                                        Rút tiền
                                    </button>
                                </div>
                                <div class="text-center mt-2 md:text-right w-100 error_withdrawl">

                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
@section('custom_js')
    <script src="{{asset('asset/js/main.js')}}"></script>
    @if($wallet)
        <script>
            $('.dropdown-finance').click(function () {
                $(this).attr('tabindex', 1).focus();
                $(this).toggleClass('active');
                $(this).find('.dropdown-menu-finan').slideToggle(300);
            });
            $('.dropdown-finance').focusout(function () {
                $(this).removeClass('active');
                $(this).find('.dropdown-menu-finan').slideUp(300);
            });
            $('.dropdown-finance .dropdown-menu-finan li').click(function () {
                if ($('#current')) {
                    $('#current').html($(this).html());
                }
                $(this).parents('.dropdown-finance').find('input').attr('value', $(this).attr('id'));
            });

        </script>
    @else
        <script>
            $('.dropdown-finance').click(function () {
                $(this).attr('tabindex', 1).focus();
                $(this).toggleClass('active');
                $(this).find('.dropdown-menu-finan').slideToggle(300);
            });
            $('.dropdown-finance').focusout(function () {
                $(this).removeClass('active');
                $(this).find('.dropdown-menu-finan').slideUp(300);
            });
            $('.dropdown-finance .dropdown-menu-finan li').click(function () {
                $(this).parents('.dropdown-finance').find('span').html($(this).html());
                $(this).parents('.dropdown-finance').find('input').attr('value', $(this).attr('id'));
            });

        </script>
    @endif

    <script>
        document.getElementsByName('name').forEach(item => {
            item.addEventListener("keypress", (e) => {
                var regex = new RegExp("^[a-zA-Z ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
        })
        $(document).ready(function () {

            const money = {{ Auth::user()->money}};
            if (money < 100000) {
                document.querySelector('.withdraw-money').setAttribute('disabled', 'true');
                document.querySelector('.withdraw-money').classList.add('opacity-70');
            }

            @if(Session::has('success'))
            const textSuccess = '{{ Session::get('success')}}';
            Swal.fire(
                textSuccess,
                'Click vào nút bên dưới để đóng',
                'success'
            )
            @endif
            @if(Session::has('error'))
            const textError = '{{ Session::get('error')}}';
            Swal.fire({
                icon: 'error',
                title: 'Tạo yêu cầu rút tiền thất bại !',
                text: textError,
            })
            @endif
            @if(Session::has('validateError'))
            const textError = '{{ $errors->first() }}';
            swalNoti('center', 'error', 'Tạo yêu cầu rút tiền thất bại', textError, 500, true, 3000);
            @endif
            @if(Session::has('validateCreate'))
            $('.btn-add-bank').click();
            @endif
            @if(Session::has('validateUpdate'))
            $('#btnEditBank').click();
            @endif
        });
    </script>

@endsection
