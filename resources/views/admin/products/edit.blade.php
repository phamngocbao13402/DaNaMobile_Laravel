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
                        <h2 class="content-header-title float-start mb-0">Quản lý sản phẩm</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin')}}">Trang chủ</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{url('admin/admin/product/list')}}">Sản
                                        phẩm</a>
                                </li>
                                <li class="breadcrumb-item active">Cập nhật sản phẩm
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
                                <h3 class="card-title fw-bolder">Cập nhật sản phẩm</h3>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" novalidate
                                    action="{{url('admin/product/update', [$product->id])}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="basic-addon-name">Tên sản
                                            phẩm</label>

                                        <input type="text" id="basic-addon-name" class="form-control"
                                            placeholder="Nhập tên sản phẩm" aria-label="Name"
                                            value="{{$product->product_name}}" name="product_name"
                                            aria-describedby="basic-addon-name" required />
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter your name.</div>
                                    </div>

                                    <div class="mb-1">
                                        <label class="form-label fs-5 fw-bolder" for="select-country1">Danh mục sản
                                            phẩm</label>
                                        <select class="form-select" onchange="changeCate()" id="select-country1" name="category_id" required
                                            name="parent_id">
                                            <option value="0">Danh mục sản phẩm</option>
                                            {!! $categorySelect !!}
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please select your country</div>
                                    </div>
                                    <div class="mb-1">
                                        <label for="customFile1" class="form-label fs-5 fw-bolder">Ảnh sản phẩm</label>
                                    </div>

                                    <div class="mb-2">
                                        <img class="rounded" src="{{asset('/images/products/'.$product->product_img)}}"
                                            width="80%" height="400px"
                                            style="object-fit:cover; display:block; margin: 0 auto;">
                                    </div>

                                    <div class="mb-2">
                                        <input class="form-control" name="product_img" type="file" id="customFile1"
                                            required />
                                    </div>


                                    <div class="mb-1">
                                        <label class="d-block form-label fs-5 fw-bolder" for="">Thông số sản
                                            phẩm</label>
                                    </div>

                                    @foreach ($specfications as $specfication)
                                    <div class="show-{{$specfication->category_id}} mb-1 ms-2 show-spec"
                                        style="display: none">
                                        <label class="form-label fs-6 fw-bolder" for="basic-addon-name1">
                                            {{$specfication->specification_name}}
                                        </label>

                                        <input type="text" id="basic-addon-name1" class="form-control"
                                            placeholder="Nhập thông số sản phẩm" name="{{$specfication->id}}_value"
                                            aria-label="Name" aria-describedby="basic-addon-name" required />
                                    </div>
                                    @endforeach
                                    <input type="hidden" id="specification_cate" name="specification_cate" value="">

                                    <div class="mb-1">
                                        <label class="d-block form-label fs-5 fw-bolder" for="validationBioBootstrap">Mô
                                            tả</label>
                                        <textarea name="product_desc" class="form-control" id="mySummernote" rows="9">
                                        {{$product->product_desc}}
                                        </textarea>
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
            <!-- /Validation -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
<script>
    function changeCate() {
    let specList = document.querySelectorAll('.show-spec');

    let valueOption = document.getElementById("select-country1").value;

    document.getElementById('specification_cate').value = valueOption;
    
    specList.forEach((spec) => {
        let isSpecSeleted = spec.className.includes("show-" + valueOption); 
        spec.style.display = isSpecSeleted ? "block" : "none";
    });
}
</script>