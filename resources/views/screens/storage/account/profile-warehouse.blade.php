@extends('layouts.storage.main')
@section('page_title','Hồ sơ của tôi')
@section('custom_css')
{{-- <link rel="stylesheet" href="{{asset('asset/css/style.css')}}"> --}}
<style>

.add-img-SP{
    cursor: pointer;
    width: 80px;
    height: 80px;
    border: 2px dashed;
    background-color: #FAFAFA;
    display:flex;
    justify-content:center;
    flex-direction:column;
    align-items:center;
    border-radius:2px;
    text-align: center;
    gap:4px;
}

.file-sp{
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 16px;
    z-index: 10;
    width: 100%;
}

.item{
    position: relative;
    width: 100%;
    height: 80px;
    z-index: 10;
}
.over-lay-img{
    background: rgba(0, 0, 0, 0.5);
    z-index: -1;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    overflow: hidden;
    opacity: 0;
    transition: 0.5s all;
}

.deleteImg{
    z-index: -1;
    width: 100%;
    height: 100%;
    position: absolute;
    opacity: 0;
    top: 0;
    transition: 0.5s all;
    cursor: pointer;
}
.file-sp .item:hover .over-lay-img{
    z-index: 1;
    opacity: 1;
    transition: 0.5s all;
}
.file-sp .item:hover .deleteImg{
    z-index: 10;
    opacity: 1;
}
.file-sp .item:hover .deleteImg svg{
z-index: 10;
position: relative;
}
</style>


@endsection
@section('modal')
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="img-zoom-full w-100 h-100">

    </div>
</div>
</div>
@endsection
@section('content')
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Quản lý thông tin kho</h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tài khoản</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Quản lý thông tin kho</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            @if(!empty($infoWarehouse))
                @foreach( $infoWarehouse as $value)
                @if( $value['type'] == 1 )
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="row">
                            <form action="{{route('update.storage.warehouse.profile')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="type" value="{{ $value['type'] }}">
                                @csrf
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                                        style="gap:10px">
                                        <h5 class="mb-0" style="font-size:18px;">Kho thường
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <form class="normal">
                                            <div class="row">
                                                <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                                    <div class="form-group">
                                                        <label style="font-weight: 600;" for="dts">Diện tích
                                                            (m2)</label>
                                                        <input class="form-control form-control-lg only-number" value="{{ $value['acreage'] }}" type="text" name="acreage" required placeholder="Nhập diện tích">
                                                    </div>
                                                </div>


                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                                    <div class="form-group">
                                                        <label style="font-weight: 600;" for="tts">Thể tích
                                                            (m3)</label>
                                                        <input class="form-control form-control-lg only-number" value="{{ $value['volume'] }}" type="text" name="volume" placeholder="Nhập thể tích">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <label style="font-weight: 600;" for="kt">Kích
                                                        thước
                                                        (m)</label>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="">Chiều dài:</label>
                                                                <input class="form-control form-control-lg only-number" value="{{ $value['length'] }}" type="text" name="length" placeholder="Nhập chiều dài">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="">Chiều rộng:</label>
                                                                <input class="form-control form-control-lg only-number" value="{{ $value['width'] }}" type="text" name="width" placeholder="Nhập chiều rộng">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="">Chiều cao:</label>
                                                                <input class="form-control form-control-lg only-number" value="{{ $value['height'] }}" type="text" name="height" placeholder="Nhập chiều cao">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <label style="font-weight: 600;" for="tts">Hình ảnh
                                                        kho</label>

                                                        <div class="d-flex align-items-start flex-wrap" style="gap: 16px;">
                                                            <div class="file-sp img-sp">
                                                                @if(!empty($value['image_storage']))
                                                                @foreach ($value['image_storage'] as $key => $img)
                                                                <div class="item" key={{$key}}>
                                                                    <div class="over-lay-img"></div>
                                                                    <div class="d-flex justify-content-center align-items-center deleteImg" style="gap:10px;">
                                                                    <svg width="16" height="16" class="zoom-img" onclick="zoomImg('{{$img}}')" style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.6822 7.5404C13.9894 3.97433 11.4305 2.17969 8.0001 2.17969C4.56796 2.17969 2.01082 3.97433 0.31796 7.54219C0.250059 7.68597 0.214844 7.843 0.214844 8.00201C0.214844 8.16102 0.250059 8.31805 0.31796 8.46183C2.01082 12.0279 4.56975 13.8225 8.0001 13.8225C11.4322 13.8225 13.9894 12.0279 15.6822 8.46005C15.8197 8.17076 15.8197 7.83505 15.6822 7.5404V7.5404ZM8.0001 12.5368C5.11975 12.5368 3.01082 11.0761 1.52332 8.00112C3.01082 4.92612 5.11975 3.4654 8.0001 3.4654C10.8805 3.4654 12.9894 4.92612 14.4769 8.00112C12.9912 11.0761 10.8822 12.5368 8.0001 12.5368ZM7.92867 4.85826C6.19296 4.85826 4.78582 6.2654 4.78582 8.00112C4.78582 9.73683 6.19296 11.144 7.92867 11.144C9.66439 11.144 11.0715 9.73683 11.0715 8.00112C11.0715 6.2654 9.66439 4.85826 7.92867 4.85826ZM7.92867 10.0011C6.82332 10.0011 5.92867 9.10647 5.92867 8.00112C5.92867 6.89576 6.82332 6.00112 7.92867 6.00112C9.03403 6.00112 9.92868 6.89576 9.92868 8.00112C9.92868 9.10647 9.03403 10.0011 7.92867 10.0011Z" fill="white" ></path>
                                                                    </svg>
                                                                    {{-- <svg class="delete-one-image" data-index="{{$key}}" width="16" height="16"  style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
                                                                    </svg> --}}
                                                                    </div>
                                                                    <img src="{{$img}}" class="w-100 img-old img-old-1"/>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                            <input type="hidden" class="input-image" name="normalImageStorage">
                                                            <div class=" add-img-SP add-imgSP" data-arrImg="1">
                                                                <svg width="14" height="14" class="cursor-pointer" viewBox="0 0 14 14" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M7.46838 1.37598H6.53088C6.44755 1.37598 6.40588 1.41764 6.40588 1.50098V6.40723H1.75C1.66667 6.40723 1.625 6.44889 1.625 6.53223V7.46973C1.625 7.55306 1.66667 7.59473 1.75 7.59473H6.40588V12.501C6.40588 12.5843 6.44755 12.626 6.53088 12.626H7.46838C7.55172 12.626 7.59338 12.5843 7.59338 12.501V7.59473H12.25C12.3333 7.59473 12.375 7.55306 12.375 7.46973V6.53223C12.375 6.44889 12.3333 6.40723 12.25 6.40723H7.59338V1.50098C7.59338 1.41764 7.55172 1.37598 7.46838 1.37598Z"
                                                                        fill="black" fill-opacity="0.85"/>
                                                                </svg>
                                                                <span style="font-size: 12px;">Tải hình ảnh</span>
                                                                <span class="countImage" style="font-size: 12px;"> {{ $value['image_storage'] ? count($value['image_storage']) : 0 }}/5</span>
                                                            </div>
                                                        </div>

                                                        <br>


                                                    </div>
                                                <div class="col-12 my-4">
                                                    <label style="font-weight: 600;" for="tts">Giấy chứng nhận
                                                        PCCC/Chứng nhận khác</label>
                                                        <div class="d-flex align-items-start flex-wrap" style="gap: 16px;">
                                                            <div class="file-sp img-sp">
                                                                @if(!empty($value['image_pccc']))
                                                                @foreach ($value['image_pccc'] as $key => $img)
                                                                <div class="item" key={{$key}}>
                                                                    <div class="over-lay-img"></div>
                                                                    <div class="d-flex justify-content-center align-items-center deleteImg" style="gap:10px;">
                                                                    <svg width="16" height="16" class="zoom-img" onclick="zoomImg('{{$img}}')" style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.6822 7.5404C13.9894 3.97433 11.4305 2.17969 8.0001 2.17969C4.56796 2.17969 2.01082 3.97433 0.31796 7.54219C0.250059 7.68597 0.214844 7.843 0.214844 8.00201C0.214844 8.16102 0.250059 8.31805 0.31796 8.46183C2.01082 12.0279 4.56975 13.8225 8.0001 13.8225C11.4322 13.8225 13.9894 12.0279 15.6822 8.46005C15.8197 8.17076 15.8197 7.83505 15.6822 7.5404V7.5404ZM8.0001 12.5368C5.11975 12.5368 3.01082 11.0761 1.52332 8.00112C3.01082 4.92612 5.11975 3.4654 8.0001 3.4654C10.8805 3.4654 12.9894 4.92612 14.4769 8.00112C12.9912 11.0761 10.8822 12.5368 8.0001 12.5368ZM7.92867 4.85826C6.19296 4.85826 4.78582 6.2654 4.78582 8.00112C4.78582 9.73683 6.19296 11.144 7.92867 11.144C9.66439 11.144 11.0715 9.73683 11.0715 8.00112C11.0715 6.2654 9.66439 4.85826 7.92867 4.85826ZM7.92867 10.0011C6.82332 10.0011 5.92867 9.10647 5.92867 8.00112C5.92867 6.89576 6.82332 6.00112 7.92867 6.00112C9.03403 6.00112 9.92868 6.89576 9.92868 8.00112C9.92868 9.10647 9.03403 10.0011 7.92867 10.0011Z" fill="white" ></path>
                                                                    </svg>
                                                                    {{-- <svg class="delete-one-image" data-index="{{$key}}" width="16" height="16"  style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
                                                                    </svg> --}}
                                                                    </div>
                                                                    <img src="{{$img}}" class="w-100 img-old img-old-2"/>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                            </div>
                                                            <input type="hidden" class="input-image" name="normalImagePccc">
                                                            <div class=" add-img-SP add-imgSP" data-arrImg="2">
                                                                <svg width="14" height="14" class="cursor-pointer" viewBox="0 0 14 14" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M7.46838 1.37598H6.53088C6.44755 1.37598 6.40588 1.41764 6.40588 1.50098V6.40723H1.75C1.66667 6.40723 1.625 6.44889 1.625 6.53223V7.46973C1.625 7.55306 1.66667 7.59473 1.75 7.59473H6.40588V12.501C6.40588 12.5843 6.44755 12.626 6.53088 12.626H7.46838C7.55172 12.626 7.59338 12.5843 7.59338 12.501V7.59473H12.25C12.3333 7.59473 12.375 7.55306 12.375 7.46973V6.53223C12.375 6.44889 12.3333 6.40723 12.25 6.40723H7.59338V1.50098C7.59338 1.41764 7.55172 1.37598 7.46838 1.37598Z"
                                                                        fill="black" fill-opacity="0.85"/>
                                                                </svg>
                                                                <span style="font-size: 12px;">Tải hình ảnh</span>
                                                                <span class="countImage" style="font-size: 12px;"> {{ $value['image_pccc'] ? count($value['image_pccc']) : 0 }}/5</span>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="mx-auto">
                                                    <button class="btn btn-primary">Cập nhật</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            </form>
                            <!-- ============================================================== -->
                            <!-- end data table  -->
                            <!-- ============================================================== -->
                        </div>
                    </div>
                @elseif($value['type'] == 2 )

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <div class="row">
                        <form action="{{route('update.storage.warehouse.profile')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="{{ $value['type'] }}">
                            @csrf
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                                    style="gap:10px">
                                    <h5 class="mb-0" style="font-size:18px;">Kho lạnh
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form class="gar">
                                        <div class="row">
                                            <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                                <div class="form-group">
                                                    <label style="font-weight: 600;" for="dts">Diện tích
                                                        (m2)</label>
                                                    <input class="form-control form-control-lg only-number" value="{{ $value['acreage'] }}" type="text" name="acreage" required placeholder="Nhập diện tích">
                                                </div>
                                            </div>


                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                                <div class="form-group">
                                                    <label style="font-weight: 600;" for="tts">Thể tích
                                                        (m3)</label>
                                                    <input class="form-control form-control-lg only-number" value="{{ $value['volume'] }}" type="text" name="volume" placeholder="Nhập thể tích">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <label style="font-weight: 600;" for="kt">Kích
                                                    thước
                                                    (m)</label>
                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="">Chiều dài:</label>
                                                            <input class="form-control form-control-lg only-number" value="{{ $value['length'] }}" type="text" name="length" placeholder="Nhập chiều dài">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="">Chiều rộng:</label>
                                                            <input class="form-control form-control-lg only-number" value="{{ $value['width'] }}" type="text" name="width" placeholder="Nhập chiều rộng">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="">Chiều cao:</label>
                                                            <input class="form-control form-control-lg only-number" value="{{ $value['height'] }}" type="text" name="height" placeholder="Nhập chiều cao">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-12">
                                                <label style="font-weight: 600;" for="tts">Hình ảnh
                                                    kho</label>

                                                    <div class="d-flex align-items-start flex-wrap" style="gap: 16px;">
                                                        <div class="file-sp img-sp">
                                                            @if(!empty($value['image_storage']))
                                                            @foreach ($value['image_storage'] as $key => $img)
                                                                <div class="item" key={{$key}}>
                                                                    <div class="over-lay-img"></div>
                                                                    <div class="d-flex justify-content-center align-items-center deleteImg" style="gap:10px;">
                                                                    <svg width="16" height="16" class="zoom-img" onclick="zoomImg('{{$img}}')" style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.6822 7.5404C13.9894 3.97433 11.4305 2.17969 8.0001 2.17969C4.56796 2.17969 2.01082 3.97433 0.31796 7.54219C0.250059 7.68597 0.214844 7.843 0.214844 8.00201C0.214844 8.16102 0.250059 8.31805 0.31796 8.46183C2.01082 12.0279 4.56975 13.8225 8.0001 13.8225C11.4322 13.8225 13.9894 12.0279 15.6822 8.46005C15.8197 8.17076 15.8197 7.83505 15.6822 7.5404V7.5404ZM8.0001 12.5368C5.11975 12.5368 3.01082 11.0761 1.52332 8.00112C3.01082 4.92612 5.11975 3.4654 8.0001 3.4654C10.8805 3.4654 12.9894 4.92612 14.4769 8.00112C12.9912 11.0761 10.8822 12.5368 8.0001 12.5368ZM7.92867 4.85826C6.19296 4.85826 4.78582 6.2654 4.78582 8.00112C4.78582 9.73683 6.19296 11.144 7.92867 11.144C9.66439 11.144 11.0715 9.73683 11.0715 8.00112C11.0715 6.2654 9.66439 4.85826 7.92867 4.85826ZM7.92867 10.0011C6.82332 10.0011 5.92867 9.10647 5.92867 8.00112C5.92867 6.89576 6.82332 6.00112 7.92867 6.00112C9.03403 6.00112 9.92868 6.89576 9.92868 8.00112C9.92868 9.10647 9.03403 10.0011 7.92867 10.0011Z" fill="white" ></path>
                                                                    </svg>
                                                                    {{-- <svg class="delete-one-image" data-index="{{$key}}" width="16" height="16"  style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
                                                                    </svg> --}}
                                                                    </div>
                                                                    <img src="{{$img}}" class="w-100 img-old img-old-3"/>
                                                                </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        <input type="hidden" class="input-image" name="coldImageStorage">
                                                        <div class=" add-img-SP add-imgSP" data-arrImg="3">
                                                            <svg width="14" height="14" class="cursor-pointer" viewBox="0 0 14 14" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M7.46838 1.37598H6.53088C6.44755 1.37598 6.40588 1.41764 6.40588 1.50098V6.40723H1.75C1.66667 6.40723 1.625 6.44889 1.625 6.53223V7.46973C1.625 7.55306 1.66667 7.59473 1.75 7.59473H6.40588V12.501C6.40588 12.5843 6.44755 12.626 6.53088 12.626H7.46838C7.55172 12.626 7.59338 12.5843 7.59338 12.501V7.59473H12.25C12.3333 7.59473 12.375 7.55306 12.375 7.46973V6.53223C12.375 6.44889 12.3333 6.40723 12.25 6.40723H7.59338V1.50098C7.59338 1.41764 7.55172 1.37598 7.46838 1.37598Z"
                                                                    fill="black" fill-opacity="0.85"/>
                                                            </svg>
                                                            <span style="font-size: 12px;">Tải hình ảnh</span>
                                                            <span class="countImage" style="font-size: 12px;"> {{ $value['image_storage'] ? count($value['image_storage']) : 0 }}/5</span>
                                                        </div>
                                                    </div>

                                                    <br>


                                                </div>
                                            <div class="col-12 my-4">
                                                <label style="font-weight: 600;" for="tts">Giấy chứng nhận
                                                    PCCC/Chứng nhận khác</label>
                                                    <div class="d-flex align-items-start flex-wrap" style="gap: 16px;">
                                                        <div class="file-sp img-sp">
                                                            @if(!empty($value['image_pccc']))
                                                            @foreach ($value['image_pccc'] as $key => $img)
                                                                <div class="item" key={{$key}}>
                                                                    <div class="over-lay-img"></div>
                                                                    <div class="d-flex justify-content-center align-items-center deleteImg" style="gap:10px;">
                                                                    <svg width="16" height="16" class="zoom-img" onclick="zoomImg('{{$img}}')" style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.6822 7.5404C13.9894 3.97433 11.4305 2.17969 8.0001 2.17969C4.56796 2.17969 2.01082 3.97433 0.31796 7.54219C0.250059 7.68597 0.214844 7.843 0.214844 8.00201C0.214844 8.16102 0.250059 8.31805 0.31796 8.46183C2.01082 12.0279 4.56975 13.8225 8.0001 13.8225C11.4322 13.8225 13.9894 12.0279 15.6822 8.46005C15.8197 8.17076 15.8197 7.83505 15.6822 7.5404V7.5404ZM8.0001 12.5368C5.11975 12.5368 3.01082 11.0761 1.52332 8.00112C3.01082 4.92612 5.11975 3.4654 8.0001 3.4654C10.8805 3.4654 12.9894 4.92612 14.4769 8.00112C12.9912 11.0761 10.8822 12.5368 8.0001 12.5368ZM7.92867 4.85826C6.19296 4.85826 4.78582 6.2654 4.78582 8.00112C4.78582 9.73683 6.19296 11.144 7.92867 11.144C9.66439 11.144 11.0715 9.73683 11.0715 8.00112C11.0715 6.2654 9.66439 4.85826 7.92867 4.85826ZM7.92867 10.0011C6.82332 10.0011 5.92867 9.10647 5.92867 8.00112C5.92867 6.89576 6.82332 6.00112 7.92867 6.00112C9.03403 6.00112 9.92868 6.89576 9.92868 8.00112C9.92868 9.10647 9.03403 10.0011 7.92867 10.0011Z" fill="white" ></path>
                                                                    </svg>
                                                                    {{-- <svg class="delete-one-image" data-index="{{$key}}" width="16" height="16"  style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
                                                                    </svg> --}}
                                                                    </div>
                                                                    <img src="{{$img}}" class="w-100 img-old img-old-4"/>
                                                                </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        <input type="hidden" class="input-image" name="coldImagePccc">
                                                        <div class=" add-img-SP add-imgSP" data-arrImg="4">
                                                            <svg width="14" height="14" class="cursor-pointer" viewBox="0 0 14 14" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M7.46838 1.37598H6.53088C6.44755 1.37598 6.40588 1.41764 6.40588 1.50098V6.40723H1.75C1.66667 6.40723 1.625 6.44889 1.625 6.53223V7.46973C1.625 7.55306 1.66667 7.59473 1.75 7.59473H6.40588V12.501C6.40588 12.5843 6.44755 12.626 6.53088 12.626H7.46838C7.55172 12.626 7.59338 12.5843 7.59338 12.501V7.59473H12.25C12.3333 7.59473 12.375 7.55306 12.375 7.46973V6.53223C12.375 6.44889 12.3333 6.40723 12.25 6.40723H7.59338V1.50098C7.59338 1.41764 7.55172 1.37598 7.46838 1.37598Z"
                                                                    fill="black" fill-opacity="0.85"/>
                                                            </svg>
                                                            <span style="font-size: 12px;">Tải hình ảnh</span>
                                                            <span class="countImage" style="font-size: 12px;"> {{ $value['image_pccc'] ? count($value['image_pccc']) : 0 }}/5</span>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="mx-auto">
                                                <button class="btn btn-primary">Cập nhật</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        </form>
                        <!-- ============================================================== -->
                        <!-- end data table  -->
                        <!-- ============================================================== -->
                    </div>
                </div>
                @elseif($value['type'] == 3 )

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <div class="row">
                        <form action="{{route('update.storage.warehouse.profile')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="{{ $value['type'] }}">
                            @csrf
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                                    style="gap:10px">
                                    <h5 class="mb-0" style="font-size:18px;">Kho bãi
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form class="cold">
                                        <div class="row">
                                            <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                                <div class="form-group">
                                                    <label style="font-weight: 600;" for="dts">Diện tích
                                                        (m2)</label>
                                                    <input class="form-control form-control-lg only-number" value="{{ $value['acreage'] }}" type="text" name="acreage" required placeholder="Nhập diện tích">
                                                </div>
                                            </div>


                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                                                <div class="form-group">
                                                    <label style="font-weight: 600;" for="tts">Thể tích
                                                        (m3)</label>
                                                        <input class="form-control form-control-lg only-number" value="{{ $value['volume'] }}" type="text" name="volume" placeholder="Nhập thể tích">
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <label style="font-weight: 600;" for="kt">Kích
                                                    thước
                                                    (m)</label>
                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="">Chiều dài:</label>
                                                            <input class="form-control form-control-lg only-number" value="{{ $value['length'] }}" type="text" name="length" placeholder="Nhập chiều dài">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="">Chiều rộng:</label>
                                                            <input class="form-control form-control-lg only-number" value="{{ $value['width'] }}" type="text" name="width" placeholder="Nhập chiều rộng">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="">Chiều cao:</label>
                                                            <input class="form-control form-control-lg only-number" value="{{ $value['height'] }}" type="text" name="height" placeholder="Nhập chiều cao">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-12">
                                                <label style="font-weight: 600;" for="tts">Hình ảnh
                                                    kho</label>

                                                    <div class="d-flex align-items-start flex-wrap" style="gap: 16px;">
                                                        <div class="file-sp img-sp">
                                                            @if(!empty($value['image_storage']))
                                                            @foreach ($value['image_storage'] as $key => $img)
                                                                <div class="item" key={{$key}}>
                                                                    <div class="over-lay-img"></div>
                                                                    <div class="d-flex justify-content-center align-items-center deleteImg" style="gap:10px;">
                                                                    <svg width="16" height="16" class="zoom-img" onclick="zoomImg('{{$img}}')" style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.6822 7.5404C13.9894 3.97433 11.4305 2.17969 8.0001 2.17969C4.56796 2.17969 2.01082 3.97433 0.31796 7.54219C0.250059 7.68597 0.214844 7.843 0.214844 8.00201C0.214844 8.16102 0.250059 8.31805 0.31796 8.46183C2.01082 12.0279 4.56975 13.8225 8.0001 13.8225C11.4322 13.8225 13.9894 12.0279 15.6822 8.46005C15.8197 8.17076 15.8197 7.83505 15.6822 7.5404V7.5404ZM8.0001 12.5368C5.11975 12.5368 3.01082 11.0761 1.52332 8.00112C3.01082 4.92612 5.11975 3.4654 8.0001 3.4654C10.8805 3.4654 12.9894 4.92612 14.4769 8.00112C12.9912 11.0761 10.8822 12.5368 8.0001 12.5368ZM7.92867 4.85826C6.19296 4.85826 4.78582 6.2654 4.78582 8.00112C4.78582 9.73683 6.19296 11.144 7.92867 11.144C9.66439 11.144 11.0715 9.73683 11.0715 8.00112C11.0715 6.2654 9.66439 4.85826 7.92867 4.85826ZM7.92867 10.0011C6.82332 10.0011 5.92867 9.10647 5.92867 8.00112C5.92867 6.89576 6.82332 6.00112 7.92867 6.00112C9.03403 6.00112 9.92868 6.89576 9.92868 8.00112C9.92868 9.10647 9.03403 10.0011 7.92867 10.0011Z" fill="white" ></path>
                                                                    </svg>
                                                                    {{-- <svg class="delete-one-image" data-index="{{$key}}" width="16" height="16"  style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
                                                                    </svg> --}}
                                                                    </div>
                                                                    <img src="{{$img}}" class="w-100 img-old img-old-5"/>
                                                                </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        <input type="hidden" class="input-image" name="warehouseImageStorage">
                                                        <div class=" add-img-SP add-imgSP" data-arrImg="5">
                                                            <svg width="14" height="14" class="cursor-pointer" viewBox="0 0 14 14" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M7.46838 1.37598H6.53088C6.44755 1.37598 6.40588 1.41764 6.40588 1.50098V6.40723H1.75C1.66667 6.40723 1.625 6.44889 1.625 6.53223V7.46973C1.625 7.55306 1.66667 7.59473 1.75 7.59473H6.40588V12.501C6.40588 12.5843 6.44755 12.626 6.53088 12.626H7.46838C7.55172 12.626 7.59338 12.5843 7.59338 12.501V7.59473H12.25C12.3333 7.59473 12.375 7.55306 12.375 7.46973V6.53223C12.375 6.44889 12.3333 6.40723 12.25 6.40723H7.59338V1.50098C7.59338 1.41764 7.55172 1.37598 7.46838 1.37598Z"
                                                                    fill="black" fill-opacity="0.85"/>
                                                            </svg>
                                                            <span style="font-size: 12px;">Tải hình ảnh</span>
                                                            <span class="countImage" style="font-size: 12px;"> {{ $value['image_storage'] ? count($value['image_storage']) : 0 }}/5</span>
                                                        </div>
                                                    </div>

                                                    <br>


                                                </div>
                                            <div class="col-12 my-4">
                                                <label style="font-weight: 600;" for="tts">Giấy chứng nhận
                                                    PCCC/Chứng nhận khác</label>
                                                    <div class="d-flex align-items-start flex-wrap" style="gap: 16px;">
                                                        <div class="file-sp img-sp">
                                                            @if(!empty($value['image_pccc']))
                                                            @foreach ($value['image_pccc'] as $key => $img)
                                                                <div class="item" key={{$key}}>
                                                                    <div class="over-lay-img"></div>
                                                                    <div class="d-flex justify-content-center align-items-center deleteImg" style="gap:10px;">
                                                                    <svg width="16" height="16" class="zoom-img" onclick="zoomImg('{{$img}}')" style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15.6822 7.5404C13.9894 3.97433 11.4305 2.17969 8.0001 2.17969C4.56796 2.17969 2.01082 3.97433 0.31796 7.54219C0.250059 7.68597 0.214844 7.843 0.214844 8.00201C0.214844 8.16102 0.250059 8.31805 0.31796 8.46183C2.01082 12.0279 4.56975 13.8225 8.0001 13.8225C11.4322 13.8225 13.9894 12.0279 15.6822 8.46005C15.8197 8.17076 15.8197 7.83505 15.6822 7.5404V7.5404ZM8.0001 12.5368C5.11975 12.5368 3.01082 11.0761 1.52332 8.00112C3.01082 4.92612 5.11975 3.4654 8.0001 3.4654C10.8805 3.4654 12.9894 4.92612 14.4769 8.00112C12.9912 11.0761 10.8822 12.5368 8.0001 12.5368ZM7.92867 4.85826C6.19296 4.85826 4.78582 6.2654 4.78582 8.00112C4.78582 9.73683 6.19296 11.144 7.92867 11.144C9.66439 11.144 11.0715 9.73683 11.0715 8.00112C11.0715 6.2654 9.66439 4.85826 7.92867 4.85826ZM7.92867 10.0011C6.82332 10.0011 5.92867 9.10647 5.92867 8.00112C5.92867 6.89576 6.82332 6.00112 7.92867 6.00112C9.03403 6.00112 9.92868 6.89576 9.92868 8.00112C9.92868 9.10647 9.03403 10.0011 7.92867 10.0011Z" fill="white" ></path>
                                                                    </svg>
                                                                    {{-- <svg class="delete-one-image" data-index="{{$key}}" width="16" height="16"  style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
                                                                    </svg> --}}
                                                                    </div>
                                                                    <img src="{{$img}}" class="w-100 img-old img-old-6"/>
                                                                </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                        <input type="hidden" class="input-image" name="warehouseImagePccc">
                                                        <div class=" add-img-SP add-imgSP" data-arrImg="6">
                                                            <svg width="14" height="14" class="cursor-pointer" viewBox="0 0 14 14" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M7.46838 1.37598H6.53088C6.44755 1.37598 6.40588 1.41764 6.40588 1.50098V6.40723H1.75C1.66667 6.40723 1.625 6.44889 1.625 6.53223V7.46973C1.625 7.55306 1.66667 7.59473 1.75 7.59473H6.40588V12.501C6.40588 12.5843 6.44755 12.626 6.53088 12.626H7.46838C7.55172 12.626 7.59338 12.5843 7.59338 12.501V7.59473H12.25C12.3333 7.59473 12.375 7.55306 12.375 7.46973V6.53223C12.375 6.44889 12.3333 6.40723 12.25 6.40723H7.59338V1.50098C7.59338 1.41764 7.55172 1.37598 7.46838 1.37598Z"
                                                                    fill="black" fill-opacity="0.85"/>
                                                            </svg>
                                                            <span style="font-size: 12px;">Tải hình ảnh</span>
                                                            <span class="countImage" style="font-size: 12px;"> {{ $value['image_pccc'] ? count($value['image_pccc']) : 0 }}/5</span>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="mx-auto">
                                                <button class="btn btn-primary">Cập nhật</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        </form>
                        <!-- ============================================================== -->
                        <!-- end data table  -->
                        <!-- ============================================================== -->
                    </div>
                </div>
                @endif
                @endforeach
            @endif
        </div>
    </div>

