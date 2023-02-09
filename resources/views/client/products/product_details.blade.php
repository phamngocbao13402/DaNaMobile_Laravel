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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Trang
                                chủ</a>
                        </li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                href="{{url('/product/byCate/', [$product->category->id])}}">{{$product->category->category_name}}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">
                            {{$product->product_name}}</li>
                    </ol>
                </nav>
            </div>
            <input type="hidden" value="{{$product->id}}" id="product_id">
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->
    <div class="container">
        <!-- Single Product Body -->
        <div class="mb-xl-14 mb-6" style="color:black">
            <div class="row">
                <div class="col-md-5 mb-4 mb-md-0">
                    <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2" data-infinite="true"
                        data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                        data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                        data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                        data-nav-for="#sliderSyncingThumb">

                        @foreach ($product->images as $productImage)

                        <div class="js-slide">
                            <img class="img-fluid" src="{{asset('images/products/'.$productImage->medium)}}"
                                alt="Image Description">
                        </div>
                        @endforeach



                    </div>

                    <div id="sliderSyncingThumb"
                        class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                        data-infinite="true" data-slides-show="5" data-is-thumbs="true"
                        data-nav-for="#sliderSyncingNav">
                        @foreach ($product->images as $productImage)
                        <div class="js-slide combi-image-js" name="combi-image-js" style="cursor: pointer;">
                            <input type="hidden" name="js-name-combiImg" value="{{$productImage->medium}}">
                            <img class="img-fluid" src="{{asset('images/products/'.$productImage->medium)}}"
                                alt="Image Description">
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-7 mb-md-6 mb-lg-0">
                    <div class="mb-2">
                        <div class="border-bottom mb-3 pb-md-1 pb-3">
                            <a href="#"
                                class="font-size-12 text-gray-5 mb-2 d-inline-block">{{$product->category->category_name}}</a>
                            <h2 class="font-size-25 text-lh-1dot2">{{$product->product_name}}</h2>
                            <div class="mb-2">
                                <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                    @if (isset ($round))
                                    <div class="text-warning" style="overflow: hidden; width : {{$round*90/5-5}}px">
                                        <div style="width: 90px">
                                            <small class="fas fa-star"></small>
                                            <small class="fas fa-star"></small>
                                            <small class="fas fa-star"></small>
                                            <small class="fas fa-star"></small>
                                            <small class="fas fa-star"></small>
                                        </div>
                                    </div>
                                    <span class="text-secondary font-size-13 " style="margin-left: 10px;">| ({{$countall}} người dùng đánh giá)</span>
                                    @else   
                                                                  
                                    @endif
                                </a>
                            </div>
                            <div class="d-md-flex align-items-center">
                                <a href="#" class="max-width-150 ml-n2 mb-2 mb-md-0 d-block"><img class="img-fluid"
                                        src="{{asset('images/categories/'.$product->category->category_image)}}"
                                        width="80px"
                                        alt="Image Description"></a>
                                <div class="ml-md-3 text-gray-9 font-size-14">Số lượng trong kho: <span
                                        class="text-green font-weight-bold" id="avilableStock_product">{{$product->avilableStock0}}</span></div>
                            </div>
                        </div>
                        <div class="flex-horizontal-center flex-wrap mb-4">

                            <a href="" id="addWishlist"><i class="ec ec-favorites mr-1 font-size-15"></i> Sản phẩm yêu thích</a>
                            <a href="" id="addCompare" class="text-blue font-size-13 ml-2" >
                                <i class="ec ec-compare mr-1 font-size-15"></i> So sánh</a>
                        </div>
                

                        <p><strong >SKU</strong>: <span id="sku_product">{{$product->sku0}}</span> </p>
                        <div class="mb-4">
                            <div class="d-flex align-items-baseline">
                                <ins id="pricesale_product" data-price="{{$product->minprice}} - {{$product->maxprice}}" class="font-size-36 text-decoration-none">{{number_format($product->minprice)}}đ -
                                    {{number_format($product->maxprice)}}đ</ins>
                            </div>
                                <del id="price_product" data-price="{{$product->minprice}} - {{$product->maxprice}}" class="font-size-25" style="color: rgb(117, 117, 132)"></del>
                        </div>
                        <input type="hidden" id="countVariation" value="{{count($product->variations)}}">
                        <div class="border-top border-bottom py-3 mb-4">
                            <div class="d-flex align-items-center">

                                <div>
                                    @foreach ($product->variations as $variation)
                                    <p class="title-variation">{{$variation->variation_name}}</p>
                                    <div class="css-radio-container">
                                        <form>
                                        @php
                                            $variationsIsset = [];
                                        @endphp

                                        @foreach ($product->variation_value as $item)
                                            @if ($variation->variation_name === $item->variation_name)

                                            @if (!in_array($item->variation_value, $variationsIsset))
                                            <label for="">

                                                <input type="radio" class="js-change-variation" name="{{$variation->variation_name}}"
                                                id="{{$item->variation_value}}" value="{{$item->variation_value}}">
                                                <span>{{$item->variation_value}}</span>
                                            </label>

                                        @endif

                                        @php
                                            $variationsIsset[] = $item->variation_value;
                                        @endphp


                                        @endif
                                        @endforeach
                                        </form>
                                    </div>

                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <form id="addtocart1" action="" method="get">
                        <div class="d-md-flex align-items-end mb-3">
                            <div class="max-width-150 mb-4 mb-md-0">
                                <h6 class="font-size-14">Số lượng</h6>
                                <!-- Quantity -->
                                <div class="border rounded-pill py-2 px-3 border-color-1">
                                    <div class="js-quantity row align-items-center">
                                        <div class="col">
                                            <input
                                                class="js-result form-control h-auto border-0 rounded p-0 shadow-none"
                                                type="number" value="1"  min="1" name="quantity_sp">
                                        </div>
                                        <div class="col-auto pr-1">
                                            <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                href="">
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                            </a>
                                            <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                href="">
                                                <small class="fas fa-plus btn-icon__inner"></small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Quantity -->
                            </div>
                            <div class="ml-md-3">
                                <button type="submit" class="btn px-5 btn-primary-dark transition-3d-hover" id="addtocart"><i
                                    class="ec ec-add-to-cart mr-2 font-size-20"></i>Thêm vào giỏ hàng
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Product Body -->
        <!-- Single Product Tab -->
        <div class="mb-8">
            <div class="position-relative position-md-static px-md-6">
                <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0"
                    id="pills-tab-8" role="tablist">
                    <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill"
                            href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1"
                            aria-selected="true">Mô tả</a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1"
                            role="tab" aria-controls="Jpills-two-example1" aria-selected="false">Thông số sản phẩm</a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill"
                            href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1"
                            aria-selected="false">Nhận xét</a>
                    </li>
                </ul>
            </div>
            <!-- Tab Content -->
            <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9" style="color: black">
                <div class="tab-content" id="Jpills-tabContent">
                    <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel"
                        aria-labelledby="Jpills-one-example1-tab">
                        <div class="row no-gutters">
                            <div class="col mb-6 mb-md-0">
                                <ul class="nav flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                    <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1"><strong>SKU:</strong>
                                        <span class="sku">{{$product->sku}}</span>
                                    </li>
                                    <li class="nav-item text-gray-111 mx-3 flex-shrink-0 flex-xl-shrink-1">/</li>
                                    <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1"><strong>Danh mục:</strong>
                                        <a href="#" class="text-blue">{{$product->category->category_name}}</a>
                                    </li>
                                    <li class="nav-item text-gray-111 mx-3 flex-shrink-0 flex-xl-shrink-1">/</li>
                                </ul>
                                <div class="row">
                                    <?php echo $product->product_desc ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Jpills-two-example1" role="tabpanel"
                        aria-labelledby="Jpills-two-example1-tab">
                        <div class="mx-md-5 pt-1" style="color: black">
                            {{-- <h3 class="font-size-18 mb-4">Technical Specifications</h3> --}}
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach ($product->specfications as $productSpec)
                                        <tr>
                                            <th class="px-4 px-xl-5">{{$productSpec->specification_name}}</th>
                                            <td>{{$productSpec->specification_value}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel"
                        aria-labelledby="Jpills-three-example1-tab">
                        <div class="row mb-8">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h3 class="font-size-18 mb-6">Dựa trên {{$countall}} đánh giá</h3>
                                    @if (isset ($round))                                      
                                    <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0">{{$round}}</h2> 
                                    <div class="text-lh-1">Tổng thể</div>                                                             
                                    @else   
                                                                  
                                    @endif
                                </div>

                                <!-- Ratings -->
                                <ul class="list-unstyled">
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 100px;">
                                                    <?php 
                                                    for ($i = 0; $i < 5; $i++){
                                                   echo '<i class="fas fa-star"></i>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 100%;"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">{{$count5}}</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 100px;">
                                                    <?php 
                                                    for ($i = 0; $i < 4; $i++){
                                                   echo '<i class="fas fa-star"></i>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 53%;"
                                                        aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">{{$count4}}</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 100px;">
                                                    <?php 
                                                    for ($i = 0; $i < 3; $i++){
                                                   echo '<i class="fas fa-star"></i>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 20%;"
                                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">{{$count3}}</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 100px;">
                                                    <?php 
                                                    for ($i = 0; $i < 2; $i++){
                                                   echo '<i class="fas fa-star"></i>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 1%;"
                                                        aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">{{$count2}}</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-1">
                                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 100px;">
                                                    <?php 
                                                    for ($i = 0; $i < 1; $i++){
                                                   echo '<i class="fas fa-star"></i>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2 mb-md-0">
                                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                    <div class="progress-bar" role="progressbar" style="width: 1%;"
                                                        aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-auto text-right">
                                                <span class="text-gray-90">{{$count1}}</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <!-- End Ratings -->
                            </div>
                            <div class="col-md-6" style="color:black">
                                <h3 class="font-size-18 mb-5">Thêm đánh giá</h3>
                                <!-- Form -->
                                
                                <form class="js-validate" id="review" action="{{route('preview',$product->id)}}" method="POST">
                                    @csrf
                                    @if (Auth::check())
                                    <div class="row align-items-center mb-4">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="rating" class="form-label mb-0">Đánh giá sao của bạn</label>
                                        </div>
                                        <style>
                                            .rating {
                                                    display: flex;
                                                    flex-direction: row-reverse;
                                                    justify-content: center;
                                                }

                                                .rating > input{ display:none;}

                                                .rating > label {
                                                    position: relative;
                                                        width: 1em;
                                                        font-size: 2vw;
                                                        color: #FFD600;
                                                        cursor: pointer;
                                                }
                                                .rating > label::before{ 
                                                    content: "\2605";
                                                    position: absolute;
                                                    opacity: 0;
                                                }
                                                .rating > label:hover:before,
                                                .rating > label:hover ~ label:before {
                                                    opacity: 1 !important;
                                                }

                                                .rating > input:checked ~ label:before{
                                                    opacity:1;
                                                }

                                                .rating:hover > input:checked ~ label:before{ opacity: 0.4; }



                                                p{ font-size: 1.2rem;}
                                                @media only screen and (max-width: 600px) {
                                                    h1{font-size: 14px;}
                                                    p{font-size: 12px;}
                                                }
                                        </style>
                                        <div class="rating">
                                            <a href="#" class="d-block">
                                                <div class="rating">
                                                    <input type="radio" name="rating status" value="5" id="5"><label for="5">☆</label>
                                                    <input type="radio" name="rating status" value="4" id="4"><label for="4">☆</label>
                                                    <input type="radio" name="rating status" value="3" id="3"><label for="3">☆</label>
                                                    <input type="radio" name="rating status" value="2" id="2"><label for="2">☆</label>
                                                    <input type="radio" name="rating status" value="1" id="1"><label for="1">☆</label>
                                                  </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="js-form-message form-group mb-3 row">
                                        <div class="col-md-4 col-lg-3">
                                            <label for="descriptionTextarea" class="form-label">Đánh giá của bạn</label>
                                        </div>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control p-5" rows="4" name="review"
                                                placeholder=""></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="offset-md-4 offset-lg-3 col-auto">
                                            <button type="submit"
                                                class="btn btn-primary-dark btn-wide transition-3d-hover">Gửi</button>
                                        </div>
                                    </div>
                                    @else 
                                    <p class="text-gray-90"> Bạn cần đăng nhập để đánh giá sản phẩm <span class="text-dark"
                                        style="color: red !important;">*</span></p>
                                    @endif
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                        <!-- Review -->
                        @foreach ($previews as $preview)
                        <div class="border-bottom border-color-1 pb-4 mb-4" style="color: black">
                            <div class="u-xl-avatar mr-md-4 mb-4 mb-md-0">
                                <img class="img-fluid rounded-circle" src="{{asset('/images/user/default.jpg')}}"
                                    alt="Image Description" width="50px">
                            </div>
                            <strong>{{$preview->name}}</strong>
                            <!-- Review Rating -->
                            <div
                                class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                <div class="text-warning text-ls-n2 font-size-16" style="width: 100px;">
                                    <?php
                                    for ($i = 0; $i < $preview->status; $i++){
                                        echo '<i class="fas fa-star"></i>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- End Review Rating -->
                            <p class="text-gray-90">{{$preview->review}}</p>
                            <!-- Reviewer -->
                            <div class="mb-2">
                                <span class="font-size-13 text-gray-23">{{$preview->created_at}}</span>
                            </div>
                            <!-- End Reviewer -->
                        </div>
                        @endforeach
                        <!-- End Review -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tab Content -->
        <div class="mb-6" style="color: black">
            <div
                class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                <h3 class="section-title mb-0 pb-2 font-size-22">Sản phẩm cùng loại</h3>
            </div>
            <ul class="row list-unstyled products-group no-gutters">
                @foreach ($similarProducts as $similarProduct)
                    <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner px-xl-4 p-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2"><a href="{{url('product/detail',[$similarProduct->id])}}"
                                            class="font-size-12 text-gray-5">{{$similarProduct->category->category_name}}</a></div>
                                    <h5 class="mb-1 product-item__title"><a href="{{url('product/detail',[$similarProduct->id])}}"
                                            class="text-blue font-weight-bold">{{$similarProduct->product_name}}</a></h5>
                                    <div class="mb-2">
                                        <a href="{{url('product/detail',[$similarProduct->id])}}" class="d-block text-center"><img
                                                class="img-fluid" src="{{asset('images/products/'.$similarProduct->product_img)}}"
                                                alt="Image Description"></a>
                                    </div>
                                    <div class="flex-center-between mb-1" style="justify-content: center">
                                        <div class="d-none d-xl-block prodcut-add-cart">
                                            <a href="{{url('product/detail',[$similarProduct->product_id])}}"
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
    <!-- End Single Product Tab -->
    <!-- Related products -->
    
    
    <!-- End Related products -->
</main>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        let variationArray = {};

        $(document).on('change','.js-change-variation', function (e) {
            let productId = $('#product_id').val();
            let variationOptionQuantity = $('#countVariation').val();
            let key = this.name;
            let value = this.value;
            variationArray[key] = value;

            let combiArray = $.map(variationArray, function (index, value) {
                return (index);
            });

            if (combiArray.length == variationOptionQuantity) {
                data = {
                    product_id: productId,
                    combistring: combiArray.join(' '),
                    combistringReverse: combiArray.reverse().join(' ')
                };
            
                fetchProductCombination(data);
            }
        });

        function fetchProductCombination(data) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                type: "GET",
                url: "/product/combi",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.status === 200) {
                        let priceProF = Intl.NumberFormat('en-US').format(response.productCombi.price);
                        if (response.productCombi.sale > 0) {
                            let priceSalePro = response.productCombi.price - (response.productCombi.price * response.productCombi.sale/100);
                            let priceSaleProF = Intl.NumberFormat('en-US').format(priceSalePro);
                            $('#price_product').html(`${priceProF}đ`);
                            $('#pricesale_product').html(`${priceSaleProF}đ`);
                        }else {
                            $('#price_product').html("");
                            $('#pricesale_product').html(`${priceProF}đ`);
                        }

                        $('#sku_product').html(response.productCombi.sku);
                        $('#avilableStock_product').html(response.productCombi.avilableStock);
                        
                        let photoGallery = $('input[name="js-name-combiImg"]');
                        $.each(photoGallery, function (index, item) { 
                            if(item.value == response.productCombi.combination_image ) {
                                item.parentElement.click();
                            }
                        });

                        let combiId = response.productCombi.id;
                        let urlCart = "{{ route('cart.add',":id")}}";
                        urlCart = urlCart.replace(':id',combiId);

                        let urlCompare = "{{ route('compare.add',":id")}}";
                        urlCompare = urlCompare.replace(':id',combiId);

                        let urlWishlist = "{{ route('addWishlist',":id")}}";
                        urlWishlist = urlWishlist.replace(':id',combiId);

                        
                        $('#addtocart1').attr('action',`${urlCart}`)
                        $('#addtocart').attr('href', `${urlCart}`);
                        $('#addCompare').attr('href', `${urlCompare}`); 
                        $('#addWishlist').attr('href', `${urlWishlist}`);
                    }else {
                        $('#price_product').html("");
                        $('#pricesale_product').html(response.message);
                    }

                }
            });
        }
    });

    jQuery(document).ready(function($){   
          var resultVal = parseInt($('.js-result').val()); 
            $('.js-plus').click(function (e){
            e.preventDefault();  
            resultVal += 1; 
            $('.js-result').val(resultVal);
          });
          $('.js-minus').click(function (e){

            e.preventDefault();
  
            if (resultVal >= 1) {
              resultVal -= 1;
  
              $('.js-result').val(resultVal);
            } else {
              return false;
            }
          });
  
        });       
</script>