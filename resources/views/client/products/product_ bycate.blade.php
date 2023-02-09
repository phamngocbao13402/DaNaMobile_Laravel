@extends('client.layouts.master')
@section('main')
<main id="content" role="main">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{url("/")}}">Trang chủ</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Shop</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="row mb-8">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                {{-- <div class="mb-6 border border-width-2 border-color-3 borders-radius-6">
                    <!-- List -->
                    <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar view-all">
                        <li><div class="dropdown-title">Danh Mục</div></li>
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav1Collapse" data-target="#sidebarNav1Collapse">
                               Phụ kiện<span class="text-gray-25 font-size-12 font-weight-normal"></span>
                            </a>

                            <div id="sidebarNav1Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav1" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    <li><a class="dropdown-item" href="#">Tai nghe<span class="text-gray-25 font-size-12 font-weight-normal"></span></a></li>
                                    <!-- <li><a class="dropdown-item" href="#">Computer Components<span class="text-gray-25 font-size-12 font-weight-normal"> (22)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Gadgets<span class="text-gray-25 font-size-12 font-weight-normal"> (5)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Home Entertainment<span class="text-gray-25 font-size-12 font-weight-normal"> (7)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Laptops & Computers<span class="text-gray-25 font-size-12 font-weight-normal"> (42)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Printers & Ink<span class="text-gray-25 font-size-12 font-weight-normal"> (63)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Smart Phones & Tablets<span class="text-gray-25 font-size-12 font-weight-normal"> (11)</span></a></li>
                                    <li><a class="dropdown-item" href="#">TV & Audio<span class="text-gray-25 font-size-12 font-weight-normal"> (66)</span></a></li>
                                    <li><a class="dropdown-item" href="#">Video Games & Consoles<span class="text-gray-25 font-size-12 font-weight-normal"> (31)</span></a></li> -->
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                    </ul>
                    <!-- End List -->
                </div> --}}
                <div class="mb-6">
                    {{-- <div class="border-bottom border-color-1 mb-5">
                        <h3 class="text-black section-title section-title__sm mb-0 pb-2 font-size-18">Bộ lọc</h3>
                    </div> --}}
                    <div class="text-black border-bottom pb-4 mb-4">
                        <h4 class="font-size-14 mb-3 font-weight-bold">Nhãn hiệu</h4>
                        @foreach ($categoryList as $cate)
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="brandAdidas">
                                <label class="custom-control-label" for="brandAdidas">{{$cate->category_name}}
                                    <span class="text-gray-25 font-size-12 font-weight-normal"> ({{$cate->countPro}})</span>
                                </label>
                            </div>
                        </div>
                        @endforeach
                        <!-- Checkboxes -->
                      
                        <!-- End Checkboxes -->

                        <!-- Link -->
                        <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse" href="#collapseBrand" role="button" aria-expanded="false" aria-controls="collapseBrand">
                            <span class="link__icon text-gray-27 bg-white">
                            </span>
                        </a>
                        <!-- End Link -->
                    </div>
                 
                    <div class="range-slider">
                        <h4 class="font-size-14 mb-3 font-weight-bold text-black">Giá</h4>
                        <!-- Range Slider -->
                        <form action="{{ route('filter_price')  }}" method="GET">
                        <select name="select_price">
                            <option value="1">Dưới 3 triệu</option>
                            <option value="2">Dưới 5 triệu</option>
                            <option value="3">Trên 5 triệu</option>
                        </select>
                        
                       

                        <!-- End Range Slider -->
                        <div class="mt-1 text-gray-111 d-flex mb-4">
                            <span class="mr-0dot5">Giá: </span>
                            <span>$</span>
                            <span id="rangeSliderExample3MinResult" class=""></span>
                            <span class="mx-0dot5"> — </span>
                            <span>$</span>
                            <span id="rangeSliderExample3MaxResult" class=""></span>
                        </div>
                        <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-wd-9gdot5">

                <!-- Shop-control-bar -->
                <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                    <div class="d-xl-none">
                        <!-- Account Sidebar Toggle Button -->
                        <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                            aria-controls="sidebarContent1"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-unfold-event="click"
                            data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent1"
                            data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInLeft"
                            data-unfold-animation-out="fadeOutLeft"
                            data-unfold-duration="500">
                            <i class="text-black fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
                        </a>
                        <!-- End Account Sidebar Toggle Button -->
                    </div>
                    <div class="px-3 d-none d-xl-block">
                        <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="false">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-th"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-align-justify"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-three-example1-tab" data-toggle="pill" href="#pills-three-example1" role="tab" aria-controls="pills-three-example1" aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-list"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-four-example1-tab" data-toggle="pill" href="#pills-four-example1" role="tab" aria-controls="pills-four-example1" aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-th-list"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End Shop-control-bar -->
                <!-- Shop Body -->
                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                        <ul class="row list-unstyled products-group no-gutters">
                            @foreach ($productList as $product)
                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner px-xl-4 p-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a href="{{url('product/byCate', [$product->category_id])}}" class="font-size-12 text-gray-5">{{$product->category->category_name}}</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{url('product/detail', [$product->id])}}" class="text-blue font-weight-bold">{{$product->product_name}}</a></h5>
                                            <div class="mb-2">
                                                <a href="{{url('product/detail', [$product->id])}}" class="d-block text-center"><img class="img-fluid" src="{{asset('images/products/'.$product->product_img)}}" alt="Image Description"></a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">{{number_format($product->minPrice)}}đ</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="tab-pane fade pt-2" id="pills-two-example1" role="tabpanel" aria-labelledby="pills-two-example1-tab" data-target-group="groups">
                        <ul class="row list-unstyled products-group no-gutters">
                            @foreach ($productList as $product)

                            <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner px-xl-4 p-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a href="{{url('product/byCate', [$product->category_id])}}" class="font-size-12 text-gray-5">{{$product->category->category_name}}</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{url('product/detail', [$product->id])}}" class="text-blue font-weight-bold">{{$product->product_name}}</a></h5>
                                            <div class="mb-2">
                                                <a href="{{url('product/detail', [$product->id])}}" class="d-block text-center"><img class="img-fluid" src="{{asset('images/products/'.$product->product_img)}}" alt="Image Description"></a>
                                            </div>
                                            <div class="mb-3">
                                                <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                    <div class="text-warning mr-2">
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                    </div>
                                                    <span class="text-secondary">(40)</span>
                                                </a>
                                            </div>
                                            <ul class="font-size-12 p-0 text-gray-110 mb-4">
                                                <li class="line-clamp-1 mb-1 list-bullet">Brand new and high quality</li>
                                                <li class="line-clamp-1 mb-1 list-bullet">Made of supreme quality, durable EVA crush resistant, anti-shock material.</li>
                                                <li class="line-clamp-1 mb-1 list-bullet">20 MP Electro and 28 megapixel CMOS rear camera</li>
                                            </ul>
                                            <div class="text-gray-20 mb-2 font-size-12">SKU: FW511948218</div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">${{$product->minPrice}}</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="{{url('product/detail', [$product->id])}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach


                        </ul>
                    </div>

                    <div class="tab-pane fade pt-2" id="pills-three-example1" role="tabpanel" aria-labelledby="pills-three-example1-tab" data-target-group="groups">
                        <ul class="d-block list-unstyled products-group prodcut-list-view">
                            @foreach ($productList as $product)


                            <li class="product-item remove-divider">
                                <div class="product-item__outer w-100">
                                    <div class="product-item__inner remove-prodcut-hover py-4 row">
                                        <div class="product-item__header col-6 col-md-4">
                                            <div class="mb-2">
                                                <a href="{{url('product/detail', [$product->id])}}" class="d-block text-center"><img class="img-fluid" src="{{asset('images/products/'.$product->product_img)}}" alt="Image Description"></a>
                                            </div>
                                        </div>
                                        <div class="product-item__body col-6 col-md-5">
                                            <div class="pr-lg-10">
                                                <div class="mb-2"><a href="{{url('product/byCate', [$product->category_id])}}" class="font-size-12 text-gray-5">{{$product->category->category_name}}</a></div>
                                                <h5 class="mb-2 product-item__title"><a href="{{url('product/detail', [$product->id])}}" class="text-blue font-weight-bold">{{$product->product_name}}</a></h5>
                                                <div class="prodcut-price mb-2 d-md-none">
                                                    <div class="text-gray-100">${{$product->minPrice}}</div>
                                                </div>
                                                <div class="mb-3 d-none d-md-block">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                                <ul class="font-size-12 p-0 text-gray-110 mb-4 d-none d-md-block">
                                                    <li class="line-clamp-1 mb-1 list-bullet">Brand new and high quality</li>
                                                    <li class="line-clamp-1 mb-1 list-bullet">Made of supreme quality, durable EVA crush resistant, anti-shock material.</li>
                                                    <li class="line-clamp-1 mb-1 list-bullet">20 MP Electro and 28 megapixel CMOS rear camera</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-item__footer col-md-3 d-md-block">
                                            <div class="mb-3">
                                                <div class="prodcut-price mb-2">
                                                    <div class="text-gray-100">${{$product->minPrice}}</div>
                                                </div>
                                                <div class="prodcut-add-cart">
                                                    <a href="{{url('product/detail', [$product->id])}}" class="btn btn-sm btn-block btn-primary-dark btn-wide transition-3d-hover">Add to cart</a>
                                                </div>
                                            </div>
                                            <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="tab-pane fade pt-2" id="pills-four-example1" role="tabpanel" aria-labelledby="pills-four-example1-tab" data-target-group="groups">
                        <ul class="d-block list-unstyled products-group prodcut-list-view-small">
                            @foreach ($productList as $product)
                            <li class="product-item remove-divider">
                                <div class="product-item__outer w-100">
                                    <div class="product-item__inner remove-prodcut-hover py-4 row">
                                        <div class="product-item__header col-6 col-md-2">
                                            <div class="mb-2">
                                                <a href="{{url('product/detail', [$product->id])}}" class="d-block text-center"><img class="img-fluid" src="{{asset('images/products/'.$product->product_img)}}" alt="Image Description"></a>
                                            </div>
                                        </div>
                                        <div class="product-item__body col-6 col-md-7">
                                            <div class="pr-lg-10">
                                                <div class="mb-2"><a href="{{url('product/byCate', [$product->category_id])}}" class="font-size-12 text-gray-5">{{$product->category->category_name}}</a></div>
                                                <h5 class="mb-2 product-item__title"><a href="{{url('product/detail', [$product->id])}}" class="text-blue font-weight-bold">{{$product->product_name}}</a></h5>
                                                <div class="prodcut-price d-md-none">
                                                    <div class="text-gray-100">${{$product->minPrice}}</div>
                                                </div>
                                                <ul class="font-size-12 p-0 text-gray-110 mb-4 d-none d-md-block">
                                                    <li class="line-clamp-1 mb-1 list-bullet">Brand new and high quality</li>
                                                    <li class="line-clamp-1 mb-1 list-bullet">Made of supreme quality, durable EVA crush resistant, anti-shock material.</li>
                                                    <li class="line-clamp-1 mb-1 list-bullet">20 MP Electro and 28 megapixel CMOS rear camera</li>
                                                </ul>
                                                <div class="mb-3 d-none d-md-block">
                                                    <a class="d-inline-flex align-items-center small font-size-14" href="#">
                                                        <div class="text-warning mr-2">
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="fas fa-star"></small>
                                                            <small class="far fa-star text-muted"></small>
                                                        </div>
                                                        <span class="text-secondary">(40)</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer col-md-3 d-md-block">
                                            <div class="mb-2 flex-center-between">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">${{$product->minPrice}}</div>
                                                </div>
                                                <div class="prodcut-add-cart">
                                                    <a href="{{url('product/detail', [$product->id])}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                            <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
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
                <!-- Recommended Products -->
                <div class="mb-6 d-none d-xl-block">
                    <div class="position-relative">
                        <div class="border-bottom border-color-1 mb-2">
                            <h3 class="text-black d-inline-block section-title section-title__full mb-0 pb-2 font-size-22">Sản phẩm gợi ý</h3>
                        </div>
                        <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
                            data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                            data-slides-show="5"
                            data-slides-scroll="1"
                            data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                            data-arrow-left-classes="fa fa-angle-left right-1"
                            data-arrow-right-classes="fa fa-angle-right right-0"
                            data-responsive='[{
                              "breakpoint": 1400,
                              "settings": {
                                "slidesToShow": 4
                              }
                            }, {
                                "breakpoint": 1200,
                                "settings": {
                                  "slidesToShow": 4
                                }
                            }, {
                              "breakpoint": 992,
                              "settings": {
                                "slidesToShow": 3
                              }
                            }, {
                              "breakpoint": 768,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }, {
                              "breakpoint": 554,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }]'>
                            @foreach ($recommendProducts as $product)

                                <div class="js-slide products-group">
                                    <div class="product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-wd-4 p-2 p-md-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a href="{{url('product/detail', [$product->id])}}" class="font-size-12 text-gray-5">{{$product->category->category_name}}</a></div>
                                                    <h5 class="mb-1 product-item__title"><a href="{{url('product/detail', [$product->id])}}" class="text-blue font-weight-bold">{{$product->product_name}}</a></h5>
                                                    <div class="mb-2">
                                                        <a href="{{url('product/detail', [$product->id])}}" class="d-block text-center"><img class="img-fluid" src="{{asset('images/products/'.$product->product_img)}}" alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">{{number_format($product->minPrice)}}đ</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="{{url('product/detail', [$product->id])}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> So sánh</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Yêu thích</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
                <!-- End Recommended Products -->
            </div>
        </div>
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
@endsection
