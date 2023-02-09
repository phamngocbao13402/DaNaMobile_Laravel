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
                                    <h2 class="content-header-title float-start mb-0">Banner</h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}">Quản trị</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/banner/list')}}">Banner</a>
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
                                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                        
                                    </div>
                                    <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                                        <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                            <a href="{{route('banner.create')}}"><button type="button" class="dt-button add-new btn btn-primary" tabindex="0" data-bs-target="#modals-slide-in" aria-controls="DataTables_Table_0">
                                                <span>Thêm Banner mới</span>
                                            </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (Session::has('success'))
                            <div class="text-secondary font-weight-bold text-xs">
                                <h2 class="btn btn-info w-30">{{Session::get('success')}}</h2>
                            </div>
                            @endif
                            <table class="user-list-table table dataTable no-footer dtr-column text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Id banner</th>
                                        <th>Hình ảnh</th>
                                        <th>Link quảng cáo</th>
                                        <th colspan="2">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($result as $banner )
                                            <tr data-dt-row="" data-dt-column="">
                                            <td>{{$banner->id}}</td>
                                            <td><img src="{{asset('images/banner/'.$banner->banner_img)}}" width="100px" height="100px" alt=""></td>
                                            <td>{{$banner->location}}</td>
                                            <td><a href="{{url('admin/banner/edit',[$banner->id])}}"><button type="button" class="btn btn-primary">Sửa</button></a></td>
                                            <td><a href="{{url('admin/banner/delete',[$banner->id])}}"><button type="button" class="btn btn-primary">Xóa</button></a></td>
                                            </tr>
                                        @endforeach                               
                                </tbody>
                            </table>
                            <div id="pagination-container"></div>
                            <div>
                       
                            </div>
                        </div>
                        
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script src="{{asset('admin_js/pagination_js.js')}}"></script>