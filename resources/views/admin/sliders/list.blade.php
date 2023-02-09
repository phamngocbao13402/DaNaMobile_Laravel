@extends('admin.layouts.master')
@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="app-user-list">
                    <div class="content-header row">
                        <div class="content-header-left col-md-9 col-12 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                    <h2 class="content-header-title float-start mb-0">Slider</h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}">Quản trị</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/slider/list')}}">Slider</a>
                                            </li>
                                            <li class="breadcrumb-item active">Danh sách
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- list and filter start -->
                    <div class="card">
                        <div class="card-datatable table-responsive pt-0">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="f-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                    <div class="col-sm-12 col-lg-6 d-flex justify-content-center justify-content-lg-start">
                                        <form action="" method="get">
                                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                <label>
                                                    Tìm kiếm: 
                                                    <input type="text" class="form-control" placeholder aria-controls="DataTables_Table_0" name="key_search">
                                                </label>
                                                <div class="dt-buttons d-inline-flex mt-50">
                                                    <button class="dt-button buttons-collection btn btn-outline-secondary me-2" 
                                                    tabindex="0" aria-controls="DataTables_Table_0" type="submit" aria-haspopup="true">Tìm kiếm</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 ps-xl-75 ps-0">
                                        <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                            <a href="{{route('slider.create')}}"><button type="button" class="dt-button add-new btn btn-primary" tabindex="0" data-bs-target="#modals-slide-in" aria-controls="DataTables_Table_0">
                                                <span>Thêm Slider mới</span>
                                            </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (Session::has('success'))
                                <h1 style="margin-left: 20px;color: green">{{Session::get('success')}}</h1>
                            @endif
                            <table class="user-list-table table dataTable no-footer dtr-column text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Id slider</th>
                                        <th>Hình ảnh</th>
                                        <th colspan="2">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($result as $slider )
                                            <tr data-dt-row="" data-dt-column="">
                                            <td>{{$slider->id}}</td>
                                            <td><img src="{{asset('images/slider/'.$slider->slider_img)}}" width="100px" height="100px" alt=""></td>
                                            <td><a href="{{url('admin/slider/edit',[$slider->id])}}"><button type="button" class="btn btn-primary">Sửa</button></a></td>
                                            <td><a href="{{url('admin/slider/delete',[$slider->id])}}"><button type="button" class="btn btn-primary">Xóa</button></a></td>
                                            </tr>
                                        @endforeach                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection