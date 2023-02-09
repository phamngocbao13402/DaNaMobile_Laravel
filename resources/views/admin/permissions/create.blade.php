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
                        <h2 class="content-header-title float-start mb-0">Bài viết</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{url('admin/post/list')}}">Bài viết</a>
                                </li>
                                <li class="breadcrumb-item active">Thêm mới
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
                                <h3 class="card-title fw-bolder">Thêm bài viết</h3>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" novalidate action="{{url('/admin/permission/create')}}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Tên quyền</label>
                                        <input type="text" id="basic-addon-name" class="form-control"
                                            placeholder="Tên quyền" aria-label="Name" name="permission_name"
                                            aria-describedby="basic-addon-name" required />
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Thêm</button>
                                    <button type="reset" class="btn btn-primary me-2">Nhập lại</button>
                                    <a href="{{url('/admin/permisson')}}" class="btn btn-primary">Danh sách</a>
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