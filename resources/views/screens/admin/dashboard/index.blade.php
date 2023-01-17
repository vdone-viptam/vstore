@extends('layouts.admin.main')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">
        <div class="col-span-8 flex flex-col justify-start items-start gap-10">
            <div class="box result p-4 xl:p-10 w-full">
                <div class="item flex flex-col justify-start items-start gap-14">
                    <div class="flex flex-col justify-start items-start gap-2">
                        <span class="text-title font-medium text-2xl">Kết quả bán hàng:</span>
                        <select name="" id=""
                                class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                            <option value="0">Theo ngày</option>
                            <option value="0">Theo tuần</option>
                            <option value="0">Theo tháng</option>
                            <option value="0">Theo năm</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 xl:gap-8 w-full">
                        <div class="flex flex-col justify-start items-start bg-[#E6F7FF] rounded-2xl p-6 w-full gap-2">
                            <div class="flex justify-start items-start gap-2">
                                <svg width="24" height="24" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 17.4736C13.6318 17.4736 17.4668 13.6304 17.4668 9.00684C17.4668 4.375 13.6235 0.540039 8.9917 0.540039C4.36816 0.540039 0.533203 4.375 0.533203 9.00684C0.533203 13.6304 4.37646 17.4736 9 17.4736ZM9 13.896C8.76758 13.896 8.59326 13.73 8.59326 13.4893V12.875C7.44775 12.7671 6.49316 12.1362 6.25244 11.1484C6.22754 11.0654 6.21094 10.9741 6.21094 10.8828C6.21094 10.584 6.41846 10.3765 6.70898 10.3765C6.96631 10.3765 7.14062 10.5093 7.24023 10.8081C7.38135 11.3726 7.82959 11.8042 8.59326 11.9121V9.38867L8.53516 9.37207C7.10742 9.03174 6.36865 8.38428 6.36865 7.29688C6.36865 6.12646 7.29834 5.31299 8.59326 5.17188V4.58252C8.59326 4.3418 8.76758 4.17578 9 4.17578C9.23242 4.17578 9.40674 4.3418 9.40674 4.58252V5.17188C10.5024 5.29639 11.3823 5.93555 11.6064 6.85693C11.623 6.94824 11.6479 7.03955 11.6479 7.12256C11.6479 7.42139 11.4321 7.62891 11.1416 7.62891C10.8677 7.62891 10.7017 7.46289 10.6187 7.20557C10.4443 6.63281 10.021 6.26758 9.40674 6.15967V8.54199L9.52295 8.56689C11.0088 8.83252 11.7642 9.53809 11.7642 10.7002C11.7642 11.9951 10.7266 12.7671 9.40674 12.8916V13.4893C9.40674 13.73 9.23242 13.896 9 13.896ZM8.59326 8.32617V6.15967C7.87109 6.28418 7.43115 6.72412 7.43115 7.23877C7.43115 7.74512 7.77148 8.08545 8.53516 8.30957L8.59326 8.32617ZM9.40674 9.58789V11.9121C10.2783 11.8125 10.7017 11.356 10.7017 10.7583C10.7017 10.2188 10.4194 9.86182 9.58936 9.6377L9.40674 9.58789Z"
                                        fill="#FAAD14"/>
                                </svg>
                                <span class="text-sm font-medium text-[#1C1C1C]">5 đơn hàng đã xong</span>
                            </div>
                            <div class="flex justify-start items-center gap-2 w-full flex-wrap">
                                <span class="text-2xl font-semibold text-[#1C1C1C]">7.210.000đ</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 18.4736C14.6318 18.4736 18.4668 14.6304 18.4668 10.0068C18.4668 5.375 14.6235 1.54004 9.9917 1.54004C5.36816 1.54004 1.5332 5.375 1.5332 10.0068C1.5332 14.6304 5.37646 18.4736 10 18.4736ZM10.0083 14.29C9.63477 14.29 9.36084 14.0244 9.36084 13.6426V9.38428L9.43555 7.56641L8.58057 8.5957L7.56787 9.6167C7.45166 9.73291 7.28564 9.80762 7.11133 9.80762C6.75439 9.80762 6.48877 9.53369 6.48877 9.18506C6.48877 9.00244 6.53857 8.85303 6.65479 8.73682L9.51025 5.88965C9.68457 5.71533 9.82568 5.64893 10.0083 5.64893C10.1992 5.64893 10.3486 5.72363 10.5146 5.88965L13.3618 8.73682C13.478 8.85303 13.5444 9.00244 13.5444 9.18506C13.5444 9.53369 13.2705 9.80762 12.9136 9.80762C12.731 9.80762 12.5732 9.74121 12.457 9.6167L11.4526 8.5957L10.5811 7.55811L10.6558 9.38428V13.6426C10.6558 14.0244 10.3901 14.29 10.0083 14.29Z"
                                        fill="#52C41A"/>
                                </svg>
                                <span class="text-xs text-[#1C1C1C]">11.01%</span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-center items-center bg-[#E6F7FF] rounded-2xl p-6 w-full gap-2">
                            <div class="flex justify-start items-start gap-2 w-full">
                                <svg width="24" height="24" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.33301 17.4819C13.9648 17.4819 17.7998 13.647 17.7998 9.01514C17.7998 4.3916 13.9565 0.54834 9.32471 0.54834C4.70117 0.54834 0.866211 4.3916 0.866211 9.01514C0.866211 13.647 4.70947 17.4819 9.33301 17.4819ZM12.7197 6.62451L11.6987 5.61182L12.3296 4.98096C12.6118 4.71533 12.9272 4.68213 13.1846 4.93945L13.3755 5.13867C13.6411 5.396 13.6245 5.71973 13.3423 6.00195L12.7197 6.62451ZM6.59375 12.7256L5.40674 13.1738C5.22412 13.2402 5.0166 13.0576 5.10791 12.8418L5.58936 11.7129L11.1841 6.11816L12.2051 7.13916L6.59375 12.7256Z"
                                        fill="#FA8C16"/>
                                </svg>
                                <span class="text-sm font-medium text-[#1C1C1C]">Đơn hàng đang phục vụ</span>
                            </div>
                            <div class="flex justify-start items-center gap-2 w-full flex-wrap">
                                <span class="text-2xl font-semibold text-[#1C1C1C]">3</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 18.4736C14.6318 18.4736 18.4668 14.6304 18.4668 10.0068C18.4668 5.375 14.6235 1.54004 9.9917 1.54004C5.36816 1.54004 1.5332 5.375 1.5332 10.0068C1.5332 14.6304 5.37646 18.4736 10 18.4736ZM10.0083 14.29C9.63477 14.29 9.36084 14.0244 9.36084 13.6426V9.38428L9.43555 7.56641L8.58057 8.5957L7.56787 9.6167C7.45166 9.73291 7.28564 9.80762 7.11133 9.80762C6.75439 9.80762 6.48877 9.53369 6.48877 9.18506C6.48877 9.00244 6.53857 8.85303 6.65479 8.73682L9.51025 5.88965C9.68457 5.71533 9.82568 5.64893 10.0083 5.64893C10.1992 5.64893 10.3486 5.72363 10.5146 5.88965L13.3618 8.73682C13.478 8.85303 13.5444 9.00244 13.5444 9.18506C13.5444 9.53369 13.2705 9.80762 12.9136 9.80762C12.731 9.80762 12.5732 9.74121 12.457 9.6167L11.4526 8.5957L10.5811 7.55811L10.6558 9.38428V13.6426C10.6558 14.0244 10.3901 14.29 10.0083 14.29Z"
                                        fill="#52C41A"/>
                                </svg>
                                <span class="text-xs text-[#1C1C1C]">25.01%</span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col justify-center items-center bg-[#E6F7FF] rounded-2xl p-6 w-full gap-2">
                            <div class="flex justify-start items-center gap-2 w-full">
                                <svg width="24" height="24" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9 17.4736C13.6318 17.4736 17.4668 13.6304 17.4668 9.00684C17.4668 4.375 13.6235 0.540039 8.9917 0.540039C4.36816 0.540039 0.533203 4.375 0.533203 9.00684C0.533203 13.6304 4.37646 17.4736 9 17.4736ZM9 13.896C8.76758 13.896 8.59326 13.73 8.59326 13.4893V12.875C7.44775 12.7671 6.49316 12.1362 6.25244 11.1484C6.22754 11.0654 6.21094 10.9741 6.21094 10.8828C6.21094 10.584 6.41846 10.3765 6.70898 10.3765C6.96631 10.3765 7.14062 10.5093 7.24023 10.8081C7.38135 11.3726 7.82959 11.8042 8.59326 11.9121V9.38867L8.53516 9.37207C7.10742 9.03174 6.36865 8.38428 6.36865 7.29688C6.36865 6.12646 7.29834 5.31299 8.59326 5.17188V4.58252C8.59326 4.3418 8.76758 4.17578 9 4.17578C9.23242 4.17578 9.40674 4.3418 9.40674 4.58252V5.17188C10.5024 5.29639 11.3823 5.93555 11.6064 6.85693C11.623 6.94824 11.6479 7.03955 11.6479 7.12256C11.6479 7.42139 11.4321 7.62891 11.1416 7.62891C10.8677 7.62891 10.7017 7.46289 10.6187 7.20557C10.4443 6.63281 10.021 6.26758 9.40674 6.15967V8.54199L9.52295 8.56689C11.0088 8.83252 11.7642 9.53809 11.7642 10.7002C11.7642 11.9951 10.7266 12.7671 9.40674 12.8916V13.4893C9.40674 13.73 9.23242 13.896 9 13.896ZM8.59326 8.32617V6.15967C7.87109 6.28418 7.43115 6.72412 7.43115 7.23877C7.43115 7.74512 7.77148 8.08545 8.53516 8.30957L8.59326 8.32617ZM9.40674 9.58789V11.9121C10.2783 11.8125 10.7017 11.356 10.7017 10.7583C10.7017 10.2188 10.4194 9.86182 9.58936 9.6377L9.40674 9.58789Z"
                                        fill="#FAAD14"/>
                                </svg>
                                <span class="text-sm font-medium text-[#1C1C1C]">Khách hàng</span>
                            </div>
                            <div class="flex justify-start items-center gap-2 w-full">
                                <span class="text-2xl font-semibold text-[#1C1C1C]">1,156</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 18.4736C14.6318 18.4736 18.4668 14.6304 18.4668 10.0068C18.4668 5.375 14.6235 1.54004 9.9917 1.54004C5.36816 1.54004 1.5332 5.375 1.5332 10.0068C1.5332 14.6304 5.37646 18.4736 10 18.4736ZM10.0083 14.29C9.63477 14.29 9.36084 14.0244 9.36084 13.6426V9.38428L9.43555 7.56641L8.58057 8.5957L7.56787 9.6167C7.45166 9.73291 7.28564 9.80762 7.11133 9.80762C6.75439 9.80762 6.48877 9.53369 6.48877 9.18506C6.48877 9.00244 6.53857 8.85303 6.65479 8.73682L9.51025 5.88965C9.68457 5.71533 9.82568 5.64893 10.0083 5.64893C10.1992 5.64893 10.3486 5.72363 10.5146 5.88965L13.3618 8.73682C13.478 8.85303 13.5444 9.00244 13.5444 9.18506C13.5444 9.53369 13.2705 9.80762 12.9136 9.80762C12.731 9.80762 12.5732 9.74121 12.457 9.6167L11.4526 8.5957L10.5811 7.55811L10.6558 9.38428V13.6426C10.6558 14.0244 10.3901 14.29 10.0083 14.29Z"
                                        fill="#52C41A"/>
                                </svg>
                                <span class="text-xs text-[#1C1C1C]">16.01%</span>
                            </div>
                        </div>
                    </div>
                    <div class="char p-4 xl:p-10 w-full">
                        <canvas id="bar-chart-grouped" width="800" height="450"></canvas>
                        <!-- <canvas id="line-chart" width="800" height="350"></canvas> -->
                    </div>
                    <div class="char p-4 xl:p-10 w-full">
                        <canvas id="bar-chart" width="800" height="350"></canvas>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-span-4">
            <div class="flex flex-col justify-start items-start gap-10">

                <div class="box history p-4 xl:p-10 w-full">
                    <div class="flex flex-col justify-start items-start gap-4 w-full">
                        <h2 class="text-lg font-medium text-[#27272A]">Hoạt động gần đây</h2>
                        @if(count(Auth::user()->notifications) > 0)
                            @foreach (Auth::user()->notifications as $index =>$notification)

                                <div class="flex justify-start items-start gap-2 w-full">
                                    <div class="w-[24px] h-[24px] rounded-full">
                                        <img
                                            src="{{$notification['data']['avatar'] != 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg' ?  asset('image/users/'.$notification['data']['avatar']) : 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg'}}"
                                            alt="" class="w-full">
                                    </div>
                                    <div class="flex flex-col justify-start items-start">
                                            <span class="text-sm "><a
                                                    href="{{$notification['data']['href']}}&noti_id={{$notification->id}}"
                                                    class="font-bold">{{$notification['data']['message']}}</span>
                                        <span
                                            class="text-xs text-secondary">{{\Illuminate\Support\Carbon::parse($notification->created_at)->format('h:i A')}}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex justify-start items-start gap-2 w-full"><p>Bạn chưa có thông báo mới
                                    nào</p></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        $(document).ready(function () {
            new Chart(document.getElementById("bar-chart-grouped"), {
                type: 'bar',
                data: {
                    labels: ["01/2021", "02/2021", "03/2021", "04/2021", "05/2021", "06/2021", "07/2021", "08/2021", "09/2021", "10/2021", "11/2021", "12/2021"],
                    datasets: [
                        {
                            label: "Africa",
                            backgroundColor: "#3e95cd",
                            data: ['110000', '120000', '140000', '125000', '160000', '180000', '160000', '150000', '200000', '210000', '190000', '220000',]
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Doanh số'
                    }, legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem) {
                                console.log(tooltipItem)
                                return tooltipItem.yLabel;
                            }
                        }
                    }
                }
            });
            new Chart(document.getElementById("bar-chart"), {
                type: 'bar',
                data: {
                    labels: ["01/2021", "02/2021", "03/2021", "04/2021", "05/2021", "06/2021", "07/2021", "08/2021", "09/2021", "10/2021", "11/2021", "12/2021"],
                    datasets: [
                        {
                            label: "Population (millions)",
                            backgroundColor: "#3e95cd",
                            data: [426, 434, 468, 523, 584, 596, 524, 612, 618, 694, 648, 688]
                        }
                    ]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: 'Số đơn hàng'
                    }
                }
            });
        })

    </script>
@endsection
