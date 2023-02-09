@extends('client.layouts.master')
@section('main')
@php
use App\Models\Product;
    
@endphp
<main id="content" role="main">
    <!-- Slider Section -->
    <div class="mb-5">
        @foreach($slider as $sliders)
        <div class="bg-img-hero" style="background-image: url({{asset('images/slider/'.$sliders->slider_img)}}">
            <div class="container min-height-420 overflow-hidden">
                <div class="js-slick-carousel u-slick"
                    data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start mb-3 mb-md-4 offset-xl-3 pl-2 pb-1">
                    @foreach($productsld as $products)
                    <div class="js-slide bg-img-hero-center">
                        <div class="row min-height-420 py-7 py-md-0">
                            <div class="offset-xl-3 col-xl-4 col-6 mt-md-8">

                                <h1 class="font-size-64 text-lh-57 font-weadd aight-light" data-scs-animation-in="fadeInUp">
                                    {{$products->product_name}}
                                </h1>
                                <br>
                                <div class="mb-4" data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                    <div class="font-size-50 font-weight-bold text-lh-45">
                                        <sup class="">{{number_format($products->minprice)}}đ - {{number_format($products->maxprice)}}đ</sup>
                                    </div>
                                </div>
                                <a href="{{url('product/detail',[$products->id])}}"
                                    class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                    data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                    Xem chi tiết
                                </a>
                            </div>
                            <div class="col-xl-5 col-6  d-flex align-items-center" data-scs-animation-in="zoomIn"
                                data-scs-animation-delay="500">
                                <img class="img-fluid" src="{{asset('images/products/'.$products->product_img)}}"
                                    width="400px" alt="Image Description">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- End Slider Section -->
    <div class="container">
        <!-- Banner -->
        <div class="mb-5">
            <div class="row">
                @foreach ($categoryhot as $list)
                {{-- {!! $categorySelect !!} --}}
                    
                <div class="col-md-6 mb-4 mb-xl-0 col-xl-3">
                    <a href="{{url('product/byCate/'.$list->id )}}" class="d-black text-gray-90">
                        <div class="min-height-132 py-1 d-flex bg-gray-1 align-items-center">
                            <div class="col-6 col-xl-5 col-wd-6 pr-0">
                                <img class="img-fluid" src="{{asset('images/categories/'.$list->category_image)}}" style="height: 100px"
                                    alt="Image Description">
                            </div>
                            <div class="col-6 col-xl-7 col-wd-6">
                                <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                    {{$list->category_name}}
                                </div>
                                <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                                    Xem sản phẩm
                                    <span class="link__icon ml-1">
                                        <span class="link__icon-inner"><i
                                                class="ec ec-arrow-right-categproes"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                @endforeach
            </div>
        </div>
        <!-- End Banner -->
        <!-- Deals-and-tabs -->
        <div class="mb-5">
            <div class="row">
                <!-- Deal -->
                <div class="col-md-auto mb-6 mb-md-0">
                    <div class="p-3 border border-width-2 border-primary borders-radius-20 bg-white min-width-370" >
                        {{-- @foreach($productsalemax as $sale ) --}}
                            <div class="d-flex justify-content-between align-items-center m-1 ml-2">
                                <h3 class="font-size-22 mb-0 font-weight-normal text-lh-28 max-width-120" style="color: black">Khuyến mãi đặc biệt</h3>
                                <div
                                    class="d-flex align-items-center flex-column justify-content-center bg-primary rounded-pill height-75 width-75 text-lh-1">
                                    <span class="font-size-12">Khuyến mãi</span>
                                    <div class="font-size-20 font-weight-bold">{{$productsalemax->sale}}%</div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <a href="{{url('product/detail',[$productsalemax->id])}}" class="d-block text-center"><img
                                        class="img-fluid" src="{{asset('images/products/'.$productsalemax->combination_image)}}" width="300px"
                                        alt="Image Description"></a>
                            </div>
                            <h5 class="mb-2 font-size-14 text-center mx-auto max-width-180 text-lh-18"><a
                                    href="{{url('product/detail',[$productsalemax->id])}}" class="text-blue font-weight-bold">{{$productsalemax->product_name}}</a></h5>
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <del class="font-size-18 mr-2 text-gray-2">{{number_format($productsalemax->price)}}đ</del>
                                <ins class="font-size-30 text-red text-decoration-none">{{number_format($productsalemax->price - ($productsalemax->price * ($productsalemax->sale/100)))}} đ</ins>
                            </div>
                            <div class="mb-3 mx-2">
                                <div class="d-flex justify-content-between align-items-center mb-2" style="color: black">
                                    <span class="">Sẵn có: <strong>{{$productsalemax->avilableStock}}</strong></span>
                                    <span class="">Đã bán: <strong>800</strong></span>
                                </div>
                                <div class="rounded-pill bg-gray-3 height-20 position-relative">
                                    <span
                                        class="position-absolute left-0 top-0 bottom-0 rounded-pill w-30 bg-primary"></span>
                                </div>
                            </div>
                            <div class="mb-2">
                                <h6 class="font-size-15 text-gray-2 text-center mb-3">Nhanh lên! Thời gian còn lại:</h6>
                                <div class="js-countdown d-flex justify-content-center" data-end-date="2022/12/29"
                                    data-hours-format="%H" data-minutes-format="%M" data-seconds-format="%S">
                                    <div class="text-lh-1">
                                        <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                            <span class="js-cd-hours"></span>
                                        </div>
                                        <div class="text-gray-2 font-size-12 text-center">GIỜ</div>
                                    </div>
                                    <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                                    <div class="text-lh-1">
                                        <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                            <span class="js-cd-minutes"></span>
                                        </div>
                                        <div class="text-gray-2 font-size-12 text-center">PHÚT</div>
                                    </div>
                                    <div class="mx-1 pt-1 text-gray-2 font-size-24">:</div>
                                    <div class="text-lh-1">
                                        <div class="text-gray-2 font-size-30 bg-gray-4 py-2 px-2 rounded-sm mb-2">
                                            <span class="js-cd-seconds"></span>
                                        </div>
                                        <div class="text-gray-2 font-size-12 text-center">GIÂY</div>
                                    </div>
                                </div>
                            </div>
                        {{-- @endforeach --}}
                    </div>
                </div>
                <!-- End Deal -->
                <!-- Tab Prodcut -->
                <div class="col">
                    <!-- Features Section -->
                    <div class="">
                        <!-- Nav Classic -->
                        <div class="position-relative bg-white text-center z-index-2">
                            <ul class="nav nav-classic nav-tab justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active " id="pills-one-example1-tab" data-toggle="pill"
                                        href="#pills-one-example1" role="tab" aria-controls="pills-one-example1"
                                        aria-selected="true">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            Tất cả sản phẩm 
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="pills-two-example1-tab" data-toggle="pill"
                                        href="#pills-two-example1" role="tab" aria-controls="pills-two-example1"
                                        aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            Sản phẩm được quan tâm
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="pills-three-example1-tab" data-toggle="pill"
                                        href="#pills-three-example1" role="tab" aria-controls="pills-three-example1"
                                        aria-selected="false">
                                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                                            Sản phẩm đánh giá hàng đầu
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Nav Classic -->

                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel"
                                aria-labelledby="pills-one-example1-tab">
                                <ul class="row list-unstyled products-group no-gutters">
                                    @foreach ($productsld as $productsss)
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a
                                                            href="{{url('product/detail',[$productsss->id])}}"
                                                            class="font-size-12 text-gray-5">{{$productsss->category->category_name}}</a>
                                                    </div>
                                                    <h5 class="mb-1 product-item__title"><a
                                                            href="{{url('product/detail',[$productsss->id])}}"
                                                            class="text-blue font-weight-bold">{{$productsss->product_name}}</a>
                                                    </h5>
                                                    <div class="mb-2">
                                                        <a href="{{url('product/detail',[$productsss->id])}}"
                                                            class="d-block text-center"><img class="img-fluid"
                                                                src="{{asset('images/products/'.$productsss->product_img)}}"
                                                                alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">{{number_format($productsss->minprice)}} đ</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="{{url('product/detail',[$productsss->id])}}"
                                                                class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                    class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade pt-2" id="pills-two-example1" role="tabpanel"
                                aria-labelledby="pills-two-example1-tab">
                                <ul class="row list-unstyled products-group no-gutters">
                                    @foreach ($view_product as $view)
                                        
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a
                                                            href="{{url('product/detail',[$view->id])}}"
                                                            class="font-size-12 text-gray-5">{{$view->category->category_name}}</a></div>
                                                    <h5 class="mb-1 product-item__title"><a
                                                            href="{{url('product/detail',[$view->id])}}"
                                                            class="text-blue font-weight-bold">{{$view->product_name}}</h5>
                                                    <div class="mb-2">
                                                        <a href="{{url('product/detail',[$view->id])}}"
                                                            class="d-block text-center"><img class="img-fluid"
                                                                src="{{asset('images/products/'.$view->product_img)}}"
                                                                alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">{{number_format($view->minprice)}} đ</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="{{url('product/detail',[$view->id])}}"
                                                                class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                    class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade pt-2" id="pills-three-example1" role="tabpanel"
                                aria-labelledby="pills-three-example1-tab">
                                <ul class="row list-unstyled products-group no-gutters">
                                    @foreach($prevew_product as $preview)
                                    <li class="col-6 col-wd-3 col-md-4 product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-xl-4 p-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2" style="color: black"><a
                                                            href="{{url('product/detail',[$preview->product_id])}}"
                                                            class="font-size-12 text-gray-5" ></a>{{$preview->category_name}}</div>
                                                    <h5 class="mb-1 product-item__title"><a
                                                            href="{{url('product/detail',[$preview->product_id])}}"
                                                            class="text-blue font-weight-bold">{{$preview->product->product_name}}</a></h5>
                                                    <div class="mb-2">
                                                        <a href="{{url('product/detail',[$preview->product_id])}}"
                                                            class="d-block text-center"><img class="img-fluid"
                                                                src="{{asset('images/products/'.$preview->product->product_img)}}"
                                                                alt="Image Description"></a>
                                                    </div>
                                                    <?php $startWidth = ($preview->avgrate * 78 ) / 5 ?>
                                                    <div class="text-warning mb-2" style="overflow: hidden; width : {{$startWidth}}px">
                                                        <div style="width: 90px">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="flex-center-between mb-1">
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="{{url('product/detail',[$preview->product_id])}}"
                                                                class="btn btn-primary transition-3d-hover">Xem chi tiết</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- End Tab Content -->
                    </div>
                    <!-- End Features Section -->
                </div>
                <!-- End Tab Prodcut -->
            </div>
        </div>
        <!-- End Deals-and-tabs -->
        
    </div>
    
    <!-- Products-4-1-4 -->
    <div class="products-group-4-1-4 space-1 bg-gray-7">
        <div class="container">
            <!-- Nav Classic -->
            <div class="position-relative text-center z-index-2 mb-3">
                <ul class="nav nav-classic nav-tab nav-tab-sm px-md-3 justify-content-start justify-content-lg-center flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble border-md-down-bottom-0 pb-1 pb-lg-0 mb-n1 mb-lg-0"
                    id="pills-tab-1" role="tablist">
                    @foreach($categorylist as $category)
                    <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                        <a class="nav-link" id="Tpills-{{$category->id}}-tap" data-toggle="pill"
                            href="#Tpills-{{$category->id}}" role="tab" aria-controls="Tpills-{{$category->id}}"
                            aria-selected="true">
                            <div class="d-md-flex justify-content-md-center align-items-md-center">
                                {{$category->category_name}}
                            </div>
                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>
            <!-- End Nav Classic -->

            <!-- Tab Content -->
            <div class="tab-content" id="Tpills-tabContent">
                @foreach ($product_cate as $cate)
                    @php
                        $productList = Product::with('category')
                            ->where('products.category_id', $cate->id)
                            ->where('products.product_status', 1)
                            ->take(8)
                            ->get();
                        $showActive = $cate->id == 21 ? 'show active' : '';
                    @endphp
                    <div class="tab-pane fade {{$showActive}}" id="Tpills-{{$cate->id}}" role="tabpanel"
                        aria-labelledby="Tpills-{{$cate->id}}-tap">
                        <div class="row no-gutters">
                            <div class="col-md-5 col-wd-12 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 flex-xl-column flex-wd-row">
                                    @foreach($productList as $products)
                                        <li class="col-xl-3 product-item max-width-xl-100 remove-divider">
                                            <div class="product-item__outer h-100 w-100 prodcut-box-shadow">
                                                <div class="product-item__inner bg-white p-3">
                                                    <div class="product-item__body pb-xl-2">
                                                        <div class="mb-2"><a
                                                                href="{{url('product/detail',[$products->id])}}"
                                                                class="font-size-12 text-gray-5">{{$cate->category_name}}</a></div>
                                                        <h5 class="mb-1 product-item__title"><a
                                                                href="{{url('product/detail',[$products->id])}}"
                                                                class="text-blue font-weight-bold">{{$products->product_name}}</a></h5>
                                                        <div class="mb-2">
                                                            <a href="{{url('product/detail',[$products->id])}}"
                                                                class="d-block text-center"><img class="img-fluid" src="{{asset('images/products/'.$products->product_img)}}" alt="Image Description"></a>
                                                        </div>
                                                        <div class="flex-center-between mb-1">
                                                            <div class="prodcut-price">
                                                                {{-- <div class="text-gray-100">30,990,000đ</div> --}}
                                                            </div>
                                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                                <a href="{{url('product/detail',[$products->id])}}"
                                                                    class="btn btn-primary transition-3d-hover">Xem chi tiết</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        <!-- End Tab Content -->
        </div>
    </div>
    <!-- End Products-4-1-4 -->
    <!-- Full banner -->
    <div class="mb-6">
        <a href="../shop/shop.html" class="d-block text-gray-90" style="height: 300px">
            <div class="" style="background-image: url({{asset('images/background.gif')}});height: 300px;background-repeat: no-repeat;background-size: 100%;">
            </div>
        </a>
    </div>
    <!-- End Full banner -->
    <div class="container">
        <!-- Prodcut-cards-carousel -->
        <div class="space-top-2">
            <div
                class=" d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                <h3 class="section-title mb-0 pb-2 font-size-22" style="color: black">Top sản phẩm bán chạy</h3>
            </div>
            <div class="js-slide">
                <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                    @foreach( $top20 as $top)
                    <li
                        class="col-wd-3 col-md-4 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner p-md-3 row no-gutters">
                                <div class="col col-lg-auto product-media-left">
                                    <a href="{{url('product/detail',[$top->id])}}"
                                        class="max-width-150 d-block"><img class="img-fluid"
                                            src="{{asset('images/products/'.$top->product_img)}}"
                                            alt="Image Description"></a>
                                </div>
                                <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1">
                                    <div class="mb-4">
                                        <div class="mb-2"><a
                                                href="{{url('product/detail',[$top->id])}}"
                                                class="font-size-12 text-gray-5">{{$top->category_name}}</a></div>
                                        <h5 class="product-item__title"><a
                                                href="{{url('product/detail',[$top->id])}}"
                                                class="text-blue font-weight-bold">{{$top->product_name}}</a>
                                        </h5>
                                    </div>
                                    <div class="flex-center-between mb-3">
                                        {{-- <div class="prodcut-price">
                                            <div class="text-gray-100">30,990,000đ</div>
                                        </div> --}}
                                        <div class="d-none d-xl-block prodcut-add-cart">
                                            <a href="{{url('product/detail',[$top->id])}}"
                                                class="btn btn-primary transition-3d-hover">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- End Prodcut-cards-carousel -->
        <!-- Brand Carousel -->
        <div class="mb-8">
            <div class="py-2 border-top border-bottom">
                <div class="js-slick-carousel u-slick my-1" data-slides-show="5" data-slides-scroll="1"
                    data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                    data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                    data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right" data-responsive='[{
                        "breakpoint": 992,
                        "settings": {
                            "slidesToShow": 2
                        }
                    }, {
                        "breakpoint": 768,
                        "settings": {
                            "slidesToShow": 1
                        }
                    }, {
                        "breakpoint": 554,
                        "settings": {
                            "slidesToShow": 1
                        }
                    }]'>
                    @foreach ($bannerlist as $list)
                        
                    <div class="js-slide">
                        <a href="{{$list->location}}" class="link-hover__brand">
                            <img class="img-fluid m-auto"
                                src="{{asset('images/banner/'.$list->banner_img)}}" alt="Image Description" style="width: 80%; max-height:7rem;">
                        </a>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
        <!-- End Brand Carousel -->
    </div>
