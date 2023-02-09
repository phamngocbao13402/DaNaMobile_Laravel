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
                                    <h2 class="content-header-title float-start mb-0"></h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}">Quản trị</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/specification/list')}}">Thông số</a>
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
                            <h4 class="card-title">Tìm kiếm và Lọc</h4>
                            <div class="row">
                                <div class="col-md-4 user_role">
                                    <label class="form-label" for="UserRole">Tên</label>
                                    <form action="{{ route('spe_name') }}" method="GET">
                                        @csrf
                                        <select name="name" class="form-select text-capitalize mb-md-0 mb-2"
                                            id="name" onchange="this.form.submit()" class="sorting">
                                            <option value="0"> Tất cả </option>
                                            <option value="1" class="text-capitalize">Từ A đến Z</option>
                                            <option value="2" class="text-capitalize">Từ Z đến A</option>
                                        </select>
                                    </form>
                                </div>
                                
                                <div class="col-md-4 user_role">
                                    <label class="form-label" for="UserRole">Danh mục</label>
                                    <form action="{{ route('category') }}" method="GET">
                                        @csrf
                                        <select name="category" class="form-select text-capitalize mb-md-0 mb-2"
                                            id="category" onchange="this.form.submit()" class="sorting">
                                            <option value="0"> Tất cả </option>
                                            {!! $categorySelect !!}
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-datatable table-responsive pt-0">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="f-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                    <div class="col-sm-12 col-lg-6 d-flex justify-content-center justify-content-lg-start">
                                        <form action="{{route('search_spe')}}" method="get">
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
                                            <div class="dt-buttons d-inline-flex mt-50">
                                                <a href="{{url('admin/specification/create')}}" style="color:white;"><button type="button" class="dt-button add-new btn btn-primary" tabindex="0" data-bs-target="#modals-slide-in" aria-controls="DataTables_Table_0">
                                                    Thêm Thông số mới
                                                </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="user-list-table table dataTable no-footer dtr-column text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID Thông số</th>
                                        <th>Tên Thông số</th>
                                        <th>Danh mục</th>
                                        <th colspan="2">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($specifications_list as $specification )
                                            <tr data-dt-row="" data-dt-column="">
                                                <td>{{$specification->id}}</td>
                                                <td>{{$specification->specification_name}}</td>
                                                <td>{{$specification->category->category_name}}</td>
                                                
                                                <td><a href="{{url('admin/specification/update',[$specification->id])}}"><button type="button" class="btn btn-primary">Sửa</button></a></td>
                                                <td><a href="{{url('admin/specification/delete',[$specification->id])}}"><button type="button" class="btn btn-primary">Xóa</button></a></td>
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
