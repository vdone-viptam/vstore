@extends('layouts.admin.main')

@section('content')
    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary">Danh mục sản phẩm</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                  stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <a href="../them-san-pham/" class="text-blueMain font-medium">Cập nhật danh mục</a>
    </div>
    <div class="px-5 xl:px-16 py-2">
        <h2 class="text-4xl text-title font-medium pb-1">Thay đổi thông tin danh mục</h2>
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <p style="color: green">{{\Illuminate\Support\Facades\Session::get('success')}}</p>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('error'))
            <p style="color: red">{{\Illuminate\Support\Facades\Session::get('error')}}</p>
        @endif
    </div>

    <form method="POST" action="{{route('screens.admin.category.update',['id' => $currentCategory->id])}}"
          enctype="multipart/form-data">
        @csrf
        <div class=" gap-y-4 lg:gap-4 px-5 xl:px-16 py-4">
            <div class=" lg:order-first">
                <div class="box-act flex flex-col justify-start items-start gap-4 p-5">
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Tên danh mục</span>
                        <input type="text" value="{{$currentCategory->name}}"
                               placeholder="Vui lòng nhập tên danh mục sản phẩm"
                               name="name" id="name"
                               class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    </div>
                    @error('name')
                    <p style="color: red">{{$message}}</p>
                    @enderror
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Danh mục cha</span>
                        <select name="parent_id" id="parent_id"
                                class="outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            <option value="0" {{$currentCategory->parent_id == 0 ? 'selected' : ''}}>Danh mục không
                                cha
                            </option>
                            @foreach($categories as $category)
                                <option
                                        value="{{$category->id}}" {{$currentCategory->parent_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('parent_id')
                    <p style="color: red">{{$message}}</p>
                    @enderror
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Ảnh mô tả</span>
                        <input name="img" id="img" type="file"
                               class="outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        <img src="{{asset('image/category/'.$currentCategory->img)}}" style="height: 100px" alt="">
                    </div>
                    @error('img')
                    <p style="color: red">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex justify-center flex-wrap md:flex-nowrap md:justify-end items-center gap-5 py-10">
                    <a href="{{route('screens.admin.category.index')}}"
                       class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-[15px] py-[6px] transition-all duration-500 hover:opacity-70 text-title">
                        Quay về trang danh sách
                    </a>
                    <button type="submit"
                            class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-[15px] py-[6px] transition-all duration-500 hover:opacity-70 bg-primary text-[#FFF]">
                        Lưu thay đổi
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
