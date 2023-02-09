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
                                    <h2 class="content-header-title float-start mb-0">Kho hàng</h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/stocks/list')}}">Kho hàng</a>
                                            </li>
                                            <li class="breadcrumb-item active">Chi tiết kho hàng
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- list and filter start -->
                    <div class="card">
                        <div class="card-body border-bottom">
                            <h4 class="card-title">Chi tiết Kho hàng</h4>
                        </div>
                        <div class="card-datatable table-responsive pt-0">
                            <table class="user-list-table table dataTable no-footer dtr-column text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Mã </th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá trị biến thể</th>
                                        <th>Giá sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày thêm</th>
                                        <th>Ngày cập nhật</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($combi as $stockdetail)
                                        @php
                                            $total_price = 0;
                                            $total_price = $stockdetail->price * $stockdetail->avilableStock;
                                        @endphp

                                    <tr data-dt-row="" data-dt-column="">
                                        <td></td>
                                        <td>{{$stockdetail->id}}</td>
                                        <td>{{$stockdetail->product->product_name}}</td>
                                        <td>{{$stockdetail->combination_string}}</td>
                                        <td>{{$stockdetail->price}}đ</td>
                                        <td>{{$stockdetail->avilableStock}}</td>
                                        <td>{{$total_price}}</td>
                                        <td>{{$stockdetail->created_at}}</td>
                                        <td>{{$stockdetail->updated_at}}</td>
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