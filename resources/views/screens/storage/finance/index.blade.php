@extends('layouts.storage.main')
@section('page_title','Hồ sơ của tôi')

@section('custom_css')

    <link rel="stylesheet" href="{{asset('asset/dist/output.css')}}">

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
                        <form action="{{route('screens.storage.finance.updateWall',['id' => $wallet->id])}}"
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
                                        <label for="exampleFormControlSelect1">Tên ngân hàng:</label>
                                        <select required class="form-control nameBank" id="exampleFormControlSelect1"
                                                name="bank_id">
                                            @foreach($banks as $bank)
                                                <option
                                                    {{$wallet->bank_id == $bank->id ? 'selected' : ''}} value="{{$bank->id}}">{{$bank->name.' - '.$bank->full_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('bank_id')
                                        <p class="text-red-600 mt-2">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số thẻ:</label>
                                        <input required type="text" name="account_number"
                                               value="{{$wallet->account_number}}" class="stk form-control"
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
                    <form action="{{route('screens.storage.finance.storeWall')}}" method="POST">
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
                                    <select name="bank_id" required
                                            class="form-control nameBank0">
                                        <option hidden value="">Lựa chọn ngân hàng</option>
                                        @foreach($banks as $bank)
                                            <option
                                                value="{{$bank->id}}">{{$bank->name.' - '.$bank->full_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('bank_id')
                                    <p class="text-red-600 mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số thẻ:</label>
                                    <input required type="text" name="account_number" value="" class="stk0 form-control"
                                           id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                    @error('account_number')
                                    <p class="text-red-600 mt-2">{{$message}}</p>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn_save_add btn btn-primary bg-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Close
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
        <div class="content" style="width: 100%; background-color: white; border-radius: 12px;">
            <form action="{{route('screens.storage.finance.deposit')}}" class="w-100" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="finance rounded-tl-3xl rounded-tr-3xl p-4"
                             style="background-color: #E8ECFD;">
                            <div
                                class="d-flex flex-column item-center w-100  flex-wrap md:flex-nowrap mt-2">
                                <span style="font-size: 14px; color:#A4B6C6 ;">Số dư tài sản: </span>
                                <span style="font-size: 18px; font-weight: 600; color: #4062FF;" id="cash">
                                {{number_format(Auth::user()->money,0,'.','.')}} VNĐ</span>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="row p-4">
                    <div
                        class="col-sm-12 col-md-6 box rounded-tr-none md:rounded-tr-[30px] rounded-tl-none  w-100 px-[20px] md:px-[60px] py-10">
                        <div class="d-flex flex-column items-start w-100 ">
                            <h3 class=" d-flex align-items-center "
                                style="gap:16px; font-weight: 700; font-size: 18px;">
                                Rút tiền
                            </h3>
                            <p class="text-success"></p>
                            <div class="flex-column items-center gap-2 w-100">
                                <div class="form-group">
                                    <label for="val-username">Số tiền cần rút <strong
                                            class="text-[#FF4D4F]">*</strong></label>
                                    <input required type="number" class="form-control" name="money" id="money"
                                           data-value="0" min="1" placeholder="0đ" max="{{Auth::user()->money}}">
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
                                            <div type="button" style="width:200px;height:30px; cursor: pointer;">
                                                <img class="img_bank" src="{{$wallet->bank->image}}" alt=""
                                                     style="max-width:100%; width:100%; height:100%; object-fit:contain">
                                            </div>
                                            <div>
                                                <h4 class="m-0">{{$wallet->bank->name}}</h4>
                                                <span style="font-size: 12px; line-height: 14px">
                                            @for($i = 0;$i < strlen($wallet->account_number) - 4;$i++)
                                                        *
                                                    @endfor
                                                    {{substr($wallet->account_number,strlen($wallet->account_number) - 4)}}
                                        </span>
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
                                                    <div class="d-flex justify-content-start align-items-center w-100"
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
                            <div class="text-center md:text-right w-100">
                                <button type="submit"
                                        class="btn btn-primary rounded-6 btnGra btn-withdrawl bg-primary">
                                    Rút tiền
                                </button>
                            </div>
                            <div class="text-center mt-2 md:text-right w-100 error_withdrawl">

                            </div>
                        </div>

                    </div>
                    <div class="d-none d-md-block col-6 text-center">
                        <div class="w-100 ">
                            <img src="https://kho.vdone.vn/asset/images/bnfinance.png" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('custom_js')
    <script src="{{asset('asset/js/main.js')}}"></script>
    <script>
        document.getElementsByName('name').forEach(item => {
            item.addEventListener("keypress", (e) => {
                var regex = new RegExp("^[A-Z]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
        })
        $(document).ready(function () {
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
            @if(Session::has('validateCreate'))
            $('.btn-add-bank').click();
            @endif
            @if(Session::has('validateUpdate'))
            $('#btnEditBank').click();
            @endif
        });
    </script>

@endsection
