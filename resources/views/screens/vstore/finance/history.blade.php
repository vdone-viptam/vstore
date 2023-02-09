@extends('layouts.vstore.main')
@section('page_title','Lịch sử giao dịch')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">

        <div class="col-span-12 ">
            <div class="box w-full">
                <div class="flex flex-col justify-start items-start w-full p-6">
                    <div class="flex flex-col justify-start items-start gap-1 pb-6 border-b-[1px] border-grey w-full">
                        <h3 class="captilize font-medium text-xl text-title">Lịch sử thay đổi số dư của tôi</h3>
                        <span class="text-secondary text-sm">Quản lý lịch sử thay đổi số dư của bạn</span>
                    </div>
                    <div class=" pt-6 w-full md:p-6 ">
                        <div class="w-full overflow-scroll">
                            <table class="w-full dsth">
                                <thead>
                                <tr>
                                    <th>Mã giao dịch</th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th>
                                        Số tiền
                                    </th>
                                    <th>
                                        Số dư
                                    </th>
                                    <th>
                                        Nội dung
                                    </th>
                                    <th>
                                        Ngày giao dịch
                                    </th>


                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>GD-0231</td>

                                    <td class="text-[#52C41A]">
                                        Thành công
                                    </td>
                                    <td>
                                        10.000.000
                                    </td>
                                    <td>
                                        2.000.000.000
                                    </td>
                                    <td>
                                        Chuyển khoản ra ngoài
                                    </td>


                                    <td>
                                        10/4/2022
                                    </td>
                                </tr>
                                <tr>
                                    <td>GD-0231</td>

                                    <td class="text-[#FF4D4F]">
                                        Thất bại
                                    </td>
                                    <td>
                                        10.000.000
                                    </td>
                                    <td>
                                        2.000.000.000
                                    </td>
                                    <td>
                                        Chuyển khoản ra ngoài
                                    </td>


                                    <td>
                                        10/4/2022
                                    </td>
                                </tr>
                                <tr>
                                    <td>GD-0231</td>

                                    <td class="text-[#52C41A]">
                                        Thành công
                                    </td>
                                    <td>
                                        10.000.000
                                    </td>
                                    <td>
                                        2.000.000.000
                                    </td>
                                    <td>
                                        Chuyển khoản ra ngoài
                                    </td>


                                    <td>
                                        10/4/2022
                                    </td>
                                </tr>
                                <tr>
                                    <td>GD-0231</td>

                                    <td class="text-[#52C41A]">
                                        Thành công
                                    </td>
                                    <td>
                                        10.000.000
                                    </td>
                                    <td>
                                        2.000.000.000
                                    </td>
                                    <td>
                                        Chuyển khoản ra ngoài
                                    </td>


                                    <td>
                                        10/4/2022
                                    </td>
                                </tr>
                                <tr>
                                    <td>GD-0231</td>

                                    <td class="text-[#52C41A]">
                                        Thành công
                                    </td>
                                    <td>
                                        10.000.000
                                    </td>
                                    <td>
                                        2.000.000.000
                                    </td>
                                    <td>
                                        Chuyển khoản ra ngoài
                                    </td>


                                    <td>
                                        10/4/2022
                                    </td>
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
