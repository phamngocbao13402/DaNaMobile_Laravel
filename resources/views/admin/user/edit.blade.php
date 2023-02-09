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
                        <h2 class="content-header-title float-start mb-0">Quản lý Khách hàng</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin')}}">Quản trị</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{url('admin/user/list')}}">Khách hàng</a>
                                </li>
                                <li class="breadcrumb-item active">Cập nhật Khách hàng
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
                                <h3 class="card-title fw-bolder">Cập nhật Khách hàng</h3>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" novalidate action="{{url('admin/user/update', [$user->id])}}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Mã khách hàng</label>
                                        <input type="text" id="basic-addon-name" class="form-control" value="{{$user->id}}" readonly placeholder="" aria-label="Name" name="title" aria-describedby="basic-addon-name" required />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Chức năng</label>
                                        <select class="form-control" name="role">
                                            <option value="0">Khách hàng</option>
                                            <option value="1">Senior Admin</option>
                                            <option value="2">Junior Admin</option>
                                        </select>
                                    </div>

                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Trạng thái</label>
                                        <select class="form-control" name="status">
                                            <option value="0">Đang hoạt động</option>
                                            <option value="1">Vô hiệu hóa</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Cập nhật</button>
                                    <button type="reset" class="btn btn-primary me-2">Nhập lại</button>
                                    <a href="http://127.0.0.1:8000/admin/user/list" class="btn btn-primary">Danh sách</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
    <!-- END: Content-->
@endsection