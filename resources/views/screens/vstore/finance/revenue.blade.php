@extends('layouts.vstore.main')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">
        <div class="col-span-3">

            <div class="p-6">
                <ul class="tab-sub-user">
                    <li class="active"><a href="./doanh-thu.html" class="flex justify-start items-center gap-2"><svg fill="#000000" width="24" height="24" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <title>stats1</title>
                                <path d="M6.987 5h-0.987v23h20v-0.963l-18.996-0.050-0.017-21.987zM14 13.812l-5-5v16.188h5v-11.188zM15 13.125v11.875h5v-12.875l-2-2-3 3zM21 16v9h5v-9h-5zM18.119 7.371l5.242 5.259-1.467 1.39 4.103 0.044-0.019-3.961-1.771 1.719-6.086-6.175-3.745 3.787-4.317-4.314-0.877 0.911 5.123 5.168 3.814-3.828z"></path>
                            </svg> Doanh thu</a></li>
                </ul>
            </div>
        </div>
        <div class="col-span-9 ">
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
                                    <td>Xe hơi</td>


                                    <td>
                                        1.000.000.000
                                    </td>
                                    <td>
                                        5
                                    </td>
                                    <td>
                                        900.000.000
                                    </td>
                                    <td>880.000.000</td>

                                </tr>

                                <tr>
                                    <td>Xe hơi</td>


                                    <td>
                                        1.000.000.000
                                    </td>
                                    <td>
                                        5
                                    </td>
                                    <td>
                                        900.000.000
                                    </td>
                                    <td>880.000.000</td>

                                </tr>
                                <tr>
                                    <td>Xe hơi</td>


                                    <td>
                                        1.000.000.000
                                    </td>
                                    <td>
                                        5
                                    </td>
                                    <td>
                                        900.000.000
                                    </td>
                                    <td>880.000.000</td>

                                </tr>
                                <tr>
                                    <td>Xe hơi</td>


                                    <td>
                                        1.000.000.000
                                    </td>
                                    <td>
                                        5
                                    </td>
                                    <td>
                                        900.000.000
                                    </td>
                                    <td>880.000.000</td>

                                </tr>
                                <tr>
                                    <td>Xe hơi</td>


                                    <td>
                                        1.000.000.000
                                    </td>
                                    <td>
                                        5
                                    </td>
                                    <td>
                                        900.000.000
                                    </td>
                                    <td>880.000.000</td>

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
