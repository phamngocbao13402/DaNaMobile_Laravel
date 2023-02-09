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
                                    <h2 class="content-header-title float-start mb-0">Đơn hàng</h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/order/details')}}">Đơn Hàng Chi Tiết</a>
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
                        <div class="card-body border-bottom">
                            <h4 class="card-title">Đơn hàng</h4>
                            <div class="row">
                               
                                <div class="col-md-4 user_status">
                                    <label class="form-label" for="FilterTransaction">Trạng thái</label>
                                    <form action="{{ route('filter.status.order') }}" method="get">
                                        <select id="FilterTransaction" name="filter_status_order" onchange="this.form.submit()" class="form-select text-capitalize mb-md-0 mb-2xx">
                                            <option value="4" {{ request()->filter_status_order == 4 ? 'selected' : '' }}> Tất cả trạng thái </option>
                                            <option value="0" {{ request()->filter_status_order == 0 ? 'selected' : '' }}> Đang xử lý </option>
                                            <option value="1" {{ request()->filter_status_order == 1 ? 'selected' : '' }}> Đang giao hàng </option>
                                            <option value="2" {{ request()->filter_status_order == 2 ? 'selected' : '' }}> Đã giao hàng </option>
                                            <option value="3" {{ request()->filter_status_order == 3 ? 'selected' : '' }}> Đã hủy hàng </option>
                                        </select>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <div class="card-datatable table-responsive pt-0">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="f-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                    
                                    </div>
                                </div>
                            </div>
                            <table class="user-list-table table dataTable no-footer dtr-column text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Phương thức thanh toán</th>                                     
                                        <th>Trạng thái</th>
                                        <th colspan="2">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0 ?>
                                    @foreach($orders as $order)
                                    <tr data-dt-row="" data-dt-column="">
                                        <td>{{ ++$i }}</td>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->fullname}}</td>
                                        <td>{{number_format($order->total_amount)}}đ</td>
                                        <td>{{$order->payment->payment_name}}</td>
                                        <td>
                                            <?php
                                            if($order["status"]==0){
                                                echo "<span class='badge rounded-pill badge-light-primary me-1'>Đang xử lý</span>";
                                            }else if($order["status"]==1){
                                                echo "<span class='badge rounded-pill badge-light-info me-1'>Đang giao hàng</span>";
                                            }else if($order["status"]==2){
                                                echo "<span class='badge rounded-pill badge-light-success me-1'>Đã giao hàng</span>";
                                            }else {
                                                echo "<span class='badge rounded-pill badge-light-warning me-1'>Đã huỷ hàng</span>";
                                            }
                                            ?>
                                        </td>
                                        <td><a href="{{ url('admin/order/details',[$order->id])}}">Xem chi tiết</a></td>
                                        <td><a href="{{ url('admin/order/edit',[$order->id])}}"><button type="button" class="btn btn-gradient-success"><i data-feather='edit'></i></button></a></td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div id="pagination-container"></div>
                            <div>
                       
                            </div>
                            <div>
                                @if(session()->has('message'))
                                    <p class="alert alert-danger">{{ session()->get('message') }}</p>
                                @endif
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