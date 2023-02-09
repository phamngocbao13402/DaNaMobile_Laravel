@extends('admin.layouts.master')
@section('main')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users list start -->
            <section class="app-user-list">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">21,459</h3>
                                    <span>Total Users</span>
                                </div>
                                <div class="avatar bg-light-primary p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">4,567</h3>
                                    <span>Paid Users</span>
                                </div>
                                <div class="avatar bg-light-danger p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-plus" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">19,860</h3>
                                    <span>Active Users</span>
                                </div>
                                <div class="avatar bg-light-success p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-check" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">237</h3>
                                    <span>Pending Users</span>
                                </div>
                                <div class="avatar bg-light-warning p-50">
                                    <span class="avatar-content">
                                        <i data-feather="user-x" class="font-medium-4"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- list and filter start -->
                <div class="card">
                    <div class="card-body border-bottom">
                        <h4 class="card-title">Tìm kiếm và Lọc</h4>
                        <div class="row">
                            <div class="col-md-4 user_role">
                                <label class="form-label" for="UserRole">Vai trò</label>
                                <select id="UserRole" class="form-select text-capitalize mb-md-0 mb-2">
                                    <option value=""> Select Role </option>
                                    <option value="' + d + '" class="text-capitalize">' + d + '</option>
                                </select>
                            </div>
                            <div class="col-md-4 user_plan">
                                <label class="form-label" for="UserPlan">Kế hoạch</label>
                                <select id="UserPlan" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Plan </option></select>
                            </div>
                            <div class="col-md-4 user_status">
                                <label class="form-label" for="FilterTransaction">Trạng thái</label>
                                <select id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2xx"><option value=""> Select Status </option></select>
                            </div>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive pt-0">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="f-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                        <label>
                                            Hiển thị 
                                            <select name="DataTables_Table_0_length" class="form-select" aria-controls="DataTables_Table_0">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                            mục
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                                    <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="me-1">
                                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                <label>
                                                    Tìm kiếm: 
                                                    <input type="search" class="form-control" placeholder aria-controls="DataTables_Table_0">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="dt-buttons d-inline-flex mt-50">
                                            <button class="dt-button buttons-collection btn btn-outline-secondary dropdown-toggle me-2" 
                                            tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="true">Xuất</button>
                                            {{-- <div class="dt-button-collection" style="top: 148.625px; left: 889.488px;">
                                                <div role="menu">
                                                    <button class="dt-button buttons-print dropdown-item" tabindex="0" type="button">Print</button>
                                                    <button class="dt-button buttons-print dropdown-item" tabindex="0" type="button">Print</button>
                                                    <button class="dt-button buttons-print dropdown-item" tabindex="0" type="button">Print</button>
                                                </div>
                                            </div> --}}
                                            <button type="button" class="dt-button add-new btn btn-primary" tabindex="0" data-bs-target="#modals-slide-in" aria-controls="DataTables_Table_0">
                                                <span>Thêm Sản phẩm mới</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="user-list-table table dataTable no-footer dtr-column text-center" >
                            <thead class="table-light ">
                                <tr>
                                    <th>#</th>
                                    <th>Mã Biến thể</th>
                                    <th>Tên Biến thể</th>
                                    <th colspan="2">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-dt-row="" data-dt-column="">
                                    <td>ABC</td>
                                    <td>Biến thể</td>
                                    <td>Biến thể</td>
                                    <td>Sửa</td>
                                    <td>Xoá</td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="pagination-container"></div>
                        <div>
                   
                        </div>
                        <div class="d-flex justify-content-between mx-2 row mb-1">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Hiển thị 0 đến 0 của 0 mục</div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                                            <a href=""></a>
                                        </li>
                                        <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next">
                                            <a href=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- list and filter end -->
            </section>
            <!-- users list ends -->

        </div>
    </div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script src="{{asset('admin_js/pagination_js.js')}}"></script>