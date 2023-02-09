@extends('admin.layouts.master')
@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Quản lý slider</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin')}}">Quản trị</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{url('admin/banner/list')}}">Banner</a>
                                </li>
                                <li class="breadcrumb-item active">Sửa slider
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Validation -->
            <section class="bs-validation">
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-8 col-12" style="margin : 0 auto">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title fw-bolder">Sửa slider</h3>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation"  action="{{route('banner.edit_process',[$banner->id])}}" method="post" enctype="multipart/form-data">
                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Thêm Banner</label>

                                        <input type="file" id="basic-addon-name" class="form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="file_img" value="{{$banner->banner_img}}"/>
                                        <img src="{{asset('images/banner/'.$banner->banner_img)}}" width="100px" height="100px" alt="">

                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter your name.</div>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Link quảng cáo</label>
                                        <input type="text" id="basic-addon-name" class="form-control"  aria-label="Name" aria-describedby="basic-addon-name" name="location" required value="{{$banner->location}}"/>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter your name.</div>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Thêm</button>
                                    <button type="reset" class="btn btn-primary me-2">Nhập lại</button>
                                    <a href="{{route('banner.list')}}"><button type="button" class="btn btn-primary">Danh sách</button></a>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /Validation -->

        </div>
    </div>
</div>
    <!-- END: Content-->
@endsection