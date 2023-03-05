@extends('layouts.vstore.main')
@section('page_title','Doanh thu')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">

        <div class="col-span-12 ">
            <div class="box w-full">
                <div class="flex flex-col justify-start items-start w-full p-6">
                    <div class="flex flex-col justify-start items-start gap-1 pb-6 border-b-[1px] border-grey w-full">
                        <h3 class="captilize font-medium text-xl text-title">Doanh thu của tôi</h3>
                        <span class="text-secondary text-sm">Quản lý doanh thu của bạn để nâng cao lợi nhuận</span>
                    </div>
                    <div class=" pt-6 w-full md:p-6 ">
                        <div class="w-full overflow-scroll">
                            <table class="w-full dsth">
                                <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>
                                        Giá bán
                                    </th>
                                    <th>
                                        Số lượng
                                    </th>
                                    <th>
                                        Giá trị
                                    </th>
                                    <th>
                                        Giá trị trừ chiết khấu
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
{{--                                <tr>--}}
{{--                                    <td>Xe hơi</td>--}}


{{--                                    <td>--}}
{{--                                        1.000.000.000--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        5--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        900.000.000--}}
{{--                                    </td>--}}
{{--                                    <td>880.000.000</td>--}}

{{--                                </tr>--}}


                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
