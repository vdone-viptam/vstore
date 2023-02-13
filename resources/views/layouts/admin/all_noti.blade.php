@extends('layouts.admin.main')
@section('page_title','Tất cả thông báo')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">
        <div class="col-span-12 flex flex-col justify-start items-start gap-10">
            <div class="box result p-4 xl:p-10 w-full">
                <div class="flex flex-col justify-start items-start gap-4">
                    <span class="text-title font-medium text-xl uppercase">Thông báo</span>
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        @if(count(Auth::user()->notifications) > 0)
                            @foreach (Auth::user()->notifications as $index =>$notification)
                                <div
                                    class="flex justify-between items-start md:gap-6 w-full flex-wrap gap-2 md:flex-nowrap">
                                    <div class="w-full">
                                        <span>{{$notification['data']['message']}}</span>
                                    </div>
                                    <div class="w-[150px] flex justify-start md:justify-end items-center gap-2">
                                        <span
                                            class="text-title font-medium">{{\Carbon\Carbon::parse($notification->created_at)->format('d/m/Y h:i')}}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div
                                class="flex justify-between items-start md:gap-6 w-full flex-wrap gap-2 md:flex-nowrap">
                                <p>Bạn chưa có thông báo mới nào</p></div>
                        @endif


                    </div>

                </div>
            </div>

        </div>


    </div>
@endsection


