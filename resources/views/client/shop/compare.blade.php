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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{url('')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">So sánh</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="table-responsive table-bordered table-compare-list mb-10 border-0">
            <table class="table">
                <tbody>
                    @if (session('product_compare_1'))
                
                    <tr>
                        <th class="min-width-200" style="width: 20%;">Sản phẩm</th>
                        @foreach (session('product_compare_1') as $id => $details )
                        <td>
                            <a href="#" class="product d-block">
                                <div class="product-compare-image">
                                    <div class="d-flex mb-3">
                                        <img class="img-fluid mx-auto" src="{{asset('images/products/'.$details['image'])}}" alt="Image Description" width="100px">
                                    </div>
                                </div>
                                <h3 class="product-item__title text-blue font-weight-bold mb-3">{{$details['name']}}</h3>
                            </a>
                            <div class="text-warning mb-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                            </div>
                        </td>
                        @endforeach
                        
                    </tr>

                    <tr>
                        <th>Giá</th>
                        @foreach (session('product_compare_1') as $id => $details )

                        <td>
                            <div class="product-price">{{number_format($details['price'])}}đ</div>
                        </td>
                        @endforeach

                    </tr>

                    <tr>
                        <th>Số lượng</th>
                        @foreach (session('product_compare_1') as $id => $details )
                        <td>{{$details['quantity']}}
                        </td>
                        @endforeach
                    </tr>
                   
                    <tr>
                        <th>Sku</th>
                        @foreach (session('product_compare_1') as $id => $details )
                        <td>{{$details['sku']}}</td>
                        @endforeach
                    </tr>
                   
                        @foreach (session('product_compare_1') as $id => $details )
                        @foreach($details['specfications'] as $value)
                        <tr>
                        <th>{{$value['specification_name']}}</th>                       
                        <td>{{$value['specification_value']}}</td>
                    </tr>
                        @endforeach

                        @endforeach
                    {{-- <tr>
                        <th>Thêm vào giỏ hàng</th>
                        @foreach (session('product_compare_1') as $id => $details )
                        <td>
                            <div class=""><a href="{{$details['price']}}" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-3 px-xl-5">Thêm vào giỏ hàng</a></div>
                        </td>
                        @endforeach
                    </tr> --}}
                    <tr>
                        <th>Xoá</th>
                        @foreach (session('product_compare_1') as $id => $details )
                        <td class="text-center">
                            <a href="{{url('compare/delete/'.$details['id'])}}" class="text-gray-90"><i class="fa fa-times"></i></a>
                        </td>
                        @endforeach
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection