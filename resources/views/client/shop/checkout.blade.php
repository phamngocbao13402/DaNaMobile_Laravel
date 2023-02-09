@extends('client.layouts.master')
@section('main')
<style>
    .dpnone{
        display: none !important;
    }

    .dpblock{
        display: block !important;
    }
    .dathang{
        color: white !important;
    }
    .cl-black{
        color: black !important;
    }
	.event-schedule-area .section-title .title-text {
    margin-bottom: 50px;
	}

	.event-schedule-area .tab-area .nav-tabs {
		border-bottom: inherit;
	}

	.event-schedule-area .tab-area .nav {
		border-bottom: inherit;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
		margin-top: 80px;
	}

	.event-schedule-area .tab-area .nav-item {
		margin-bottom: 75px;
	}
	.event-schedule-area .tab-area .nav-item .nav-link {
		text-align: center;
		font-size: 22px;
		color: #333;
		font-weight: 600;
		border-radius: inherit;
		border: inherit;
		padding: 0px;
		text-transform: capitalize !important;
	}
	.event-schedule-area .tab-area .nav-item .nav-link.active {
		color: #4125dd;
		background-color: transparent;
	}

	.event-schedule-area .tab-area .tab-content .table {
		margin-bottom: 0;
		width: 80%;
	}
	.event-schedule-area .tab-area .tab-content .table thead td,
	.event-schedule-area .tab-area .tab-content .table thead th {
		border-bottom-width: 1px;
		font-size: 20px;
		font-weight: 600;
		color: #252525;
	}
	.event-schedule-area .tab-area .tab-content .table td,
	.event-schedule-area .tab-area .tab-content .table th {
		border: 1px solid #b7b7b7;
		padding-left: 30px;
	}
	.event-schedule-area .tab-area .tab-content .table tbody th .heading,
	.event-schedule-area .tab-area .tab-content .table tbody td .heading {
		font-size: 16px;
		text-transform: capitalize;
		margin-bottom: 16px;
		font-weight: 500;
		color: #252525;
		margin-bottom: 6px;
	}
	.event-schedule-area .tab-area .tab-content .table tbody th span,
	.event-schedule-area .tab-area .tab-content .table tbody td span {
		color: #4125dd;
		font-size: 18px;
		text-transform: uppercase;
		margin-bottom: 6px;
		display: block;
	}
	.event-schedule-area .tab-area .tab-content .table tbody th span.date,
	.event-schedule-area .tab-area .tab-content .table tbody td span.date {
		color: #656565;
		font-size: 14px;
		font-weight: 500;
		margin-top: 15px;
	}
	.event-schedule-area .tab-area .tab-content .table tbody th p {
		font-size: 14px;
		margin: 0;
		font-weight: normal;
	}

 .section-title .title-text h2 {
		margin: 0px 0 15px;
	}

 ul.custom-tab {
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		border-bottom: 1px solid #dee2e6;
		margin-bottom: 30px;
	}
 ul.custom-tab li {
		margin-right: 70px;
		position: relative;
	}
 ul.custom-tab li a {
		color: #252525;
		font-size: 25px;
		line-height: 25px;
		font-weight: 600;
		text-transform: capitalize;
		padding: 35px 0;
		position: relative;
	}
 ul.custom-tab li a:hover:before {
		width: 100%;
	}
 ul.custom-tab li a:before {
		position: absolute;
		left: 0;
		bottom: 0;
		content: "";
		background: #4125dd;
		width: 0;
		height: 2px;
		-webkit-transition: all 0.4s;
		-o-transition: all 0.4s;
		transition: all 0.4s;
	}
 ul.custom-tab li a.active {
		color: #4125dd;
	}

 .primary-btn {
		margin-top: 40px;
	}

 .tab-content .table {
		-webkit-box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
		box-shadow: 0 1px 30px rgba(0, 0, 0, 0.1);
		margin-bottom: 0;
	}
 .tab-content .table thead {
		background-color: #007bff;
		color: #fff;
		font-size: 20px;
	}
 .tab-content .table thead tr th {
		padding: 20px;
		border: 0;
	}
 .tab-content .table tbody {
		background: #fff;
	}
 .tab-content .table tbody tr.inner-box {
		border-bottom: 1px solid #dee2e6;
	}
 .tab-content .table tbody tr th {
		border: 0;
		padding: 30px 20px;
		vertical-align: middle;
	}
 .tab-content .table tbody tr th .event-date {
		color: #252525;
		text-align: center;
	}
 .tab-content .table tbody tr th .event-date span {
		font-size: 50px;
		line-height: 50px;
		font-weight: normal;
	}
 .tab-content .table tbody tr td {
		padding: 30px 20px;
		vertical-align: middle;
	}
 .tab-content .table tbody tr td .r-no span {
		color: #252525;
	}
 .tab-content .table tbody tr td .event-wrap h3 a {
		font-size: 20px;
		line-height: 20px;
		color: #cf057c;
		-webkit-transition: all 0.4s;
		-o-transition: all 0.4s;
		transition: all 0.4s;
	}
 .tab-content .table tbody tr td .event-wrap h3 a:hover {
		color: #4125dd;
	}
 .tab-content .table tbody tr td .event-wrap .categories {
		display: -webkit-inline-box;
		display: -ms-inline-flexbox;
		display: inline-flex;
		margin: 10px 0;
	}
 .tab-content .table tbody tr td .event-wrap .categories a {
		color: #252525;
		font-size: 16px;
		margin-left: 10px;
		-webkit-transition: all 0.4s;
		-o-transition: all 0.4s;
		transition: all 0.4s;
	}
 .tab-content .table tbody tr td .event-wrap .categories a:before {
		content: "\f07b";
		font-family: fontawesome;
		padding-right: 5px;
	}
 .tab-content .table tbody tr td .event-wrap .time span {
		color: #252525;
	}
 .tab-content .table tbody tr td .event-wrap .organizers {
		display: -webkit-inline-box;
		display: -ms-inline-flexbox;
		display: inline-flex;
		margin: 10px 0;
	}
 .tab-content .table tbody tr td .event-wrap .organizers a {
		color: #4125dd;
		font-size: 16px;
		-webkit-transition: all 0.4s;
		-o-transition: all 0.4s;
		transition: all 0.4s;
	}
 .tab-content .table tbody tr td .event-wrap .organizers a:hover {
		color: #4125dd;
	}
 .tab-content .table tbody tr td .event-wrap .organizers a:before {
		content: "\f007";
		font-family: fontawesome;
		padding-right: 5px;
	}
 .tab-content .table tbody tr td .primary-btn {
		margin-top: 0;
		text-align: center;
	}
 .tab-content .table tbody tr td .event-img img {
		width: 150px;
		border-radius: 8px;
	}
