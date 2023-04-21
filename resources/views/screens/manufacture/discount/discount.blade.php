@extends('layouts.manufacture.main')
@section('page_title','Quản lý giảm giá')



@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body md-content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Quản lý giảm giá</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý giảm giá</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                <h5 class="mb-0" style="font-size:18px;">Quản lý giảm giá</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="field" value="{{$field}}">
                                <input type="hidden" name="limit" value="{{$limit}}">
                                <input name="key_search" value="{{$key_search ?? ''}}" class="form-control"
                                       type="search"
                                       placeholder="Tìm kiếm..">
                            </form>

                        </div>
                    </li>
                </ul> 
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary my-2">
                        Thêm mới giảm giá
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <form action="{{route('screens.manufacture.product.storeDis')}}" method="POST">
                            <div class="modal-dialog  modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thêm mới
                                            mã
                                            giảm giá</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body md-content">
                                        <div class="">
                                            @csrf
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Lựa chọn sản phẩm tạo giảm giá</label>
                                                    <select name="product_id" id="product_id"
                                                            class="form-control-lg form-control choose-product">
                                                        <option value="" selected disabled>Chọn sản phẩm</option>
                                                        @foreach($products as $product)
                                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="">Giá sản phẩm (đ):</label>
                                                    <input disabled name="price" id="price"
                                                           class="form-control form-control-lg">
                                                </div>
                                                <div class="form-group">
                                                    <label class="">Phần trăm chiết khấu cho V-Store (%):</label>
                                                    <input disabled name="discount_ncc" id="discount_ncc"
                                                           class="form-control-lg form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="">Phần trăm chiết khấu mua nhiều (%):</label>
                                                    <input disabled name="buy_more" id="buy_more"
                                                           class="form-control form-control-lg">
                                                </div>
                                                <div class="form-group">
                                                    {{--                        <span class="text-title font-medium  ">Phần trăm chiết khấu cho Vshop:</span>--}}
                                                    <input disabled name="buy_more" id="buy_more" type="hidden"
                                                           class="form-control-lg form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="">Phần trăm giảm giá (%):</label>
                                                    <input name="discount" id="discount1" type="number"
                                                           class="form-control form-control-lg">
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 form-group">
                                                        <span class="">Ngày bắt đầu:</span>
                                                        <input type="datetime-local" name="start_date" id="start_date"
                                                               required
                                                               min="{{ Carbon\Carbon::now()->addSeconds(600)->format('Y-m-d H:i') }}"
                                                               class="form-control-lg form-control ">
                                                        @error('start_date')
                                                        <p class="text-red-600">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <span class="">Ngày kết thúc:</span>
                                                        <input type="datetime-local" id="end_date" name="end_date"
                                                               required
                                                               min="{{ Carbon\Carbon::now()->format('Y-m-d H:i') }}"
                                                               class="form-control-lg form-control">
                                                        @error('end_date')
                                                        <p class="text-red-600">{{$message}}</p>
                                                        @enderror

                                                    </div>

                                                </div>
                                                <p class="text-danger" id="message">Phần trăm giảm giá phải nhỏ hơn phần
                                                    trăm còn lại sau chiết
                                                    khấu <span class="discountFinal"></span></p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            class="btn btn-success btnSubmit"
                                        >Thêm mới
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <table id="example" class="table table-striped table-bordered second    "
                    >
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'products.name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="products.name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="products.name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="products.name"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Phần trăm giảm giá
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'discounts.discount')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="discounts.discount"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="discounts.discount"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="discounts.discount"></i>
                                    @endif
                                </span>
                            </th>

                            <th>Ngày bắt đầu
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'discounts.start_date')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="discounts.start_date"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="discounts.start_date"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="discounts.start_date"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Ngày kết thúc
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'discounts.end_date')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="discounts.end_date"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="discounts.end_date"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="discounts.end_date"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Ngày tạo
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'discounts.created_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="discounts.created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="discounts.created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="discounts.created_at"></i>
                                    @endif
                                </span>
                            </th>
                            <th>
                                Chức năng
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @if(count($discounts) > 0)
                            @foreach($discounts as $discount)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$discount->name}}</td>
                                    <td>{{$discount->discount}}</td>
                                    <td>{{\Carbon\Carbon::parse($discount->start_date)->format('d/m/Y')}}</td>
                                    <td>{{\Carbon\Carbon::parse($discount->end_date)->format('d/m/Y')}}</td>
                                    <td>{{\Carbon\Carbon::parse($discount->created_at)->format('d/m/Y')}}</td>
                                    <td><a href="#" data-id="{{$discount->id}}"
                                           class="btn btn-warning more-details">Sửa</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="7">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{$discounts->withQueryString()->links()}}
                    <div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 float-right mt-4">
                        <form>
                            <div class="form-group">
                                <select class="form-control" id="limit">
                                    <option value="10" {{$limit == 10 ? 'selected' : ''}}>10 phần tử / trang</option>
                                    <option value="25" {{$limit == 25 ? 'selected' : ''}}>25 phần tử / trang</option>
                                    <option value="50" {{$limit == 50 ? 'selected' : ''}}>50 phần tử / trang</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>



            </div>

        </div>
    </div>

