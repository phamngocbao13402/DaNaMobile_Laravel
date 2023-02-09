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
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Thống kê sản phẩm</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{url('admin/admin/statistical/list')}}">Thống kê</a>
                                    </li>
                                   
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- list and filter start -->
                <div class="card">
                    <div class="card-body border-bottom">
                        <h4 class="card-title">Tìm kiếm và lọc</h4>
                        <div class="row">
                            <div class="col-md-2 user_plan">
                                <label class="form-label" for="UserPlan">Thống kê</label>
                                <form action="" method="get">
                                    @csrf
                                    <select id="choise_option_statistical" name="choise_option_statistical"
                                        class="form-select text-capitalize mb-md-0 mb-2 select-statistical-js" >
                                        <option value="1"> Sản phẩm bán được</option>
                                        <option value="2"> Doanh thu </option>
                                        <option value="3"> Sản phẩm chưa có lượt bán </option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-3 user_status">
                                <label class="form-label" for="FilterTransaction">Từ ngày</label>
                                <input type="date" class="form-control" id="start-day" name="start-day" id="">
                                
                            </div>
                            <div class="col-md-3 user_status">
                                <label class="form-label" for="FilterTransaction">Đến ngày</label>
                                <input type="date" class="form-control" id="end-day" name="end-day" id="">
                            </div>
                            <div class="col-md-2 user_status">
                                <label class="form-label" for="FilterTransaction">Sắp xếp</label>
                                <form action="" method="get">
                                    <select id="choise_order_statistical" name="choise_order_statistical"
                                        class="form-select text-capitalize mb-md-0 mb-2xx select-statistical-js">
                                        <option value="ASC">Sắp xếp</option>
                                        <option value="DESC">Giảm dần</option>
                                        <option value="ASC">Tăng dần</option>
                                    </select>
                                </form>
                            </div>

                            <div class="col-md-2 user_status">
                                <label class="form-label" for="FilterTransaction">Số lượng</label>
                                <form action="" method="get">
                                    <select id="choise_amount_statistical" name="choise_amount_statistical"
                                        class="form-select text-capitalize mb-md-0 mb-2xx select-statistical-js">
                                        <option value="1000">Toàn bộ</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-datatable table-responsive pt-0"> --}}
                        <div class="card-datatable pt-0">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="f-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                    <div class="col-sm-12 col-lg-6 d-flex justify-content-center justify-content-lg-start">
                                        <div class="me-1">
                                            <form action="" method="get">
                                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                    <label>
                                                        Tìm kiếm: 
                                                        <input type="text" class="form-control" placeholder aria-controls="DataTables_Table_0" name="key_search" value="">
                                                    </label>
                                                    <div class="dt-buttons d-inline-flex mt-50">
                                                        <button class="dt-button buttons-collection btn btn-outline-secondary me-2" 
                                                        tabindex="0" aria-controls="DataTables_Table_0" type="submit" aria-haspopup="true">Tìm kiếm</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6 ps-xl-75 ps-0">
                                        <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">                                           
                                            <div class="dt-buttons d-inline-flex mt-50">
                                                <a type="button" href="#"
                                                    class="dt-button add-new btn btn-primary" id="show-chart-stat" tabindex="0"
                                                    data-bs-target="#modals-slide-in"
                                                    aria-controls="DataTables_Table_0">
                                                    <span>Xem biểu đồ thống kê</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>              
                                </div>
                            </div>
                        </div>
                        <table class="user-list-table table dataTable no-footer dtr-column text-center">
                         
                            
                        </table>
                        <div id="pagination-container"></div>
                        <div>
                   
                        </div>
                    </div>
                </div>
            </section>
            <div class="modal" id="chart-statistical" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
            
                        <div id="myChart" style="max-width:700px; height:400px"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
        
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script> --}}
<script
src="https://www.gstatic.com/charts/loader.js">
</script>

<script src="{{asset('admin_js/statistical.js')}}"></script>