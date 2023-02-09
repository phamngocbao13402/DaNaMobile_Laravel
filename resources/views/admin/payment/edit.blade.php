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
                        <h2 class="content-header-title float-start mb-0">Phương thức thanh toán</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{url('admin/payment/list')}}">Phương thức thanh toán</a>
                                </li>
                                <li class="breadcrumb-item active">Nhập phương thức thanh toán
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
                                <h3 class="card-title fw-bolder">Chỉnh sửa phương thức thanh toán</h3>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" novalidate action="{{url('/admin/payment/update', [$payment->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Tên</label>
                                        <input type="text" id="basic-addon-name" class="form-control" placeholder="Nhập tên" value="{{$payment->payment_name}}" aria-label="Name" name="payment_name" aria-describedby="basic-addon-name" required />
                                    </div>

                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Nội dung</label>

                                        <input type="text" id="basic-addon-name" class="form-control" placeholder="Nhập số tài khoản" value="{{$payment->payment_content}}" aria-label="Name" name="payment_status" aria-describedby="basic-addon-name" required />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Trạng thái</label>
                                        <select name="payment_status" id="" class="form-control">
                                            @if($payment->payment_status == 1)
                                                <option value="0" checked>Vô hiệu hoá</option>
                                                <option value="1">Đang hoạt động</option>
                                            @else
                                            <option value="0" >Vô hiệu hoá</option>
                                            <option value="1" checked>Đang hoạt động</option>
                                            @endif
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Cập nhật</button>
                                    <button type="reset" class="btn btn-primary me-2">Nhập lại</button>
                                    <a href="{{url('/admin/payment/list')}}" class="btn btn-primary">Danh sách</a>
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