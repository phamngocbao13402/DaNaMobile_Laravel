@extends('admin.layouts.master')
@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
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
                                            <li class="breadcrumb-item active">Danh sách
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body border-bottom">
                            <h4 class="card-title">Kho hàng</h4>
                            <div class="row">
                                <div class="col-md-4 user_role">
                                    <label class="form-label" for="UserRole">Tên</label>
                                    <form action="{{ route('stock_name') }}" method="GET">
                                        @csrf
                                        <select name="name" class="form-select text-capitalize mb-md-0 mb-2"
                                            id="name" onchange="this.form.submit()" class="sorting">
                                            <option value="0"> Tất cả </option>
                                            <option value="1" class="text-capitalize">Từ A đến Z</option>
                                            <option value="2" class="text-capitalize">Từ Z đến A</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-datatable table-responsive pt-0">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="f-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                    </div>
                                    <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                                        <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                            <div class="me-1">
                                                <form action="{{route('search_stock')}}" method="get">
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
                            </div>
                            <table class="user-list-table table dataTable no-footer dtr-column text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Tổng kho</th>
                                        <th>Tổng giá</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0 ?>
                                @foreach($products_stocks as $product)
                                        @php
                                            $total_stock = 0;
                                            $total_price = 0;
                                            
                                            foreach($product->combinations as $product_combination){
                                                $total_stock += $product_combination->avilableStock;
                                                $total_price += $product_combination->price * $product_combination->avilableStock;
                                            }
                                        @endphp
                                    <tr data-dt-row="" data-dt-column="">
                                        <td>{{++$i}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td><img class="rounded" src="{{asset('images/products/'.$product->product_img)}}" width="100px" height="70px" style="display:block; margin: 0 auto;"></td>
                                        <td>{{$total_stock}}</td>
                                        <td>{{number_format($total_price)}}đ</td>
                               
                                        <td><a href="http://127.0.0.1:8000/admin/stocks/stock_detail/{{$product->id}}"><button type="button" class="btn btn-gradient-info"><i data-feather='eye'></i></button></a></td>
                                        <!-- <td><a href="{{url('admin/stocks/stock_detail', [$product->id])}}">Chi tiết</a></td> -->

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