@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {
            document.querySelectorAll('.sort').forEach(item => {
                const {sort} = item.dataset;
                item.addEventListener('click', () => {
                    let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                    if (orderBy === 'asc') {
                        localStorage.setItem('orderBy', JSON.stringify('desc'));
                    } else {
                        localStorage.setItem('orderBy', JSON.stringify('asc'));
                    }
                    setTimeout(() => {
                        document.location = '{{route('screens.manufacture.product.discount',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
    </script>
    <script>
        document.getElementsByName('start_date')[0].addEventListener('change', (e) => {
            document.getElementsByName('end_date')[0].setAttribute('min', e.target.value);
        });
        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
        document.getElementById('start_date').addEventListener('change', (e) => {
            $.ajax({
                url: '{{route('check_date')}}?_token={{csrf_token()}}&start_date=' + e.target.value,
                success: function (result) {
                    if (result.validated === false) {
                        console.log(result)
                        document.getElementById('message').innerHTML = result.error.end_date;
                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                    } else {
                        document.getElementById('message').innerHTML = '';
                        if (document.getElementById('end_date').value) {
                            $.ajax({
                                url: '{{route('check_date')}}?_token={{csrf_token()}}&end_date=' + document.getElementById('end_date').value + '&start_date=' + document.getElementById('start_date').value,
                                success: function (result) {
                                    if (result.validated === false) {
                                        document.getElementById('message').innerHTML = result.error.end_date;
                                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                    } else {
                                        if (document.getElementById('discount1').value && document.getElementById('discount1').value < 100 - document.querySelector('#buy_more').value - document.querySelector('#discount_ncc').value) {
                                            document.querySelector('.btnSubmit').removeAttribute('disabled');
                                            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                                            document.getElementById('message').innerHTML = '';
                                        } else {
                                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - document.querySelector('#buy_more').value - document.querySelector('#discount_ncc').value}`;

                                        }

                                    }
                                },
                            });
                        }
                    }
                },
            });
        });
        document.getElementById('end_date').addEventListener('change', (e) => {
            if (document.getElementById('start_date').value) {
                $.ajax({
                    url: '{{route('check_date')}}?_token={{csrf_token()}}&end_date=' + e.target.value + '&start_date=' + document.getElementById('start_date').value,
                    success: function (result) {
                        if (result.validated === false) {
                            document.getElementById('message').innerHTML = result.error.end_date;
                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                        } else {
                            if (document.getElementById('discount1').value && document.getElementById('discount1').value < 100 - document.querySelector('#buy_more').value - document.querySelector('#discount_ncc').value) {
                                document.querySelector('.btnSubmit').removeAttribute('disabled');
                                document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                                document.getElementById('message').innerHTML = '';
                            } else {
                                document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - document.querySelector('#buy_more').value - document.querySelector('#discount_ncc').value}`;

                            }

                        }
                    },
                });
            }
        });
        document.getElementById('discount1').addEventListener('keyup', (o) => {
            const value = +o.target.value;

            if (value < 100 - document.querySelector('#buy_more').value - document.querySelector('#discount_ncc').value && value > 0 && document.getElementById('end_date').value && document.getElementById('start_date').value) {
                $.ajax({
                    url: '{{route('check_date')}}?_token={{csrf_token()}}&end_date=' + document.getElementById('end_date').value + '&start_date=' + document.getElementById('start_date').value,
                    success: function (result) {
                        if (result.validated === false) {
                            document.getElementById('message').innerHTML = result.error.end_date;
                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                        } else {
                            if (value && value < 100 - document.querySelector('#buy_more').value - document.querySelector('#discount_ncc').value) {
                                document.querySelector('.btnSubmit').removeAttribute('disabled');
                                document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                                document.getElementById('message').innerHTML = ``;
                            } else {
                                document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - document.querySelector('#discount_ncc').value - document.querySelector('#discount_ncc').value}`;

                            }

                        }
                    },
                });
                document.querySelector('.btnSubmit').removeAttribute('disabled');
                document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - document.querySelector('#buy_more').value - document.querySelector('#discount_ncc').value}`;
            } else {
                document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - document.querySelector('#discount_ncc').value - document.querySelector('#discount_ncc').value}`;

            }

        });
        document.querySelector('.choose-product').addEventListener('change', (e) => {
            const value = e.target.value;
            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
            document.querySelector('.btnSubmit').classList.add('bg-slate-300');

            $.ajax({
                url: '{{route('screens.manufacture.product.chooseProduct')}}?_token={{csrf_token()}}&product_id=' + value,
                success: function (result) {
                    if (result) {
                        console.log(result)
                        document.querySelector('#price').value = result.pro.price;
                        document.querySelector('#discount_ncc').value = result.pro.discount;
                        document.querySelector('#buy_more').value = result.pro.buy_more;

                    } else {
                        document.querySelector('#price').value = 0 + ' đ';
                        document.querySelector('#buy_more').value = ''
                        document.querySelector('#discount_ncc').value = ''
                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                        document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - document.querySelector('#discount_ncc').value - document.querySelector('#discount_ncc').value}`;
                    }
                    // console.log(result);
                },
            });
        });

        let limit = document.getElementById('limit');
        console.log(limit)
        $(document).ready(function () {
            document.querySelectorAll('.sort').forEach(item => {
                const {sort} = item.dataset;
                item.addEventListener('click', () => {
                    let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                    if (orderBy === 'asc') {
                        localStorage.setItem('orderBy', JSON.stringify('desc'));
                    } else {
                        localStorage.setItem('orderBy', JSON.stringify('asc'));
                    }
                    setTimeout(() => {
                        document.location = '{{route('screens.manufacture.product.discount',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.manufacture.product.discount',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>
@endsection
