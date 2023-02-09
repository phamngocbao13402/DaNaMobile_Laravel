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
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="my-6">
                    <h1 class="text-center" style="color: black">Sản phẩm yêu thích</h1>
                </div>
                <div class="mb-16 wishlist-table">
                    <form class="mb-4" action="#" method="post">
                        <div class="table-responsive">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">Hình ảnh</th>
                                        <th class="product-name">Tên sản phảm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-Stock w-lg-15">Trạng thái</th>
                                        <th class="product-subtotal min-width-200-md-lg">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($showWl as  $item)
                                    <tr>
                                        <td class="text-center">
                                            <a href="{{url('deleteWishList/'.$item->id)}}" class="text-gray-32 font-size-26">×</a>
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <a href="#"><img class="img-fluid max-width-100 p-1 border border-color-1" src="{{asset('images/products/'.$item->image)}}" alt="Image Description"></a>
                                        </td>

                                        <td data-title="Product">
                                            <a href="#" class="text-gray-90">{{$item->name}}</a>
                                        </td>

                                        <td data-title="Unit Price">
                                            <span class="">{{number_format($item->price)}}đ</span>
                                        </td>

                                        <td data-title="Stock Status">
                                            <!-- Stock Status -->
                                            <span>Tồn tại</span>
                                            <!-- End Stock Status -->
                                        </td>

                                        <td>
                                            <a href="{{url('cart/add/'.$item->product_id)}}">
                                            <button type="button" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">Thêm vào giỏ hàng</button>
                                        </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </main>
@endsection