</main>

<!-- Footer-top-widget -->
<div class="container d-none d-lg-block mb-3">
    <div class="row">
        <div class="col-wd-3 col-lg-4">
            <div class="widget-column">
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18" style="color: black">Sản phẩm gợi ý</h3>
                </div>
                <ul class="list-unstyled products-group">
                    @foreach ($random as $randoms)
                        
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="{{url('product/detail',[$randoms->id])}}"
                                class="d-block width-75 text-center"><img class="img-fluid"
                                    src="{{asset('images/products/'.$randoms->product_img)}}" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0"><a href="{{url('product/detail',[$randoms->id])}}"
                                    class="text-blue font-weight-bold">{{ $randoms->product_name }}</a></h5>
                            <div class="prodcut-price mt-auto" style="color: black">
                                <div class="font-size-15">{{number_format($randoms->minprice)}}đ</div>
                            </div>
                        </div>
                    </li>

                    @endforeach

                </ul>
            </div>
        </div>
        <div class="col-wd-3 col-lg-4">
            <div class="border-bottom border-color-1 mb-5">
                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18" style="color: black">Sản phẩm đang giảm giá</h3>
            </div>
            <ul class="list-unstyled products-group">
                @foreach ($product_sale as $sale)
                <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                    <div class="col-auto">
                        <a href="{{url('product/detail',[$sale->id])}}" class="d-block width-75 text-center"><img
                                class="img-fluid" src="{{asset('images/products/'.$sale->product_img)}}"
                                alt="Image Description"></a>
                    </div>
                    <div class="col pl-4 d-flex flex-column">
                        <h5 class="product-item__title mb-0"><a href="{{url('product/detail',[$sale->id])}}"
                                class="text-blue font-weight-bold">{{$sale->product_name}}</a>
                        </h5>
                        <div class="prodcut-price mt-auto flex-horizontal-center" style="color: black">
                            <ins class="font-size-15 text-decoration-none">{{ number_format($sale->minprice - ($sale->minprice * ($sale->sale/100))) }}</ins>
                            <del class="font-size-12 text-gray-9 ml-2">{{ number_format($sale->minprice) }}</del>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-wd-3 col-lg-4">
            <div class="border-bottom border-color-1 mb-5">
                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18" style="color: black">Sản phẩm đánh giá hàng đầu</h3>
            </div>
            <ul class="list-unstyled products-group">
                @foreach( $top3preview as $top3)
                <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                    <div class="col-auto">
                        <a href="{{url('product/detail',[$top3->product_id])}}" class="d-block width-75 text-center"><img
                                class="img-fluid" src="{{asset('images/products/'.$top3->product->product_img)}}"
                                alt="Image Description"></a>
                    </div>
                    <div class="col pl-4 d-flex flex-column">
                        <h5 class="product-item__title mb-0"><a href="{{url('product/detail',[$top3->product_id])}}"
                            class="text-blue font-weight-bold">{{ $top3->product->product_name }}</a></h5>
                        <?php $startWidth = ($top3->avgrate * 78 ) / 5 ?>
                        <div class="text-warning mb-2" style="overflow: hidden; width : {{$startWidth}}px">
                            <div style="width: 90px">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        {{-- @foreach($banner as $banners) --}}
        <div class="col-wd-3 d-none d-wd-block">
            <a href="{{$banner->location}}" class="d-block"><img class="img-fluid"
                    src="{{asset('images/banner/'.$banner->banner_img)}}" alt="Image Description"
                    style="width:100%"></a>
        </div>
        {{-- @endforeach --}}
    </div>
</div>
<!-- End Footer-top-widget -->
@endsection