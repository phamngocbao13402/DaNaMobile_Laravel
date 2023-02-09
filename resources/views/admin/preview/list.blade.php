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
                            <h4 class="card-title">Tìm kiếm và lọc</h4>
                            
                                <div class="col-md-4 user_status">
                                    <label class="form-label" for="FilterTransaction">Trạng thái</label>
                                    <form action="{{ url('admin/preview/filter-preview-date') }}" method="get">
                                        <select id="FilterTransaction" name="filter_preview_date" onchange="this.form.submit()" class="form-select text-capitalize mb-md-0 mb-2xx">
                                            <option value="1" {{ request()->filter_preview_date == 1 ? 'selected' : ''; }}> Bình luận mới nhất </option>
                                            <option value="2" {{ request()->filter_preview_date != 1 ? 'selected' : ''; }}> Bình luận cũ nhất </option>
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
                            <table class="user-list-table table dataTable no-footer dtr-column">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số bình luận</th>
                                        <th>Ngày bình luận</th>
                                        <th>Tổng sao</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($previews as $preview)
                                    <tr data-dt-row="" data-dt-column="">
                                        <td>{{++$i}}</td>
                                        <td>{{$preview->product->product_name}}</td>
                                        <td>{{$preview->total}}</td>
                                        <td>{{$preview->maxdate}}</td>
                                        <td>{{number_format($preview->avgrate, 1,'.', '')}}</td>
                                        <td><a href="{{url('admin/preview/detail',[$preview->product->id])}}">
                                                <button type="button" class="btn btn-gradient-info">
                                                    <i data-feather='eye'></i>
                                                </button></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="pagination-container"></div>
                        <div>
                   
                        </div>
                        </div>
                        <!-- Modal to add new user starts-->

                        <!-- Modal to add new user Ends-->
                    </div>
                    <!-- list and filter end -->
                </section>
                <!-- users list ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script src="{{asset('admin_js/pagination_js.js')}}"></script>