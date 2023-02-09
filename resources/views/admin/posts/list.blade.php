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
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                            
                                <h2 class="content-header-title float-start mb-0">Bài viết</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{url('admin/post/list')}}">Bài viết</a>
                                        </li>
                                        <li class="breadcrumb-item active">Danh sách
                                        </li>
                                    </ol>
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
                                <label class="form-label" for="UserRole">Tìm kiếm theo danh mục</label>
                                <form action="{{ route('searchs') }}" method="GET">
                                    @csrf
                                    <select name="key_cate_id" class="form-select text-capitalize mb-md-0 mb-2"
                                        id="cate" onchange="this.form.submit()" class="sorting">
                                        <option value="0">Danh mục</option>
                                        <option value="0">Tất cả bài viết</option>
                                        
                                        @foreach ($categories as $category)
                                        <option data-id="{{ $category->id }}" value="{{ $category->id }}">
                                            {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-4 user_plan">
                                <label class="form-label" for="UserPlan">Lượt xem</label>
                                <form action="{{route('filter_views')}}" method="get">
                                    @csrf
                                    <select id="view" name="view_selected"
                                        class="form-select text-capitalize mb-md-0 mb-2" onchange="this.form.submit()">
                                        <option value="0"> Mặc định </option>
                                        <option value="1"> Giảm dần </option>
                                        <option value="2"> Tăng dần </option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-4 user_status">
                                <label class="form-label" for="FilterTransaction">Trạng thái</label>
                                <form action="{{route('filter_statuss')}}" method="get">
                                    <select name="status_selected" id="status"
                                        class="form-select text-capitalize mb-md-0 mb-2xx"
                                        onchange="this.form.submit()">
                                        <option value="2"> Tất Cả Trạng Thái </option>
                                        <option value="1"> Đang hoạt động </option>
                                        <option value="0"> Vô Hiệu hoá </option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                @if (Session::has('messenger'))
                <div class="text-secondary font-weight-bold text-xs">
                    <h2 class="btn btn-info w-30">{{Session::get('messenger')}}</h2>
                </div>
                @endif
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
                                            <a href="{{url('admin/post/create')}}" style="color:white;"><button type="button" class="dt-button add-new btn btn-primary" tabindex="0" data-bs-target="#modals-slide-in" aria-controls="DataTables_Table_0">
                                                Thêm Bài viết mới
                                            </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="w-100 user-list-table table dataTable no-footer dtr-column text-center" style="overflow: hidden;display: block;">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Tiêu đề</th>
                                    <th>Tóm tắt</th>
                                    <th>Nội dung</th>
                                    <th>Danh mục</th>
                                    <th>Ảnh</th>
                                    <th>Tác giả</th>
                                    <th>Trang thái</th>
                                    <th>Chi tiết</th>
                                    <th colspan="2">Hành động</th>
                                </tr> 
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach ($posts as $post)
                                <tr data-dt-row="" data-dt-column="">   
                                    <?php $status = $post->status==0 ? "Công khai" : "Ẩn" ?>                              
                                       <td>{{++$i}}</td>
                                       <td>
                                            <span style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;width: 50px">{{$post->title}}</span>
                                        </td>
                                 
                                        <td>
                                           <span style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;">{{$post->summary}}</span>
                                        </td>

                                        <td  class="w-10">
                                            <span style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;width: 150px"><?php echo $post->content ?></span>
                                        </td>
                                       <td>{{$post->category->category_name}}</td>
                                       <td><img class="rounded" src="{{asset('images/post/'.$post->post_img)}}" width="100px" height="100px" style="display:block; margin: 0 auto;"></td>
                                       <td>{{$post->user->name}}</td>
                                       
                                       <td>{{$status}}</td>
                                       <td><a href="http://localhost:8000/admin/post/details/{{$post->id}}"><button type="button" class="btn btn-gradient-info"><i data-feather='eye'></i></button></a></td>
                                       <td><a href="http://localhost:8000/admin/post/edit/{{$post->id}}"><button type="button" class="btn btn-gradient-success"><i data-feather='edit'></i></button></a></td>
                                       <td><a href="http://localhost:8000/admin/post/delete/{{$post->id}}"><button type="button" class="btn btn-gradient-danger"><i data-feather='trash-2'></i></button></a></td>                              
                                </tr>
                                @endforeach
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
                                <!-- <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                                            <a href=""></a>
                                        </li>
                                        <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next">
                                            <a href=""></a>
                                        </li>
                                    </ul>
                                </div> -->
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