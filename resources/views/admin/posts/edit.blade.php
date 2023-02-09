@extends('admin.layouts.master')
@section('main')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
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
                                <li class="breadcrumb-item active">Chỉnh sửa
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Validation -->
            <section class="bs-validation">
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-8 col-12" style="margin : 0 auto">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title fw-bolder">Cập nhật bài viết</h3>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" novalidate action="{{url('admin/post/update', [$post->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Tiêu đề bài viết</label>

                                        <input type="text" id="basic-addon-name" class="form-control" value="{{$post->title}}" placeholder="Nhập tên bài viết" aria-label="Name" name="title" aria-describedby="basic-addon-name" required />
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter your name.</div>
                                    </div>

                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Tóm tắt bài viết</label>

                                        <input type="text" id="basic-addon-name" class="form-control" value="{{$post->summary}}" placeholder="Nhập tên bài viết" aria-label="Name" name="summary" aria-describedby="basic-addon-name" required />
                                    </div>

                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nội dung bài viết</label>
                                        <textarea name="content" class="form-control" id="mySummernote"  rows="9">{{$post->content}}</textarea>

                                    </div>

                                    <div class="mb-2">
                                        <img class="rounded" src="{{asset('/images/post/'.$post->post_img)}}" width="60%" height="400px" style="object-fit:cover; display:block; margin: 0 auto;">
                                    </div>
                                    
                                
                                    <div class="mb-2">
                                        <label for="customFile1" class="form-label fs-5 fw-bolder">Ảnh bài viết</label>
                                        <input class="form-control" name="post_img" type="file" id="customFile1" required />
                                    </div>


                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="select-country1">Danh mục bài viết</label>
                                        <select class="form-select" id="select-country1" name="category_id" required name="parent_id">
                                            <option value="0">Danh mục bài viết</option>
                                            {!! $categorySelect !!}
                                        </select>
                                    </div>
                                                                 
                                    <button type="submit" class="btn btn-primary me-2">Cập nhật</button>
                                    <button type="reset" class="btn btn-primary me-2">Nhập lại</button>
                                    <a href="{{url('/admin/product/list')}}" class="btn btn-primary">Danh sách</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
    <!-- END: Content-->
@endsection