@extends('layouts.vstore.main')
@section('page_title','Doanh thu')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">

        <div class="col-span-12 ">
            <div class="brc flex justify-start items-center gap-2 py-4">
                <span class="text-secondary">Tài chính</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18"
                          stroke="black"
                          stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <a href="" class="text-blueMain font-medium italic">Doanh thu</a>
            </div>

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
                                <tr>
                                    <td colspan="5">Không tìm thấy dữ liệu phù hợp</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
