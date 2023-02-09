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
                        <h2 class="content-header-title float-start mb-0">Thêm Danh mục</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{url('admin/category/list')}}">Danh
                                        mục</a>
                                </li>
                                <li class="breadcrumb-item active">Thêm mới
                                </li>
                            </ol>
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
                                    <h3 class="card-title fw-bolder">Thêm danh mục</h3>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" method="POST"
                                        action="{{url('/admin/category/create')}}" novalidate enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-1">
                                            <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Tên danh
                                                mục</label>
                                            <input type="text" name="category_name" id="basic-addon-name" value="{{old('category_name')}}"
                                                class="form-control" placeholder="Nhập tên danh mục" aria-label="Name" 
                                                aria-describedby="basic-addon-name" />
                                            @error('category_name')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <label for="customFile1" class="form-label fs-5 fw-bolder">Ảnh danh
                                                mục</label>
                                            <input class="form-control" type="file" id="customFile1" value="{{old('category_image')}}"
                                                name="category_image" />
                                            @error('category_image')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label fs-5 fw-bolder" for="select-country1">Danh
                                                mục</label>
                                            <select class="form-select" id="select-country1"  name="parent_id">
                                                <option value="">Danh mục cha</option>
                                                {!! $categorySelect !!}
                                            </select>
                                            @error('parent_id')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please select your country</div>
                                        </div>

                                        <button type="submit" class="btn btn-primary me-2">Thêm</button>
                                        <button type="reset" class="btn btn-primary me-2">Nhập lại</button>
                                        <a href="{{url('/admin/category/list')}}"><button type="button"
                                                class="btn btn-primary">Danh sách</button></a>
                                    </form>
                                </div>
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