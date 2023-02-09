@extends('client.layouts.master')
@section('main')
<main id="content" role="main" class="cart-page">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Đơn hàng chi tiết của bạn</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-4">
            <h1 class="text-center text-black">Đơn hàng chi tiết</h1>
        </div>
        <div class="mb-10 cart-table text-black">
            <table class="table text-black" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-remove">#</th>
                        <th class="product-name">Tên sản phẩm</th>
                        <th class="product-remove">Hình ảnh</th>
                        <th class="product-name">Số lượng</th>
                        <th class="product-name">Đơn giá</th>
                        <th class="product-name">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($billDetails as $item )
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $item->product_name }} - {{ $item->product_combi->combination_string }}</td>
                            <td><img src="{{asset('images/products/'.$item->product_combi->combination_image)}}" width="100px" height="80px" alt=""></td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{number_format( $item->product_combi->price) }}₫</td>
                            <td>{{number_format( $item->quantity * $item->product_combi->price )}}₫</td>
                        </tr>
                    @endforeach
                  
                </tbody>
            </table>
        </div>
    </div>
</main>
<script>
    let cartBtn = document.querySelectorAll('.deleteCart');
    cartBtn.forEach(element => {
        element.firstElementChild.stopPropagation();
    });
</script>
@endsection
