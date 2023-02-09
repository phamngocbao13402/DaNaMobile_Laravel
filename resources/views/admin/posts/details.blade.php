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
                                <li class="breadcrumb-item active">Bài viết chi tiết
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
                                <h2 class="card-title fw-bolder fs-2">{{$post->title}}</h2>
                            </div>
                            <div class="card-body">
                                    <div class="mb-2" style="font-style: italic;  font-weight: 600;">
                                        {{$post->summary}}
                                    </div>

                                    <div class="mb-2">
                                    <img class="rounded" src="{{asset('/images/post/'.$post->post_img)}}" width="60%" height="400px" style="object-fit:cover; display:block; margin: 0 auto;">
                                    </div>

                                    <div class="mb-4">
                                        <?php
                                        echo $post->content
                                        ?>
                                    </div>

                                    <div class="mb-2" style="font-style: italic;">
                                       Tác giả : {{$post->user->name}}
                                    </div>

                                    <div class="mb-2" style="font-style: italic;">
                                      Ngày đăng: {{$post->created_at}}
                                    </div>
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