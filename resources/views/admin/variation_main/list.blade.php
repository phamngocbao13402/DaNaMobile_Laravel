@extends('admin.layouts.master')
@section('main')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="app-user-list">
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
                                        <div class="dt-buttons d-inline-flex mt-50">
                                            <button type="button" class="dt-button add-new btn btn-primary" tabindex="0" data-bs-target="#modals-slide-in" aria-controls="DataTables_Table_0">
                                               <a href="{{url('admin/variation_main/create')}}" style="color: white;">Thêm kiểu biến thể mới</a>
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
                                    <th colspan="2" style="width=20%;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                <?php foreach ($variations as $variation) { $i++;?>
                                    <tr data-dt-row="" data-dt-column="">
                                        <td><?=$i?></td>
                                        <td>{{$variation->id}}</td>
                                        <td>{{$variation->variation_name}}</td>
                                        <td style="width:10% !important;">
                                            <a href="{{url('admin/variation_main/edit', [$variation->id])}}"><button type="button" class="btn btn-success"><i data-feather='edit'></i></button></a>
                                        </td>
                                        <td style="width:10% !important;">
                                            <a href="{{url('admin/variation_main/delete', [$variation->id])}}"><button type="button" class="btn btn-danger"><i data-feather='trash-2'></i></button></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                
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
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script src="{{asset('admin_js/pagination_js.js')}}"></script>