</style>
<main id="content" role="main" class="checkout-page">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{url('/')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Thanh toán</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-5">
            <h1 class="text-center" style="color: red; font-weight: 700;">THANH TOÁN</h1>
        </div>

        <!-- Accordion -->
        <div id="shopCartAccordion1" class="accordion rounded mb-6">
            <!-- Card -->
            <div class="card border-0">
                <div id="shopCartHeadingTwo" class="alert alert-primary mb-0" role="alert" style="color: white;">
                    Có phiếu giảm giá?  <a href="#" class="alert-link" data-toggle="collapse" data-target="#shopCartTwo" aria-expanded="false" aria-controls="shopCartTwo" style="color: white;">Nhấn vào đây để nhập mã của bạn</a>
                </div>
                <div id="shopCartTwo" class="collapse border border-top-0" aria-labelledby="shopCartHeadingTwo" data-parent="#shopCartAccordion1" style="">
                    <form class="js-validate p-5">
                        <p class="w-100 text-gray-90" >Nếu bạn có mã giảm giá, vui lòng áp dụng nó bên dưới.</p>
                        <div class="input-group input-group-pill ">
                            <div class="row mb-5" style="width: 100%">
                                <div class="col-lg-12">
                                 
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table">                            
                                                    <tbody>
                                                        
                                                        <?php $i=0 ?>
                                                        @foreach($list_vu as $vu)
                                                        <tr class="inner-box">
                                                            <th scope="row">
                                                                <div class="">
                                                                    <span><?php  $i++; echo $i ?></span>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div class="event-img">
                                                                    @if($vu->vu_voucher->type == "Giảm theo tiền")
                                                                    <img src="{{asset('images/logo/price.jpg')}}" alt="" width="150px"/>
                                                                    @else
                                                                    <img src="{{asset('images/logo/per.jpg')}}" alt="" width="150px"/>
                                                                    @endif	
                                                                    
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h3><a href="#">{{$vu->vu_voucher->code}}</a></h3>
                                                                    <div class="meta">
                                                                        <div class="">
                                                                            <a href="#">{{$vu->vu_voucher->type}}</a>
                                                                        </div>
                                                                        {{-- <div class="categories">
                                                                            <a href="#">Inspire</a>
                                                                        </div> --}}
                                                                        <div class="time">
                                                                            <span>Hạn sử dụng: {{$vu->vu_voucher->time}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="r-no">
                                                                    @if($vu->vu_voucher->type == "Giảm theo tiền")
                                                                    <span>{{$vu->vu_voucher->value}} đ</span>
                                                                    @else
                                                                    <span>{{$vu->vu_voucher->value}} %</span>
                                                                    @endif												
                                                                </div>
                                                            </td>
                                                           
                                                            @if(session('vc'))
                                                                @if($vu->voucher_id !== session('vc')['id'])
                                                                    <td>
                                                                        <div class="primary-btn">
                                                                            <form action="{{url('/voucher/useCheckout')}}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" name="voucher_id" value="{{$vu->voucher_id}}">
                                                                                <button class="btn btn-primary" type="submit">Dùng ngay</button>
                                                                            </form>
                                                                        </div>
                                                                    </td>
                                                                @else
                                                                <td>
                                                                    <div class="primary-btn">                                    
                                                                        <p class="btn btn-primary">Đang sử dụng</p>
                                                                    </div>
                                                                </td>
                                                                @endif
                                                            @else
                                                            <td>
                                                                <div class="primary-btn">
                                                                    <form action="{{url('/voucher/useCheckout')}}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" name="voucher_id" value="{{$vu->voucher_id}}">
                                                                        <button class="btn btn-primary" type="submit">Dùng ngay</button>
                                                                    </form>
                                                                </div>
                                                            </td>  
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                    
                                    </div>
                    
                                </div>
                                <!-- /col end-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Accordion -->
        <form class="js-validate" novalidate="novalidate" action="{{route('done')}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                    <div class="pl-lg-3 ">
                        <div class="bg-gray-1 rounded-lg">
                            <!-- Order Summary -->
                            <div class="p-4 mb-4 checkout-table">
                                <!-- Title -->
                                <div class="border-bottom border-color-1 mb-5">
                                    <h3 class="section-title mb-0 pb-2 font-size-25 cl-black">Đơn hàng của bạn</h3>
                                </div>
                                <!-- End Title -->

                                <!-- Product Content -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-total">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php $subTotal = 0;
                                                $ship = 30000;
                                                $total = 0;
                                                
                                        ?>
                                        @foreach ( session('cart') as $cart )
                                        <?php $subTotal += $cart['price']*$cart['quantity'] ?>
                                        <tr class="cart_item">
                                            <td>{{$cart['name']}}&nbsp;<strong class="product-quantity">× {{$cart['quantity']}}</strong></td>
                                            <td>{{number_format($cart['price']*$cart['quantity'])}}đ</td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tổng tiền tạm thời</th>
                                            <td><?= number_format($subTotal) ?>đ</td>
                                        </tr>
                                        <tr>
                                            <th>Phí vận chuyển</th>
                                            <td><?= number_format($ship) ?>đ</td>
                                        </tr>
                                        @if(session('vc'))
                                        <input type="hidden" name="voucher" value="{{session('vc')['id']}}">
                                            @if(session('vc')['type'] === 'Giảm theo tiền')
                                            
                                            <tr>
                                                <th>Giảm giá</th>
                                                <td><?php $voucher =  (double)session('vc')['value']; 
                                                ?><?= $voucher ?>đ</td>
                                            </tr>
                                            @else
                                            <tr>
                                                <th>Giảm giá</th>
                                                <td><?php $voucher =  (double)$subTotal*session('vc')['value']/100;
                                                    ?><?= $voucher ?>đ</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th>Tổng</th>
                                                <td><strong><?= number_format($subTotal + $ship - $voucher) ?>đ</strong></td>
                                                <input type="hidden" value="<?= $subTotal + $ship ?>" name="total_amount">
                                            </tr>
                                        @else
                                        <tr>
                                            <th>Tổng</th>
                                            <td style="text-align: right !important;"><strong><?= number_format($subTotal + $ship) ?>đ</strong></td>
                                            <input type="hidden" value="<?= $subTotal + $ship ?>" name="total_amount">
                                        </tr>
                                        @endif
                                       
                                    </tfoot>
                                </table>
                                <!-- End Product Content -->
                                <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                    <!-- Basics Accordion -->
                                    <div id="basicsAccordion1">                                     
                                        <!-- Card -->
                                        @foreach ($payments as $payment) 
                                        <div class="border-bottom border-color-1 border-dotted-bottom">
                                            <div class="p-3" id="basicsHeading{{$payment->id}}">
                                                <div class="custom-control custom-radio" id="click{{$payment->id}}">
                                                    <input type="radio" class="custom-control-input" id="{{$payment->id}}StylishRadio1" name="payment_id" value="{{$payment->id}}">
                                                    <label class="custom-control-label form-label cl-black" for="{{$payment->id}}StylishRadio1"
                                                        data-toggle="collapse"
                                                        data-target="#basicsCollapse{{$payment->id}}"
                                                        aria-expanded="false"
                                                        aria-controls="basicsCollapse{{$payment->id}}">
                                                        {{$payment->payment_name}}
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="basicsCollapse{{$payment->id}}" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                aria-labelledby="basicsHeading{{$payment->id}}"
                                                data-parent="#basicsAccordion1">
                                                <div class="p-4 cl-black">
                                                    {{$payment->payment_content}}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach                       
                                    </div>
                                    <!-- End Basics Accordion -->
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck10" required name="check">
                                        <label class="form-check-label form-label cl-black" for="defaultCheck10">
                                            Tôi đã đọc và đồng ý <a href="#" class="text-blue">các điều khoản và điều kiện </a>
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3 dathang dpnone" name="redirect" id="redirect"><img src="{{asset('images/logo/vnpay.png')}}" style="margin-right: 20px;" width="30px">Thanh toán VNPay</button>
                                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3 dathang dpnone" name="payUrl" id="payUrl"><img src="{{asset('images/logo/momo.png')}}" style="margin-right: 20px;" width="30px">Thanh toán MOMO</button>
                                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3 dathang dpnone" name="done" id="done">Đặt hàng</button>
                            </div>
                            <!-- End Order Summary -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 order-lg-1">
                    <div class="pb-7 mb-7">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25 cl-black">Chi tiết thanh toán</h3>
                        </div>
                        <!-- End Title -->

                        <!-- Billing Form -->
                        
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label cl-black">
                                        Họ và tên
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" value="{{$user->name}}" class="form-control" name="fullname" placeholder="Jack" aria-label="Jack" required="" data-msg="Hãy nhập tên của bạn." data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off">
                                </div>
                                <!-- End Input -->
                            </div>

                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label cl-black">
                                        Tên công ty (Nếu có)
                                    </label>
                                    <input type="text" class="form-control" name="companyName" placeholder="Company Name" aria-label="Company Name" data-msg="Hãy nhập tên công ty của bạn." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label cl-black">
                                        Địa chỉ
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="address" id="address" class="form-control js-select selectpicker dropdown-select" required="" data-msg="Địa chỉ không được để trống." data-error-class="u-has-error" data-success-class="u-has-success"
                                        data-live-search="true" data-style="form-control border-color-1 font-weight-normal">
                                        <option id="" value="">Chọn địa chỉ </option>                                         
                                        @foreach($user->user_addresses as $address)
                                            <option id="{{$address->id}}" value="{{$address->id}}">{{ $address -> city }} - {{ $address -> district }} - {{ $address -> ward }} - {{ $address -> street }}                                          
                                                @if ($address->type_address == 0)
                                                    ( Nhà riêng )
                                                @else
                                                    ( Văn phòng )
                                                @endif
                                            </option>
                                        @endforeach                        
                                    </select>
                                </div>
                                <!-- End Input -->
                            </div>
                          
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6" id="inputMobile">
                                    <label class="form-label cl-black">
                                        Điện thoại
                                        <span class="text-danger">*</span>
                                    </label>
                                    @foreach($user->user_addresses as $phoneNumber)
                                        <input id="phone{{$phoneNumber->id}}" type="text" style="display: none" name="phone" value="{{$phoneNumber->phoneNumber}}" class="form-control" placeholder="+84 (829) 111 111" aria-label="+84 (829) 111 111" data-msg="Hãy nhập số điện thoại của bạn!" data-error-class="u-has-error" data-success-class="u-has-success">
                                    @endforeach  
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label cl-black">
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" value="{{$user->email}}" class="form-control" name="emailAddress" placeholder="jackwayley@gmail.com" aria-label="jackwayley@gmail.com" required="" data-msg="Hãy nhập Email của bạn!" data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                                <!-- End Input -->
                            </div>

                            <div class="w-100"></div>
                        </div>
                    
                        <!-- End Billing Form -->

                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25 cl-black">Chi tiết vận chuyển</h3>
                        </div>
                        <!-- End Title -->
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Ghi chú đơn hàng (Nếu có)
                            </label>

                            <div class="input-group">
                                <textarea class="form-control p-5" rows="4" name="text" placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt cho giao hàng."></textarea>
                            </div>
                        </div>
                        <!-- End Input -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
<script>
    jQuery(document).ready(function () {
        $("#address").change(function() {
            var select = $("select option:selected").val();
            console.log(select);
            $("#phone"+select).css("display","block");
            $("input[name=phone]").not("#phone"+select).css("display","none");
        });
    });       
</script>