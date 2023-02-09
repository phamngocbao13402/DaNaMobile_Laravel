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
                            <h2 class="content-header-title float-start mb-0">Quản lý sản phẩm</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{url('admin/product/list')}}">Sản
                                            phẩm</a>
                                    </li>
                                    <li class="breadcrumb-item active">Danh sách biến thể sản phẩm
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- list and filter start -->
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div
                                class="f-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                    {{--  --}}
                                </div>
                                <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                                    <div
                                        class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="me-1">
                                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                <label>
                                                    Tìm kiếm:
                                                    <input type="search" class="form-control" placeholder
                                                        aria-controls="DataTables_Table_0">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="dt-buttons d-inline-flex mt-50">
                                            <button
                                                class="dt-button buttons-collection btn btn-outline-secondary me-2"
                                                tabindex="0" aria-controls="DataTables_Table_0" type="button"
                                                aria-haspopup="true">Tìm kiếm</button>

                                            <a type="button" href="{{url('/admin/product/create')}}"
                                                class="dt-button add-new btn btn-primary" tabindex="0"
                                                data-bs-target="#modals-slide-in" aria-controls="DataTables_Table_0">
                                                <span>Thêm Sản phẩm mới</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="user-list-table table dataTable no-footer dtr-column text-center">
                            <thead class="table-light">
                                <tr>
                                    <th><input type="checkbox" name="select-all" id="select-all"></th>
                                    <th>#</th>
                                    <th>Tên Sản phẩm</th>
                                    <th>Giá trị biến thể</th>
                                    <th>Ảnh</th>
                                    <th>Giá</th>
                                    <th>Giảm giá</th>
                                    <th>Số lượng</th>
                                    <th colspan="2">Hành động</th>
                                </tr>
                            </thead>

                            <input type="hidden" name="productId" value="{{$product->id}}">

                            <tbody>
                                <?php $i=0; ?>
                                @foreach ($product->combinations as $productVariation)
                                <?php  $i++ ?>
                                <tr data-dt-row="" data-dt-column="">
                                    <td><input type="checkbox" name="checkbox-<?php echo $i ?>" id="checkbox-<?php echo $i ?>" /></td>
                                    <td>
                                        <?php echo $i ?>
                                    </td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$productVariation->combination_string}}</td>
                                    <td><img class="rounded"
                                            src="{{asset('images/products/'.$productVariation->combination_image)}}"
                                            width="150px" height="100px" style="display:block; margin: 0 auto;"></td>
                                    <td>{{$productVariation->price}}</td>
                                    <td>{{$productVariation->sale}}</td>
                                    <td>{{$productVariation->avilableStock}}</td>
                                    {{-- <td>
                                        <a href="{{url('admin/product/editProVar', [$productVariation->id])}}"><button
                                                type="button" class="btn btn-success"><i
                                                    data-feather='edit'></i></button></a>
                                    </td> --}}
                                    <td>
                                        <a href="{{url('admin/product/deleteProvar', [$productVariation->id])}}"><button
                                                type="button" class="btn btn-danger"><i
                                                    data-feather='trash-2'></i></button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- list and filter end -->
            </section>
            <!-- users list ends -->

        </div>
    </div>
</div>
<!-- END: Content-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
}); 
</script>
@endsection
