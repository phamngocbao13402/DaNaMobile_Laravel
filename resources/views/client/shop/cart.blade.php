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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active text-black" aria-current="page">Giỏ hàng</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-4">
            <h1 class="text-center text-black">Giỏ hàng </h1>
        </div>
        <div class="mb-10 cart-table">

            <table class="table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-remove">#</th>
                        <th class="product-remove">HÌnh ảnh</th>
                        <th class="product-name">Tên sản phẩm</th>
                        <th class="product-price">Giá</th>
                        <th class="product-quantity w-lg-15">Số lượng</th>
                        <th class="product-quantity w-lg-15">Xóa</th>
                        <th class="product-quantity w-lg-15">Cập nhật</th>
                        <th class="product-subtotal">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total = 0;
                    @endphp
                    @foreach((array) session('cart') as $id => $details)

                    @php $total += $details['price'] * $details['quantity'] @endphp
                    @endforeach
                    @if (session('cart'))
                    @foreach (session('cart') as $id => $details )
                    <form action="{{url('cart/updateCart/'.$details['id_combi'])}}" method="post">
                        @csrf

                        <tr class="" data-id="{{ $id }}">
                            <td></td>
                            <td class="d-none d-md-table-cell">
                                <a href="#"><img class="img-fluid max-width-100 p-1 border border-color-1"
                                        src="{{asset('images/products/'.$details['image'])}}"
                                        alt="Image Description"></a>
                            </td>
                            <td data-title="Product">
                                <a href="#" class="text-gray-90">{{$details['name']}}</a>
                            </td>

                            <td data-title="Price">
                                <span class="">{{number_format($details['price'])}}đ</span>
                            </td>

                            {{-- <td data-title="Quantity"> --}}
                            <td data-th="Quantity">
                                <input type="number" value="{{ $details['quantity'] }}" name="quantityNew"
                                    class="form-control quantity update-cart" min="1" />
                            </td>

                            <td class="deleteCart">
                                <button class="btn btn-danger btn-sm cart_delete ">
                                    <a class="text-white"
                                        href="{{url('cart/deleteCart/'.$details['id_combi'])}}">Xóa</a>
                                </button>
                            </td>
                            <td class="deleteCart">
                                <a href="{{url('cart/updateCart/'.$details['id_combi'])}}"><button
                                        class="btn btn-danger btn-sm cart_delete">Cập nhật</button></a>
                            </td>
                            <td data-title="Total">
                                <span class="">{{number_format($details['quantity'] * $details['price'])}}đ</span>
                            </td>
                        </tr>
                    </form>
                    @endforeach
                    @endif
                    <tr>
                        <td colspan="8" class="border-top space-top-2 justify-content-center">
                            <div class="pt-md-3">
                                <div class="d-block d-md-flex flex-center-between" style="justify-content: end">
                                    
                                    <div class="d-md-flex">
                                        @if (Auth::check())
                                            <a href="{{url('checkout')}}"
                                            class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block text-white">Thanh toán</a>
                                        @else
                                            <a href="{{url('login')}}"
                                            class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block text-white">Vui lòng đăng nhập để thanh toán</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
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
