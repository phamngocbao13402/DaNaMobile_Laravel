<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{asset('images/logo/dana.png')}}" alt="" width="65%">
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Trang chủ</span></a></li>
            
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Chức năng</span><i data-feather="more-horizontal"></i></li>


            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/category/list')}}"><i data-feather="align-justify"></i><span class="menu-title text-truncate" data-i18n="align-justify">Danh mục</span></a>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/category/list')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/category/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm danh mục</span></a>
                </ul>    
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/product/list')}}"><i data-feather="gift"></i><span class="menu-title text-truncate" data-i18n="gift">Sản phẩm</span></a>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/product/list')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/product/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm sản phẩm</span></a>
                </ul> 
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/variation/list')}}"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="grid">Biến thể</span></a>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/variation_main/list')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/variation_main/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm biến thể</span></a>
                </ul> 
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href=""><i data-feather='cpu'></i><span class="menu-title text-truncate" data-i18n="grid">Thông số</span></a>
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/specification/list')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/specification/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm Thông số</span></a>
                </ul> 
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/preview/list')}}"><i data-feather="edit-2"></i><span class="menu-title text-truncate" data-i18n="edit-2">Bình luận</span></a></li>
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/order/list')}}"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="shopping-cart">Đơn hàng</span></a></li>
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/stocks/list')}}"><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="shopping-cart">Kho hàng</span></a></li>
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/user/list')}}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="user">Tài khoản</span></a></li>
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/contact/list')}}"><i data-feather="twitch"></i><span class="menu-title text-truncate" data-i18n="twitch">Liên hệ</span></a></li>
            

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/slider/list')}}"><i data-feather="columns"></i><span class="menu-title text-truncate" data-i18n="columns">Slider</span></a>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/slider/list')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/slider/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm slider</span></a>
                </ul> 
            </li>
            

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/banner/list')}}"><i data-feather="copy"></i><span class="menu-title text-truncate" data-i18n="copy">Banner</span></a>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/banner/list')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/banner/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm banner</span></a>
                </ul> 
            </li>
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/voucher/list')}}"><i data-feather="square"></i><span class="menu-title text-truncate" data-i18n="Modal Examples">Phiếu giảm giá</span></a>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/voucher/list')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/voucher/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm voucher</span></a>
                </ul> 
            </li>
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/payment/list')}}"><i data-feather="credit-card"></i><span class="menu-title text-truncate" data-i18n="credit-card">Phương thức thanh toán</span></a>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/payment/list')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/payment/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm phương thức thanh toán</span></a>
                </ul> 
            </li>
            
            
            <li class=" navigation-header"><span data-i18n="User Interface">Bài viết</span><i data-feather="more-horizontal"></i></li>
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/post/list')}}"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="file-text">Bài viết</span></a>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/post/list')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/post/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm bài viết</span></a>
                </ul> 
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/permission/')}}"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="file-text">Quyền</span></a>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/permission/')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/permission/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm quyền</span></a>
                </ul> 
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/role/')}}"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="file-text">Vai trò</span></a>

                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li><a class="d-flex align-items-center" href="{{url('admin/role/')}}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="list">Danh sách </span></a></li>
                    <li><a class="d-flex align-items-center" href="{{url('admin/role/create')}}"><i data-feather="plus-square"></i><span class="menu-title text-truncate" data-i18n="plus-square">Thêm vai trò</span></a>
                </ul> 
            </li>

            <li class=" navigation-header"><span data-i18n="User Interface">Thống kê</span><i data-feather="more-horizontal"></i></li>
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin/statistical')}}"><i data-feather="pie-chart"></i><span class="menu-title text-truncate" data-i18n="file-text">Thống kê sản phẩm</span></a>

                 
            </li>
        </ul>
    </div>
</div>