@endsection
@section('custom_js')
    <script>

        let i = 1;
        // let arrImage = [];
        let arrImage1 = [];
        let arrImage2 = [];
        let arrImage3 = [];
        let arrImage4 = [];
        let arrImage5 = [];
        let arrImage6 = [];
    $('.add-imgSP').on('click', function () {
        let checkArr = $(this).attr('data-arrImg') ;
        let arrImage;
        switch (checkArr) {
            case '1':
                arrImage = arrImage1;
                break;
            case '2':
                arrImage = arrImage2;
                break;
            case '3':
                arrImage = arrImage3;
                break;
            case '4':
                arrImage = arrImage4;
                break;
            case '5':
                arrImage = arrImage5;
                break;
            case '6':
                arrImage = arrImage6;
                break;
            default:
                break;
        }
        let input = document.createElement('input');
        input.type = 'file';
        input.onchange = _ => {
            var files = Array.from(input.files);
            const reader = new FileReader();
            return new Promise(resolve => {
                reader.onload = ev => {
                    resolve(ev.target.result)
                    arrImage.push(ev.target.result);
                    $(this).parent().siblings('.img-sp').append(` <div class="item" >
                    <img src="${ev.target.result}" style="width: 100%" alt="">
                    <div class="over-lay-img"></div>
                    <div class="d-flex justify-content-center align-items-center deleteImg" style="gap:10px">
                    <svg width="16" height="16" class="zoom-img" onclick="zoomImg('${arrImage}')" style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.6822 7.5404C13.9894 3.97433 11.4305 2.17969 8.0001 2.17969C4.56796 2.17969 2.01082 3.97433 0.31796 7.54219C0.250059 7.68597 0.214844 7.843 0.214844 8.00201C0.214844 8.16102 0.250059 8.31805 0.31796 8.46183C2.01082 12.0279 4.56975 13.8225 8.0001 13.8225C11.4322 13.8225 13.9894 12.0279 15.6822 8.46005C15.8197 8.17076 15.8197 7.83505 15.6822 7.5404V7.5404ZM8.0001 12.5368C5.11975 12.5368 3.01082 11.0761 1.52332 8.00112C3.01082 4.92612 5.11975 3.4654 8.0001 3.4654C10.8805 3.4654 12.9894 4.92612 14.4769 8.00112C12.9912 11.0761 10.8822 12.5368 8.0001 12.5368ZM7.92867 4.85826C6.19296 4.85826 4.78582 6.2654 4.78582 8.00112C4.78582 9.73683 6.19296 11.144 7.92867 11.144C9.66439 11.144 11.0715 9.73683 11.0715 8.00112C11.0715 6.2654 9.66439 4.85826 7.92867 4.85826ZM7.92867 10.0011C6.82332 10.0011 5.92867 9.10647 5.92867 8.00112C5.92867 6.89576 6.82332 6.00112 7.92867 6.00112C9.03403 6.00112 9.92868 6.89576 9.92868 8.00112C9.92868 9.10647 9.03403 10.0011 7.92867 10.0011Z" fill="white" ></path>
                        </svg>
                    <svg class="delete-one-image" width="16" height="16"  style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
                    </svg>
                    </div>

                </div>`)
                    if (arrImage.length >= 5) {
                        //   document.querySelector('.add-img-SP').classList.add('hidden');
                        $(this).addClass("hidden");
                    }
                    render(arrImage,$(this));
                }
                reader.readAsDataURL(files[0])
            })
        };
        input.click();
    })
    function zoomImg(img){
    $('.img-zoom-full').html(`<img src="${img}" style="width:100%" />`);
    $('#modalDetail').modal('show');
    }
    function render(data, elementInput) {
        const html = data.map((item, index) => {
            return `<div class="item" key=${index}>
                <div class="over-lay-img"></div>
                <div class="d-flex justify-content-center align-items-center deleteImg" style="gap:10px;">
                <svg width="16" height="16" class="zoom-img" onclick="zoomImg('${item}')" style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.6822 7.5404C13.9894 3.97433 11.4305 2.17969 8.0001 2.17969C4.56796 2.17969 2.01082 3.97433 0.31796 7.54219C0.250059 7.68597 0.214844 7.843 0.214844 8.00201C0.214844 8.16102 0.250059 8.31805 0.31796 8.46183C2.01082 12.0279 4.56975 13.8225 8.0001 13.8225C11.4322 13.8225 13.9894 12.0279 15.6822 8.46005C15.8197 8.17076 15.8197 7.83505 15.6822 7.5404V7.5404ZM8.0001 12.5368C5.11975 12.5368 3.01082 11.0761 1.52332 8.00112C3.01082 4.92612 5.11975 3.4654 8.0001 3.4654C10.8805 3.4654 12.9894 4.92612 14.4769 8.00112C12.9912 11.0761 10.8822 12.5368 8.0001 12.5368ZM7.92867 4.85826C6.19296 4.85826 4.78582 6.2654 4.78582 8.00112C4.78582 9.73683 6.19296 11.144 7.92867 11.144C9.66439 11.144 11.0715 9.73683 11.0715 8.00112C11.0715 6.2654 9.66439 4.85826 7.92867 4.85826ZM7.92867 10.0011C6.82332 10.0011 5.92867 9.10647 5.92867 8.00112C5.92867 6.89576 6.82332 6.00112 7.92867 6.00112C9.03403 6.00112 9.92868 6.89576 9.92868 8.00112C9.92868 9.10647 9.03403 10.0011 7.92867 10.0011Z" fill="white" ></path>

        </svg>
                <svg class="delete-one-image" data-index="${index}" width="16" height="16"  style="cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
                </svg>
                </div>

            <img src="${item}" class="w-100"></img></div>`;
        }).join("")

        elementInput.siblings('.img-sp').html(html);
        elementInput.find('.countImage').html( data.length +'/5');
        elementInput.siblings('.input-image').val(JSON.stringify(data));

        let checkArr = elementInput.attr('data-arrImg');
        let arrImage;
        

        document.querySelectorAll('.delete-one-image').forEach((item, indexDelete) => {
            const {index} = item.dataset;
            item.addEventListener('click', (e) => {

                // hafm xoá ảnh từ arr
                switch (checkArr) {
                    case '1':
                        arrImage1 = data.filter((item1, index1) =>{ return index1 !== +index});
                        arrImage = arrImage1;
                        break;
                    case '2':
                        arrImage2 = data.filter((item1, index1) =>{ return index1 !== +index});
                        arrImage = arrImage2;
                        break;
                    case '3':
                        arrImage3 = data.filter((item1, index1) =>{ return index1 !== +index});
                        arrImage = arrImage3;
                        break;
                    case '4':
                        arrImage4 = data.filter((item1, index1) =>{ return index1 !== +index});
                        arrImage = arrImage4;
                        break;
                    case '5':
                        arrImage5 = data.filter((item1, index1) =>{ return index1 !== +index});
                        arrImage = arrImage5;
                        break;
                    case '6':
                        arrImage6 = data.filter((item1, index1) =>{ return index1 !== +index});
                        arrImage = arrImage6;
                        break;
                    default:
                        break;
                }
                // arrImage = data.filter((item1, index1) =>{ return index1 !== +index});


                // hien the them anh
                var div = e.target.closest('.align-items-start');
                let addImgspElement = div.querySelector('.add-imgSP');
                if (arrImage.length < 5) {
                    addImgspElement.classList.remove('hidden');
                }
                render(arrImage,elementInput);
            })
        })
    }
    $(document).ready(function () {
        @if(Session::has('success'))
        const textSuccess = '{{ Session::get('success')}}';
        swalNoti('center', 'success', textSuccess,'', 500, true, 2200);
        @endif

        @if(Session::has('error'))
        swalNoti('center', 'error', 'Ảnh kho chưa có ','', 500, true, 2200);
        @endif

        function getBase64Image(img) {
            var canvas = document.createElement("canvas");
            canvas.width = img.width;
            canvas.height = img.height;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0);
            var dataURL = canvas.toDataURL("image/png");
            // return dataURL;
            return dataURL.replace(/^data:image\/?[A-z]*;base64,/);
        }
        function getBase64Imagev2(img) {
            var c = document.createElement('canvas');
            var img = document.getElementById('Img1');
            c.height = img.naturalHeight;
            c.width = img.naturalWidth;
            var ctx = c.getContext('2d');

            ctx.drawImage(img, 0, 0, c.width, c.height);
            var base64String = c.toDataURL();
        }
        oldImage('.img-old-1',arrImage1, 'normalImageStorage');
        oldImage('.img-old-2',arrImage2,'normalImagePccc');
        oldImage('.img-old-3',arrImage3, 'coldImageStorage');
        oldImage('.img-old-4',arrImage4, 'coldImagePccc');
        oldImage('.img-old-5',arrImage5, 'warehouseImageStorage');
        oldImage('.img-old-6',arrImage6, 'warehouseImagePccc');
        function oldImage(elementOldImage,arrImg, nameInput) {
            let inputs = document.querySelectorAll(elementOldImage);
            var arrRequest = []
            inputs.forEach((item, index) => {
                let c = document.createElement('canvas');
                let img = item;
                c.height = img.naturalHeight;
                c.width = img.naturalWidth;
                let ctx = c.getContext('2d');
                ctx.drawImage(img, 0, 0, c.width, c.height);
                let base64String = c.toDataURL();
                arrImg.push(base64String);
                document.getElementsByName(nameInput)[0].value = JSON.stringify(arrImg);

                if( index >=4){
                    $(elementOldImage).closest('.img-sp').siblings('.add-imgSP').addClass('hidden');
                }
            });

        }

    });

    </script>

@endsection
