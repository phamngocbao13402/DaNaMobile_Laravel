<?php
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\HomeController;

$categories = Category::all();
$cate = new HomeController();
$categorySelect = $cate->res(0);
$slider = Slider::first()->orderBy('slider.created_at','DESC')->paginate(1);
?>
{{-- Begin header --}}

<header id="header" class="u-header u-header-left-aligned-nav">
    <div class="u-header__section">
        <!-- Topbar -->
        <div class="u-header-topbar py-2 d-none d-xl-block">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="topbar-left">
                        <a href="#" class="text-gray-110 font-size-13 hover-on-dark">Chào mừng bạn đến với cửa hàng thiết bị
                            điện thoại di động DaNa-Mobile</a>

                    </div>
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">
                            <li
                                class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="{{route('bill.list')}}" class="u-header-topbar__nav-link"><i

                                        class="ec ec-transport mr-1"></i> Đơn hàng của bạn</a>
                            </li>
                            <li class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar nav-item-border">
                                <!-- Account Sidebar Toggle Button -->
                                @if (Route::has('login'))
                                    @auth
                                        <div class="position-relative">
                                            <a id="Userclient"
                                                class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal"
                                                href="javascript:;" role="button" aria-controls="userlogin" aria-haspopup="true"
                                                aria-expanded="false" data-unfold-event="hover" data-unfold-target="#userlogin"
                                                data-unfold-type="css-animation" data-unfold-duration="300"
                                                data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                                                data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                                <span class="user-name fw-bolder">{{ Auth::user()->name }}</span>
                                            </a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <div id="userlogin" class="dropdown-menu dropdown-unfold "
                                                    style="text-align:center" aria-labelledby="Userclient">
                                                    <a href="{{url('user', [Auth::user()->id])}}" class="dropdown-item">Thông tin cá nhân</a>
                                                    @if(Auth::user()->role == 1)
                                                    <a href="{{url('/admin')}}" class="dropdown-item">Trang quản trị</a>
                                                    @endif
                                                    <a href="{{url('/voucher/voucher_user')}}" class="dropdown-item">Kho voucher</a>
                                                    <a href="{{url('user/updatepass', [Auth::user()->id])}}" class="dropdown-item">Đổi mật khẩu</a>
                                                    <hr>
                                                    <a href="route('logout')"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        {{ __('Đăng xuất') }}
                                                    </a>

                                                </div>
                                            </form>
                                        </div>
                                        @else
                                            <a href="{{ route('login') }}"
                                            class="text-sm text-gray-700 dark:text-gray-500 underline">
                                            <i class="ec ec-user mr-1"></i>Đăng nhập</a>
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}"
                                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">
                                                <i class="ec ec-user mr-1"></i>Đăng ký</a>
                                            @endif
                                    @endauth
                                @endif
                                <!-- End Account Sidebar Toggle Button -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <!-- Logo-Search-header-icons -->
        <div class="py-2 py-xl-5 bg-primary-down-lg">
            <div class="container my-0dot5 my-xl-0">
                <div class="row align-items-center">
                    <!-- Logo-offcanvas-menu -->
                    <div class="col-auto">
                        <!-- Nav -->
                        <nav
                            class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                            <!-- Logo -->
                            <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center"
                                href="{{url('/')}}" aria-label="DaNaMobile">

                                <img src="{{asset('images/logo/dana.png')}}" alt="" width="300px" height="60px">
                            </a>
                                <!-- End Logo-->
                        </nav>
                        <!-- End Nav -->
                    </div>
                    <!-- End Logo-offcanvas-menu -->
                    <!-- Search Bar -->
                    <div class="col d-none d-xl-block">
                        <form class="js-focus-state" action="{{url('/product/search')}}" method="GET">
                            @csrf
                            <label class="sr-only" for="searchproduct">Tìm kiếm</label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control py-2 pl-5 font-size-15 border-right-0 height-40 border-width-2 rounded-left-pill border-primary"
                                    name="keyword" id="searchproduct-item" placeholder="Tìm kiếm Sản Phẩm"
                                    aria-label="Search for Products" aria-describedby="searchProduct1" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary height-40 py-2 px-3 rounded-right-pill" type="submit"
                                        id="searchProduct1">
                                        <span class="ec ec-search font-size-24"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- End Search Bar -->
                    <!-- Header Icons -->
                    <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                        <div class="d-inline-flex">
                            <ul class="d-flex list-unstyled mb-0 align-items-center">
                                <!-- Search -->
                                <li class="col d-xl-none px-2 px-sm-3 position-static">
                                    <a id="searchClassicInvoker"
                                        class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary"
                                        href="javascript:;" role="button" data-toggle="tooltip" data-placement="top"
                                        title="Search" aria-controls="searchClassic" aria-haspopup="true"
                                        aria-expanded="false" data-unfold-target="#searchClassic"
                                        data-unfold-type="css-animation" data-unfold-duration="300"
                                        data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                                        data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                        <span class="ec ec-search"></span>
                                    </a>

                                    <!-- Input -->
                                    <div id="searchClassic"
                                        class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2"
                                        aria-labelledby="searchClassicInvoker">
                                        <form class="js-focus-state input-group px-3">
                                            <input class="form-control" type="search" placeholder="Search Product">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary px-3" type="button"><i
                                                        class="font-size-18 ec ec-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Input -->
                                </li>
                                <!-- End Search -->
                                <li class="col d-none d-xl-block"><a href="{{url('compare')}}" class="text-gray-90"
                                        data-toggle="tooltip" data-placement="top" title="So sánh"><i
                                            class="font-size-22 ec ec-compare"></i></a></li>
                                @if(isset(Auth::user()->id))
                                <li class="col d-none d-xl-block"><a href="{{url('listWishList')}}" class="text-gray-90"
                                        data-toggle="tooltip" data-placement="top" title="Yêu thích"><i
                                            class="font-size-22 ec ec-favorites"></i></a></li>
                                @endif 
                              
                                <li class="col pr-xl-0 px-2 px-sm-3 d-none d-xl-block">
                                    <div id="basicDropdownHoverInvoker" class="text-gray-90 position-relative d-flex "
                                        data-toggle="tooltip" data-placement="top" title="Giỏ hàng"
                                        aria-controls="basicDropdownHover" aria-haspopup="true" aria-expanded="false"
                                        data-unfold-event="click" data-unfold-target="#basicDropdownHover"
                                        data-unfold-type="css-animation" data-unfold-duration="300"
                                        data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                                        data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                        <i class="font-size-22 ec ec-shopping-bag"></i>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach((array) session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        @endforeach
                                        <span
                                            class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white" > <?=count((array) session('cart'))?> </span>
                                        <span
                                            class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3">{{number_format($total)}}đ</span>
                                    </div>
                                    <div id="basicDropdownHover"
                                        class="cart-dropdown dropdown-menu dropdown-unfold border-top border-top-primary mt-3 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0"
                                        aria-labelledby="basicDropdownHoverInvoker">
                                        @if (session('cart'))
                                        @foreach (session('cart') as $id => $details )
                                        <ul class="list-unstyled px-3 pt-3">
                                            <li class="border-bottom pb-3 mb-3">
                                                <div class="">
                                                    <ul class="list-unstyled row mx-n2">
                                                        <li class="px-2 col-5">
                                                            <img class="img-fluid" src="{{asset('images/products/'.$details['image'])}}"
                                                                alt="Image Description">
                                                        </li>
                                                        <li class="px-2 col-5">
                                                            <h5 class="text-blue font-size-14 font-weight-bold">{{$details['name']}}</h5>
                                                            <span class="font-size-14">{{$details['quantity']}} X {{$details['price']}}</span>
                                                        </li>
                                                        <li class="px-2 col-2">
                                                            <a href="{{url('cart/deleteCart/'.$details['id_combi'])}}" class="text-gray-90"><i
                                                                    class="ec ec-close-remove"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                        @endforeach
                                        @endif
                                        <div class="flex-center-between px-4 pt-2">
                                            <a href="{{url('/cart/')}}"
                                            class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">Giỏ hàng</a>
                                            @if (Auth::check() && count((array) session('cart')) == 0)
                                                <a href="{{url('/')}}"
                                                class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 text-white">Mua Hàng</a>
                                            @elseif (Auth::check() && count((array) session('cart')) > 0)
                                                <a  href="{{url('/checkout/')}}"
                                                class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 text-white">Thanh toán</a>
                                            @elseif (!Auth::check())
                                            <a  href="{{url('/login/')}}"
                                            class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 text-white">Đăng nhập</a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Logo-Search-header-icons -->
        <!-- Vertical-and-secondary-menu -->
        <div class="d-none d-xl-block container">
            <div class="row">
                <!-- Vertical Menu -->
                <div class="col-md-auto d-none d-xl-block">
                    <div class="max-width-270 min-width-270">
                        <!-- Basics Accordion -->
                        <div id="basicsAccordion">
                            <!-- Card -->
                            <div class="card border-0">
                                <div class="card-header card-collapse border-0" id="basicsHeadingOne">


                                    <button type="button" id="js-header-btn"

                                        class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90"
                                        data-toggle="collapse" data-target="#basicsCollapseOne" aria-expanded="true"
                                        aria-controls="basicsCollapseOne">
                                        <span class="ml-0 text-gray-90-cate mr-2">
                                            <span class="fa fa-list-ul"></span>
                                        </span>
                                        <span class="pl-1 text-gray-90-cate">Danh mục</span>
                                    </button>
                                </div>
                                <div id="basicsCollapseOne" class="collapse show vertical-menu"
                                    aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion">
                                    <div class="card-body p-0">
                                        <nav
                                            class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                            <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                                <ul class="navbar-nav u-header__navbar-nav">
                                                    <!-- Nav Item MegaMenu -->
                                                    {!! $categorySelect !!}
                                                    <!-- End Nav Item MegaMenu-->

                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Basics Accordion -->
                    </div>
                </div>
                <!-- End Vertical Menu -->
                <!-- Secondary Menu -->
                <div class="col">
                    <!-- Nav -->
                    <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                        <!-- Navigation -->
                        <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                            <ul class="navbar-nav u-header__navbar-nav">
                                <!-- Home -->
                                <li class="nav-item u-header__nav-item">
                                    <a class="nav-link u-header__nav-link" href="{{url('/')}}"
                                        aria-haspopup="true" aria-expanded="false" aria-labelledby="pagesSubMenu">Trang chủ</a>
                                </li>
                                <!-- End Home -->

                                <!-- Featured Brands -->
                                <li class="nav-item u-header__nav-item">
                                    <a class="nav-link u-header__nav-link" href="{{url('/blogs')}}"
                                        aria-haspopup="true" aria-expanded="false" aria-labelledby="pagesSubMenu">Bài viết</a>
                                </li>
                                <!-- End Featured Brands -->

                                <!-- Trending Styles -->
                                <li class="nav-item u-header__nav-item">
                                    <a class="nav-link u-header__nav-link" href="{{url('/contact')}}" aria-haspopup="true"
                                        aria-expanded="false" aria-labelledby="blogSubMenu">Liên hệ</a>
                                </li>

                                <li class="nav-item u-header__nav-item">
                                    <a class="nav-link u-header__nav-link" href="{{url('/voucher')}}" aria-haspopup="true"
                                        aria-expanded="false" aria-labelledby="blogSubMenu">Săn Voucher</a>
                                </li>
                                <!-- End Trending Styles -->

                                <!-- Gift Cards -->
                                {{-- <li class="nav-item u-header__nav-item">
                                    <a class="nav-link u-header__nav-link" href="#" aria-haspopup="true"
                                        aria-expanded="false">Gift Cards</a>
                                </li> --}}
                                <!-- End Gift Cards -->
                            </ul>
                        </div>
                        <!-- End Navigation -->
                    </nav>
                    <!-- End Nav -->
                </div>
                <!-- End Secondary Menu -->
            </div>
        </div>
        <!-- End Vertical-and-secondary-menu -->
    </div>
</header>

{{-- End Header --}}