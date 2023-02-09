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
                                    <h2 class="content-header-title float-start mb-0">Tài khoản</h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}">Quản trị</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="{{url('admin/user/list')}}">Khách hàng</a>
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
                                    </div>
                                </div>
                            </div>
                            <table class="user-list-table table dataTable no-footer dtr-column text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Mã khách hàng</th>
                                        <th>Tên</th>
                                        <th>Mail</th>
                                        <th>Chức năng</th>
                                        <th>Trạng thái</th>  
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($alluser as $key)
                                    <tr data-dt-row="" data-dt-column="">
                                        <td>{{++$i}}</td>
                                        <td>{{$key->id}}</td>
                                        <td>{{$key->name}}</td>
                                        <td>{{$key->email}}</td>
                                        <td>
                                            <?php
                                            if($key["role"]==1){
                                                echo "Admin";
                                            }else if ($key['role']==2) {
                                                echo "Junior Admin";
                                            }else {
                                                echo "Khách hàng";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if($key["status"]==0){
                                                echo "Hoạt động";
                                            }else {
                                                echo "Vô hiệu hóa";
                                            }
                                            ?>
                                        </td>
                                        <td><a href="{{url('admin/user/edit',[$key->id])}}"><button type="button" class="btn btn-gradient-success"><i data-feather='edit'></i></button></a></td>
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