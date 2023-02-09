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
                                    <h2 class="content-header-title float-start mb-0">Đánh giá bình luận</h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/preview/list')}}">Bình luận</a>
                                            </li>
                                            <li class="breadcrumb-item active">Chi tiết
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- list and filter start -->
                    <div class="card">
                        <table class="user-list-table table dataTable no-footer dtr-column text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Mã</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Nội dung bình luận</th>
                                    <th>Đánh giá sao</th>
                                    <th>Người bình luận</th>
                                    <th>Ngày bình luận</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detail as $stockdetail)

                                <tr data-dt-row="" data-dt-column="">
                                    <td></td>
                                    <td>{{$stockdetail->id}}</td>
                                    <td>{{$stockdetail->product->product_name}}</td>
                                    <td>{{$stockdetail->review}}</td>
                                    <td>{{$stockdetail->status}}</td>
                                    <td>{{$stockdetail->user->name}}</td>
                                    <td>{{$stockdetail->created_at}}</td>
                                    <td><a href="http://127.0.0.1:8000/admin/preview/delete/{{$stockdetail->id}}"><button type="button" class="btn btn-gradient-danger"><i data-feather='trash-2'></i></button></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- list and filter end -->
                </section>
                <!-- users list ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection